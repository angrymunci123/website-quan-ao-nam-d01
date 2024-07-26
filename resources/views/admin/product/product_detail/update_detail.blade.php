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
          <form
            action="/admin/product/product_detail/update_detail"
            method="POST" enctype='multipart/form-data'>
            {!! csrf_field() !!}
            <input type="hidden" name="product_id" value="{{$inj->product_id}}">
            <input type="hidden" name="product_detail_id" value="{{$inj->product_detail_id}}">
            {{-- @method('put')--}}
            <div class="col-md-12">
              <div class="form-group">
                <strong>Sản Phẩm: {{$inj->product_name}}</strong>
                <input type="number" name="product_id" id="product_id" value="{{$inj->product_id}}" hidden required maxlength="255">
              </div>
              <div class="form-group">
                <strong>Giá</strong>
                <input type="number" name="price" id="price" value="{{$inj->price}}" class="form-control" required max="9999999999">
              </div>
              <div class="form-group">
                <strong>Giá Khuyến Mãi</strong>
                <input type="number" name="sale_price" id="sale_price" value="{{$inj->sale_price}}"
                class="form-control" required max="9999999999">
              </div>
              <div class="form-group">
                <strong>Số lượng</strong>
                <input type="number" name="quantity" id="quantity" value="{{$inj->quantity}}" class="form-control"
                required max="500">
              </div>
              <div class="form-group">
                <strong>Màu Sắc</strong>
                <input type="text" name="color" id="color" value="{{$inj->color}}" class="form-control" required maxlength="255" >
              </div>
              <div class="form-group">
                <strong>Kích Cỡ</strong>
                <select name="size" id="size" class="form-select w-auto" aria-label="Chọn kích cỡ" required >
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                    </select>
              </div>
              <div class="form-group">
                <strong>Chất Liệu</strong>
                <input type="text" name="material" id="material" value="{{$inj->material}}" class="form-control"
                required maxlength="255">
              </div>
              <div class="form-group">
                <strong>Image</strong>
                <div class="card" style="width: 300px">
                <input type="file" name="image" value="/image/{{$inj->image}}" class="form-control-ls" required>
                </div>
                <div class="card" style="width: 300px">
                <img type="file" id="image" src="/image/{{$inj->image}}" class="form-control-ls">
                </div>
              </div>
            </div>
          </div>
          <div class="grid">
          <div class="col-sm-4 col-xl-1">
            <button type="submit" class="btn btn-primary mt-2" style="width:100px">Sửa</button>
          </div>
          </form>
      @endforeach
            <div class="col-sm-4 col-xl-1">
              <form action="/admin/product/product_detail/product_id={{$inj->product_id}}"
                enctype="multipart/form-data" style=" padding-left: 10px; padding-top: 7px" >
                <button type="submit" class="btn btn-warning" style="width: 120px;">Quay Lại</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

</div>
</main>
@endsection
