<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Đăng ký </title>
  <link rel="shortcut icon" type="image/png" href="{{asset('/public/assets')}}/images/logos/favicon.png" />
  <link rel="stylesheet" href="{{asset('/public/assets')}}/css/styles.min.css" />
</head>
<body>
  <!--  Body Wrapper -->
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed">
  <div
    class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
    <div class="d-flex align-items-center justify-content-center w-100">
      <div class="row justify-content-center w-100">
        <div class="col-md-8 col-lg-6 col-xxl-3">
          <div class="card mb-0">
            <div class="card-body">
              <a href="/" class="text-nowrap logo-img text-center d-block py-3 w-100">
                <img src="{{asset('/public/assets')}}/images/logos/fita-logo-01.svg" width="180" alt="">
              </a>
              <p class="text-center">Đăng ký</p>

              @if($errors->any())
                  @foreach ($errors->all() as $error)
                    <p style="color: red;">{{ $error }}</p>
                    @endforeach
              @endif

              <form action="{{ route('userRegister') }}" method="POST">
                @csrf
                <div class="mb-3">
                  <label for="exampleInputtext1" class="form-label">Họ tên</label>
                  <input type="text" class="form-control" id="exampleInputtext1" name="name">
                </div>
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Email</label>
                  <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                </div>
                <div class="mb-4">
                  <label for="exampleInputPassword1" class="form-label">Nhập lại mật khẩu</label>
                  <input type="password" class="form-control" id="InputPassword1" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng ký </button>
                <div class="d-flex align-items-center justify-content-center">
                  <p class="fs-4 mb-0 fw-bold">Bạn đã có tài khoản</p>
                  <a class="text-primary fw-bold ms-2" href="/login">Đăng nhập</a>
                </div>
              </form>

              @if(Session::has('success'))
              <p style="color: green;">{{ Session::get('success') }}</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="{{asset('/public/assets')}}/libs/jquery/dist/jquery.min.js"></script>
<script src="{{asset('/public/assets')}}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
