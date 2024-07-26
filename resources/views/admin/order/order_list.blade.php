@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <table style="width: 100%">
            <th style="font-size: 26px">Đơn Hàng</th>
            <th style="float:right" colspan="2">
            </th>
            <tr>
              <td>
                <form method="post" style="width: 300px" action="/admin/order/search_order"
                  enctype='multipart/form-data'>
                  <input type="number" class="form-control" name="order_id" placeholder="Nhập mã đơn hàng..." min="1">
                  @csrf
                </form>
              </td>
              <td style="float:right;">
                <form action="{{ route('filter.status') }}" method="GET">
                  <select name="status" id="order_status" class="form-select w-auto"
                    aria-label="Chọn trạng thái đơn hàng">
                    <option value="">Chọn trạng thái</option>
                    <option value="Đang chờ xác nhận">Đang chờ xác nhận</option>
                    <option value="Đã xác nhận">Đã xác nhận</option>
                    <option value="Đang giao hàng">Đang giao hàng</option>
                    <option value="Đã giao hàng">Đã giao hàng</option>
                    <option value="Đã hủy">Đã hủy</option>
                  </select>
                  <td><button type="submit" style="border-radius: 5px; height: 40px;">Lọc</button></td>
                </form>
              </td>
            </tr>
          </table>
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
          <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
              <thead>
                <tr>
                  <th class="text-uppercase font-weight-bolder opacity-7 text-center">ID Đơn Hàng</th>
                  <th class="text-uppercase font-weight-bolder opacity-7 text-center">Ngày đặt hàng</th>
                  <th class="text-uppercase font-weight-bolder opacity-7 text-center">Trạng thái</th>
                  <th class="text-uppercase font-weight-bolder opacity-7 text-center">Chức Năng</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($orders as $order)
          <tr>
            <td class="text-center">
            <h5 class="mb-0">{{$order->order_id}}</h5>
            </td>
            <td class="text-center">
            <h5 class="mb-0">{{$order->created_at->format('d/m/Y') }}</h5>
            </td>
            <td class="text-center">
            <h5 class="mb-0">{{$order->status}}</h5>
            </td>
            <td style="width:100px" class="text-center">
            <form action="/admin/order/order_detail/order_id={{$order->order_id}}" method="GET">
              <button type="submit" class="btn btn-info" style="width:75px; color:white">Xem</button>
            </form>
            </td>
          </tr>
        @endforeach
              </tbody>
            </table>
            {{ $orders->onEachSide(1)->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</main>
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const select = document.getElementById('order_status');

    // Thay đổi của select
    select.addEventListener('change', function () {
      const selected_option = select.options[select.selectedIndex];
      const href = selected_option.getAttribute('data-href');

      if (href) {
        window.location.href = href;
      }
    });
  });
</script>
@endsection