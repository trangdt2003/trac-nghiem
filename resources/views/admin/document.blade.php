@extends('admin.master')
@section('title', 'Tài liệu')
{{-- main content --}}
@section('main-content')
<div class="container-fluid">
    <form class="example" action="">
        <input type="text" placeholder="Tìm kiếm.." name="key" onkeyup="searchTable()" class="w-80">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </form>
    <div class="card">
    </div>

    <div class="card-body">
        <!-- Button Add document -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addDocumentModal">
            + Thêm tài liệu
        </button>

        <!-- Modal Add document -->
        <div class="modal fade" id="addDocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm tài liệu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="addDocument" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <label for="" class="form-label">Tên tài liệu</label>
                            <input type="text" class="form-control form-control-alt" name="name" placeholder="Nhập tên tài liệu" required></br>
                            <label for="" class="form-label">Chọn môn học</label>
                            <select name="subject_id" class="form-control form-control-alt" >
                                <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                @if(count($subjects) > 0)
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select></br>
                            <label for="" class="form-label">Tải lên tài liệu</label>
                            <input type="file" class="form-control form-control-alt" name="document" accept=".pdf" required></br>
                            <p>Giới hạn kích thước file tài liệu là 50MB, chỉ chấp nhận file PDF.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Thêm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--See document Modal--}}
        <div class="modal fade" id="seeDocumentModal" tabindex="-1" aria-labelledby="seeDocumentModal" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xem tài liệu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="text-center" style="font-weight: bold; font-size: 16px;" id="documentName"></p>
                        <embed id="documentFile" type="application/pdf" width="100%" height="600px" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- edit modal -->
        <div class="modal fade" id="editDocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa tài liệu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editDocument" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" id="document_id"> <!-- Trường ẩn này -->
                        <div class="modal-body">
                            <label for="" class="form-label">Tên tài liệu</label>
                            <input type="text" class="form-control form-control-alt" name="name" id="document_name" placeholder="Nhập tên tài liệu" required></br>
                            <label for="" class="form-label">Chọn môn học</label>
                            <select name="subject_id" class="form-control form-control-alt" id="document_subject">
                                <option value=""><label for="" class="form-label">Chọn môn học</label></option>
                                @if(count($subjects) > 0)
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->subject }}</option>
                                    @endforeach
                                @endif
                            </select></br>
                            <label for="" class="form-label">Tài liệu hiện tại</label>
                            <p id="current_document" class="form-control form-control-alt"></p>
                            <label for="" class="form-label">Tải lên tài liệu mới</label>
                            <input type="file" class="form-control form-control-alt" name="document" id="document_file"></br>
                            <p>Giới hạn kích thước file tài liệu là 50MB, chỉ chấp nhận file PDF.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-primary">Cập nhật </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteDocumentModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa tài liệu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="deleteDocument"> <!-- Sửa ID của form -->
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="id" id="deleteDocumentId">
                            <p>Bạn có chắc chắn muốn xóa tài liệu hay không?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-danger">Xóa </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{--Table--}}
        <div class="table-responsive">
            <table class="table table-vcenter" id="documentsTable">
                <thead>
                <tr>
                    <th class="text-center">STT</th>
                    <th class="text-center">Tên tài liệu</th>
                    <th class="text-center">Nội dung</th>
                    <th class="text-center">Môn học</th>
                    <th class="text-center col-header-action">Tùy chọn</th>
                    <th class="text-center col-header-action">Tùy chọn</th>
                </tr>
                <tr>
                @if(count($documents) > 0)
                    @php
                        $i = 0;
                        $perPage = $documents->perPage(); // Số lượng mục trên mỗi trang
                        $currentPage = $documents->currentPage(); // Trang hiện tại
                        $i = ($currentPage - 1) * $perPage; // Tính toán số thứ tự ban đầu cho trang hiện tại
                    @endphp
                    @foreach($documents as $document)
                        <tr>
                            <td class="text-center">{{ ++$i}}</td>
                            <td>{{ $document->name}}</td>
                            <td class="text-center">
                                <a href="#" class="document" data-id="{{$document->id}}" data-bs-target="#seeDocumentModal" data-bs-toggle="modal">Xem tài liệu</a>
                            </td>
                            <td class="text-center">{{ $document->subjects[0]['subject']}}</td>
                            <td>
                                <div class="text-center inline-block">
                                    <button class="btn btn-danger deletebutton" data-bs-toggle="modal" data-id="{{$document->id  }}" data-bs-target="#deleteDocumentModal">Xóa</button>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success editbutton" data-bs-toggle="modal" data-id="{{$document->id  }}" data-bs-target="#editDocumentModal">Sửa</button>
                            </td>
                        </tr>
                    @endforeach

                @else
                    <tr>
                        <td>Không có tài liệu!</td>
                    </tr>
                @endif
                </thead>
            </table>
            {{ $documents->links() }}
        </div>
</div>

<style>
    #documentsTable thead tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function(){
        // add document
        $("#addDocument").submit(function(e){
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url:"{{ route('addDocument') }}",
            type:"POST",
            data:formData,
            processData: false,
            contentType: false,
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

        // get document
    $(document).on('click', '.document', function(e) {
        e.preventDefault();

        var id = $(this).data('id');

        $.ajax({
            url: '/admin/get-document-detail/' + id,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#documentName').text(response.data.name);
                    $('#documentFile').attr('src', '/public/document/' + response.data.document);
                    $('#seeDocumentModal').modal('show');
                } else {
                    alert(response.msg);
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi lấy dữ liệu!');
            }
        });
    });

    //click hidden get reload
    $('#seeDocumentModal').on('hidden.bs.modal', function () {
        location.reload();
    });

    // edit document
    $(document).on('click', '.editbutton', function() {
        var id = $(this).data('id');
        $('#document_id').val(id);

        $.ajax({
            url: '/admin/get-document-detail/' + id,
            method: 'GET',
            success: function(response) {
                if (response.success) {
                    $('#editDocument input[name="id"]').val(response.data.id);
                    $('#editDocument input[name="name"]').val(response.data.name);
                    $('#editDocument select[name="subject_id"]').val(response.data.subject_id);
                    $('#current_document').text(response.data.document);
                    $('#editDocumentModal').modal('show');
                } else {
                    alert(response.msg);
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi lấy dữ liệu!');
            }
        });
    });

    $('#editDocument').submit(function(e) {
        e.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            url: "{{ route('editDocument') }}",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.msg);
                }
            },
            error: function() {
                alert('Có lỗi xảy ra khi cập nhật dữ liệu!');
            }
        });
    });


    //delete document
    $(".deletebutton").click(function(){
        var id = $(this).attr('data-id');
        $("#deleteDocumentId").val(id); // Sửa ID của form
    });

    $("#deleteDocument").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('deleteDocument') }}",
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

</script>




@endsection
