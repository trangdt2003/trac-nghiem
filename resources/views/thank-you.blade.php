@extends('user.master')
@section('title', 'Đề thi')
{{-- main content --}}
@section('main-content')
    <div class="container">
        <div class="text-center">
            <h2>Cảm ơn bạn đã hoàn thành bài kiểm tra!</h2>
            <h1 style="color: red; font-weight: bold;">Điểm: {{$mark}} </h1>
            @if ($mark < 5)
                <h3>Hãy cố gắng luyện tập nhiều hơn để cải thiện được điểm số của bạn nhé</h3>
            @elseif ($mark < 10)
                <h3>Hãy cẩn thận hơn trong việc luyện tập đề thi nhé</h3>
            @endif
            <a href="/user/exam" class="btn btn-info">Quay lại trang đề thi</a>
        </div>
    </div>
    <style>
    body {
    background: #f8f9fa;
    font-family: 'Poppins', sans-serif;
    }

    .container {
    max-width: 960px;
    margin: auto;
    padding: 2rem;
    }

    .text-center h2 {
    font-size: 2.5rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
    }

    .text-center h1 {
    font-size: 3rem;
    color: #dc3545;
    margin-bottom: 1.5rem;
    }

    .text-center h3 {
    font-size: 1.5rem;
    color: #6c757d;
    margin-bottom: 1.5rem;
    }

    .btn-info {
    background-color: #0d6efd;
    border-color: #0d6efd;
    color: #fff;
    }

    .btn-info:hover {
    background-color: #0b5ed7;
    border-color: #0a58ca;
    }

    .password-field {
    position: relative;
    }

    .password-field i {
    position: absolute;
    right: 10px;
    top: 10px;
    cursor: pointer;
    }
    </style>
@endsection
