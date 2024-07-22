@extends('admin.admin_layout')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <table style="width: 100%">
              @foreach($product_name as $prd)
                <th style="font-size: 26px">Các Chi Tiết Sản Phẩm: {{ $prd->product_name }}</th>
              @endforeach
                <th style="float:right">
                <form method="get" action="/admin/product/product_detail/add_product_detail/product_id={{ $product_id }}">
                  @csrf
                  <input type="number" name="product_id" value="{{$product_id}}" required hidden>
                  <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
                      <button name="controller=create" class="btn btn-success">Tạo Chi Tiết Sản Phẩm</button>
                  </form>
                </th>
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
                <table class="table align-items-center mb-0" >
                  <thead>
                    <tr>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">ID</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Giá</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Giá khuyến mãi</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Số Lượng</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Màu Sắc</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Chất Liệu</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Size</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center" colspan="3">Chức Năng</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($product_details as $product_detail)
                    <tr>
                      <td class="text-center">
                          <h6 class="mb-0">{{$product_detail->product_detail_id}}</h6>
                        </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{number_format($product_detail->price)}} VND</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{number_format($product_detail->sale_price)}} VND</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$product_detail->quantity}}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$product_detail->color}}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$product_detail->material}}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$product_detail->size}}</h6>
                      </td>
                          <td style="width:10px; column-gap: 1px;" class="text-center" >
                            <form action="/admin/product/product_detail/view_detail/product_id={{$product_detail->product_id}}&product_detail_id={{$product_detail->product_detail_id}}" method="GET">
                                <button type="submit" class="btn btn-info" style="width:75px ;color:white">Xem</button>
                            </form>
                            </td>
                            <td style="width:10px; column-gap: 1px;" class="text-center">
                                <form action="/admin/product/product_detail/edit_detail/product_id={{$product_detail->product_id}}&product_detail_id={{$product_detail->product_detail_id}}" method="GET">
                                    <button type="submit" class="btn btn-warning" style="width:75px ;color:black">Sửa</button>
                                </form>
                            </td>
                            <td style="width:10px; column-gap: 1px;" class="text-center">
                            <form action="" method="POST" id="deleteForm-{{$product_detail->product_detail_id}}">
                                @csrf
                                <button type="button" class="btn btn-danger" style="width:75px" onclick="openPopup('{{$product_detail->product_detail_id}}')">Xóa</button>
                            </form>
                            </td>
                    </tr>
                  <div class="popup" id="confirmPopup-{{$product_detail->product_detail_id}}">
                      <div class="popup-content">
                        <p>Bạn có chắc chắn muốn xóa chi tiết sản phẩm này không? </p>
                        <form action="/admin/product/product_detail/delete_detail/product_id={{$product_detail->product_id}}&product_detail_id={{$product_detail->product_detail_id}}" method="POST">
                            @csrf 
                            <button type="submit" id="confirmDeleteButton-{{$product_detail->product_detail_id}}" class="btn btn-danger">Xác nhận</button>
                            </form>
                            <button id="cancelDeleteButton-{{$product_detail->product_detail_id}}" class="btn btn-secondary">Hủy bỏ</button>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
                {{ $product_details->onEachSide(1)->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
    <script>
    function openPopup(product_detail_id) {
      let confirmPopup = document.getElementById("confirmPopup-" + product_detail_id);
      confirmPopup.classList.add("open-popup");

      let deleteForm = document.getElementById("deleteForm-" + product_detail_id);

      document.getElementById('confirmDeleteButton-' + product_detail_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); 
      });

      document.getElementById('cancelDeleteButton-' + product_detail_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
      });
    }
  </script>
  @endsection
