@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <table style="width: 100%">
            @foreach($view_prd_details as $prd)
        <th style="font-size: 26px; text-align:center">Chi Tiết Sản Phẩm: {{ $prd->product_name }}</th>
      @endforeach
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
          <div class="table-responsive p-0 ">
            <table class="table align-items-center" style="width: 100%; margin-left:auto; margin-right:auto">
              @foreach($view_prd_details as $prd)
          <tr>
          <td class="col-md-6">
            <div style="float: right">
            <img src="/image/{{$prd->image}}" style="width:400px;height:600px;">
            </div>
          </td>
          <td class="col-md-6">
            <h5><b>{{ $prd->product_name }}</b></h5>
            <h6>Giá: {{ number_format($prd->price) }} VND</h6>
            <h6>Giá khuyến mãi: {{ number_format($prd->sale_price) }} VND</h6>
            <h6>Màu Sắc: {{ $prd->color }}</h6>
            <p><b>Size</b>: {{ $prd->size }}</p>
            <h6>Số Lượng: {{ $prd->quantity }}</h6>
            <table style="margin-bottom: 20px; border:none">
            <tr>
              <th colspan="3"></th>
            </tr>
            <tr>
              <td>
              <form action="/admin/product/product_detail/product_id={{$prd->product_id}}" method="GET"
                enctype='multipart/form-data'>
                <button class="btn btn-info">Quay Lại</button>
              </form>
              </td>
              <td>
              <form
                action="/admin/product/product_detail/edit_detail/product_id={{$prd->product_id}}&product_detail_id={{$prd->product_detail_id}}"
                method="GET">
                <button type="submit" class="btn btn-warning" style="width:75px ;color:black">Sửa</button>
              </form>
              </td>
              <td>
              <form
                action="/admin/product/product_detail/delete_detail/product_id={{$prd->product_id}}&product_detail_id={{$prd->product_detail_id}}"
                method="POST">
                @csrf
                <button type="submit" class="btn btn-danger" style="width:75px">Xóa</button>
              </form>
              </td>
            </tr>
            </table>
          </td>
          </tr>
        @endforeach
            </table>
            <div class="container">
              <h4 style="text-align: justify">Mô Tả</h4>
              <p style="text-align: justify">{{$prd->description}}</p>
              <center>
                <img src="{{ asset('admin_assets/img/des.png')}}" style="width: 550px">
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

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
  let confirmPopup = document.getElementById("confirmPopup");
  let deleteForm = document.getElementById("deleteForm-");

  function openPopup() {
    confirmPopup.classList.add("open-popup");
  }

  document.getElementById('confirmDeleteButton').addEventListener('click', function () {
    confirmPopup.classList.remove("open-popup");
    deleteForm.submit(); // Thực hiện submit form để xóa
  });

  document.getElementById('cancelDeleteButton').addEventListener('click', function () {
    confirmPopup.classList.remove("open-popup");
  });

</script>
@endsection