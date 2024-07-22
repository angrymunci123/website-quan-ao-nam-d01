@extends('admin.admin_layout')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <table style="width: 100%">
              <th style="font-size: 26px">Sản Phẩm</th>
              <th style="float:right">
                <form method="get" action="/admin/product/add_product">
                    <button name="controller=create"  class="btn btn-success">Tạo Sản Phẩm</button>
                </form>
                </th>
                </table>
            </div>
            <div class="input-group" style="width: 300px; padding-left: 23px">
              <form method="post" style="width: 300px" action="/admin/product/search_product" enctype='multipart/form-data'>
                <input type="text" class="form-control" name="keywords" placeholder="Sản phẩm...">
                @csrf
              </form>
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
                <table class="table align-items-center mb-0" >
                  <thead>
                    <tr>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">ID</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Tên Sản Phẩm</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Danh Mục</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Nhãn Hiệu</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center" colspan="3">Chức Năng</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($search_products as $search)
                    <tr>
                      <td class="text-center">
                        <h6 class="mb-0">{{$search->product_id}}</h6>
                        </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$search->product_name}}</h6>
                      </td> 
                      <td class="text-center">
                        <h6 class="mb-0">{{$search->category_name}}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$search->brand_name}}</h6>
                      </td>
                      <td style="width:10px; column-gap: 1px;" class="text-center" >
                            <form action="/admin/product/product_detail/product_id={{$search->product_id}}" method="GET">    
                                <button type="submit" class="btn btn-info" style="width:75px ;color:white">Xem</button>
                            </form>
                            </td>
                            <td style="width:10px; column-gap: 1px;" class="text-center">
                            <form action="/admin/product/edit_product/product_id={{$search->product_id}}" method="GET">
                                <button type="submit" class="btn btn-warning" style="width:75px ;color:black">Sửa</button>
                            </form>
                            </td>
                            <td style="width:10px; column-gap: 1px;" class="text-center">
                            <form action="/admin/product/delete_product/product_id={{$search->product_id}}" method="POST" id="deleteForm-{{$search->product_id}}">
                                @csrf
                                <button type="button" class="btn btn-danger" style="width:75px" onclick="openPopup('{{$search->product_id}}')">Xóa</button>
                            </form>
                            </td>
                        </td>
                    </tr>
                    <div class="popup" id="confirmPopup">
                      <div class="popup-content">
                          <p>Bạn có chắc chắn muốn xóa sản phẩm này không?</p>
                          <form action="/admin/product/delete_product/product_id={{$search->product_id}}" method="POST">
                          @csrf 
                          <button id="confirmDeleteButton">Xác nhận</button>
                          </form>
                          <button id="cancelDeleteButton">Hủy bỏ</button>
                      </div>
                    </div>
                  @endforeach
                  </tbody>
                </table>
                {{ $search_products->onEachSide(1)->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <script>
    let confirmPopup = document.getElementById("confirmPopup");
    
    let deleteForm = document.getElementById("deleteForm-{{$search->product_id}}");

    function openPopup() {
        confirmPopup.classList.add("open-popup");
    }

    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); // Thực hiện submit form để xóa
    });

    document.getElementById('cancelDeleteButton').addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
    });

  </script>
  @endsection
