@extends('login_layout')
@section('content')
<div class="limiter">
		<div class="container-login100" style="background-image: url('temp_assets/img/background.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="user" method="get" action="/reset_password">
					<strong class="login100-form-title p-b-49" style="font-family: Arial">
						Quên mật khẩu
					</strong>
					@if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
					<div class="wrap-input100 validate-input m-b-23" data-validate = "Địa chỉ email là bắt buộc">
						<span class="label-input100" style="font-family: Arial">Địa Chỉ Email</span>
						<input class="input100" style="font-family: Arial" type="email" name="email" id="exampleInputEmail" aria-describedby="emailHelp" value="{{old('email')}}" placeholder="Địa chỉ email">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Mật khẩu là bắt buộc">
						<span class="label-input100" style="font-family: Arial">Nhập mật khẩu cũ trước đó bạn đã đăng nhập</span>
						<input style="font-family: Arial" class="input100" type="password" name="old_password" id="exampleInputPassword1" placeholder="Mật khẩu">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn btn-success" type="submit" style="font-family: Arial">
								<strong>
								Xác nhận
								</strong>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div id="dropDownSelect1"></div>
@endsection
