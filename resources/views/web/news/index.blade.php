@extends('layouts.web_base')

@section('content')
    <section class="section" style="width: 100%;">
        <div class="container px-5" >
            <div class="row">
                <div class="col-md-9">
                    @foreach ($news as $new)
                        <div class="row pt-5 col-md-12">
                            <div class="col-md-4">
                                <div class="bg-image hover-overlay ripple shadow-2-strong rounded-5" data-mdb-ripple-color="light">
                                    <img src="{{asset('storage/images/news/' . $new->image)}}" class="img-news" />
                                    <a href="{{ route('news_web_show', $new->id) }}">
                                    <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);"></div>
                                    </a>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <span class="badge bg-danger px-2 py-1 shadow-1-strong mb-3">{{ ($new->created_at)->format('d / m / Y  H:m:s') }}</span>
                                <h4>
                                    <strong class="two-line-truncate">{{ $new->title }}</strong>
                                </h4>
                                <p class="text-muted two-line-truncate">
                                    {{ $new->description }}
                                </p>
                                <div class="" style="display: inline-block" >
                                    @foreach ($new->tags as $tag)
                                        <a href="http://" style="position: relative; float: left; padding-right: 5px;"><p style="font-size: 12px; color: rgb(121, 121, 245)">{{ $tag->tag . ';' }} </p></a>
                                    @endforeach
                                </div>
                                <div>
                                    <a href="{{ route('news_web_show', $new->id) }}" class="btn" style="background-color: #009A74; color: white;">Ler Mais</a>
                                </div>
                            </div>
                        </div>
                        <hr>

                    @endforeach

                </div>
                <div class="col-md-3" >
                    <div class="pt-5 " style="text-align: right">
                        <h5 >Características</h5>
                        @foreach ($categories as $category)
                            <a href="" class="btn btn-lg btn-block" style="text-align: right; background-color: #009A74; color: white;">{{ $category->title }}</a>
                        @endforeach
                    </div>
                    <div class="pt-5 " style="text-align: right">
                        <h5 >Tags</h5>
                        @foreach ($tags as $tag)
                            <a href="" class="btn btn-lg btn-block" style="text-align: right; background-color: #009A74; color: white;">{{ $tag->tag }}</a>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-12" >

                    <div class="d-flex justify-content-center" style="margin-top: 3%;">
                        {{ $news->links()}}
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
