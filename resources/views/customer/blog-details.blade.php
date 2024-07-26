@extends('customer.layout')
@section('content')
@foreach($news_detail as $news)
 <section class="blog-hero spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-9 text-center">
                    <div class="blog__hero__text">
                        <h2>{{$news->title}}</h2>

                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-details spad">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-12">
                    @if ($news->image == NULL)

                    @else
                    <div class="blog__details__pic">
                        <img src="/image/{{$news->image}}" alt="">
                    </div>
                    @endif
                </div>
                <div class="col-lg-8">
                    <div class="blog__details__content">

                        <div class="blog__details__text">
                            <p>{{$news->content}}</p>
                        </div>
                        <div class="blog__details__quote">
                            <i class="fa fa-quote-left"></i>
                            <p>Người đăng: {{$news->fullname}}</p>
                            <h6>Ngày đăng: {{$news->created_at}}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Details Section End -->
@endforeach
@endsection
