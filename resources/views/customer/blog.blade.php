@extends('customer.layout')
@section('content')
<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-blog set-bg" data-setbg="{{ asset ('temp_assets/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Tin tức</h2>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Blog Section Begin -->
    <section class="blog spad">
        <div class="container">
            <div class="row">
                @foreach($news_list as $news)
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic set-bg" data-setbg="{{ asset('image/'.$news->image) }}">
                            <img src="{{ asset('image/'.$news->image) }}" alt="Image" style="display: none;">
                        </div>
                        <div class="blog__item__text">
                            <span><img src="{{ asset('temp_assets/img/icon/calendar.png') }}" alt="">{{ $news->created_at }}</span>
                            <h5>{{ $news->title }}</h5>
                            <a href="/ktcstore/blog/{{$news->title}}">Xem thêm</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Blog Section End -->
@endsection
