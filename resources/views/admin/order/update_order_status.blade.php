@extends('admin.admin_layout')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Cập nhật trạng thái đơn hàng</h4>
            </div>
            <div class="card-body">
                @if(Session::has('notification'))
                    <div class="alert alert-success" style="color:white">
                        {{Session::get('notification')}}
                    </div>
                @endif
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
                @foreach ($order_details as $order)
              <form action="/admin/order/update_process/order_id={{$order->order_id}}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Trạng thái đơn hàng</strong>
                    </div>
                    <div class="form-group">
                        <strong>Tên người nhận hàng</strong>
                        <input class="form-control" type="text" name='consignee' value='{{$order->consignee}}' placeholder="Người nhận hàng..." required>
                    </div>
                    <div class="form-group">
                        <strong>Số điện thoại</strong>
                        <input class="form-control" type="text" name='phone_number' value='{{$order->phone_number}}' placeholder="Số điện thoại..." required>
                    </div>
                    <div class="form-group">
                        <strong>Địa chỉ nhận hàng</strong>
                        <input type="text" name="address" class="form-control" placeholder="Địa chỉ..." value='{{$order->address}}' required>
                    </div>
                    <div class="form-group">
                        <strong>Đơn vị vận chuyển</strong>
                        <select class="form-control" name='shipping_unit'>
                            <option type="text">Viettelpost</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="col-sm-4 col-xl-1">
                    <button type="submit" class="btn btn-primary mt-2" style="width:100px">Cập nhật</button>
                </div>
            </form>
            @endforeach
            <br>
            <div class="col-sm-4 col-xl-1">
                <form action="/admin/order/order_detail/order_id={{$order->order_id}}" enctype="multipart/form-data">
                    <button type="submit" class="btn btn-warning">Quay Lại</button>
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
