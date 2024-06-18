@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <table style="width: 100%">
              <th style="font-size: 26px;" class="text-center">Chi tiết đơn hàng</th>
                </table>
            </div>
            <div class="card-body">
                @if(Session::has('notification'))
                    <div class="alert alert-success" style="color:white">
                        {{Session::get('notification')}}
                    </div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">   
                    <table class="table align-items-center mb-0" style="padding-left: 15px; padding-right: 15px; border-style: none">
                        <tbody>
                        <tr style="width:100%">
                        <td class="font-weight-bolder opacity-7" style="float: left; width: 50%">
                            <div>
                                <p><b>Họ tên người nhận: </b>Nguyễn Trung Thành</p>
                                <p><b>SDT:</b></p>
                                <p><b>Địa chỉ:</b></p>
                                <p><b>Ngày đặt:</b></p>
                            </div>
                        </td>
                        <td class="font-weight-bolder opacity-7" style="width: 50%">
                            <div style="float:right">
                                <p><b>ID đơn hàng:</b></p>
                                <p><b>Tình trạng đơn hàng:</b></p>
                                <p><b>Phương thức thanh toán:</b></p>
                                <p><b>Ngày chỉnh sửa:</b></p>
                            </div>
                        </td>                      
                        </tr>
                        </tbody>
                    </table>
                    <table class="table align-items-center table-bordered" style="padding: 20px; width:100%;">
                        <thead class="thead-light">
                        <tr style="width:100%; text-align: center">
                            <th>Sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr style="width:100%; text-align: center">
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                            <td>1</td>
                        </tr>
                        </tbody>
                    </table>
                    <table style="width: 100%"> 
                        <tr style="width: 100%">
                            <td class="font-weight-bolder" style="width: 50%">
                                <div style="float: left; padding-left: 50px">
                                    <p><b>Tổng:</b></p>
                                </div>
                            </td>                    
                        </tr>
                    </table>
                    <form action="" method="GET" style="padding-right: 20px; float: right">    
                        <button type="submit" class="btn btn-success" style="width: 110px; color:white">Quay lại<i></i></button>
                    </form>    
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection