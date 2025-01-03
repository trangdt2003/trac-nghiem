<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use App\Exam;
use App\QnaExam;
use App\ExamAnswer;
use App\ExamAttempt;
use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    //load examDashboard
    public function loadExamDashboard($id)
    {
        $qna = []; // Khởi tạo $qna với một mảng rỗng
        $notifications = Notification::all();
        $notification_count = count($notifications);

        $qnaExam = Exam::where('enterance_id', $id)
            ->with(['getQnaExam'])
            ->get();
        if(count($qnaExam) > 0){
            if (count($qnaExam[0]['getQnaExam']) > 0) {
                $qna = QnaExam::where('exam_id', $qnaExam[0]['id'])->with('question','answers')->inRandomOrder()->get();
                return view('user.exam-dashboard', ['success'=>true, 'exam'=>$qnaExam,'qna'=>$qna, 'notifications' => $notifications, 'notification_count'=>$notification_count]);
            }else{
                return view('user.exam-dashboard', ['success'=>false, 'msg' => 'Đề thi không khả dụng!', 'exam'=>$qnaExam, 'qna'=>$qna,'notifications' => $notifications, 'notification_count'=>$notification_count]);
            }
        }else{
            return view('404');
        }
    }

    //Submit exam
    public function examSubmit(Request $request)
    {
        $notifications = Notification::all();
        $notification_count = count($notifications);

        $attempt_id = ExamAttempt::insertGetId([
            'exam_id' => $request->exam_id,
            'user_id' => Auth::user()->id,
        ]);

        $qcount = count($request->q);
        $totalQuestions = $qcount;
        $correctAnswers = 0;

        if ($qcount > 0) {
            for ($i = 0; $i < $qcount; $i++) {
                $question_id = $request->q[$i];
                $answer_id = request()->input('ans_' . ($i + 1));

                ExamAnswer::insert([
                    'attempt_id' => $attempt_id,
                    'question_id' => $question_id,
                    'answer_id' => $answer_id,
                ]);

                // Kiểm tra câu trả lời của người dùng
                $is_correct = QnaExam::where('question_id', $question_id)
                    ->whereHas('answers', function ($query) use ($answer_id) {
                        $query->where('id', $answer_id)
                            ->where('is_correct', 1);
                    })
                    ->exists();

                if ($is_correct) {
                    $correctAnswers++;
                }
            }


            // Tính điểm
            $mark = round(($correctAnswers / $totalQuestions) * 10,2); // Điểm tối đa là 10, làm tròn 2 chữ số sau dấu phẩy

            // Lưu điểm vào cơ sở dữ liệu, cập nhật trạng thái
            ExamAttempt::where('id', $attempt_id)->update(['marks' => $mark, 'status' => 1]);

            // Cập nhật số lần thử
            $attemptCount = ExamAttempt::where('user_id', Auth::user()->id)
                ->where('exam_id', $request->exam_id)
                ->count();
            Exam::where('id', $request->exam_id)->update(['attempt' => $attemptCount]);
        }
        return view('thank-you', ['mark' => $mark, 'notifications' => $notifications,'notification_count'=>$notification_count]);

    }

    //load examAttempt
    public function examAttempt($id)
    {
        $notifications = Notification::all();
        $notification_count = count($notifications);
        // Lấy thông tin về bài thi
        $exam = Exam::where('enterance_id', $id)->first();

        if($exam){
            // Lấy id của người dùng hiện tại
            $user_id = auth()->user()->id;

            // Lấy danh sách các lần làm bài của bài thi này theo người dùng
            $attempts = ExamAttempt::where('exam_id', $exam->id)->where('user_id', $user_id)->get();

            if(count($attempts) > 0){
                return view('user.attempt', ['success'=>true, 'exam'=>$exam,'attempts'=>$attempts,'notifications' => $notifications, 'notification_count'=>$notification_count]);
            }else{
                return view('user.attempt', ['success'=>false, 'msg' => 'Không có lịch sử làm bài!', 'exam'=>$exam, 'attempts'=>[], 'notifications' => $notifications, 'notification_count'=>$notification_count]);
            }
        }else{
            return view('404');
        }
    }

    //load examHistory
    public function examHistory($id, $attempt_id)
    {
        $notifications = Notification::all();
        $notification_count = count($notifications);
        // Lấy thông tin về bài thi
        $exam = Exam::where('enterance_id', $id)->first();

        if($exam){
            // Lấy thông tin về lần làm bài cụ thể
            $attempt = ExamAttempt::where('exam_id', $exam->id)->where('id', $attempt_id)->first();

            if($attempt){
                // Lấy danh sách các câu trả lời cho lần làm bài này
                $answers = ExamAnswer::where('attempt_id', $attempt->id)->get();

                foreach ($answers as $answer) {
                    $question = $answer->question;
                    $answerContent = $answer->answer;
                    // Bạn có thể sử dụng $question và $answerContent ở đây
                }

                return view('user.history', ['success'=>true, 'exam'=>$exam, 'attempt'=>$attempt, 'answers'=>$answers,'notifications' => $notifications, 'notification_count'=>$notification_count]);
            }else{
                return view('user.history', ['success'=>false, 'msg' => 'Không tìm thấy lần làm bài!', 'exam'=>$exam, 'notifications' => $notifications, 'notification_count'=>$notification_count]);
            }
        }else{
            return view('404');
        }
    }

}

