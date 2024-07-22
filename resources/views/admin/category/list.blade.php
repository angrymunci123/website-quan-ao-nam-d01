@extends('admin.admin_layout')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <table style="width: 100%">
              <th style="font-size: 26px;">Danh Mục</th>
              <th style="float: right;">
              <form method="get" action="/admin/category/add_category">
                    <button name="controller=create" class="btn btn-success">Tạo Danh Mục</button>
                </form>
              </th>
                </table>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                  <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                  <div class="alert alert-danger" style="color: white">{{Session::get('fail')}}</div>
                @endif
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">ID Danh Mục</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Tên Danh Mục</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center" colspan="2">Chức Năng</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($categories as $category)
                    <tr>
                      <td class="text-center">
                        <h6 class="mb-0">{{ $category->category_id }}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{ $category->category_name }}</h6>
                      </td>
                      <td style="width:100px" class="text-center">
                            <form action="/admin/category/edit_category/category_id={{$category->category_id}}" method="GET">
                                <button type="submit" class="btn btn-warning" style="width:75px; color:black">Sửa</button>
                            </form>
                            </td>
                            <td style="width:100px">
                            <form action="/admin/category/delete_category/category_id={{ $category->category_id }}" method="POST" id="deleteForm-{{ $category->category_id }}">
                                @csrf
                                <button type="button" class="btn btn-danger" style="width:75px" onclick="openPopup('{{ $category->category_id }}')">Xóa</button>
                            </form>
                            </td>
                        </td>
                    </tr>
                    <div class="popup" id="confirmPopup-{{ $category->category_id }}">
                      <div class="popup-content">
                        <p>Bạn có chắc chắn muốn xóa danh mục này không?</p>
                        <form action="/admin/category/delete_category/category_id={{ $category->category_id }}" method="POST">
                            @csrf 
                            <button type="submit" id="confirmDeleteButton-{{ $category->category_id }}" class="btn btn-danger">Xác nhận</button>
                            </form>
                            <button id="cancelDeleteButton-{{ $category->category_id }}" class="btn btn-secondary">Hủy bỏ</button>
                      </div>
                    </div>
                    @endforeach
                  </tbody>
                </table>
                {{ $categories->onEachSide(1)->links() }}
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
  <script>
    function openPopup(category_id) {
      let confirmPopup = document.getElementById("confirmPopup-" + category_id);
      confirmPopup.classList.add("open-popup");

      let deleteForm = document.getElementById("deleteForm-" + category_id);

      document.getElementById('confirmDeleteButton-' + category_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); // Thực hiện submit form để xóa
      });

      document.getElementById('cancelDeleteButton-' + category_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
      });
    }
  </script>
  @endsection
