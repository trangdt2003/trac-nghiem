 {{-- BACK 1 --}}
 <section>
     <header id="header" class="header d-flex align-items-center fixed-top">
         <div class="container-fluid container-xl position-relative d-flex align-items-center">

             <a href="/user/dashboard" class="logo d-flex align-items-center me-auto">
                 <img src="{{ asset('/public/asset_home') }}/img/fita.png" alt="">
                 <h1 class="sitename">FITA TEST</h1>
             </a>

             <nav id="navmenu" class="navmenu">
                 <ul>
                     <li><a href="/user/dashboard" class="">Trang chủ</a></li>
                     <li><a href="/user/document">Tài liệu</a></li>
                     <li><a href="/user/exam">Đề thi</a></li>
                     <li>
                         <button class="noti" data-bs-toggle="modal" data-bs-target="#notificationModal">
                             <i class="bi bi-bell-fill"></i> <!-- Biểu tượng chuông -->
                         </button>
                     </li>

                 </ul>
                 <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
             </nav>

             <nav class="navbar navbar-expand-lg navbar-light">
                 <ul class="navbar-nav">
                     <li class="nav-item d-block d-xl-none">
                         <a class="nav-link sidebartoggler nav-icon-hover" id="headerCollapse" href="javascript:void(0)">
                             <i class="ti ti-menu-2"></i>
                         </a>
                     </li>
                 </ul>
                 <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
                     <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                         <li class="nav-item dropdown">
                             @if (Auth::check())
                                 <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop2" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                     <img src="{{ asset(Auth::user()->avatar ? '/public/avatars/' . Auth::user()->avatar : '/public/assets/images/profile/user-1.jpg') }}" alt="" width="35" height="35" class="rounded-circle">
                                     {{ Auth::user()->name }}
                                 </a>
                             @else
                                 <a class="nav-link nav-icon-hover" href="/login">
                                     <img src="{{asset('/public/assets')}}/images/profile/user-1.jpg" alt="" width="35" height="35" class="rounded-circle">
                                     Đăng nhập
                                 </a>
                             @endif

                             <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                                 <div class="message-body">
                                     <button type="button" class="d-flex align-items-center gap-2 dropdown-item" data-bs-toggle="modal" data-bs-target="#profileModal">
                                         <i class="ti ti-user fs-6"></i>
                                         <p class="mb-0"><i class="bi bi-person"></i>Trang cá nhân </p>
                                     </button>
                                     <a href="/logout" class="btn btn-outline-primary mx-3 mt-2 d-block">Đăng xuất</a>
                                 </div>
                             </div>
                         </li>
                     </ul>
                 </div>
             </nav>


{{--             modal notification--}}
             <div class="modal fade" id="notificationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="false">
                 <div class="modal-dialog">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="exampleModalLabel">Thông báo</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             @foreach($notifications as $notification)
                                 <p>Nội dung: {{ $notification->notification }} || Thời gian: {{ $notification->time }} - {{ $notification->date }}</p>
                             @endforeach
                         </div>
                         <div class="modal-footer">
                             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                         </div>
                     </div>
                 </div>
             </div>


             <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true" data-bs-backdrop="false">
                 <div class="modal-dialog modal-lg">
                     <div class="modal-content">
                         <div class="modal-header">
                             <h5 class="modal-title" id="profileModalLabel">Trang cá nhân</h5>
                             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         </div>
                         <div class="modal-body">
                             <div class="container">
                                 <div class="row">
                                     <!-- Cột hình ảnh -->
                                     <div class="col-md-4">
                                         <div class="avatar-container">
                                             @if(Auth::user()->avatar)
                                                 <img id="currentAvatar" src="{{ asset('public/avatars/' . Auth::user()->avatar) }}" alt="Current Avatar" class="img-fluid">
                                             @endif
                                         </div>
                                     </div>
                                     <!-- Cột dữ liệu -->
                                     <div class="col-md-8">
                                         <form action="{{ route('updateProfile', ['id' => Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                                             @csrf
                                             <div class="mb-3">
                                                 <label for="avatar" class="form-label">Avatar</label>
                                                 <input type="file" class="form-control" id="avatar">
                                             </div>
                                             <div class="mb-3">
                                                 <label for="name" class="form-label">Họ tên</label>
                                                 <input type="text" class="form-control" id="name" value="{{ Auth::user()->name }}">
                                             </div>
                                             <div class="mb-3">
                                                 <label for="email" class="form-label">Email</label>
                                                 <input type="email" class="form-control" id="email" value="{{ Auth::user()->email }}">
                                             </div>
                                             <div class="mb-3">
                                                 <label for="gender" class="form-label">Giới tính</label>
                                                 <select class="form-select" id="gender">
                                                     <option value="man" {{ Auth::user()->gender == 'man' ? 'selected' : '' }}>Nam</option>
                                                     <option value="woman" {{ Auth::user()->gender == 'woman' ? 'selected' : '' }}>Nữ</option>
                                                 </select>
                                             </div>
                                             <div class="mb-3">
                                                 <label for="birth" class="form-label">Sinh nhật</label>
                                                 <input type="date" class="form-control" id="birth" value="{{ Auth::user()->birth }}">
                                             </div>
                                             <div class="mb-3">
                                                 <label for="phone" class="form-label">Số điện thoại </label>
                                                 <input type="tel" class="form-control" id="phone" value="{{ Auth::user()->phone }}">
                                             </div>
                                             <div class="modal-footer">
                                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                                 <button type="submit" class="btn btn-primary profileUser"> Cập nhật </button>
                                             </div>
                                         </form>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </header>

     <style>

         .dropdown-item {
             color: #333;
             padding: 5px;
             transition: all 0.3s ease;
         }

         .dropdown-item:hover {
             background-color: #f8f9fa;
             color: #007bff;
         }

         .dropdown-item i {
             margin-right: 10px;
         }

         .btn-outline-primary {
             color: #007bff;
             border-color: #007bff;
             transition: all 0.3s ease;
         }

         .btn-outline-primary:hover {
             background-color: #007bff;
             color: #fff;
         }

         .notification-count {
             background-color: red;
             color: white;
             border-radius: 70%;
             padding: 1px 7px;
             font-size: 10px;
             position: absolute;
             top: 5px;
             right: 7px;
         }

         .noti {
             background-color: #ffffff; /* Thay #màuCủaNền bằng mã màu nền thực tế của bạn */
             border: none;
             color: #3d4348;
             padding: 10px 20px; /* Điều chỉnh kích thước nút */
             text-align: center;
             text-decoration: none;
             display: inline-block;
             font-size: 16px;
             margin: 4px 2px;
             cursor: pointer;
             border-radius: 5px; /* Góc tròn */
             transition: background-color 0.3s ease;
         }

         .noti:hover{
             color: rgba(56, 141, 168, 0.75 );
         }

         .avatar-container {
             border: 2px solid #DFE5EF; /* Đặt màu và độ dày của khung */
             width: 200px; /* Chiều rộng của khung */
             height: 300px; /* Chiều cao của khung */
             display: flex;
             justify-content: center;
             align-items: center;
         }

         .avatar-container img {
             max-width: 100%;
             max-height: 100%;
             object-fit: cover;
         } /* Đảm bảo hình ảnh luôn vừa với khung */
     </style>
     <script>
         $(document).ready(function(){
             $(".profileUser").click(function(e){
                 e.preventDefault();

                 let formData = new FormData();
                 let avatarFile = $('#avatar')[0].files[0];
                 if (avatarFile) {
                     formData.append('avatar', avatarFile);
                 }
                 formData.append('name', $('#name').val());
                 formData.append('email', $('#email').val());
                 formData.append('gender', $('#gender').val());
                 formData.append('birth', $('#birth').val());
                 formData.append('phone', $('#phone').val());
                 formData.append('_token', '{{ csrf_token() }}');

                 $.ajax({
                     url: "{{ route('updateUserProfile', ['id' => Auth::user()->id]) }}",
                     type: 'POST',
                     data: formData,
                     contentType: false,
                     processData: false,
                     success: function(response){
                         // Cập nhật dữ liệu người dùng ở đây
                         alert('cập nhật thành công');
                         location.reload();
                     },
                     error: function(response){
                         alert('Error: ' + response.message);
                     }
                 });
             });
         });
     </script>
  </section>
