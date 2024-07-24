@extends('admin.admin_layout')
@section('content')
<!-- End Navbar -->
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
            @foreach ($news_detail as $news)
                <div class="card-header pb-0">
                    <table style="width: 100%">
                        <tr>
                            <th style="width:75%"></th>
                            <th colspan="3" style="width:25%"></th>
                        </tr>
                        <tr>
                            <td>
                                <h4>Chi tiết bài viết: {{$news->title}}</h4>
                            </td>
                            <td>
                                <form action="/admin/news" method="GET">
                                    <button type="submit" class="btn btn-info" style="width:120px; color:white">Quay lại</button>
                                </form>
                            </td>
                            <td>
                                <form action="/admin/news/edit_news/news_id={{$news->news_id}}" method="GET">
                                    <button type="submit" class="btn btn-warning"
                                        style="width:75px; color:white; padding-left: 10px; padding-right: 10px;">Sửa</button>
                                </form>
                            </td>
                            <td>
                                <form action="/admin/news/delete_news/news_id={{$news->news_id}}" method="POST">
                                @csrf
                                    <button type="submit" class="btn btn-danger"
                                        style="width:75px; color:white">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-body">
                    @if(Session::has('notification'))
                        <div class="alert alert-success" style="color:white">
                            {{Session::get('notification')}}
                        </div>
                    @endif
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container align-items-center">
                        <div class="text-center">
                            @if($news->image == NULL)

                            @else
                            <img src="/image/{{$news->image}}" style="width:400px;height:600px;">
                            @endif
                        </div>
                        <div class="blog__details__content">

                            <div class="blog__details__text">
                                <p>{{$news->content}}</p>
                            </div>
                            <div class="blog__details__text">
                                <p><b>Ngày tạo: </b> {{$news->created_at}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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