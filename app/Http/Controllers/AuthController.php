<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use Illuminate\Http\Request;
use App\User;
use App\Subject;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\PasswordReset;
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;
use PharIo\Manifest\Email;


class AuthController extends Controller
{
    // landing page
    public function loadHomeDashboard(){
        $subjects = Subject::count();
        $questions = Question::count();
        $users = User::count();
        $exams = Exam::count();
        return view('user.home', compact('subjects','exams','questions', 'users'));

    }

    //load register
    public function loadRegister(){
        return view('register');
    }

    //register
    public function userRegister(Request $request){
        $request->validate([
            'name' => 'string|required|min:2',
            'email' => 'string|email|required|max:100|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Đăng ký thành công!');
    }

    //load login
    public function loadLogin(){
        if(Auth::user()){
            $route = $this->redirectDash();
            return redirect($route);
        }
        return view('login');
    }

    //login
    public function userLogin(Request $request){
        $request->validate([
            'email' => 'string|required|email',
            'password' => 'string|required'
        ]);

        $userCredential = $request->only('email', 'password');
        if(Auth::attempt($userCredential)){
            $route = $this->redirectDash();
            return redirect($route);
        }
        else{
            return back()->with('error','Tài khoản & mật khẩu không đúng');
        }

    }

    //phân trang
    public function redirectDash()
    {
        $redirect = '';

        if(Auth::user() && Auth::user()->role == 1){
            $redirect = '/admin/dashboard';
        }
        else{
            $redirect = '/user/dashboard';
        }
        return $redirect;
    }

    //logout
    public function logout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

    //forgot password load
    public function forgetPasswordLoad(Request $request){
        return view('forget-password');
    }

    //forgot password
    public function forgetPassword(Request $request){
        try{

            $user = User::where('email', $request->email)->get();
            if(count($user) > 0){
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain.'/reset-password?token='.$token;

                $data['url'] = $url;
                $data['email']= $request->email;
                $data['title']= 'Cập nhật mật khẩu';
                $data['body']= 'Nhấn vào đường link bên dưới';

                Mail::send('forgetPasswordMail',['data'=>$data],function($message) use ($data){
                    $message->to($data['email'])->subject($data['title']);
                });

                $dateTime = Carbon::now()->format('Y-m-d H:i:s');

                PasswordReset::updateOrCreate(
                    ['email'=>$request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'create_at' => $dateTime
                    ]
                );
                return back()->with('success','Kiểm tra lại email của bạn!');

            }else{
                return back()->with('error','Email không tồn tại!');
            }

        }catch(\Exception $e){
            return back()->with('error', $e->getMessage());
        }
    }

    //reset password load
    public function resetPasswordLoad(Request $request){
        $resetData = PasswordReset::where('token',$request->token)->get();

        if(isset($request->token) && count($resetData) > 0){
            $user =User::where('email', $resetData[0]['email'])->get();

            return view('resetPassword', compact('user'));
        }
        else{
            return view('404');
        }
}

    //reset password
    public function resetPassword(Request $request){
        $request->validate([
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::find($request->id);
        $user->password = Hash::make($request->password);
        $user->save();

        PasswordReset::where('email',$user->email)->delete();

        return
            "<h2>Mật khẩu của bạn được đổi thành công! </h2> <a href='/login'>Đăng nhập</a>";

    }

}
