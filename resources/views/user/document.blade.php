@extends('user.master')
@section('title', 'Tài liệu')
{{-- main content --}}
@section('main-content')
<h1 class="text-center" style="margin-top: 50px; color: #317894">Trang Tài liệu</h1>
    <div class="container-fluid">
        <form class="example d-flex mb-4" action="">
            <input class="form-control flex-grow-1 me-2" type="text" placeholder="Tìm kiếm tài liệu.." name="document">
            <select class="form-control flex-grow-1 me-2" name="subject">
                <option value="" selected>Tìm kiếm theo môn học</option>
                @foreach($subjects as $subject)
                    <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                @endforeach
            </select>
            <button class="btn btn-outline-success" type="submit"><i class="bi bi-search"></i></button>
        </form>

        @foreach($subjects as $subject)
            @php
                $subjectDocuments = $documents->where('subject_id', $subject->id);
            @endphp
            @if(count($subjectDocuments) > 0)
                <h2 style="color: #842029; font-weight: bold;">Môn học: {{ $subject->subject }}</h2>
                <div class="row">
                    @foreach($subjectDocuments as $document)
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <div class="card-body" >
                                    <div>
                                        <h5 class="card-title" style="font-weight: bold">{{$document->name}}</h5>
                                        <h3 class="card-text" style="font-weight: bold; color: #0ea78b"><label>Môn học: </label> {{$document->subjects[0]['subject']}}</h3>
                                    </div>
                                <div class="card-footer">
                                    <a href="{{route('documentLoad', ['id' => $document->id])}}" class="btn btn-primary"><i class="bi bi-eye"></i> Xem</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach
    </div>

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

/* Color Scheme */
        body {
            background-color: #f8f9fa; /* Light background for contrast */
        }

        /* Card Design */
        .card {
            box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
            transition: 0.3s;
            border-radius: 10px; /* Rounded corners */
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
        }

        /* Typography */
         h1, h2, h5 {
            font-family: 'Open Sans', sans-serif;
        }

        /*button*/
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            color: #fff;
            transition: all 0.5s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
            color: #fff;
            transform: scale(1.1);
        }

        .btn-primary:focus, .btn-primary:active {
            box-shadow: 0 0 0 0.2rem rgba(38, 143, 255, 0.5);
        }



        .row {
            margin-left: 50px;
            margin-right: 50px;
            margin-top: 20px;
        }

        h2 {
            margin-left: 100px;
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
