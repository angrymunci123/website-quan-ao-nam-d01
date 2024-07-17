@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h4>Thông tin cá nhân</h4>
                </div>
                <div class="card-body">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container">
                        @foreach ($user_info as $user)
                            <div>
                                <p> <b>Địa chỉ: </b>{{$user->address}}</p>
                                <p><b>Mật khẩu: </b>
                                    <!-- <a href="/ktcstore/change_password">Thay đổi</a></p> -->
                                    <input type='password' value='{{ $user->password }}' id='myInput' readonly='readonly'>
                                    <br>
                                    <input type="checkbox" id="showPassword" onclick="togglePassword()">&nbsp; Hiển thị mật
                                    khẩu
                            </div>
                        @endforeach
                        <br>
                        <div style="text-align:center">
                            <form action="/admin/personal_info/edit_info" method="GET">
                                <button type="submit" class="btn btn-info" style="width:150px; color:white">Cập
                                    nhật</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<script>
    function togglePassword() {
        var passwordField = document.getElementById("myInput");
        var checkbox = document.getElementById("showPassword");
        if (checkbox.checked) {
            passwordField.type = "text";
        } else {
            passwordField.type = "password";
        }
    }
</script>
@endsection