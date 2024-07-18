@extends('admin.admin_layout')
@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h4>Sửa Bài Viết</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive p-0">
              @foreach($news as $edit_new)
              <form action="/admin/news/update_news/news_id={{$edit_new->news_id}}" method="POST" enctype='multipart/form-data'>
                @csrf
                <div class="col-md-12">
                    <div class="form-group">
                        <strong>Tiêu Đề</strong>
                        <input type="text" name="title" id="title" class="form-control" placeholder="Tiêu đề" value="{{$edit_new->title}}" required>
                    </div>
                    <br>
                    <div class="form-group">
                        <strong>Nội Dung</strong>
                        <textarea type="text" name="content" id="content" class="form-control" cols="30" rows="10" value="{{$edit_new->content}}" placeholder="Mô tả"></textarea>
                    </div>
                    <div class="form-group">
                      <strong>Image</strong>
                      <div class="card" style="width: 300px">
                        <input type="file" name="image" value="/image/" class="form-control-ls">
                      </div>
                      <div class="card" style="width: 300px">
                        <img type="file" id="image" src="/image/" class="form-control-ls">
                      </div>
                    </div>
                </div>
                <br>
                <div class="col-sm-4 col-xl-1">
                        <button type="submit" class="btn btn-primary mt-2" style="width:100px">Cập Nhật</button>
                </div>
            </form>
            @endforeach
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
