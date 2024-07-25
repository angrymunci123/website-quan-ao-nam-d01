@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-12">
      <div class="card mb-4">
        <div class="card-header pb-0">
          <h4>Tạo Danh Mục</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive p-0">
            <form action="/admin/category/save_category" method="POST" enctype='multipart/form-data'>
              {!! csrf_field() !!}
              <div class="col-md-12">
                <div class="form-group">
                  <strong>Tên Danh Mục</strong>
                  <input type="text" name="category_name" id="category_name" class="form-control" required maxlength="255">
                </div>
              </div>
              <div class="grid">
                <div class="col-sm-4 col-xl-1">
                  <button type="submit" class="btn btn-primary mt-2" style="width:100px">Lưu</button>
                </div>
            </form>
            <div class="col-sm-4 col-xl-1">
              <form action="/admin/category" enctype="multipart/form-data" style=" padding-left: 10px; padding-top: 7px">
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
<script>
  var win = navigator.platform.indexOf('Win') > -1;
  if (win && document.querySelector('#sidenav-scrollbar')) {
    var options = {
      damping: '0.5'
    }
    Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
  }
</script>
@endsection
