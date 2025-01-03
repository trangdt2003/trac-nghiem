<?php

namespace App\Http\Controllers;

use App\Exam;
use App\Question;
use App\Subject;
use App\User;
use App\Document;
use App\Notification;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //dashboard user
    public function Dashboard()
    {
        // Lấy ngày và thời gian hiện tại
        $currentDateTime = new \DateTime();

        // Lấy thông báo từ cơ sở dữ liệu
        $notifications = Notification::all();
        $notification_count = 0;

        foreach ($notifications as $key => $notification) {
            // Kết hợp ngày và thời gian của thông báo
            $notificationDateTime = new \DateTime($notification->date . ' ' . $notification->time);

            // Tính số giờ chênh lệch giữa thời gian hiện tại và thời gian của thông báo
            $hoursDifference = $currentDateTime->diff($notificationDateTime)->h;

            // Nếu chênh lệch nhỏ hơn hoặc bằng 24 giờ, tăng biến đếm
            if ($hoursDifference <= 24) {
                $notification_count++;
            } else {
                // Nếu chênh lệch lớn hơn 24 giờ, loại bỏ thông báo khỏi mảng
                unset($notifications[$key]);
            }
        }
        // Truyền thông báo vào view
        return view('user.dashboard', ['notifications' => $notifications, 'notification_count' => $notification_count]);
    }

    //show exam
    public function exam(Request $request)
    {
        // Lấy ngày và thời gian hiện tại
        $currentDateTime = new \DateTime();

        // Lấy thông báo từ cơ sở dữ liệu
        $notifications = Notification::all();
        $notification_count = 0;

        foreach ($notifications as $key => $notification) {
            // Kết hợp ngày và thời gian của thông báo
            $notificationDateTime = new \DateTime($notification->date . ' ' . $notification->time);

            // Tính số giờ chênh lệch giữa thời gian hiện tại và thời gian của thông báo
            $hoursDifference = $currentDateTime->diff($notificationDateTime)->h;

            // Nếu chênh lệch nhỏ hơn hoặc bằng 24 giờ, tăng biến đếm
            if ($hoursDifference <= 24) {
                $notification_count++;
            } else {
                // Nếu chênh lệch lớn hơn 24 giờ, loại bỏ thông báo khỏi mảng
                unset($notifications[$key]);
            }
        }

        // truy vấn môn học
        $subjects = Subject::all();

        $searchExam = $request->get('exam');
        $searchSubject = $request->get('subject');

        $exams = Exam::with('subjects')
            ->when($searchExam, function ($query, $searchExam) {
                return $query->where('exam_name', 'like', '%' . $searchExam . '%');
            })
            ->when($searchSubject, function ($query, $searchSubject) {
                return $query->whereHas('subjects', function ($query) use ($searchSubject) {
                    $query->where('id', $searchSubject);
                });
            })
            ->orderBy('date', 'desc')
            ->paginate(10); // Số lượng mục trên mỗi trang

        return view('user.exam',['exams'=>$exams, 'notifications' => $notifications, 'notification_count' => $notification_count, 'subjects'=>$subjects]);
    }

    //Show documentDashboard
    public function document(Request $request)
    {
        // Lấy ngày và thời gian hiện tại
        $currentDateTime = new \DateTime();

        // Lấy thông báo từ cơ sở dữ liệu
        $notifications = Notification::all();
        $notification_count = 0;

        foreach ($notifications as $key => $notification) {
            // Kết hợp ngày và thời gian của thông báo
            $notificationDateTime = new \DateTime($notification->date . ' ' . $notification->time);

            // Tính số giờ chênh lệch giữa thời gian hiện tại và thời gian của thông báo
            $hoursDifference = $currentDateTime->diff($notificationDateTime)->h;

            // Nếu chênh lệch nhỏ hơn hoặc bằng 24 giờ, tăng biến đếm
            if ($hoursDifference <= 24) {
                $notification_count++;
            } else {
                // Nếu chênh lệch lớn hơn 24 giờ, loại bỏ thông báo khỏi mảng
                unset($notifications[$key]);
            }
        }

        // Lấy danh sách môn học từ cơ sở dữ liệu
        $subjects = Subject::all();

        $searchDocument = $request->get('document');
        $searchSubject = $request->get('subject');

        $documents = Document::with('subjects')
            ->when($searchDocument, function ($query, $searchDocument) {
                return $query->where('name', 'like', '%' . $searchDocument . '%');
            })
            ->when($searchSubject, function ($query, $searchSubject) {
                return $query->whereHas('subjects', function ($query) use ($searchSubject) {
                    $query->where('id', $searchSubject);
                });
            })
            ->get(); // Số lượng mục trên mỗi trang

        return view('user.document',['documents'=>$documents, 'notifications' => $notifications, 'notification_count' => $notification_count, 'subjects'=>$subjects]);
    }

    //load document
    public function documentLoad($id)
    {
        // Lấy ngày và thời gian hiện tại
        $currentDateTime = new \DateTime();

        // Lấy thông báo từ cơ sở dữ liệu
        $notifications = Notification::all();
        $notification_count = 0;

        foreach ($notifications as $key => $notification) {
            // Kết hợp ngày và thời gian của thông báo
            $notificationDateTime = new \DateTime($notification->date . ' ' . $notification->time);

            // Tính số giờ chênh lệch giữa thời gian hiện tại và thời gian của thông báo
            $hoursDifference = $currentDateTime->diff($notificationDateTime)->h;

            // Nếu chênh lệch nhỏ hơn hoặc bằng 24 giờ, tăng biến đếm
            if ($hoursDifference <= 24) {
                $notification_count++;
            } else {
                // Nếu chênh lệch lớn hơn 24 giờ, loại bỏ thông báo khỏi mảng
                unset($notifications[$key]);
            }
        }

        // Tìm tài liệu dựa trên ID
        $document = Document::find($id);

        // Kiểm tra xem tài liệu có tồn tại không
        if ($document) {

            return view('user.document-dashboard', ['success'=>true, 'document'=>$document, 'notifications' => $notifications, 'notification_count' => $notification_count]);

        } else {
            return back()->with('error', 'Không tìm thấy tài liệu!');
        }
    }

    //load profile User
    public function loadUserProfile()
    {
        // Lấy thông tin người dùng hiện tại từ database
        $user = Auth::user();

        // Trả về view với dữ liệu người dùng
        return view('user.dashboard', ['user' => $user]);
    }

    //User update profile
    public function updateUserProfile(Request $request, $id)
    {
        // Validate request data
        $request->validate([
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required',
            'email' => 'required|email',
            'gender' => 'required',
            'birth' => 'required|date',
            'phone' => 'required',
        ]);

        // Lấy thông tin người dùng từ database
        $user = User::find($id);

        // Cập nhật thông tin người dùng
        $user->name = $request->name;
        $user->email = $request->email;
        $user->gender = $request->gender;
        $user->birth = $request->birth;
        $user->phone = $request->phone;

        // Xử lý file avatar nếu có
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }

        // Lưu thông tin người dùng
        $user->save();
    }

}

































