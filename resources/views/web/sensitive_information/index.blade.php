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
            <div class="my-3 p-3 bg-white rounded box-shadow">
                <h6 class="border-bottom border-gray pb-2 mb-0">Suggestions</h6>
                <div class="media text-muted pt-3">
                <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Full Name</strong>
                    <a href="#">Follow</a>
                    </div>
                    <span class="d-block">@username</span>
                </div>
                </div>
                <div class="media text-muted pt-3">
                <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Full Name</strong>
                    <a href="#">Follow</a>
                    </div>
                    <span class="d-block">@username</span>
                </div>
                </div>
                <div class="media text-muted pt-3">
                <img data-src="holder.js/32x32?theme=thumb&bg=007bff&fg=007bff&size=1" alt="" class="mr-2 rounded">
                <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                    <div class="d-flex justify-content-between align-items-center w-100">
                    <strong class="text-gray-dark">Full Name</strong>
                    <a href="#">Follow</a>
                    </div>
                    <span class="d-block">@username</span>
                </div>
                </div>
                <small class="d-block text-right mt-3">
                <a href="#">All suggestions</a>
                </small>
            </div>
        </div>
    </section>
@endsection
