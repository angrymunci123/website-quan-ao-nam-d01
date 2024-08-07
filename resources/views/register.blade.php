@extends('login_layout')
@section('content')
<div class="limiter">
		<div class="container-login100" style="background-image: url('temp_assets/img/background.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="user" method="POST" action="{{route('registerProcess')}}">
					<span class="login100-form-title p-b-49" style="font-family: Arial;">
						<b>Đăng Ký KTC Store</b>
					</span>
					@if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
                    <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Địa chỉ email là bắt buộc">
						<span class="label-input100" style="font-family: Arial;">Địa Chỉ Email</span>
						<input class="input100" type="email" name="email" id="exampleInputEmail" aria-describedby="emailHelp" value="{{old('email')}}" placeholder="Địa chỉ email" maxlength="255">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<div class="wrap-input100 validate-input" data-validate="Họ và tên là bắt buộc">
						<span class="label-input100" style="font-family: Arial;">Họ Và Tên</span>
						<input class="input100" type="text" name="full_name" id="" placeholder="Họ Và Tên" style="font-family: Arial;" maxlength="255">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<br>
					<div class="wrap-input100 validate-input" data-validate="Địa Chỉ là bắt buộc">
						<span class="label-input100" style="font-family: Arial;">Địa Chỉ</span>
						<input class="input100" type="text" name="address" id="" placeholder="Địa Chỉ" style="font-family: Arial;" maxlength="255">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<br>
					<div class="wrap-input100 validate-input" data-validate="Số Điện Thoại là bắt buộc">
						<span class="label-input100" style="font-family: Arial;">Số Điện Thoại</span>
						<input class="input100" type="text" name="phone_number" id="" oninput="this.value = this.value.replace(/[^0-9]/g, '')" placeholder="Số Điện Thoại" style="font-family: Arial;" minlength="10" maxlength="11">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>
					<br>
					<div class="wrap-input100 validate-input" data-validate="Mật khẩu là bắt buộc">
						<span class="label-input100" style="font-family: Arial;">Mật Khẩu</span>
						<input class="input100" type="password" name="password" id="exampleInputPassword1" placeholder="Mật khẩu" minlength="8" maxlength="20" style="font-family: Arial;">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<div class="wrap-input100 validate-input" data-validate="Mật khẩu là bắt buộc">
						<span class="label-input100" style="font-family: Arial;">Xác Nhận Mật Khẩu</span>
						<input class="input100" type="password" name="confirm_password" id="" placeholder="Mật khẩu từ 8 tới 20 kí tự" minlength="8" maxlength="20" style="font-family: Arial;">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<form class="user" method="GET" action="/register/register_process">
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" type="submit" style="font-family: Arial">
									<strong>Đăng Ký</strong>
							</button>
						</div>
					</div>
					</form>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>
@endsection
