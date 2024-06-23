@extends('admin.admin_layout')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Tạo Biến Thể Sản Phẩm</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
              <form action="/admin/product/product_detail/save_product_detail" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        @foreach($products as $prd)
                        <strong>Sản Phẩm: {{$prd->product_name}}</strong>
                        <input hidden type="number" name="product_id" id="product_id" class="form-control" value="{{$prd->product_id}}" readonly/>
                        @endforeach
                    </div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token()?>"/>
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
                        <input type="text" name="size" id="size" class="form-control" required>
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
                @foreach ($products as $product)
                    <form action="/admin/product/product_detail/product_id={{$product->product_id}}" enctype="multipart/form-data">
                        <button type="submit" class="btn btn-warning">Quay Lại</button>
                    </form>
                @endforeach
            </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </main>
@endsection
