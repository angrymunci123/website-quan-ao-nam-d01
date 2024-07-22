@extends('admin.admin_layout')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <table style="width: 100%;">
              <th style="font-size: 26px">Hãng Sản Xuất</th>
              <th style="float: right">
                <form method="get" action="/admin/brand/add_brand">
                    <button name="controller=create" class="btn btn-success">Tạo Hãng Sản Xuất</button>
                </form>
                </th>
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
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">ID Hãng</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Tên Hãng Sản Xuất</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center" colspan="2">Chức Năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($brands as $brand)
                    <tr>
                      <td class="text-center">
                        <h6 class="mb-0">{{ $brand->brand_id }}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{ $brand->brand_name }}</h6>
                      </td>
                      <td style="width: 100px;" class="text-center">
                            <form action="/admin/brand/edit_brand/brand_id={{$brand->brand_id}}" method="GET">
                                <button type="submit" class="btn btn-warning" style="width:75px; color:black">Sửa</button>
                            </form>
                            </td>
                            <td style="width: 100px;">
                            <form action="/admin/brand/delete_brand/brand_id={{$brand->brand_id}}" method="POST" id="deleteForm-{{$brand->brand_id}}">
                                @csrf
                                <button type="button" class="btn btn-danger" style="width:75px" onclick="openPopup('{{$brand->brand_id}}')">Xóa</button>
                            </form>
                            </td>
                        </td>
                    </tr>
                    <div class="popup" id="confirmPopup-{{$brand->brand_id}}">
                      <div class="popup-content">
                        <p>Bạn có chắc chắn muốn xóa hãng sản xuất này không? {{$brand->brand_id}}</p>
                        <form action="/admin/brand/delete_brand/brand_id={{$brand->brand_id}}" method="POST">
                            @csrf 
                            <button type="submit" id="confirmDeleteButton-{{$brand->brand_id}}" class="btn btn-danger">Xác nhận</button>
                            </form>
                            <button id="cancelDeleteButton-{{$brand->brand_id}}" class="btn btn-secondary">Hủy bỏ</button>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
                {{ $brands->onEachSide(1)->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <script>
    function openPopup(brand_id) {
      let confirmPopup = document.getElementById("confirmPopup-" + brand_id);
      confirmPopup.classList.add("open-popup");

      let deleteForm = document.getElementById("deleteForm-" + brand_id);

      document.getElementById('confirmDeleteButton-' + brand_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); // Thực hiện submit form để xóa
      });

      document.getElementById('cancelDeleteButton-' + brand_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
      });
    }
  </script>
  @endsection
