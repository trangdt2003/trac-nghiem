@extends('admin.master')
@section('title', 'Đề thi')
{{-- main content --}}
@section('main-content')

<div class="container-fluid">
    {{--search--}}
    <form class="example" action="">
        <input type="text" placeholder="Tìm kiếm.." name="key" onkeyup="searchTable()" class="w-80">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>

    <div class="card">
    </div>

    <div class="card-body">
        <!-- Button Add modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExamModal">
            + Thêm Đề thi
        </button>

        <!-- Modal Add-->
        <div class="modal fade" id="addExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm Đề thi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addExam">
                        @csrf
                        <div class="modal-body">
                            <label for="" class="form-label">Tên Đề thi</label>
                            <input type="text" class="form-control form-control-alt" name="exam_name" placeholder="Nhập tên bài thi" required></br>
                            <select name="subject_id" class="form-control form-control-alt" >
                                <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                @if(count($subjects) > 0)
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select>
                            </br>
                            <label for="" class="form-label">Ngày tháng</label>
                            <input type="date" class="form-control form-control-alt" name="date" required min="@php echo date('Y-m-d'); @endphp">
                            </br>
                            <label for="" class="form-label">Thời gian thi (phút)</label>
                            <input type="number" class="form-control form-control-alt" name="time" min="0" required>
                            </br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit Modal -->
        <div class="modal fade" id="editExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa Đề thi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editExam">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="exam_id" id="exam_id">
                            <label for="" class="form-label">Tên Đề thi</label>
                            <input type="text" class="form-control form-control-alt" id="exam_name" name="exam_name" placeholder="Nhập tên đề thi" required></br>
                            <select name="subject_id" id="subject_id" class="form-control form-control-alt" >
                                <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                @if(count($subjects) > 0)
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select>
                            </br>
                            <label for="" class="form-label">Ngày tháng</label>
                            <input type="date" id="date" class="form-control form-control-alt" name="date" require min="@php echo date('Y-m-d'); @endphp">
                            </br>
                            <label for="" class="form-label">Thời gian thi (phút)</label>
                            <input type="number" id="time" class="form-control form-control-alt" name="time" min="0" required>
                            </br>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteExamModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa đề thi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="deleteExam">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="exam_id" id="deleteExamId">
                            <p>Bạn có chắc chắn muốn xóa đề thi hay không?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-danger">Xóa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal add questions-->
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
                            <input type="hidden" name="exam_id" id="addExamId">
                            <input type="hidden" name="subject_id" id="addSubjectId">
                            <input type="search" name="search" id="search" onkeyup="searchTable()" class="w-100 search-input" placeholder="tìm kiếm..">
                            <br><br>
                            <table class="table" id="questionsTable">
                                <thead>
                                <th class="text-center">Lựa chọn</th>
                                <th class="text-center">Câu hỏi</th>
                                </thead>
                                <tbody class="addBody">

                                </tbody>
                                <style>
                                    #questionsTable img{
                                        max-width: 100px;
                                        height: auto;
                                    }
                                </style>
                            </table>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Thêm </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal show questions-->
        <div class="modal fade" id="seeQnaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Câu hỏi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <script>
                        $('body').data('token', "{{ csrf_token() }}");
                    </script>
                    <div class="modal-body">

                        <table class="table" id="showquestionTable">
                            <thead>
                            <th class="text-center">STT</th>
                            <th class="text-center">Câu hỏi</th>
                            <th class="text-center">Tùy chọn</th>

                            </thead>
                            <tbody class="seeQuestionsTable">

                            </tbody>
                            <style>
                                #showquestionTable img{
                                    max-width: 100px;
                                    height: auto;
                                }
                            </style>
                        </table>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                        <button type="button" class="btn btn-danger deleteSelectedQuestions">Xóa</button>
                    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    {{-- table --}}
    <div class="table-responsive">
        <table class="table table-vcenter" id="examsTable">
            <thead>
            <tr>
                <th class="text-center">STT</th>
                <th class="text-center">Đề thi</th>
                <th class="text-center">Môn học</th>
                <th class="text-center">Ngày tạo</th>
                <th class="text-center">Thời gian thi (Phút)</th>
                <th class="text-center">Số lượt thi</th>
                <th class="text-center">Thêm câu hỏi</th>
                <th class="text-center">Xem câu hỏi</th>
                <th class="text-center col-header-action">Tùy chọn</th>
                <th class="text-center col-header-action">Tùy chọn</th>
            </tr>

            <tr>
            @if(count($exams) > 0)
                @php
                    $i = 0;
                    $perPage = $exams->perPage(); // Số lượng mục trên mỗi trang
                    $currentPage = $exams->currentPage(); // Trang hiện tại
                    $i = ($currentPage - 1) * $perPage; // Tính toán số thứ tự ban đầu cho trang hiện tại
                @endphp
                @foreach($exams as $exam)
                    <tr>
                        <td class="text-center">{{ ++$i}}</td>
                        <td >{{ $exam->exam_name }}</td>
                        <td class="text-center">{{ $exam->subjects[0]['subject']}}</td>
                        <td class="text-center">{{ $exam->date}}</td>
                        <td class="text-center">{{ $exam->time }} Phút</td>
                        <td class="text-center">{{ $exam->attempt }}</td>
                        <td class="text-center">
                            <a href="#" class="addQuestion" data-id="{{$exam->id}}" data-subject-id="{{$exam->subjects[0]['id']}}"
                               data-bs-target="#addQnaModal" data-bs-toggle="modal">Thêm câu hỏi</a>
                        </td>
                        <td class="text-center">
                            <a href="#" class="seeQuestion" data-id="{{$exam->id}}" data-bs-target="#seeQnaModal" data-bs-toggle="modal">Xem câu hỏi</a>
                        </td>
                        <td>
                            <div class="text-center inline-block">
                                <button class="btn btn-danger deletebutton" data-bs-toggle="modal" data-id="{{$exam->id}}"
                                        data-bs-target="#deleteExamModal">Xóa</button>
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-success editbutton" data-bs-toggle="modal" data-id="{{$exam->id}}"
                                    data-bs-target="#editExamModal">Sửa</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td>Không có đề thi!</td>
                </tr>
            @endif
            </thead>
        </table>
        {{ $exams->links() }}
    </div>

<style>
    #examsTable tbody tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }

    .search-input {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
        border: none;
        border-bottom: 2px solid dodgerblue;
    }
</style>

<script>
    $(document).ready(function() {
        $("#addExam").submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('addExam') }}",
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

        $(".editbutton").click(function () {
            var id = $(this).attr('data-id');
            $("#exam_id").val(id);

            var url = '{{ route("getExamDetail", "id") }}';
            url = url.replace('id', id);

            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (data.success == true) {
                        var exam = data.data;
                        $("#exam_name").val(exam[0].exam_name);
                        $("#subject_id").val(exam[0].subject_id);
                        $("#date").val(exam[0].date);
                        $("#time").val(exam[0].time);
                        $("#attempt").val(exam[0].attempt);
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });


        $("#editExam").submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('editExam') }}",
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

        //delete exam

        $(".deletebutton").click(function () {
            var id = $(this).attr('data-id');
            $("#deleteExamId").val(id);
        });

        $("#deleteExam").submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('deleteExam') }}",
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


        //     add questions part
        $('.addQuestion').click(function () {
            var id = $(this).attr('data-id');
            var subject_id = $(this).attr('data-subject-id'); // Get the subject_id from the data attribute

            $('#addExamId').val(id);
            $('#addSubjectId').val(subject_id); // Set the subject_id in the form

            $.ajax({
                url: "{{route('getQuestions')}}",
                type: "GET",
                data: {
                    exam_id: id,
                    subject_id: subject_id // Send the subject_id as a parameter
                },
                success: function (data) {
                    if (data.success == true) {
                        var questions = data.data;
                        var html = '';
                        if (questions.length > 0) {
                            for (let i = 0; i < questions.length; i++) {
                                html += `
            <tr>
                <td class="text-center"><input type="checkbox" value="` + questions[i]['id'] + `" name="questions_ids[]" ></td>
                <td class="text-center">` + questions[i]['questions'] + `</td>
            </tr>`;
                            }
                        } else {
                            html += `
        <tr>
            <td colspan="2">không có câu hỏi!</td>
        </tr>`;
                        }

                        $('.addBody').html(html);
                    } else {
                        alert(data.msg);
                        $('.addBody').html('Chưa có câu hỏi nào trong môn học!');
                    }
                }
            });
        });


        $("#addQna").submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('addQuestions') }}",
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


        //     seeQuestion
        $('.seeQuestion').click(function () {
            var id = $(this).attr('data-id');

            $.ajax({
                url: "{{ route('getExamQuestions') }}",
                type: "GET",
                data: {exam_id: id},
                success: function (data) {
                    var html = '';
                    var questions = data.data;
                    if (questions.length > 0) {
                        for (let i = 0; i < questions.length; i++) {
                            if (questions[i]['question'].length > 0) {
                                html += `
                                    <tr>
                                        <td class="text-center">` + (i + 1) + `</td>
                                        <td class="text-center">` + questions[i]['question'][0]['question'] + `</td>
                                        <td class="text-center"><input type="checkbox" class="questionCheckbox" value="` + questions[i]['id'] + `"></td>
                                    </tr> `;
                            }
                        }
                    } else {
                        html += `
                            <tr>
                               <td colspan="3">Không có câu hỏi!</td>
                            </tr>
                            `;
                    }
                    $('.seeQuestionsTable').html(html)
                }
            });
        });

// Xóa câu hỏi
        $(document).on('click', '.deleteSelectedQuestions', function(){
            var qnaExamIds = $('.questionCheckbox:checked').map(function(){
                return $(this).val();
            }).get(); // Đây là một mảng các ID của hàng trong bảng QnaExam
            var token = $('body').data('token');

            $.ajax({
                url: "{{ route('deleteExamQuestions') }}",
                type: "POST",
                data: {
                    _token: token,
                    qna_exam_ids: qnaExamIds // Gửi mảng các ID của hàng trong bảng QnaExam
                },
                success: function (data) {
                    if (data.success) {
                        alert('Các câu hỏi đã được xóa thành công!');
                        location.reload();
                    } else {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                }
            });
        });
    });


</script>

{{--tìm kiếm--}}
<script>
    function searchTable() {
        let input = document.getElementById('search');
        let filter = input.value.toUpperCase();
        let table = document.getElementById('questionsTable');
        let tr = table.getElementsByTagName('tr');

        for (let i = 0; i < tr.length; i++) {
            let td = tr[i].getElementsByTagName('td')[1];
            if (td) {
                let txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>
@endsection
