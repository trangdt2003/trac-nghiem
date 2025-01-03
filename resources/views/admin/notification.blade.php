@extends('admin.master')
@section('title', 'Thông báo')
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
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNotificationModal">
    + Thêm thông báo
    </button>

    <!-- Modal -->
    <div class="modal fade" id="addNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addNotification">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Thông báo</label>
                    <input type="text" class="form-control form-control-alt" name="notification" placeholder="Nhập thông báo" required><br>
                    <label for="" class="form-label">Thời gian</label>
                    <input type="time" class="form-control form-control-alt" name="time" min="<?php echo date('H:i'); ?>"><br>
                    <label for="" class="form-label">Ngày tháng</label>
                    <input type="date" class="form-control form-control-alt" name="date" min="<?php echo date('Y-m-d'); ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tắt</button>
                    <button type="submit" class="btn btn-primary">Thêm </button>
                </div>
            </div>
        </form>
    </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Sửa thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editNotification">
                    @csrf
                    <div class="modal-body">
                        <label for="" class="form-label">Thông báo</label>
                        <input type="text" class="form-control form-control-alt" name="notification" placeholder="Nhập thông báo" id="edit-notification" required><br>
                        <label for="" class="form-label">Thời gian</label>
                        <input type="time" class="form-control form-control-alt" name="time" id="edit-notification-time" required min="<?php echo date('H:i'); ?>"><br>
                        <label for="" class="form-label">Ngày tháng</label>
                        <input type="date" class="form-control form-control-alt" name="date" id="edit-notification-date" required min="<?php echo date('Y-m-d'); ?>">
                        <input type="hidden" name="id" id="edit-notification-id">
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
    <div class="modal fade" id="deleteNotificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Xóa thông báo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="deleteNotification">
                    @csrf
                    <div class="modal-body">
                        <p>Bạn có chắc chắn muốn xóa thông báo không?</p>
                        <input type="hidden" name="id" id="delete_notification_id">
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
    <table class="table table-vcenter" id="notificationsTable">
        <thead>
        <tr>
            <th class="text-center">STT</th>
            <th class="text-center">thông báo</th>
            <th class="text-center">Thời gian</th>
            <th class="text-center">Ngày tháng</th>
            <th class="text-center col-header-action">Tùy chọn</th>
            <th class="text-center col-header-action">Tùy chọn</th>
        </tr>

        <tr>
        @if(count($notifications) > 0)

            @foreach($notifications as $notification)
                <tr>
                    <td class="text-center">{{ ++$i}}</td>
                    <td class="text-center">{{ $notification->notification }}</td>
                    <td class="text-center">{{ $notification->time }}</td>
                    <td class="text-center">{{ $notification->date }}</td>
                    <td class="text-center">
                    <button class="btn btn-danger deletebutton" data-bs-toggle="modal" data-id="{{$notification->id  }}" data-bs-target="#deleteNotificationModal">Xóa</button>
                    </td>
                    <td class="text-center">
                        <button class="btn btn-success editbutton" data-bs-toggle="modal" data-id="{{$notification->id  }}" data-notification="{{$notification->notification }}"  data-time="{{$notification->time}}" data-date="{{$notification->date}}" data-bs-target="#editNotificationModal">Sửa</button>
                    </td>
                </tr>
            @endforeach

        @else
            <tr>
                <td>Không có thông báo!</td>
            </tr>
        @endif
        </thead>
    </table>
        {{$notifications->links()}}
    </div>
<style>
    #notificationsTable thead tr:hover {
        background-color: #f5f5f5;
        cursor: pointer;
    }
</style>

<script>
    $(document).ready(function(){
        $("#addNotification").submit(function(e){
            e.preventDefault();

            var formData = $(this).serialize();

            $.ajax({
                url:"{{ route('addNotification') }}",
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

    //edit notification
    $(".editbutton").click(function(){
        var notification_id = $(this).attr('data-id');
        var notification = $(this).attr('data-notification');
        var notification_time = $(this).attr('data-time');
        var notification_date = $(this).attr('data-date');
        $("#edit-notification").val(notification);
        $("#edit-notification-time").val(notification_time);
        $("#edit-notification-date").val(notification_date);
        $("#edit-notification-id").val(notification_id);

    })

    $("#editNotification").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();
        $.ajax({
            url:"{{ route('editNotification') }}",
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
        var notification_id = $(this).attr('data-id');
        $("#delete_notification_id").val(notification_id);
    })

    $("#deleteNotification").submit(function(e){
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url:"{{ route('deleteNotification') }}",
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
