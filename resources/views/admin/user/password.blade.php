@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Đổi Mật khẩu:</h4>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0" style="width:100%">
                            <thead>
                                <tr>
                                    <th colspan="2"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="float:right; width:50%">
                                        <h6 style=" padding-bottom: 5px;">Mật khẩu cũ:</h6>
                                        <h6 style=" padding-bottom: 5px;">Mật khẩu mới:</h6>
                                        <h6 style=" padding-bottom: 5px;">Xác nhận mật khẩu mới:</h6>
                                    </td>
                                    <td style="width:50%">
                                        <div style=" padding-bottom: 5px;" class="input-container">
                                            <input type="password" id="password1" placeholder="" style="width:300px">
                                            <i class="fas fa-eye"
                                                onclick="togglePasswordVisibility('password1', this)"></i>
                                        </div>
                                        <div style=" padding-bottom: 5px;" class="input-container">
                                            <input type="password" id="password2" placeholder="" style="width:300px">
                                            <i class="fas fa-eye"
                                                onclick="togglePasswordVisibility('password2', this)"></i>
                                        </div>
                                        <div style=" padding-bottom: 5px;" class="input-container">
                                            <input type="password" id="password3" placeholder="" style="width:300px">
                                            <i class="fas fa-eye"
                                                onclick="togglePasswordVisibility('password3', this)"></i>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="grid">
                            <form action="" method="GET" style="text-align:center">
                                <button type="submit" class="btn btn-info" style="width:75px; color:white">Lưu</button>
                            </form>
                            <form action="" method="GET" style="text-align:center; padding-left: 10px;">
                                <button type="submit" class="btn btn-warning" style="width:110px; color:white">Quay
                                    lại</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer pt-3  ">
        <div class="container-fluid">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6 mb-lg-0 mb-4">
                    <div class="copyright text-center text-sm text-muted text-lg-start">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        made with <i class="fa fa-heart"></i> by
                        <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                        for a better web.
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative
                                Tim</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                target="_blank">About Us</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                target="_blank">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                target="_blank">License</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
</main>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    function togglePasswordVisibility(inputId, icon) {
        var input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove("fa-eye");
            icon.classList.add("fa-eye-slash");
        } else {
            input.type = "password";
            icon.classList.remove("fa-eye-slash");
            icon.classList.add("fa-eye");
        }
    }
</script>
@endsection