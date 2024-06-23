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
              <form action="/admin/product/product_detail/update_detail/product_id={{$inj->product_id}}&product_detail_id={{$inj->product_detail_id}}" method="POST" enctype='multipart/form-data'>
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
  
    </div>
  </main>
@endsection
