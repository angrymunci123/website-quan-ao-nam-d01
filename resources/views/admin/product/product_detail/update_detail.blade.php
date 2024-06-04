@extends('admin.admin_layout')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Cập Nhật Chi Tiết Sản Phẩm</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
              @foreach($inner_join as $inj)
              <form action="/admin/product/product_detail/save_product_detail" method="POST" enctype='multipart/form-data'>
                {!! csrf_field() !!}
                {{--        @method('put')--}}
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Sản Phẩm: {{$inj->product_name}}</strong>
                        <input type="number" name="product_id" id="product_id" value="{{$inj->product_id}}" hidden required>
                    </div>
                    <div class="form-group">
                        <strong>Giá</strong>
                        <input type="number" name="price" id="price" value="{{$inj->price}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Giá Khuyến Mãi</strong>
                        <input type="number" name="sale_price" id="sale_price" value="{{$inj->sale_price}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Số lượng</strong>
                        <input type="number" name="quantity" id="quantity" value="{{$inj->quantity}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Màu Sắc</strong>
                        <input type="text" name="color" id="color" value="{{$inj->color}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Kích Cỡ</strong>
                        <input type="text" name="size" id="size" value="{{$inj->size}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <strong>Chất Liệu</strong>
                        <input type="text" name="material" id="material" value="{{$inj->material}}" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <strong>Image</strong>
                      <div class="card" style="width: 300px">
                        <input type="file" name="image" value="/image/{{$inj->image}}" class="form-control-ls">
                      </div>
                      <div class="card" style="width: 300px">
                        <img type="file" id="image" src="/image/{{$inj->image}}" class="form-control-ls">
                      </div>
                    </div>
                </div>
                </div>
                <br>
                <div class="col-sm-4 col-xl-1">
                  <button type="submit" class="btn btn-primary mt-2" style="width:100px">Sửa</button>
                </div>
            </form>
            @endforeach
            <br>
            <div class="col-sm-4 col-xl-1">
                <form action="/admin/product/product_detail/product_id={{$inj->product_id}}" enctype="multipart/form-data">
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
