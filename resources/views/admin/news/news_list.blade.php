@extends('admin.admin_layout')
@section('content')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <table style="width: 100%;">
              <th style="font-size: 26px">Danh sách tin tức</th>
              <th style="float: right">
                <form method="get" action="/admin/news/create_news" enctype='multipart/form-data'>
                    <button class="btn btn-success">Tạo bài viết</button>
                </form>
                </th>
                </table>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                  <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                  <div class="alert alert-danger" style="color: white">{{Session::get('fail')}}</div>
                @endif  
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">ID bài viết</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center">Tiêu đề</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center" colspan="2">Chức năng</th>
                      <th class="text-uppercase font-weight-bolder opacity-7 text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($news as $new)
                    <tr>
                      <td class="text-center">
                        <h6 class="mb-0">{{$new->news_id}}</h6>
                      </td>
                      <td class="text-center">
                        <h6 class="mb-0">{{$new->title}}</h6>
                      </td>
                      <td style="width:100px" class="text-center">
                        <form action="/admin/news/view_news/news_id={{$new->news_id}}" method="GET">    
                          <button type="submit" class="btn btn-info" style="width:75px; color:white">Xem</button>
                        </form>
                      </td>
                      <td style="width: 100px;" class="text-center">  
                          <form action="/admin/news/edit_news/news_id={{$new->news_id}}" method="GET">
                            <button type="submit" class="btn btn-warning" style="width:75px; color:black">Sửa</button>
                          </form>
                      </td>
                      <td style="width: 100px;">
                        <form action="/admin/news/delete_news/news_id={{$new->news_id}}" method="POST" id="deleteForm-">
                            @csrf
                            <button type="button" class="btn btn-danger" style="width:75px" onclick="openPopup('')">Xóa</button>
                        </form>
                      </td>
                    </tr>
                    <div class="popup" id="confirmPopup">
                      <div class="popup-content">
                          <p>Bạn có chắc chắn muốn xóa mục này?/p>
                          <form action="" method="POST" id="deleteForm-">
                            @csrf
                            <button id="confirmDeleteButton">Xác nhận</button>
                          </form>
                          <button id="cancelDeleteButton">Hủy bỏ</button>
                      </div>
                    </div>
                    <div class="popup" id="confirmPopup-{{$new->news_id}}">
                      <div class="popup-content">
                        <p>Bạn có chắc chắn muốn xóa chi tiết sản phẩm này không? </p>
                        <form action="/admin/news/delete_news/news_id={{$new->news_id}}" method="POST">
                            @csrf 
                            <button type="submit" id="confirmDeleteButton-{{$new->news_id}}" class="btn btn-danger">Xác nhận</button>
                            </form>
                            <button id="cancelDeleteButton-{{$new->news_id}}" class="btn btn-secondary">Hủy bỏ</button>
                      </div>
                    </div>
                  @endforeach
                  </tbody>
                </table>
                {{ $news->onEachSide(1)->links() }}
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
    function openPopup(news_id) {
      let confirmPopup = document.getElementById("confirmPopup-" + news_id);
      confirmPopup.classList.add("open-popup");

      let deleteForm = document.getElementById("deleteForm-" + news_id);

      document.getElementById('confirmDeleteButton-' + news_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
        deleteForm.submit(); // Thực hiện submit form để xóa
      });

      document.getElementById('cancelDeleteButton-' + news_id).addEventListener('click', function() {
        confirmPopup.classList.remove("open-popup");
      });
    }
  </script>
@endsection