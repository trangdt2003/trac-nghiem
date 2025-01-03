@extends('user.master')
@section('title', 'Đề thi')
{{-- main content --}}
@section('main-content')
<div class="container-fluid">
    <h2 class="text-center">Lịch sử đề thi</h2>
    @php $qcount = 1; @endphp
    @if($success == true)
        @if(count($answers) > 0)
            @foreach($answers as $answer)
                <div class="question-container">
                    <h5>Câu hỏi {{$qcount++}}: {!! ( $answer->question->question ) !!}</h5> <!-- Hiển thị nội dung câu hỏi -->
                    <div class="answer-container">
                        @foreach($answer->question->answers->chunk(2) as $chunk)
                            <div class="row">
                                @foreach($chunk as $ans)
                                    <div class="col-md-6 answer-item">
                                        <input type="radio" name="radio_{{$qcount-1}}" data-id="{{$qcount-1}}" class="select_ans" value="{{$ans->id}}" {{ $ans->id == $answer->answer_id ? 'checked' : '' }} disabled>
                                        {{strip_tags( $ans->answer)  }} <!-- Hiển thị nội dung đáp án -->
                                        @if($ans->is_correct == 1)
                                            <span class="correct"><i class="bi bi-check"></i></span> <!-- Hiển thị dấu tích xanh nếu đáp án đúng -->
                                        @elseif($ans->id == $answer->answer_id && $ans->is_correct == 0)
                                            <span class="incorrect"><i class="bi bi-x"></i></span> <!-- Hiển thị dấu X đỏ nếu đáp án sai -->
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        @else
            <h3 style="color: red;" class="text-center" >Câu hỏi và câu trả lời không khả dụng!</h3>
        @endif
    @else
        <h3 style="color:red;" class="text-center">{{$msg}}</h3>
    @endif
    <div class="text-center">
        <a href="{{ route('examAttempt', ['id' => $exam->enterance_id]) }}" class="btn btn-primary text-center" id="back"> <i class="bi bi-arrow-left"> Quay lại</i></a>
    </div>
</div>

<style>
    #back {
        border: 2px solid #388da8 !important; /* Đặt viền màu xanh */
        background-color: white !important; /* Đặt nền màu trắng */
        color: #388da8 !important; /* Đặt màu chữ màu xanh */
        margin-bottom: 30px;
    }

    #back:hover{
        background-color: #388da8 !important;
        color: white !important;
    }

    .correct {
        color: green;
        font-size: 1.5em;
    }
    .incorrect {
        color: red;
        font-size: 1.5em;
    }
    .question-container {
        margin-left: 100px;
        margin-bottom: 1em;
    }
    .answer-container {
        margin-left: 1em;
    }
</style>

<script>
    document.addEventListener('copy', function(e) {
        e.preventDefault();
        alert('Sao chép nội dung trên trang web này đã bị vô hiệu hóa.');
    });
</script>
@endsection
