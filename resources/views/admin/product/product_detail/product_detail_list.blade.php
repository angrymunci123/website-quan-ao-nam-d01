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
  <div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
    <script>
    function openPopup(product_detail_id) {
      let confirmPopup = document.getElementById("confirmPopup-" + product_detail_id);
      confirmPopup.classList.add("open-popup");

      let deleteForm = document.getElementById("deleteForm-" + product_detail_id);

      document.getElementById('confirmDeleteButton-' + product_detail_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); // Thực hiện submit form để xóa
      });

      document.getElementById('cancelDeleteButton-' + product_detail_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
      });
    }
  </script>
  @endsection
