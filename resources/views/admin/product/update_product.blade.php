@extends('admin.admin_layout')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Cập Nhật Sản Phẩm</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
              <form action="/admin/product/product_detail/save_product_detail" method="POST" enctype='multipart/form-data'>
                {!! csrf_field() !!}
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Tên Sản Phẩm</strong>
  
                        <input type="text" name="product_id" id="product_id" class="form-control" value="" readonly/>
         
                    </div>
                    <div class="form-group">
                        <strong>Giá</strong>
                        <input type="number" name="price" id="price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Giá Khuyến Mãi</strong>
                        <input type="number" name="sale_price" id="sale_price" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Số lượng</strong>
                        <input type="number" name="quantity" id="quantity" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Màu Sắc</strong>
                        <input type="text" name="color" id="color" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Kích Cỡ</strong>
                        <input type="number" name="size" id="size" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Chất Liệu</strong>
                        <input type="text" name="material" id="material" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Image</strong>
                        <input type="file" name="image" id="image" class="form-control-ls">
                    </div>
                </div>
                </div>
                <br>
                <div class="col-sm-4 col-xl-1">
                        <button type="submit" class="btn btn-primary mt-2" style="width:100px">Tạo</button>
                </div>
            </form>
            <br>
            <div class="col-sm-4 col-xl-1">
                <form action="/admin/brand" enctype="multipart/form-data">
                    <button type="submit" class="btn btn-warning">Quay Lại</button>
                </form>
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer pt-3  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
@endsection
