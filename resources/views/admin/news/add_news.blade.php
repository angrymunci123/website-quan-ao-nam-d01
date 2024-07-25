@extends('admin.admin_layout')
@section('content')
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4>Tạo Bài Viết</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive p-0">
            <form action="/admin/news/save_news" method="POST" enctype='multipart/form-data'>
              {!! csrf_field() !!}
              <div class="col-md-12">
                <div class="form-group">
                  <strong>Tiêu Đề</strong>
                  <input type="text" name="title" id="title" class="form-control" placeholder="Tên sản phẩm" required maxlength="255">
                </div>
                <div class="form-group">
                  <strong>Nội Dung</strong>
                  <textarea type="text" name="content" id="content" class="form-control" cols="30" rows="10"
                    placeholder="Mô tả" required></textarea>
                </div>
                <div class="form-group">
                  <strong>Image</strong>
                  <input type="file" name="image" id="image" class="form-control-ls">
                </div>
              </div>
              <div class="grid">
                <div class="col-sm-4 col-xl-1">
                  <button type="submit" class="btn btn-primary mt-2" style="width:100px">Tạo</button>
                </div>
            </form>
            <div class="col-sm-4 col-xl-1">
              <form action="/admin/brand" enctype="multipart/form-data" style=" padding-left: 10px; padding-top: 7px">
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
