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
            <form action="/admin/product/update_product/product_id={{$products->product_id}}" method="POST"
              enctype='multipart/form-data'>
              {!! csrf_field() !!}
              <div class="col-md-12">
                <div class="form-group">
                  <strong>Tên Sản Phẩm</strong>
                  <input type="text" name="product_name" id="productname" class="form-control"
                    value="{{$products->product_name}}" required maxlength="255"/>
                </div>
                <div class="form-group">
                  <strong>Danh Mục</strong>
                  <select class="form-control" name='category_id'>

                    @foreach($categories as $category)
            <option type="number" name='category_id' value='{{$category->category_id}}'>
              {{$category->category_name}}</option>
            {{-- if ({{$products->category_id}} == {{$category->category_id}}){
            <option type="number" name='category_id' value='{{$category->category_id}}' selected>
              {{$category->category_name}}</option>
            } else {
            <option type="number" name='category_id' value='{{$category->category_id}}'>
              {{$category->category_name}}</option>
            } --}}
          @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <strong>Nhãn Hiệu</strong>
                  <select class="form-control" name='brand_id'>
                    @foreach($brands as $brand)
            <option type="number" name='brand_id' value='{{$brand->brand_id}}'>{{$brand->brand_name}}</option>
          @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <strong>Mô Tả Sản Phẩm</strong>
                  <textarea type="text" name="description" id="description" class="form-control" cols="30"
                    rows="10">{{$products->description}} required</textarea>
                </div>
              </div>
          </div>
          <div class="grid">
            <div class="col-sm-4 col-xl-1">
              <button type="submit" class="btn btn-primary mt-2" style="width:120px">Cập Nhật</button>
            </div>
            </form>
            <div class="col-sm-4 col-xl-1">
              <form action="/admin/product" enctype="multipart/form-data" style=" padding-left: 30px; padding-top: 7px">
                <button type="submit" class="btn btn-warning" style="width: 120px;">Quay Lại</button>
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
