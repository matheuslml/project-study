@extends('layouts.web_base')


@section('content')
    <!--
    ============================
    PageTitle #14 Section
    ============================
    -->
    <section class="content pt-0 mt-0" >

    <!-- Carousel wrapper -->
    <div id="carouselBanner" class="carousel slide" data-bs-ride="carousel" style="height:260px;">
        <!-- Inner -->
        <div class="carousel-inner" style="height:220px;">
            <!-- Single item -->
            <div class="carousel-item active">
                <img src="{{ isset($banner->image) ? (asset('storage/images/banners/' . $banner->image)) : ''}}" class="d-block w-100" alt="{{ isset($banner->title) ? $banner->title : '' }}"/>
            </div>
        </div>
        <!-- Inner -->
    </div>
    <!-- Carousel wrapper -->
    <div class="container pt-4">
        <div class="row pt-8">
        <div class="col-12 col-lg-6 pt-4">
            <div class="title">
            <h1 class="title-heading" style="color: #009A74; font-family: 'Helvetica Neue', sans-serif; font-size: 55px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: left;">{{ isset($banner->title) ? $banner->title : '' }}</h1>
            <!-- End .breadcrumb-->
            </div>
            <!-- End .title-->
        </div>
        <!-- End .col-12-->
        </div>
        <!-- End .row-->
    </div>
    </section>
    <section id="projects">
        <div class="container">

            <div class="row">
                @foreach($projects as $project)
                <div class="col-md-3 py-3">
                    <a href="{{ route('project_web_show', $project->id) }}" style="text-decoration: none">
                        <div class="card shadow-sm" style="border-radius: 5px 5px 5px 15px; ">
                            <div style="width:100%; height: 100%">
                                <img class="card-img-top shadow rounded" src="{{asset('storage/images/projects/' . $project->thumb)}}" alt="Card image cap"
                                style="j
                                max-width: 100%;
                                height: 260px;
                                object-fit: cover;
                                border:solid 1px;
                                border-color: #b9d9ba !important;
                                ">
                            </div>
                            <div class="card-body text-center">
                                <h2 style="font-size: 22px;">{{$project->title}}</h2>
                                <p class="card-text text-secondary text-center" style="font-size: 14px;">
                                    {{$project->description}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
