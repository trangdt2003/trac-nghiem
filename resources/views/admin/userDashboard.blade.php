@extends('admin.master')
@section('title', 'Người dùng')
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
        {{-- button start --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserModal">
            + Thêm người dùng
        </button>

        <!-- Modal add -->
        <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thêm người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="addUser">

                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="modal-body ">
                            <div class="row">
                                <div class="col">
                                    <label class="form-label">Họ tên</label>
                                    <input type="text" class="form-control form-control-alt" name="name" placeholder="Nhập tên người dùng" required>
                                    <span class="error-message">{{ $errors->first('name') }}</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-alt" name="email" placeholder="Nhập email" required>
                                    <span class="error-message">{{ $errors->first('email') }}</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-2">
                                    <label class="form-label">Giới tính</label><br>
                                    <input type="radio" name="gender" value="man" checked="checked">Nam</input></br>
                                    <input type="radio" name="gender" value="woman">Nữ</input>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Birth</label>
                                    <input type="date" class="form-control form-control-alt" name="birth" placeholder="Nhập ngày tháng năm sinh" min="1900-01-01" max="2024-06-03" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control form-control-alt" name="phone" placeholder="Nhập số điện thoại" required>
                                    <span class="error-message">{{ $errors->first('phone') }}</span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <label class="form-label">Role</label>
                                <div class="col">
                                    <input type="radio" name="role" value="0" class="radio" checked="checked"> User</br>
                                    <input type="radio" name="role" value="1" class="radio"> Admin</input></br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                                <button type="submit" class="btn btn-primary">Thêm </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- Modal edit -->
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sửa người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="editUser">
                        @csrf
                        <div class="modal-body ">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="id" id="id">
                                    <label class="form-label">Họ tên</label>
                                    <input type="text" class="form-control form-control-alt" name="name" id="name_edit" placeholder="Nhập tên người dùng" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control form-control-alt" name="email" id="email_edit" placeholder="Nhập email" required>
                                </div>
                            </div>
                                        <div class="row mt-3">
                                            <div class="col">
                                                <label class="form-label">Giới tinh</label></br>
                                                <input class="form-control form-control-alt" id="gender_edit" disabled>
                                            </div>
                                        </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Lựa chọn lại giới tính (Nếu chưa đúng)</label></br>
                                    <input type="radio" name="gender" value="man" checked="checked"> Nam</input></br>
                                    <input type="radio" name="gender"  value="woman"> Nữ</input>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control form-control-alt" name="birth" id="birth_edit" placeholder="Nhập ngày tháng năm sinh" min="1900-01-01" max="2024-06-03" required>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label class="form-label">Số điện thoại</label>
                                    <input type="text" class="form-control form-control-alt" name="phone" id="phone_edit" placeholder="Nhập số điện thoại" required>
                                </div>

                                <div class="row mt-3">
                                    <label class="form-label">Chọn quyền</label>
                                    <select name="role" id="role_edit" class="form-control form-control-alt" >
                                        <option value=""><label for="" class="form-label">Chọn quyền</label></option>
                                        @if(count($roles) > 0)
                                            @foreach($roles as $role)
                                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                                    <button type="submit" class="btn btn-primary">Cập nhật </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal delete -->
        <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Xóa người dùng</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="deleteUser">
                        @csrf
                        <div class="modal-body ">
                            <p>Bạn có chắc chắn muốn xóa người dùng này không?</p>
                            <input type="hidden" name="id" id="user_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                            <button type="submit" class="btn btn-danger">Xoá </button>
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
                    <th class="text-center">Họ tên </th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Giới tính </th>
                    <th class="text-center">Ngày sinh </th>
                    <th class="text-center"> Số điện thoại </th>
                    <th class="text-center">Quyền</th>
                    <th class="text-center col-header-action">Tùy chọn</th>
                    <th class="text-center col-header-action">Tùy chọn</th>
                </tr>

                <tr>
                @if(count($users) > 0)
                    @foreach($users as $user)
                        <tr>
                            <td class="text-center">{{ ++$i}}</td>
                            <td class="text-center">{{ $user->name  }}</td>
                            <td class="text-center">{{ $user->email }}</td>
                            <td class="text-center">
                                <span style="color:{{ $user->gender ? 'black' : 'red' }}">
                                    @if($user->gender == 'man')
                                        nam
                                    @elseif($user->gender == 'woman')
                                        nữ
                                    @else
                                        chưa cập nhật thông tin
                                    @endif
                                </span>
                            </td>
                            <td class="text-center"><span style="color:{{ $user->birth ? 'black' : 'red' }}">{{ $user->birth ?? 'chưa cập nhật thông tin' }}</span></td>
                            <td class="text-center"><span style="color:{{ $user->phone ? 'black' : 'red' }}">{{ $user->phone?? 'chưa cập nhật thông tin' }}</span></td>
                            <td class="text-center">{{ $user->roles[0]['name']}}</td>
                            <td>
                                <div class="text-center inline-block">
                                    <button class="btn btn-danger deleteButton" data-bs-toggle="modal" data-id="{{ $user->id }}"  data-bs-target="#deleteUserModal">Xóa</button>
                                </div>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-success updateButton" data-bs-toggle="modal" data-gender="{{ $user->gender }}"
                                        data-birth="{{ $user->birth }}" data-phone="{{ $user->phone }}" data-role="{{ $user->role }}"
                                        data-id="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}"
                                        data-bs-target="#editUserModal">Sửa</button>
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
            {{$users->links()}}
        </div>

<style>
    #usersTable thead tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

<script>

    $(document).ready(function(){
        $("#addUser").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax ({
                url:"{{ route('addUser') }}",
                type:"POST",
                data:formData,
                success:function(data){

                    if(data.success  == true){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });


// edit button
        $(".updateButton").click(function() {
            var id = $(this).attr('data-id');
            $("#id").val(id);

            var url = '{{ route("getUserDetail", "id") }}';
            url = url.replace('id', id);

            $.ajax({
                url: url,
                type: "GET",
                success: function (data) {
                    if (data.success == true) {
                        var user = data.data;
                        $("#name_edit").val(user.name);
                        $("#email_edit").val(user.email);
                        $("#gender_edit").val(user.gender);
                        $("#birth_edit").val(user.birth);
                        $("#phone_edit").val(user.phone);
                        $("#role_edit").val(user.role);
                    } else {
                        alert(data.msg);
                    }
                }
            });
        });


            $("#editUser").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();
            console.log(formData);
            $.ajax({
                url:"{{ route('editUser') }}",
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


        $(".deleteButton").click(function (){
            var id = $(this).attr('data-id');
            $("#user_id").val(id);
        });

        $("#deleteUser").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax ({
                url:"{{ route('deleteUser') }}",
                type:"POST",
                data:formData,
                success:function(data){

                    if(data.success  == true){
                        location.reload();
                    }else{
                        alert(data.msg);
                    }
                }
            });
        });
    })

</script>
@endsection
