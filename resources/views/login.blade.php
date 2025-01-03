
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đăng nhập</title>
  <link rel="shortcut icon" type="image/png" href="{{asset('/public/assets')}}/images/logos/favicon.png" />
  <link rel="stylesheet" href="{{asset('/public/assets')}}/css/styles.min.css" />
  <link rel="stylesheet" href="{{asset('/public/assets')}}/css/app.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
    {{-- main content --}}
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
                <p class="text-center">Đăng nhập</p>
                @if($errors->any())
                @foreach ($errors->all() as $error)
                  <p style="color: red;">{{ $error }}</p>
                  @endforeach
                @endif

                @if(Session::has('error'))
                <p style="color: red;">{{ Session::get('error') }}</p>
                @endif

                <form action="{{ route('userLogin') }}" method="POST">
                  @csrf
                  <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" name="email">
                  </div>
                    <div class="mb-4">
                        <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
                        <div>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
                            <i id="togglePassword" class="bi bi-eye"></i>
                        </div>
                    </div>
                  <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="form-check">
                      <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                      <label class="form-check-label text-dark" for="flexCheckChecked">
                        Nhớ tới tôi
                      </label>
                    </div>
                    <a class="text-primary fw-bold" href="/forget-password">Quên mật khẩu</a>
                  </div>
                  <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng nhập</button>
                  <div class="d-flex align-items-center justify-content-center">
                    <p class="fs-4 mb-0 fw-bold">Tạo tài khoản mới?</p>
                    <a class="text-primary fw-bold ms-2" href="/register">Đăng ký</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#exampleInputPassword1');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
        });
    </script>
  <script src="{{asset('/public/assets')}}/libs/jquery/dist/jquery.min.js"></script>
  <script src="{{asset('/public/assets')}}/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('/public/assets')}}/js/sidebarmenu.js"></script>
  <script src="{{asset('/public/assets')}}/js/app.min.js"></script>
  <script src="{{asset('/public/assets')}}/libs/apexcharts/dist/apexcharts.min.js"></script>
  <script src="{{asset('/public/assets')}}/libs/simplebar/dist/simplebar.js"></script>
  <script src="{{asset('/public/assets')}}/js/dashboard.js"></script>
</body>
</html>
