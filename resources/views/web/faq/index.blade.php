@extends('layouts.web_base')



@section('content')

      <!--
      ============================
     Banner
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
<!-- ======= FAQ ======= -->
    <section id="faq" class="faq">
            <div class="row mb-5 col-md-8 offset-md-2">
                <div class="">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        @foreach($faqs as $faq)
                            <div class="accordion-item col-md-10 offset-md-1">
                                <h2 class="accordion-header" id="flush-heading{{ $faq->id }}">
                                    <button id="collapse01-{{ $faq->id }}" class="accordion-button collapsed my-1" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $faq->id }}" aria-expanded="false" aria-controls="flush-collapse{{ $faq->id }}" aria-controls="collapse01-{{ $faq->id }}">
                                        <li style="color: #0e9c09;"><strong style="color: #111f2c;">{{ $faq->question }}</strong></li>
                                    </button>
                                </h2>
                                <div id="flush-collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="flush-heading{{ $faq->id }}" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body ps-5" style="background-color: #a9fcb4de; color: #041a07;">{{ $faq->answer }}</div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Frequently Asked Questions Section -->
@endsection
