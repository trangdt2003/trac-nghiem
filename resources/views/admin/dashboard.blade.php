@extends('admin.master')
@section('title', 'trang quản trị')
{{-- main content --}}
@section('main-content')
<div class="container-fluid">
    {{-- Môn học --}}
    <div class="content flex-grow-1 d-flex">
        <div class="card overflow-hidden bg-blue text-white">
            <div class="card-body p-4">
                <h5 class="card-title mb-9 fw-semibold">Môn học</h5>
                <div class="row align-items-center">
                    <div class="col-8">
                        <h4 class="fw-semibold mb-3">{{$subject}}</h4>
                        <a href="/admin/subject">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>

    {{-- Câu hỏi --}}
    <div class="card overflow-hidden bg-green text-dark">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Câu hỏi</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3">{{$question}}</h4>
                    <a href="/admin/qna-ans">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Đề thi --}}
    <div class="card overflow-hidden bg-yellow text-dark">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold">Đề thi</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3">{{$exam}}</h4>
                    <a href="/admin/exam">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Người dùng --}}
    <div class="card overflow-hidden bg-red text-white">
        <div class="card-body p-4">
            <h5 class="card-title mb-9 fw-semibold" style="font-weight: bold">Người dùng</h5>
            <div class="row align-items-center">
                <div class="col-8">
                    <h4 class="fw-semibold mb-3" style="font-weight: bold">{{$user}}</h4>
                    <a href="/admin/users">Xem thêm</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /*color*/
    .bg-blue {
        background-color: #79CDCD; /* Màu xanh dương */
    }
    .text-white {
        color: #ffffff; /* Màu chữ trắng */
    }

    .bg-green {
        background-color: #F4A460; /* Màu xanh lá */
    }
    .text-dark {
        color: #343a40; /* Màu chữ đen */
    }

    .bg-yellow {
        background-color: #F3C246; /* Màu vàng */
    }

    .bg-red {
        background-color: #EE6363; /* Màu đỏ */
    }

    .container-fluid {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .content {
        flex-grow: 1;
        display: flex;
    }

    .card {
        flex: 1 0 auto;
        margin: 10px;
    }
</style>
@endsection
