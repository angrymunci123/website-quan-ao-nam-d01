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
                        <input type="text" name="title" id="title" class="form-control" placeholder="Tên sản phẩm" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <strong>Nội Dung</strong>
                        <textarea type="text" name="content" id="content" class="form-control" cols="30" rows="10" placeholder="Mô tả"></textarea>
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

    </div>
  </main>
@endsection
