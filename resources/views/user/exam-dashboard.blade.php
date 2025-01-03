@extends('user.master')
{{-- main content --}}
@section('main-content')
<div class="container">
    <a href="/user/exam" class="btn btn-danger">
        <i class="bi bi-arrow-left"> Quay lại</i>
    </a>
    <p style="color: black">Chào mừng {{ Auth::user()->name }} đã tới với bài thi</p>
    <h1 class="text-center">Bài thi: {{$exam[0]['exam_name'] }}</h1>
    <h4 style="color: rebeccapurple" class="text-center time">{{$exam[0]['time'] }}</h4>
    @php
        // Chuyển đổi thời gian từ giờ sang phút
        $timeInMinutes = $exam[0]['time'];
        $time = [$timeInMinutes, 0];
    @endphp

    <div id="questionIndicators">
        @foreach($qna as $index => $data)
            <div class="questionIndicator" id="questionIndicator{{$index+1}}" data-question-id="{{$index+1}}">{{$index+1}}</div>
        @endforeach
    </div>
    @php $qcount = 1; @endphp

    @if($success == true)
        @if(count($qna) > 0)
            <form action="{{route('examSubmit')}}" id="examForm" method="POST" class="mb-5" onsubmit="return isValid()">
                @csrf
                <input type="hidden" name="exam_id" value=" {{$exam[0]['id'] }}">
                @foreach($qna as $data)
                    <div class="question-container">
                        <h5>Câu hỏi {{$qcount++}}: {!! html_entity_decode($data['question'][0]['question']) !!}</h5>
                        <input type="hidden" name="q[]" value="{{$data['question'][0]['id']}}">
                        <input type="hidden" name="correct_ans[]" value="{{$data['question'][0]['correct_answer_id']}}">
                        <input type="hidden" name="ans_{{$qcount-1}}" id="ans_{{$qcount-1}}">

                        <div class="answer-container">
                        @foreach($data['question'][0]['answers'] as $answer)
                                <div class="answer-item">
                                <input type="radio" name="radio_{{$qcount-1}}" data-id="{{$qcount-1}}" class="select_ans" value="{{$answer['id']}}">
                                {{strip_tags($answer['answer'])}}
                                </div>
                        @endforeach
                        </div>
                    </div>
                @endforeach
                <div class="button-container">
                    <button type="button" id="prev" class="btn btn-info">
                        <i class="bi bi-arrow-bar-left"> Quay lại</i></button>
                    <button type="button" id="next" class="btn btn-info"> Tiếp theo
                        <i class="bi bi-arrow-bar-right"></i>
                    </button>
                </div>

                <div class="text-center">
                    <input type="submit" id="submitBtn" class="btn btn-danger submit" value="Nộp bài">
                </div>
            </form>
        @else
            <h3 style="color: red;" class="text-center" >Câu hỏi và câu trả lời không khả dụng!</h3>
        @endif
    @else
        <h3 style="color:red;" class="text-center">{{$msg}}</h3>
    @endif
</div>

<style>
    #questionIndicators {
        position: fixed; /* Khóa vị trí của danh sách hình tròn */
        top: 100px; /* Đặt vị trí từ phía trên của màn hình */
        right: 100px; /* Đặt vị trí từ phía phải của màn hình */
    }

    .questionIndicator {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        background-color: grey;
        color: white;
        text-align: center;
        line-height: 30px;
        margin-top: 7px;
        display: inline-block;
    }
    .answer-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .answer-item {
        width: 45%; /* Adjust this value to create the desired space between items */
        margin-bottom: 10px;
    }

    .question-container {
        display: none; /* Ẩn tất cả các câu hỏi */
        padding: 20px; /* Thêm đệm cho câu hỏi */
        margin-bottom: 10px; /* Thêm không gian dưới câu hỏi */
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5); /* Thêm bóng cho khung */
        border: none; /* Loại bỏ viền */
        background-color: #f0f0f0; /* Đặt màu nền của khung là màu xám */
        width: 80%; /* Đặt chiều rộng của khung */
        margin: auto; /* Căn giữa khung */
    }
    .question-container.active {
        display: block; /* Hiển thị câu hỏi hiện tại */
    }
    .select_ans {
        appearance: none; /* Loại bỏ giao diện mặc định của radio button */
        width: 20px; /* Đặt chiều rộng của radio button */
        height: 20px; /* Đặt chiều cao của radio button */
        background: #fff; /* Đặt màu nền của radio button */
        border: 1px solid #000; /* Thêm viền cho radio button */
    }
    .select_ans:checked {
        background: #12e581; /* Đổi màu nền của radio button khi được chọn */
    }

    .submit {
        margin-top: 20px; /* Thêm lề trên nút */

    }
    .button-container {
        margin-left: 130px;
        width: 80%; /* Chiều rộng tối đa */
        display: flex; /* Sử dụng flexbox để căn chỉnh các nút */
        justify-content: space-between; /* Đặt không gian đều giữa các nút */
        margin-top: 10px; /* Thêm lề trên 10px */
    }

</style>

<script>
    document.addEventListener('copy', function(e) {
        e.preventDefault();
        alert('Sao chép nội dung trên trang web này đã bị vô hiệu hóa.');
    });

    $(document).ready(function (){
        // Cập nhật màu của hình tròn biểu thị câu hỏi khi người dùng chọn một câu trả lời
        $('input[type=radio]').change(function() {
            var questionNumber = $(this).attr('name').replace('radio_', '');
            $('#questionIndicator' + questionNumber).css('background-color', 'green');
        });

        $('.select_ans').click(function (){
            var no = $(this).attr('data-id');
            $('#ans_'+no).val($(this).val());
        });

        var time = @json($time);
        $('.time').text('Thời gian ' +time[0]+':'+time[1]+ ' hết giờ')

        var seconds =  0;
        var minutes = time[0];

        var intervalId = setInterval(() => {

            if(minutes <= 0 && seconds <= 0){
                // Nếu thời gian hết, tự động nộp bài và dừng đếm ngược
                clearInterval(intervalId);
                document.getElementById('examForm').submit();
                return;
            }

            if(seconds <= 0){
                minutes--;
                seconds = 59;
            }

            let tempMinutes = minutes.toString().length > 1? minutes: '0'+minutes;
            let tempSeconds = seconds.toString().length > 1? seconds: '0'+seconds;

            $('.time').text('Thời gian ' +tempMinutes+':' +tempSeconds+ ' hết giờ');

            seconds--;

        }, 1000)

    });

    //  cảnh báo chọn câu trả lời
    {{--function isValid(){--}}
    {{--    var result = true;--}}

    {{--    var qlength = parseInt("{{$qcount}}")-1;--}}

    {{--    $('.error_msg').remove();--}}

    {{--    for (let i = 1; i <= qlength; i++){--}}
    {{--        if($('#ans_'+i).val() == ""){--}}
    {{--            result = false;--}}
    {{--            $('#ans_'+i).parent().append('<span style="color: red;" class="error_msg">Hãy chọn câu trả lời!</span>');--}}
    {{--            setTimeout(() => {--}}
    {{--                $('.error_msg').remove();--}}
    {{--            }, 5000);--}}

    {{--        }--}}
    {{--    }--}}

    {{--    return result;--}}
    {{--}--}}

    window.onload = function() {
        var questions = document.getElementsByClassName('question-container');
        var currentQuestion = 0;

        // Hiển thị câu hỏi đầu tiên
        questions[currentQuestion].classList.add('active');

        // Thêm sự kiện cho tất cả các nút radio
        // var radios = document.getElementsByClassName('select_ans');
        // for (var i = 0; i < radios.length; i++) {
        //     radios[i].addEventListener('change', function() {
        //         // Ẩn câu hỏi hiện tại
        //         questions[currentQuestion].classList.remove('active');
        //
        //         // Hiển thị câu hỏi tiếp theo
        //         currentQuestion++;
        //         if (currentQuestion < questions.length) {
        //             questions[currentQuestion].classList.add('active');
        //         }
        //     });
        // }


        // Thêm sự kiện cho nút quay lại
        document.getElementById('prev').addEventListener('click', function() {
            if (currentQuestion > 0) {
                // Ẩn câu hỏi hiện tại
                questions[currentQuestion].classList.remove('active');

                // Hiển thị câu hỏi trước đó
                currentQuestion--;
                questions[currentQuestion].classList.add('active');
            }
        });

        // Thêm sự kiện cho nút tiếp theo
        document.getElementById('next').addEventListener('click', function() {
            if (currentQuestion < questions.length - 1) {
                // Ẩn câu hỏi hiện tại
                questions[currentQuestion].classList.remove('active');

                // Hiển thị câu hỏi tiếp theo
                currentQuestion++;
                questions[currentQuestion].classList.add('active');
            }
        });
    };
</script>

@endsection
