@extends('admin.master')
@section('title', 'Quyền người dùng')
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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addManageModal">
            + Thêm quyền
        </button>

<!-- Modal add -->
<div class="modal fade" id="addManageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm quyền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="addManage">
                @csrf
                <div class="modal-body ">
                    <div class="row">
                        <div class="col">
                            <label class="form-label">tên quyền</label>
                            <input type="text" class="form-control form-control-alt" name="name" placeholder="Nhập tên quyền" required>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> Tắt </button>
                    <button type="submit" class="btn btn-primary"> Thêm </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editManageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa quyền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editManage">
                @csrf
                <div class="modal-body">
                    <label for="" class="form-label">Tên quyền</label>
                    <input type="text" class="form-control form-control-alt" name="name" placeholder="Nhập tên quyền" id="edit_role" required>
                    <input type="hidden" name="id" id="edit_role_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                    <button type="submit" class="btn btn-primary"> Câp nhật </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal delete -->
<div class="modal fade" id="deleteManageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Xóa quyền</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="deleteManage">
                @csrf
                <div class="modal-body ">
                    <p>Bạn có chắc chắn muốn xóa quyền này không?</p>
                    <input type="hidden" name="id" id="delete_manage_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                    <button type="submit" class="btn btn-danger">Xóa</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- table --}}
<div class="table-responsive">
    <table class="table table-vcenter" id="usersTable">
        <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">Tên quyền</th>
            <th class="text-center col-header-action">Tùy chọn</th>
            <th class="text-center col-header-action">Tùy chọn</th>
        </tr>

        <tr>
            @if(count($roles) > 0)
                @foreach($roles as $role)
                    <tr>
                        <td class="text-center">{{ ++$i}}</td>
                        <td class="text-center">{{ $role->name }}</td>
                        <td>
                            <div class="text-center inline-block">
                                <button class="btn btn-danger deleteButton" data-bs-toggle="modal" data-id="{{ $role->id }}"  data-bs-target="#deleteManageModal">Xóa</button>
                            </div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-success editButton" data-bs-toggle="modal" data-id="{{ $role->id }}" data-name="{{$role->name}}"
                                    data-bs-target="#editManageModal">Sửa</button>
                        </td>
                    </tr>
                @endforeach

            @else
                    <tr>
                        <td>Không có dữ liệu</td>
                    </tr>
           @endif
        </thead>
    </table>
    {{$roles->links()}}
</div>

<style>
    #usersTable thead tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

<script>
//add Manage
    $(document).ready(function() {
        $("#addManage").submit(function (e) {
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url: "{{ route('addManage') }}",
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

        //edit manage
        $(".editButton").click(function(){
            var id =$(this).attr('data-id');
            var name =$(this).attr('data-name');
            $("#edit_role").val(name);
            $("#edit_role_id").val(id);
        })

        $("#editManage").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url:"{{ route('editManage') }}",
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
        $(".deleteButton").click(function(){
            var role_id = $(this).attr('data-id');
            $("#delete_manage_id").val(role_id);
        })

        $("#deleteManage").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('deleteManage') }}",
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
