@extends('user.master')
@section('title', 'Tài liệu')
{{-- main content --}}
@section('main-content')
<div class="container-fluid" style="padding-left: 300px; padding-right: 300px;">
    <h2 class="text-center">Tên Tài liệu: {{ $document->name }}</h2> <!-- Hiển thị tên tài liệu -->
    <h3 class="text-center">Môn học: {{$document->subjects[0]['subject']}}</h3>
    <embed src="/public/document/{{ $document->document }}" class="text-center" type="application/pdf" width="100%" height="800px" />
    <div class="text-center">
        <a href="/user/document" class="btn btn-danger">
            <i class="bi bi-arrow-left"> Quay lại</i>
        </a>
    </div>
</div>

<style>
    embed {
        border: 1px solid #007bff; /* Blue border */
        border-radius: 10px; /* Rounded corners */
        transition: all 0.5s ease; /* Smooth transition */
    }


    .abc {
        text-align: center;
    }
    h2, h3 {
        color: #317894;
        text-align: center;
        margin-top: 20px;
        font-family: 'Arial', sans-serif;
        font-size: 2.5em;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        transition: all 0.5s ease;
        margin-bottom: 50px;
    }
    h2:hover {
        transform: scale(1.1);
        color: #0a3622;
    }

    h3:hover {
        transform: scale(1.1);
        color: #0a3622;
    }
</style>

@endsection
