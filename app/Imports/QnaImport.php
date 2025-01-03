<?php

namespace App\Imports;

use App\Question;
use App\Answer;

use Maatwebsite\Excel\Concerns\ToModel;

class QnaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $subjectId;

    public function __construct($subjectId)
    {
        $this->subjectId = $subjectId;
    }

    public function model(array $row)
    {
        \Log::info($row);

        if(isset($row[0]) && $row[0] != 'question'){
            $questionId = Question::insertGetId([
                'question' => $row[0],
                'subject_id' => $this->subjectId,
            ]);

            $correctIndex = isset($row[5]) ? intval($row[5]) : null; // Lấy số thứ tự của câu trả lời đúng từ cột G

            for ($i = 1; $i <= 4; $i++) // Chỉnh sửa vòng lặp để bắt đầu từ 1 và kết thúc ở 4
            {
                if(isset($row[$i]) && !empty($row[$i])){ // Kiểm tra xem ô không phải là trống

                    $is_correct = ($i == $correctIndex) ? 1 : 0; // So sánh chỉ số với số thứ tự của câu trả lời đúng

                    Answer::insert([
                        'questions_id' => $questionId,
                        'answer' => $row[$i],
                        'is_correct' => $is_correct
                    ]);
                }
            }
        }
    }
}
