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
                <div class="card-body px-0 pt-0 pb-2">
                <div class="container">
                    <table class="table align-items-center"
                        style="padding-left: 15px; padding-right: 15px;">
                        <tbody>
                            @foreach($user_info as $user)
                    <tr style="width:100%">
                        <td class="font-weight-bolder"
                            style="float: left; border: solid white">
                            <div>
                                <br>
                                <p> <b>Họ và tên: </b> {{$user->fullname}}</p>
                                <p> <b>Địa chỉ Email: </b>{{$user->email}}</p>
                            </div>
                        </td>
                        <td class="font-weight-bolder" style="float:right; border: solid white">
                            <div>
                                <form action="/admin/personal_info/update_info" method="POST" enctype='multipart/form-data'>
                                    @csrf
                                    <input hidden type="text" name="fullname" value="{{$user->fullname}}" required/>
                                    <input hidden type="text" name="email" value="{{$user->email}}" required/>
                                    <p> <b>Số điện thoại: </b> <input type="text" name="phone_number" value="{{$user->phone_number}}" placeholder="Số điện thoại" required maxlength="255"/></p>
                                    <p> <b>Địa chỉ: </b> <input type="text" name="address" value="{{$user->address}}" placeholder="Địa chỉ" required maxlength="255"/></p>
                                    <div style="text-align:center">
                                        <button type="submit" class="btn btn-info" style="width:100px; color:white">Cập nhật</button>
                                    </div>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
@endsection
