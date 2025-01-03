<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Exam;
use App\User;
use App\Role;
use App\Notification;
use App\Document;
use App\Question;
use App\Answer;
use App\QnaExam;
use App\ExamAttempt;

// excel
use App\Imports\QnaImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;

class AdminController extends Controller
{

    //show admin dashboard
    public function adminDashboard()
    {
        $subject = Subject::all()->count();
        $question = Question::all()->count();
        $exam = Exam::all()->count();
        $user = User::all()->count();
        return view('admin.dashboard', compact('subject', 'question', 'exam', 'user'));
    }

    // subject start
    public function subject()
    {
        $subjects = Subject::search()->paginate(10);

        $count_exam = Exam::select('subject_id', DB::raw('count(*) as total'))
            ->groupBy('subject_id')
            ->get('subject_id');

        $count_question = Question::select('subject_id', DB::raw('count(*) as total'))
            ->groupBy('subject_id')
            ->get();

        $count_document = Document::select('subject_id', DB::raw('count(*) as total'))
            ->groupBy('subject_id')
            ->get();

        return view('admin.subject', compact('count_exam', 'count_question', 'count_document', 'subjects'))
            ->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // add subject
    public function addSubject(Request $request)
    {
        $request->validate([
            'subject' => 'unique:subjects|required',
        ]);

        try {

            Subject::insert([
                'subject' => $request->subject
            ]);

            return response()->json(['success' => true, 'msg' => 'Thêm môn học thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Vui lòng kiểm tra laị tên môn học!']);
        }
    }

    //edit subject
    public function editSubject(Request $request)
    {
        try {

            $subject = Subject::find($request->id);
            $subject->subject = $request->subject;
            $subject->save();
            return response()->json(['success' => true, 'msg' => 'Sửa môn học thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //delete subject
    public function deleteSubject(Request $request)
    {
        try {
            // Kiểm tra xem có câu hỏi, đề thi, tài liệu nào liên quan đến môn học này không
            $hasQuestions = Question::where('subject_id', $request->id)->exists();
            $hasExams = Exam::where('subject_id', $request->id)->exists();
            $hasDocuments = Document::where('subject_id', $request->id)->exists();

            if ($hasQuestions || $hasExams || $hasDocuments) {
                // Nếu có, trả về thông báo lỗi
                return response()->json(['success' => false, 'msg' => 'Môn học đã được sử dụng, không thể xóa']);
            }

            // Nếu không, xóa môn học
            Subject::where('id', $request->id)->delete();

            return response()->json(['success' => true, 'msg' => 'Xóa môn học thành công!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //Exam
    public function exam(Request $request)
    {

        $subjects = Subject::all();

        // Số lượng mục trên mỗi trang
        $perPage = 10;

        // Tìm kiếm và phân trang kết quả
        $exams = Exam::search()->with('subjects')->paginate($perPage);

        return view('admin.exam', ['subjects' => $subjects, 'exams' => $exams]);
    }

    //add exam
    public function addExam(Request $request)
    {
        try {
            $unique_id = uniqid('exid');
            $request->validate([
                'exam_name' => 'unique:exams|required',
            ]);

            // Lưu thời gian dưới dạng phút
            $timeInMinutes = $request->time;

            Exam::insert([
                'exam_name' => $request->exam_name,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $timeInMinutes,
                'enterance_id' => $unique_id
            ]);

            return response()->json(['success' => true, 'msg' => 'Thêm đề thi thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //get exam detail
    public function getExamDetail($id)
    {
        try {

            $exam = Exam::where('id', $id)->get();

            return response()->json(['success' => true, 'data' => $exam]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }

    }

    //edit exam
    public function editExam(Request $request)
    {
        try {
            $exam = Exam::find($request->exam_id);
            $exam->exam_name = $request->exam_name;
            $exam->subject_id = $request->subject_id;
            $exam->date = $request->date;
            // Lưu thời gian dưới dạng phút
            $exam->time = $request->time;
            $exam->save();
            return response()->json(['success' => true, 'msg' => "Đề thi update thành công"]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //delete exam
    public function deleteExam(Request $request)
    {
        try {
            $examAttempts = ExamAttempt::where('exam_id', $request->exam_id)->count();
            if ($examAttempts > 0) {
                return response()->json(['success' => false, 'msg' => "Không thể xóa đề thi do đã có người làm bài thi"]);
            }
            QnaExam::where('exam_id', $request->exam_id)->delete();
            Exam::where('id', $request->exam_id)->delete();
            return response()->json(['success' => true, 'msg' => "Đề thi xóa thành công"]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //getQuestions
    public function getQuestions(Request $request)
    {
        try {
            // Get the exam_id and subject_id from the request
            $exam_id = $request->exam_id;
            $subject_id = $request->subject_id;

            // Filter the questions based on the subject_id
            $questions = Question::where('subject_id', $subject_id)->get();

            if (count($questions) > 0) {
                $data = [];
                $counter = 0;

                foreach ($questions as $question) {
                    $qnaExam = QnaExam::where(['exam_id' => $exam_id, 'question_id' => $question->id])->get();
                    if (count($qnaExam) == 0) {
                        $data[$counter]['id'] = $question->id;
                        $data[$counter]['questions'] = $question->question;
                        $counter++;
                    }
                }
                return response()->json(['success' => true, 'msg' => 'Questions data!', 'data' => $data]);
            } else {
                return response()->json(['success' => false, 'msg' => 'Questions not found!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //add question
    public function addQuestions(Request $request)
    {
        try {

            if (isset($request->questions_ids)) {

                foreach ($request->questions_ids as $qid) {

                    QnaExam::insert([
                        'exam_id' => $request->exam_id,
                        'question_id' => $qid

                    ]);

                }
            }
            return response()->json(['success' => false, 'msg' => "Questions added successfully!"]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //get exam question
    public function getExamQuestions(Request $request)
    {
        try {
            $data = QnaExam::where('exam_id', $request->exam_id)->with('question')->get();
            // In ra dữ liệu để kiểm tra
            error_log(print_r($data, true));
            return response()->json(['success' => false, 'msg' => "Questions details!", 'data' => $data]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

//    delete Exam Question
    public function deleteExamQuestions(Request $request)
    {
        try {
            // Lấy mảng các ID của hàng trong bảng QnaExam từ yêu cầu
            $qnaExamIds = $request->get('qna_exam_ids');

            // Xóa hàng
            QnaExam::destroy($qnaExamIds);

            // Trả về phản hồi thành công
            return response()->json([
                'success' => true,
                'message' => 'Các câu hỏi đã được xóa thành công khỏi đề thi'
            ], 200);
        } catch (\Exception $e) {
            // Trả về phản hồi lỗi nếu có lỗi xảy ra
            return response()->json([
                'success' => false,
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ], 500);
        }
    }

    // Q&A
    public function qnaDashboard(Request $request)
    {
        $subjects = Subject::all();
        $questions = Question::with('answers')->get();

        // Sử dụng phương thức search nếu có từ khóa tìm kiếm
        if ($request->has('key')) {
            $qna = Question::search()->paginate(10);
        } else {
            $qna = Question::paginate(10);
        }

        return view('admin.qnaDashboard', compact('questions', 'subjects', 'qna'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //Add Q&a
    public function addQna(Request $request)
    {
        $request->validate([
            'question' => 'unique:questions|required',
        ]);
        try {

            $questionId = Question::insertGetId([
                'question' => $request->question,
                'subject_id' => $request->subject_id
            ]);


            foreach ($request->answers as $answer) {
                $is_correct = 0;

                if ($request->is_correct == $answer) {
                    $is_correct = 1;
                }

                Answer::insert([
                    'questions_id' => $questionId,
                    'answer' => $answer,
                    'is_correct' => $is_correct
                ]);

            }
            return response()->json(['success' => true, 'msg' => "Thêm câu hỏi thành công"]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //UPLOAD IMAGE IN CKEDITOR
    public function upload(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path('media'), $fileName);
            $url = asset('public/media/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);

        }

    }

    //get answer
    public function getQnaDetails(Request $request)
    {
        $qna = Question::where('id', $request->qid)->with('answers')->get();

        return response()->json(['data' => $qna]);
    }

    //delete Answer
    public function deleteAns(Request $request)
    {
        Answer::where('id', $request->id)->delete();
        return response()->json(['success' => true, 'msg' => 'Xóa câu trả lời thành công!']);
    }

    //edit question
    public function updateQna(Request $request)
    {

        try {
            if (isset($request->question) && !empty($request->question)) {
                Question::where('id', $request->question_id)->update([
                    'question' => $request->question,
                    'subject_id' => $request->subject_id  // Thêm dòng này
                ]);
            } else {
                throw new \Exception('Câu hỏi không được để trống.');
            }
            //old answer update
            if (isset($request->answers)) {

                foreach ($request->answers as $key => $value) {

                    $is_correct = 0;
                    if ($request->is_correct == $value) {
                        $is_correct = 1;
                    }

                    Answer::where('id', $key)
                        ->update([
                            'questions_id' => $request->question_id,
                            'answer' => $value,
                            'is_correct' => $is_correct
                        ]);
                }
            }

            //new answer update
            if (isset($request->new_answers)) {

                foreach ($request->new_answers as $answer) {

                    $is_correct = 0;
                    if ($request->is_correct == $answer) {
                        $is_correct = 1;
                    }

                    Answer::insert([
                        'questions_id' => $request->question_id,
                        'answer' => $answer,
                        'is_correct' => $is_correct
                    ]);
                }
            }
            return response()->json(['success' => true, 'msg' => 'Update thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //delete question
    public function deleteQna(Request $request)
    {
        Question::where('id', $request->id)->delete();
        Answer::where('questions_id', $request->id)->delete();

        return response()->json(['success' => true, 'msg' => 'Delete thành công!']);
    }

    //import question excel
    public function importQna(Request $request)
    {
        try {
            // Kiểm tra xem 'subject_id' có tồn tại trong request không
            if (!$request->has('subject_id')) {
                return response()->json(['success' => false, 'msg' => 'subject_id is required']);
            }

            // Lấy id môn học từ request
            $subjectId = $request->input('subject_id');

            // Kiểm tra xem file đã được tải lên chưa
            if (!$request->hasFile('file')) {
                return response()->json(['success' => false, 'msg' => 'File is required']);
            }

            // Sử dụng id môn học trong import
            Excel::import(new QnaImport($subjectId), $request->file('file'));

            return response()->json(['success' => true, 'msg' => 'Import danh sách câu hỏi thành công!']);

        } catch (\Exception $e) {

            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // user dashboard
    public function userDashboard()
    {
        $users = User::search()->paginate(10);
        $roles = Role::all();
        return view('admin.userDashboard', compact('users', 'roles'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    // addUser
    public function addUser(Request $request)
    {
        try {

            $request->validate([
                'email' => 'unique:users|required',
                'name' => 'min:3|required',
                'phone' => 'min:10|max:11|required',
            ]);

            $password = Str::random(8);

            User::insert([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
                'gender' => $request->gender,
                'birth' => $request->birth,
                'phone' => $request->phone,
                'role' => $request->role,
            ]);

            $url = URL::to('/login');
            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['password'] = $password;
            $data['gender'] = $request->gender;
            $data['birth'] = $request->birth;
            $data['phone'] = $request->phone;
            $data['role'] = $request->role;
            $data['title'] = "Người dùng đăng ký trên FITA TEST";

            Mail::send('registrationMail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            return response()->json(['success' => true, 'msg' => 'Thêm người dùng thành công']);


        } catch (\Exception $e) {

            return response()->json(['success' => false, 'msg' => 'Kiểm tra lại email không được trùng, họ tên lớn hơn 3 ký tự, số điện thoại lớn hơn 10 số, nhỏ hơn 11 số']);
        }
    }

    //get user
    public function getUserDetail($id)
    {
        try {
            $user = User::where('id', $id)->first();

            return response()->json(['success' => true, 'data' => $user]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    // update user
    public function editUser(Request $request)
    {
        try {
            $request->validate([
                'name' => 'min:3|required',
                'phone' => 'min:10|max:11|required',
            ]);

            $user = User::find($request->id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->gender = $request->gender;
            $user->birth = $request->birth;
            $user->phone = $request->phone;
            $user->role = $request->role;
            $user->save();

            $url = URL::to('/login');

            $data['url'] = $url;
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['gender'] = $request->gender;
            $data['birth'] = $request->birth;
            $data['phone'] = $request->phone;
            $data['role'] = $request->role;

            $data['title'] = "Sửa Người dùng đăng ký trên FITA TEST";

            Mail::send('updateProfileMail', ['data' => $data], function ($message) use ($data) {
                $message->to($data['email'])->subject($data['title']);
            });

            return response()->json(['success' => true, 'msg' => "Người dùng update thành công"]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }

    }

    //delete user
    public function deleteUser(Request $request)
    {
        try {

            $a = User::where('id', $request->id)->delete();

            return response()->json(['success' => true, 'msg' => 'Người dùng đã được xóa!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);

        }
    }

    //manage user
    public function manageRole()
    {
        $roles = Role::search()->paginate(10);
        return view('admin.manage-role', compact('roles'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //add manage
    public function addManage(Request $request)
    {

        try {
            $request->validate([
                'name' => 'unique:roles|required'
            ]);

            Role::insert([
                'name' => $request->name
            ]);

            return response()->json(['success' => true, 'msg' => 'Thêm quyền thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Trùng tên quyền! Hãy chọn tên quyền khác!']);

        }
    }

    //edit Manage
    public function editManage(Request $request)
    {

        try {
            $request->validate([
                'name' => 'unique:roles|required'
            ]);

            $role = Role::find($request->id);
            $role->name = $request->name;
            $role->save();
            return response()->json(['success' => true, 'msg' => "Quyền update thành công"]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => "Quyền đã có vui lòng nhập tên quyền khác!"]);
        }

    }

    //delete manage
    public function deleteManage(Request $request)
    {
        try {

            Role::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Xóa quyền thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Không thể xóa quyền do quyền đang được người dùng sử dụng!']);
        }
    }

    //notification
    public function notification()
    {
        $notifications = Notification::search()->paginate(10);

        return view('admin.notification', compact('notifications'))->with('i', (request()->input('page', 1) - 1) * 10);
    }

    //add notification
    public function addNotification(Request $request)
    {
        try {
            $request->validate([
                'notification' => 'required',
                'time' => 'required'
            ]);

            Notification::insert([
                'notification' => $request->notification,
                'time' => $request->time,
                'date' => $request->date
            ]);

            return response()->json(['success' => true, 'msg' => 'Thêm thông báo thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Thêm thông báo không thành công!']);
        }
    }

    //edit notification
    public function editNotification(Request $request)
    {
        try {
            $request->validate([
                'notification' => 'required',
                'time' => 'required'
            ]);
            $notification = Notification::find($request->id);
            $notification->notification = $request->notification;
            $notification->time = $request->time;
            $notification->date = $request->date;
            $notification->save();
            return response()->json(['success' => true, 'msg' => 'Sửa thông báo thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Sửa thông báo không thành công!']);
        }
    }

    //delete notification
    public function deleteNotification(Request $request)
    {
        try {

            Notification::where('id', $request->id)->delete();
            return response()->json(['success' => true, 'msg' => 'Xóa thông báo thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Xóa thông báo không thành công!']);
        }
    }

    //document
    public function document()
    {
        $key = request()->key;
        $documents = Document::search()->paginate(10); // Sử dụng phương thức search
        $subjects = Subject::all();
        return view('admin.document', compact('documents', 'subjects'));
    }

    //add document
    public function addDocument(Request $request)
    {
        try {
            $maxFileSize = 64 * 1024 * 1024; // Giới hạn kích thước file là 64MB

            if ($request->file('document')->getSize() > $maxFileSize) {
                return response()->json(['success' => false, 'msg' => 'Bạn đã tải lên file quá lớn!']);
            }

            $request->validate([
                'name' => 'unique:documents|required',
                'document' => 'required|mimes:pdf'
            ]);

            // Lấy tên file gốc
            $originalFilename = $request->file('document')->getClientOriginalName();

            // Di chuyển file vào thư mục public/document với tên file gốc
            $request->file('document')->move(public_path('document'), $originalFilename);

            Document::insert([
                'name' => $request->name,
                'document' => $originalFilename, // Lưu tên file gốc vào cơ sở dữ liệu
                'subject_id' => $request->subject_id
            ]);

            return response()->json(['success' => true, 'msg' => 'Thêm tài liệu thành công!']);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Thêm tài liệu không thành công!']);
        }
    }

    //get document
    public function getDocumentDetail(Request $request, $id)
    {
        try {
            $document = Document::where('id', $id)->first();

            if ($document) {
                return response()->json(['success' => true, 'data' => $document]);
            } else {
                return response()->json(['success' => false, 'msg' => 'Không tìm thấy tài liệu!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Không thể lấy tài liệu!']);
        }
    }

    //get document
    public function getDocument($filename)
    {
        $path = public_path('document/' . $filename);

        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }

    // edit document
    public function editDocument(Request $request)
    {
        try {
            $document = Document::find($request->id);

            if ($document) {
                $maxFileSize = 64 * 1024 * 1024; // Giới hạn kích thước file là 64MB

                if ($request->hasFile('document') && $request->file('document')->getSize() > $maxFileSize) {
                    return response()->json(['success' => false, 'msg' => 'Bạn đã tải lên file quá lớn!']);
                }

                $request->validate([
                    'name' => 'required',
                    'document' => 'mimes:pdf,doc,docx'
                ]);

                // Lấy tên file gốc
                if ($request->hasFile('document')) {
                    $originalFilename = $request->file('document')->getClientOriginalName();

                    // Di chuyển file vào thư mục public/document với tên file gốc
                    $request->file('document')->move(public_path('document'), $originalFilename);

                    // Cập nhật tên file trong cơ sở dữ liệu
                    $document->document = $originalFilename;
                }

                $document->name = $request->name;
                $document->subject_id = $request->subject_id;
                $document->save();

                return response()->json(['success' => true, 'msg' => 'Cập nhật tài liệu thành công!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Không tìm thấy tài liệu!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Không thể cập nhật tài liệu!']);
        }
    }

    //delete document
    public function deleteDocument(Request $request)
    {
        try {
            $document = Document::find($request->id);

            if ($document) {
                $document->delete();
                return response()->json(['success' => true, 'msg' => 'Xóa tài liệu thành công!']);
            } else {
                return response()->json(['success' => false, 'msg' => 'Không tìm thấy tài liệu!']);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => 'Không thể xóa tài liệu!']);
        }
    }

    //get profile
    public function loadProfile()
    {
        // Lấy thông tin người dùng hiện tại từ database
        $user = Auth::user();

        // Trả về view với dữ liệu người dùng
        return view('admin.dashboard', ['user' => $user]);
    }

    // update profile
    public function updateProfile(Request $request, $id)
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
        $admin = User::find($id);

        // Cập nhật thông tin người dùng
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->gender = $request->gender;
        $admin->birth = $request->birth;
        $admin->phone = $request->phone;

        // Xử lý file avatar nếu có
        if ($request->hasFile('avatar')) {
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            $avatar->move(public_path('avatars'), $filename);
            $admin->avatar = $filename;
        }

        // Lưu thông tin người dùng
        $admin->save();

        return redirect()->route('dashboardAdmin', ['id' => $id])->with('status', 'Profile updated successfully!');
    }

}

