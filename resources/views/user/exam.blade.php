@extends('user.master')
@section('title', 'Đề thi')
{{-- main content --}}
@section('main-content')
<h1 class="text-center" style="color: #0a3622"> Trang Đề thi</h1>

<div class="container-fluid">
    {{--search--}}
    <form class="example d-flex" action="">
        <input class="form-control flex-grow-1 me-2" type="text" placeholder="Tìm kiếm đề thi..." name="exam" class="w-80">
        <select class="form-control flex-grow-1 me-2" name="subject">
            <option value="" selected>Tìm kiếm theo môn học</option>
            @foreach($subjects as $subject)
                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
            @endforeach
        </select>
        <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
    </form>

    {{--table--}}
    <div class="card-body">
        {{-- table --}}
        <div class="table-responsive">
            <table class="table table-vcenter" id="examsTable">
                <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Đề thi</th>
                    <th class="text-center">Môn học</th>
                    <th class="text-center">Ngày tạo</th>
                    <th class="text-center">Thời gian (Phút)</th>
                    <th class="text-center">Số lượt thi</th>
                    <th class="text-center">Lịch sử làm bài</th>
                    <th class="text-center">Vào thi</th>
                </tr>
                </thead>
                <tbody>
                @if(count($exams) > 0)
                    @php $count = 1; @endphp
                    @foreach($exams as $exam)
                        @php
                           $user_id = Auth::user()->id; // ID của người dùng đăng nhập
                           $exam_id = $exam->id; // ID của bài kiểm tra
                           $attemptCount = \App\ExamAttempt::where('user_id', $user_id)
                               ->where('exam_id', $exam_id)
                               ->count();
                        @endphp
                        <tr>
                            <td class="text-center">{{$count++}}</td>
                            <td>{{$exam->exam_name}}</td>
                            <td>{{$exam->subjects[0]['subject']}}</td>
                            <td class="text-center">{{$exam->date}}</td>
                            <td class="text-center">{{$exam->time}} Phút</td>
                            <td class="text-center">{{$attemptCount}} lượt</td>
                            <td class="text-center">
                                <a href="{{ route('examAttempt', ['id' => $exam->enterance_id]) }}" class="btn btn-outline-secondary">
                                    <i class="bi bi-arrow-right-square-fill"> xem lịch sử bài thi</i>
                                </a>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('exam.dashboard', ['id' => $exam->enterance_id]) }}" class="btn btn-outline-success">
                                    <i class="bi bi-arrow-right-square-fill"> Vào thi</i>
                                </a>
                            </td>

                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">Không có đề thi nào để hiển thị!</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $exams->links() }}
        </div>
    </div>
</div>

{{--CSS cho trang đề thi--}}
<style>
    h1 {
        color: #317894;
        text-align: center;
        margin-top: 50px;
        font-family: 'Arial', sans-serif;
        font-size: 2.5em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: all 0.5s ease;
    }

    h1:hover {
        transform: scale(1.1);
        color: #0a3622;
    }

    .table-responsive {
        max-width: 1200px;
        margin: auto;
        display: flex;
        justify-content: center;
    }

    .table-responsive table {
        border-collapse: collapse;   /* Đảm bảo các đường kẻ của bảng không bị chồng chéo */
    }

    .table-responsive td, .table-responsive th {
        border-left: 1px solid #ddd;  /* Thêm đường kẻ dọc vào bên trái của mỗi ô */
        padding: 8px;                 /* Thêm đệm cho mỗi ô */
    }

    .table-responsive tr:nth-child(even) {
        background-color: #f2f2f2;    /* Thêm màu nền cho các hàng chẵn để dễ nhìn hơn */
    }


    .example {
        margin: 20px auto;
        max-width: 600px;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        border-radius: 5px;
        display: flex;
        flex-wrap: nowrap;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
    }

    .example input[type=text] {
        padding: 10px;
        margin: 8px 0;
        display: inline-block;
        border: none;
        background: #f1f1f1;
        flex-grow: 1;
        transition: 0.3s;
    }

    .example input[type=text]:focus {
        outline: none;
        box-shadow: 0 0 10px rgba(0,0,0,0.25);
    }

    .example button {
        padding: 10px;
        background-color: #fff;
        color: black;
        border: none;
        cursor: pointer;
        transition: 0.3s;
    }

    .example button:hover {
        color: white;
        background-color: #388da8;
        transform: scale(1.1);
    }

</style>

@endsection
