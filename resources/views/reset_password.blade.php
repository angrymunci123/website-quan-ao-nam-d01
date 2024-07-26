@extends('login_layout')
@section('content')
<div class="limiter">
		<div class="container-login100" style="background-image: url('temp_assets/img/background.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="user" method="POST" action="/reset_password_process">
					<strong class="login100-form-title p-b-49" style="font-family: Arial">
						Đặt mật khẩu mới
					</strong>
					@if(Session::has('success'))
                        <div class="alert alert-success">{{Session::get('success')}}</div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">{{Session::get('fail')}}</div>
                    @endif
                    @csrf
					<input type="hidden" name="email" value="{{$email}}"/>
					<div class="wrap-input100 validate-input" data-validate="Mật khẩu mới là bắt buộc">
						<span class="label-input100" style="font-family: Arial">Mật khẩu mới</span>
						<input style="font-family: Arial" class="input100" type="password" name="new_password" id="exampleInputPassword1" required placeholder="Mật khẩu mới" minlength="8" maxlength="20">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<div class="wrap-input100 validate-input" data-validate="Xác nhận mật khẩu mới là bắt buộc">
						<span class="label-input100" style="font-family: Arial">Xác nhận mật khẩu mới</span>
						<input style="font-family: Arial" class="input100" type="password" name="confirm_new_password" id="exampleInputPassword1" required placeholder="Xác nhận mật khẩu mới" minlength="8" maxlength="20">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div>
					<br>
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn btn-success" type="submit" style="font-family: Arial">
								<strong>
								Đổi mật khẩu
								</strong>
							</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
@endsection
