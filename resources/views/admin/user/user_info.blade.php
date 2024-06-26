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
                    <table class="table align-items-center"
                        style="padding-left: 15px; padding-right: 15px;">
                        <tbody>
                            <tr style="width:100%">
                                @foreach ($user_info as $user)
                                <td class="font-weight-bolder"
                                    style="float: left; border: solid white">
                                    <div>
                                        <p> <b>Họ và tên: </b> {{$user->fullname}}</p>
                                        <p> <b>Địa chỉ Email: </b>{{$user->email}}</p>
                                        <p> <b>Số điện thoại: </b>{{$user->phone_number}}</p>
                                    </div>
                                </td>
                                <td class="font-weight-bolder" style="float:right; border: solid white">
                                    <div>
                                        <p> <b>Địa chỉ: </b>{{$user->address}}</p>
                                        <p><b>Mật khẩu: </b>
                                            <!-- <a href="/ktcstore/change_password">Thay đổi</a></p> -->
                                            <input type='password' value='{{ $user->password }}' id='myInput' readonly='readonly'>
                                            <br>
                                            <input type="checkbox" onclick="myFunction()">&nbsp; Hiển thị mật khẩu
                                    </div>
                                </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <div style="text-align:center">
                        <form action="/admin/personal_info/edit_info" method="GET">
                            <button type="submit" class="btn btn-info" style="width:100px; color:white">Cập nhật</button>
                        </form>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection