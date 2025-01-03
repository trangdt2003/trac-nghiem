@extends('admin.master')
@section('title', 'Môn học')
{{-- main content --}}
@section('main-content')

<div class="container-fluid">
    <form class="example" action="">
        <input type="text" placeholder="Tìm kiếm.." name="key" onkeyup="searchTable()" class="w-80">
        <button type="submit" class="btn btn-primary">Tìm kiếm </button>
    </form>
<div class="card">
    </div>
    <div class="card-body">

    <!-- Button Add modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSubjectModal">
    + Thêm môn học
</button>

    <!-- Modal Add-->
<div class="modal fade" id="addSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <form id="addSubject">
        @csrf
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Thêm môn học</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <label for="" class="form-label">Tên môn học</label>
                <input type="text" class="form-control form-control-alt" name="subject" placeholder="Nhập tên môn học" required>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
        <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
    </div>
    </form>
    </div>
</div>

   <!-- Edit Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title" id="exampleModalLabel">Sửa môn học</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <form id="editSubject">
        @csrf
        <div class="modal-body">
                <label for="" class="form-label">Tên môn học</label>
                <input type="text" class="form-control form-control-alt" name="subject" placeholder="Nhập tên môn học" id="edit_subject" required>
                <input type="hidden" name="id" id="edit_subject_id">
        </div>
        <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tăt</button>
                <button type="submit" class="btn btn-primary">Cập nhật </button>
        </div>
    </form>
</div>

</div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Xóa môn học</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="deleteSubject">
            @csrf
            <div class="modal-body">
                <p>Bạn có chắc chắn muốn xóa môn học không?</p>
                <input type="hidden" name="id" id="delete_subject_id">
            </div>
            <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt </button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
            </div>
        </form>
    </div>

    </div>
</div>

{{-- table --}}
<div class="table-responsive">
<table class="table table-vcenter" id="subjectsTable">
    <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Tên môn</th>
            <th class="text-center">Số đề kiểm tra</th>
            <th class="text-center">Số câu hỏi</th>
            <th class="text-center">Số tài liệu</th>
            <th class="text-center col-header-action">Tùy chọn</th>
            <th class="text-center col-header-action">Tùy chọn</th>
        </tr>
    </thead>
    <tbody>
        @if(count($subjects) > 0)
            @foreach($subjects as $subject)
            <tr>
                <td class="text-center">{{ ++$i}}</td>
                <td class="text-center">{{ $subject->subject }}</td>
                <td class="text-center">
                    @php
                        $examTotal = 0;
                    @endphp
                    @foreach ($count_exam as $exam)
                        @if ($subject->id == $exam->subject_id)
                            @php
                                $examTotal = $exam->total;
                            @endphp
                        @endif
                    @endforeach
                    {{ $examTotal }}
                </td>
                <td class="text-center">
                    @php
                        $questionTotal = 0;
                    @endphp
                    @foreach ($count_question as $question)
                        @if ($subject->id == $question->subject_id)
                            @php
                                $questionTotal = $question->total;
                            @endphp
                        @endif
                    @endforeach
                    {{ $questionTotal }}
                </td>
                <td class="text-center">
                    @php
                        $documentTotal = 0;
                    @endphp
                    @foreach ($count_document as $document)
                        @if ($subject->id == $document->subject_id)
                            @php
                                $documentTotal = $document->total;
                            @endphp
                        @endif
                    @endforeach
                    {{ $documentTotal }}
                </td>

                <td>
                    <div class="text-center inline-block">
                        <button class="btn btn-danger deletebutton" data-bs-toggle="modal" data-id="{{$subject->id  }}" data-bs-target="#deleteSubjectModal">Xóa</button>
                    </div>
                </td>
                <td class="text-center">
                <button class="btn btn-success editbutton" data-bs-toggle="modal" data-id="{{$subject->id  }}" data-subject="{{$subject->subject  }}" data-bs-target="#editSubjectModal">Sửa</button>
                </td>
            </tr>
            @endforeach
            @else
                <tr>
                    <td>Không có môn học!</td>
                </tr>
            @endif

</table>
{{$subjects->links()}}
</div>

<style>
    #subjectsTable tbody tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function(){
        $("#addSubject").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addSubject') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if(data.success == true){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });


        //edit subject
        $(".editbutton").click(function(){
            var subject_id =$(this).attr('data-id');
            var subject =$(this).attr('data-subject');
            $("#edit_subject").val(subject);
            $("#edit_subject_id").val(subject_id);
        })

        $("#editSubject").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url:"{{ route('editSubject') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if(data.success == true){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });

        //Delete subject
        $(".deletebutton").click(function(){
            var subject_id = $(this).attr('data-id');
            $("#delete_subject_id").val(subject_id);
        })

        $("#deleteSubject").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('deleteSubject') }}",
                type:"POST",
                data:formData,
                success:function(data){
                    if(data.success == true){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });




    });
</script>

@endsection
