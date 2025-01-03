@extends('user.master')
@section('title', 'Đề thi')
{{-- main content --}}
@section('main-content')
<div class="container-fluid">
<h1 class="text-center" style="color: #0b856f">Lịch sử lần thi</h1>
    <a href="/user/exam" id="back" class="btn btn-danger">
        <i class="bi bi-arrow-left"> Quay lại</i>
    </a>
    <div class="card-body">
        {{-- table --}}
        <div class="table-responsive">
            <table class="table table-vcenter" id="examsTable">
                <thead>
                    <tr>
                        <th class="text-center">Đề thi</th>
                        <th class="text-center">Lần thi</th>
                        <th class="text-center">Điểm</th>
                        <th class="text-center">Xem đề thi</th>
                    </tr>
                </thead>
                <tbody>
                @if(count($attempts) > 0)
                    @php $count = 1; @endphp
                    @foreach($attempts as $attempt)
                        <tr>
                            <td class="text-center">{{ $attempt->exam ? $attempt->exam->exam_name : 'N/A' }}</td>
                            <td class="text-center">{{ $count++ }}</td>
                            <td class="text-center">{{ $attempt->marks }}</td>
                            <td class="text-center">
                                <a href="{{ route('examHistory', ['id' => $exam->enterance_id, 'attempt_id' => $attempt->id]) }}" class="btn btn-outline-success">
                                    <i class="bi bi-arrow-right-square-fill">Xem bài thi cũ</i>
                                </a>

                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8">Không có lịch sử đề thi nào để hiển thị!</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    #back {
        border: 2px solid #388da8 !important; /* Đặt viền màu xanh */
        background-color: white !important; /* Đặt nền màu trắng */
        color: #388da8 !important; /* Đặt màu chữ màu xanh */
        margin-left: 70px;
    }

    .table-responsive {
        max-width: 1000px;
        margin: auto;
        display: flex;
        justify-content: center;
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

    .bubble {
        position: absolute;
        border-radius: 50%;
        background-color: #388da8;
        animation: float 10s ease-in-out infinite;
    }

    @keyframes float {
        0% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-100px);
        }
        100% {
            transform: translateY(0px);
        }
    }

</style>

@endsection
