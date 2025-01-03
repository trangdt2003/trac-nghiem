@extends('admin.master')
@section('title', 'Câu hỏi')
{{-- main content --}}
@section('main-content')
<div class="container-fluid">
    <form class="example" action="" >
        <input type="text" placeholder="Tìm kiếm.." name="key" onkeyup="searchTable()" class="w-80">
        <button type="submit" class="btn btn-primary">Tìm kiếm </button>
    </form>
    <div class="card">
    </div>
    <div class="card-body">
        <!-- Button Add Question modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addQnaModal">
            + Thêm câu hỏi
        </button>

        <!-- Button Import Question modal -->
        <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#importQnaModal">
            + Thêm danh sách câu hỏi
        </button>

        <!-- Modal Add -->
        <div class="modal fade" id="addQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addQna">
                        @csrf
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Môn học</label>
                                    <select name="subject_id" class="form-control form-control-alt" >
                                        <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                        @if(count($subjects) > 0)
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label class="form-label">Câu hỏi</label>
                                    <textarea  class="form-control form-control-alt" name="question" id="ckeditor" placeholder="Nhập câu hỏi"></textarea>
                                    <label class="form-label">Câu trả lời 1</label></br>
                                    <input type="radio" name="is_correct" class="is_correct" value="1"> Câu trả lời đúng
                                    <textarea  class="form-control form-control-alt" name="answers[]" id="ckeditor1"  placeholder="Nhập câu trả lời" ></textarea>
                                    <label class="form-label">Câu trả lời 2</label></br>
                                    <input type="radio" name="is_correct" class="is_correct" value="2"> Câu trả lời đúng
                                    <textarea  class="form-control form-control-alt" name="answers[]" id="ckeditor2"  placeholder="Nhập câu trả lời" ></textarea>
                                    <label class="form-label">Câu trả lời 3</label></br>
                                    <input type="radio" name="is_correct" class="is_correct" value="3"> Câu trả lời đúng
                                    <textarea class="form-control form-control-alt" name="answers[]" id="ckeditor3"  placeholder="Nhập câu trả lời" ></textarea>
                                    <label class="form-label">Câu trả lời 4</label></br>
                                    <input type="radio" name="is_correct" class="is_correct" value="4"> Câu trả lời đúng
                                    <textarea  class="form-control form-control-alt" name="answers[]" id="ckeditor4"  placeholder="Nhập câu trả lời" ></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <span class="error" style="color: red;"></span>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Thêm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Show answer Modal -->
        <div class="modal fade" id="showAnsModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Câu trả lời</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                            <th class="text-center">Mã câu trả lời</th>
                            <th class="text-center">Câu trả lời</th>
                            <th class="text-center">Câu trả lời đúng</th>
                            </thead>
                            <tbody class="showAnswers">

                            </tbody>
                        </table>
                    </div>

                    <div class="modal-footer">
                        <span class="error" style="color: red;"></span>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                    </div>
                </div>
            </div>
        </div>

        <!--Edit Modal -->
        <div class="modal fade" id="editQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="editQna">
                        @csrf
                        <div class="modal-body editModalAnswers">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Môn học</label>
                                    <select name="subject_id"  id="subject_id" class="form-control form-control-alt" >
                                        <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                        @if(count($subjects) > 0)
                                            @foreach($subjects as $subject)
                                                <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                    <label class="form-label">Câu hỏi</label>
                                    <input type="hidden" name="question_id" id="question_id">
                                    <textarea type="text" class="form-control form-control-alt" id="question"  name="question" placeholder="Nhập câu hỏi"></textarea>
                                    <input type="hidden" name="is_correct" id="is_correct">
                                    @for ($i = 1; $i <= 4; $i++)
                                        <label class="form-label">Câu trả lời {{ $i }}</label></br>
                                        <input type="radio" name="is_correct_edit" class="is_correct_edit" value="{{ $i }}"> Câu trả lời đúng
                                        <textarea  class="form-control form-control-alt" name="answer[]" id="answer{{ $i }}"  placeholder="Nhập câu trả lời" ></textarea>
                                        <input type="hidden" name="answer_id[]" id="answer_id{{ $i }}">
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <span class="editError" style="color: red;"></span>
                            <button type="button" class="btn btn-secondary closeModal" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="deleteQna">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="delete_qna_id">
                            <p>Bạn có chắc chắn muốn xóa câu hỏi hay không?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-danger">Xóa </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Import Modal -->
        <div class="modal fade" id="importQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm danh sách câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="loadingSpinner"></div>
                    <form id="importQna" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label class="form-label">Môn học</label>
                            <select name="subject_id"  id="subject_id" class="form-control form-control-alt" >
                                <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                @if(count($subjects) > 0)
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select>
                            <label class="form-label">FILE MẪU UP LOAD</label>
                            <a class="form-control form-control-alt"  type="file"  href="/public/example/FITATEST.xlsx" download>Tải file mẫu upload</a></br>
                            <label class="form-label">Upload file</label>
                            <input class="form-control form-control-alt" type="file" name="file" id="fileupload" required accept=".xls,.xlsx,.xlsm,.xlsb,.csv"></br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-info">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- table --}}
        <div class="table-responsive">
            <table class="table table-vcenter" id="qnasTable">
                <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Câu hỏi</th>
                    <th class="text-center">Câu trả lời</th>
                    <th class="text-center">Môn học</th>
                    <th class="text-center col-header-action">Tùy chọn</th>
                    <th class="text-center col-header-action">Tùy chọn</th>
                </tr>
                </thead>
                <tbody>
                @if(count($qna) > 0)
                    @php
                        $i = 0;
                        $perPage = $qna->perPage(); // Số lượng mục trên mỗi trang
                        $currentPage = $qna->currentPage(); // Trang hiện tại
                        $i = ($currentPage - 1) * $perPage; // Tính toán số thứ tự ban đầu cho trang hiện tại
                    @endphp
                    @foreach($qna as $question)
                        <tr>
                            <td class="text-center">{{ ++$i}}</td>
                            <td class="text-center">{!! $question->question !!}</td>
                            <td class="text-center">
                                <a href="#" class="ansButton" data-id="{{ $question->id }}" data-bs-toggle="modal" data-bs-target="#showAnsModal">Xem câu trả lời</a>
                            </td>
                            <td class="text-center">{{ $question->subject->subject }}</td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-danger deleteButton" data-bs-toggle="modal" data-id="{{ $question->id }}" data-bs-target="#deleteQnaModal">Xóa</button>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <button class="btn btn-success editButton" data-bs-toggle="modal" data-id="{{ $question->id }}" data-bs-target="#editQnaModal">Sửa</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>Không có dữ liệu</td>
                    </tr>
                @endif


            </table>
            {{ $qna->links() }}

        </div>
        </div>

<style>
    #qnasTable tbody tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function() {

        //form submittion
        $("#addQna").submit(function (e) {
            e.preventDefault();

            var checkIsCorrect = false;

            for (let i = 0; i < $(".is_correct").length; i++) {
                if ($(".is_correct:eq(" + i + ")").prop('checked') == true) {
                    checkIsCorrect = true;
                    var giatri = "";
                    if (i == 0) {
                        giatri = ckedit['#ckeditor1'].getData();
                    }
                    if (i == 1) {
                        giatri = ckedit['#ckeditor2'].getData();
                    }
                    if (i == 2) {
                        giatri = ckedit['#ckeditor3'].getData();
                    }
                    if (i == 3) {
                        giatri = ckedit['#ckeditor4'].getData();
                    }

                    $(".is_correct:eq(" + i + ")").val(giatri);

                }

                if (checkIsCorrect) {

                    var formData = $(this).serialize();

                    $.ajax({
                        url: "{{ route('addQna') }}",
                        type: "POST",
                        data: formData,
                        success: function (data) {
                            console.log(data);
                            if (data.success == true) {
                                location.reload();
                            } else {
                                alert(data.msg);
                            }
                        }
                    });

                } else {
                    $(".error").text("Hãy chọn câu trả lời đúng!")
                    setTimeout(function () {
                        $(".error").text("");
                    }, 2000);
                }

            }
        });

        // show ans
        // Hàm kiểm tra URL có phải là hình ảnh không
        function isImage(url) {
            return (url.match(/\.(jpeg|jpg|gif|png)$/) != null);
        }

        // Hàm thêm class và giới hạn kích thước hình ảnh
        function updateImageClassAndSize() {
            $('img').each(function() {
                var img = $(this);
                if (!img.hasClass('myImageClass')) {
                    img.addClass('myImageClass');
                }
                img.css({
                    'max-width': '100px',
                    'max-height': '100px',
                    'width': 'auto',
                    'height': 'auto'
                });
            });
        }

        $(".ansButton").click(function () {
            $(".closeModal").click(function () {
                location.reload();
            });
            var questions = @json($questions);
            var qid = $(this).attr('data-id');
            var html = '';

            $('#showAnsModal').on('hidden.bs.modal', function (e) {
                location.reload();
            })

            for (let i = 0; i < questions.length; i++) {
                if (questions[i]['id'] == qid) {

                    var answersLength = questions[i]['answers'].length;
                    for (let j = 0; j < answersLength; j++) {
                        let is_correct = "Sai";
                        if (questions[i]['answers'][j]['is_correct'] == 1) {
                            is_correct = 'Đúng';
                        }


                        html += `
                            <tr>
                                <td class="text-center">` + (j + 1) + `</td>
                                <td class="text-center">` + (isImage(questions[i]['answers'][j]['answer']) ?
                                                            '<div class="image"><img src="' + questions[i]['answers'][j]['answer'] + '" class="myImageClass"></div>' : questions[i]['answers'][j]['answer']) + `</td>
                                <td class="text-center">` + is_correct + `</td>
                            </tr>
                        `;

                    }
                    break;

                }
            }

            $('.showAnswers').html(html);

            setTimeout(updateImageClassAndSize, 0);
        });

        //edit or Update Answer
        let editorInstances = {};

        $(".editButton").click(function () {
            var qid = $(this).attr('data-id');
            $(".closeModal").click(function () {
                location.reload();
            });

            $.ajax({
                url: "{{ route('getQnaDetails') }}",
                type: "GET",
                data: {qid: qid},
                success: function (data) {
                    var qna = data.data[0];
                    $("#subject_id").val(qna['subject_id']);
                    $("#question_id").val(qna['id']);
                    $("#question").val(qna['question']);
                    $(".editAnswers").remove();
                    // Lấy dữ liệu biến is_correct cho từng câu trả lời
                    let answersData = qna['answers'].map(answer => {
                        return {
                            answer: answer['answer'],
                            is_correct: answer['is_correct']
                        };
                    });

                    for (let i = 0; i < qna['answers'].length; i++) {
                        var answer = qna['answers'][i]['answer'];
                        var is_correct = qna['answers'][i]['is_correct'];
                        var answer_id = qna['answers'][i]['id'];
                        var checked = is_correct == 1 ? 'checked' : '';

                        // Cập nhật radio button cho câu trả lời đúng
                        $(".is_correct_edit[value=" + (i + 1) + "]").prop('checked', checked === 'checked');

                        // Cập nhật ID của câu trả lời
                        $("#answer_id" + (i + 1)).val(answer_id);

                        // Nếu câu trả lời này là câu trả lời đúng, cập nhật giá trị của trường is_correct
                        if (checked === 'checked') {
                            $("#is_correct").val(answer);
                        }

                        if (editorInstances["#answer" + (i + 1)]) {
                            editorInstances["#answer" + (i + 1)].destroy().then(() => {
                                createEditor("#answer" + (i + 1), answer);
                            });
                        } else {
                            createEditor("#answer" + (i + 1), answer);
                        }
                    }

                    if (editorInstances["#question"]) {
                        editorInstances["#question"].destroy().then(() => {
                            createEditor("#question", qna['question']);
                        });
                    } else {
                        createEditor("#question", qna['question']);
                    }
                }
            });
        });

        function createEditor(elementId, content) {
            ClassicEditor
                .create(document.querySelector(elementId), {
                    language: 'en',
                    ckfinder: {
                        uploadUrl: '{{route('ckeditor.upload', ['_token'=>csrf_token()] ) }}',
                    },
                    toolbar: {
                        items: ['heading',
                            '|', 'bold', 'italic',
                            '|', 'insertTable',
                            '|', 'bulletedList', 'numberedList', 'outdent', 'indent',
                            '|', 'MathType', 'ChemType', 'SpecialCharacters',
                            '|', 'imageUpload',
                            '|', 'undo', 'redo']
                    },
                })
                .then(editor => {
                    editorInstances[elementId] = editor;
                    editor.setData(content);
                })
                .catch(error => {
                    console.error(error);
                });
        }

        $('#editQnaModal').on('hidden.bs.modal', function (e) {
            location.reload();
        })

//Update Qna submission
        $("#editQna").submit(function (e) {
            e.preventDefault();

            // Cập nhật giá trị của textarea gốc với dữ liệu từ CKEditor
            let answers = {};
            for (let i = 1; i <= 4; i++) {
                if (editorInstances["#answer" + i]) {
                    let answerData = editorInstances["#answer" + i].getData();
                    $("#answer" + i).val(answerData);
                    let answerId = $("#answer_id" + i).val();
                    answers[answerId] = answerData;

                    // Nếu câu trả lời này là câu trả lời đúng, cập nhật giá trị của trường is_correct
                    if ($(".is_correct_edit[value=" + i + "]").prop('checked')) {
                        $("#is_correct").val(answerData);
                    }
                }
            }

            // Lấy dữ liệu câu hỏi từ CKEditor
            let questionData = editorInstances["#question"].getData();
            $("#question").val(questionData);

            // Kiểm tra xem có ít nhất một câu trả lời đúng được chọn
            var checkIsCorrect = $(".is_correct_edit:checked").length > 0;

            // Nếu có, tiếp tục xử lý form
            if (checkIsCorrect) {
                var formData = $(this).serializeArray();
                // Tìm câu trả lời đúng và cập nhật giá trị is_correct tương ứng
                formData.forEach(function(item) {
                    if (item.name === "is_correct_edit") {
                        item.value = answers[parseInt(item.value) - 1];
                    }
                });

                // Thêm dữ liệu câu trả lời vào formData
                for (let answerId in answers) {
                    formData.push({name: "answers[" + answerId + "]", value: answers[answerId]});
                }

                // Thêm dữ liệu câu hỏi vào formData
                formData.push({name: "question", value: questionData});

                // Thêm dữ liệu môn học vào formData
                $.ajax({
                    url: "{{ route('updateQna') }}",
                    type: "POST",
                    data: formData,

                    success: function (data) {
                        if (data.success == true) {
                            // Cập nhật giá trị is_correct trong cơ sở dữ liệu
                            location.reload();
                        } else {
                            alert(data.msg);
                        }
                    }
                });
            } else {
                // Nếu không, hiển thị thông báo lỗi
                $(".editError").text("Hãy chọn câu trả lời đúng!");
                setTimeout(function () {
                    $(".editError").text("");
                }, 2000);
            }
        });


        // delete_qna_id delete Q&A
        $('.deleteButton').click(function () {
            var id = $(this).attr('data-id')
            $('#delete_qna_id').val(id);
        });

        $('#deleteQna').submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('deleteQna') }}",
                type: "POST",
                data: formData,
                success: function (data) {
                    if (data.success == true) {
                        location.reload();
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });
    })

    // import Qna
    // When a subject is selected...
    $(document).ready(function() {
        $('#importQna').on('submit', function(e) {
            e.preventDefault();

            var formData = new FormData(this);

            $.ajax({
                url: "{{ route('importQna') }}",
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function() {
                    // Hiển thị spinner khi bắt đầu gửi yêu cầu
                    $('#loadingSpinner').show();
                },
                success: function(response) {
                    // Ẩn spinner khi yêu cầu thành công
                    $('#loadingSpinner').hide();
                    console.log(response);
                },
                error: function(error) {
                    // Ẩn spinner khi có lỗi
                    $('#loadingSpinner').hide();
                    console.log(error);
                }
            });
        });
    });

</script>

<style>
    #loadingSpinner {
        display: none;
        position: fixed;
        z-index: 999;
        height: 2em;
        width: 2em;
        overflow: show;
        margin: auto;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
    }

    #loadingSpinner:before {
        content: '';
        display: block;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.3);
    }

    #loadingSpinner:not(:required):after {
        content: '';
        display: block;
        width: 1em;
        height: 1em;
        margin-top: -0.5em;
        -webkit-animation: spinner 150ms infinite linear;
        -moz-animation: spinner 150ms infinite linear;
        -ms-animation: spinner 150ms infinite linear;
        -o-animation: spinner 150ms infinite linear;
        animation: spinner 150ms infinite linear;
        border-radius: 0.5em;
        -webkit-box-shadow: rgba(0, 0, 0, 0.75) 1.5em 0 0 0, rgba(0, 0, 0, 0.75) 1.1em 1.1em 0 0, rgba(0, 0, 0, 0.75) 0 1.5em 0 0, rgba(0, 0, 0, 0.75) -1.1em 1.1em 0 0, rgba(0, 0, 0, 0.5) -1.5em 0 0 0, rgba(0, 0, 0, 0.5) -1.1em -1.1em 0 0, rgba(0, 0, 0, 0.75) 0 -1.5em 0 0, rgba(0, 0, 0, 0.75) 1.1em -1.1em 0 0;
    }

    @-webkit-keyframes spinner {
        0% { -webkit-transform: rotate(0deg); -moz-transform: rotate(0deg); -ms-transform: rotate(0deg); -o-transform: rotate(0deg); transform: rotate(0deg); }
        100% { -webkit-transform: rotate(360deg); -moz-transform: rotate(360deg); -ms-transform: rotate(360deg); -o-transform: rotate(360deg); transform: rotate(360deg); }
    }
</style>
{{--ckeditor add--}}
<script>

    let ckedit = {};

    function createEditor(elementId) {
        ClassicEditor
            .create(document.querySelector(elementId), {
                language: 'en',
                ckfinder: {
                    uploadUrl: '{{route('ckeditor.upload', ['_token'=>csrf_token()] ) }}',
                },
                toolbar: {
                    items: ['heading',
                        '|', 'bold', 'italic',
                        '|', 'insertTable',
                        '|', 'bulletedList', 'numberedList', 'outdent', 'indent',
                        '|', 'MathType', 'ChemType','SpecialCharacters',
                        '|','imageUpload',
                        '|', 'undo', 'redo',
                    ]
                },
            })
            .then(editor => {
                ckedit[elementId] = editor;
            })
            .catch(error => {
                console.error(error);
            });
    }

    ['#ckeditor', '#ckeditor1', '#ckeditor2', '#ckeditor3', '#ckeditor4'].forEach(createEditor);


</script>


@endsection
