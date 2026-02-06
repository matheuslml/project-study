@extends('layouts.web_base')

@section('page-style')
@endsection

@section('content')
    <div id="carouselHomeBanner" class="carousel slide carousel-fade" data-mdb-ride="carousel" style="height:100%;">
        <!-- Indicators -->
        <div class="carousel-indicators">
            @php
                $i=0;
            @endphp
            @foreach($posts as $post)
                <button
                type="button"
                data-mdb-target="#carouselHomeBanner"
                data-mdb-slide-to={{ $i }}
                @if ($i == 0)
                    class="active"
                    aria-current="true"
                @endif
                aria-label={{ $post->title }}
                ></button>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>

        <!-- Inner -->
        <div class="carousel-inner" style="height:100%;">
            @php
                $banner_path = "";
                $verification = false; //verification serve para dr o status active para o banner
            @endphp
            @foreach($posts as $post)
                @foreach($post->media as $img)
                <!-- parei aqui pegar por tamanho da pag o bannr path-->
                    @if($img->type_media_id == 1 && !$isMobile)
                        @php
                            $banner_path = $img->url;
                        @endphp
                    @endif
                    @if($img->type_media_id == 2 && $isMobile)
                        @php
                            $banner_path = $img->url;
                        @endphp
                    @endif
                @endforeach

                //verifica se foi upada imagem para mobile
                @php
                    $banner_path = "";
                    foreach($post->media as $img) {
                        if($img->type_media_id == 1 && !$isMobile) {
                            $banner_path = $img->url;
                        }
                        if($img->type_media_id == 2 && $isMobile) {
                            $banner_path = $img->url;
                        }
                    }
                    // Fallback: usa a imagem desktop se a mobile não existir
                    if($isMobile && empty($banner_path)) {
                        $banner_path = $post->media->where('type_media_id', 1)->first()->url ?? '';
                    }
                @endphp
                
                    @if ($verification)
                        <!-- Single item -->
                        <div class="carousel-item">
                            @if (isset($post->link))
                                <a href="{{ $post->link }}"><img src="{{asset('storage/images/posts/' . $banner_path)}}" class="d-block w-100" alt="Capa PMAC"/></a>
                            @else
                                <img src="{{asset('storage/images/posts/' . $banner_path)}}" class="d-block w-100" alt="Capa PMAC"/>
                            @endif
                            @if (isset($post->title))
                                <div class="carousel-caption d-none " >
                                    <h5>{{ $post->title }}</h5>
                                    <p>{{ $post->sub_title }}</p>
                                </div>
                            @endif
                        </div>
                    @else
                        @php
                            $verification = true;
                        @endphp
                        <!-- Single item -->
                        <div class="carousel-item active">
                            @if (isset($post->link))
                                <a href="{{ $post->link }}"><img src="{{asset('storage/images/posts/' . $banner_path)}}" class="d-block w-100" alt="Capa PMAC"/></a>
                            @else
                                <img src="{{asset('storage/images/posts/' . $banner_path)}}" class="d-block w-100" alt="Capa PMAC"/>
                            @endif
                            @if (isset($post->title))
                                <div class="carousel-caption d-none ">
                                    <h5>{{ $post->title }}</h5>
                                    <p>{{ $post->sub_title }}</p>
                                </div>
                            @endif
                        </div>
                    @endif
            @endforeach
        </div>
        <!-- Inner -->

        <!-- Controls -->
        <button class="carousel-control-prev" type="button" data-mdb-target="#carouselHomeBanner" data-mdb-slide="prev">
            <span class="" aria-hidden="true" style="font-size: 125%"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-mdb-target="#carouselHomeBanner" data-mdb-slide="next">
            <span class="" aria-hidden="true" style="font-size: 125%"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></span>
            <span class="visually-hidden">Próximo</span>
        </button>
    </div>
    <!-- Carousel wrapper -->

    <!-- SHORTCUT ICONS -->
    <div class="team-boxed">
        <div class="container">
            <div class="carousel-wrapper">
            <div class="row person">
                @foreach ($web_shortcuts as $web_shortcut)
                <div class="col-12 col-md-2 col-lg-2 col-xl-2 item">
                    <a href="{{ $web_shortcut->link_url }}">
                    <div class="box">
                        <img class="rounded-circle" src="{{asset('storage/images/shortcutweb/' . $web_shortcut->img_url)}}">
                        <h2 class="name">{{ $web_shortcut->title }}</h2>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
            <!-- Botões de navegação ajustados -->
            <button class="carousel-nav prev" aria-label="Botão anterior">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-nav next" aria-label="Botão próximo">
                <i class="fa fa-chevron-circle-right" aria-hidden="true"></i>
                <span class="visually-hidden">Próximo</span>
            </button>
            </div>
        </div>
    </div>
    <!-- ======= comment section ======= -->
    <section class="comment-section" >
      <div class="container">
            <h3>Arraial do Cabo, é um verdadeiro paraíso costeiro. Com suas dunas, restingas, lagoas e praias deslumbrantes, a cidade encanta moradores e turistas. Além disso, Arraial do Cabo é conhecida como a capital brasileira do mergulho.</h3>
      </div>
    </section>

  <!-- ======= title-section ======= -->
  <section class="title-section" >
    <div class="container">
        <h2>Notícias</h2>
        <div class="col-md-6 pt-0 mt-0">
            <h3>Acompanhe as Notícias da Cidade</h3>
        </div>
    </div>
  </section>
  <!-- ======= News Section =======  -->
  <section class="news-section pc d-none d-lg-block" style="background-color: #eef4f7;">
    <div class="container "style="background-color: #eef4f7;">
        <div class="row ">
            <div class="col-md-12">
                <div id="news-slider" class="owl-carousel"  >
                    @foreach($news as $obj)
                        <div class="post-slide"  >
                            <div class="post-img">
                                <a href="{{ route('news_web_show', $obj->id) }}"><img src="{{asset('storage/images/news/' . $obj->image)}}" alt=""></a>
                            </div>
                            <div class="post-content">
                                <div class="post-date">
                                    <span class="month">{{ date('M', strtoTime($obj->created_at))}}</span>
                                    <span class="date">{{ date('d', strtoTime($obj->created_at))}}</span>
                                </div>
                                <h5 class="post-title one-line-truncate"><a href="{{ route('news_web_show', $obj->id) }}">{{$obj->title}}</a></h5>
                                <p class="post-description one-line-truncate">
                                    {{substr($obj->description, 0, 127) . '...'}}
                                </p>
                            </div>
                                <ul class="post-bar">
                                    <li> <a href="{{ route('news_web_show', $obj->id) }}">Ver Notícia</a> </li>
                                </ul>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
  </section>

    <section class="news-section phone d-lg-none" >
        <div class="container ">
            <div class="row  ">
                <div class="col-12">
                    <div id=""   >
                        @foreach($news as $obj)
                            <div class="post-slide"  >
                                <div class="post-img">
                                    <a href="{{ route('news_web_show', $obj->id) }}"><img src="{{asset('storage/images/news/' . $obj->image)}}" alt=""></a>
                                </div>
                                <div class="post-content">
                                    <div class="post-date">
                                        <span class="month">{{ date('M', strtoTime($obj->created_at))}}</span>
                                        <span class="date">{{ date('d', strtoTime($obj->created_at))}}</span>
                                    </div>
                                    <h5 class="post-title"><a href="#">{{$obj->title}}</a></h5>
                                    <p class="post-description">
                                        {{substr($obj->description, 0, 127) . '...'}}
                                    </p>
                                </div>
                                    <ul class="post-bar">
                                        <li> <a href="{{ route('news_web_show', $obj->id) }}">Ver Notícia</a> </li>
                                    </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>


  <!-- ======= Secretários Section ======= -->
  <section class="title-section" >
    <div class="container">
        <h2>Secretarias</h2>
        <div class="col-md-6 pt-0 mt-0">
            <h3>Conheça os Secretários e as Secretarias da nossa Prefeitura</h3>
        </div>
    </div>
  </section>
    <!-- secretarias -->
    <div class="team-boxed" style="padding-bottom: 5%">
        <div class="container" ><div class="gtco-testimonials">
            <div class="owl-carousel owl-carousel1 owl-theme leadership-web" >
                @foreach ($leaderships as $leadership)
                    <div>
                        <div class="card text-center ">
                            <img
                                class="card-img-leadership"
                                src="{{asset('storage/images/leadership/' . $leadership->photo)}}" alt="">
                            <div class="card-body" style="width: 300px">
                                <h5>{{ substr($leadership->name, 0, 34)  . '...' }}</h5>
                                <p>{{ $leadership->occupation }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
          </div>
        </div>
    </div>

    @foreach ($service_pages as $service_page)
        @if ($service_page->meta_keywords == 'Matrícula')
            <!-- ======= Contact Us Section ======= -->
            <section id="matricula" class="matricula">
                <div class="container mt-5 mb-5">

                    <div class="section-title">
                        <h2>Faça sua Matrícula</h2>
                    </div>

                    <div class=" text-center" >
                        <a href="{{ route('pagina_web', $service_page->meta_keywords) }}" class="btn ">Clique Aqui e Saiba Mais<i class="energia-arrow-right"></i></a>
                    </div>

                </div>
            </section><!-- End Contact Us Section -->
        @endif
    @endforeach
    <!-- Carousel wrapper -->
    <section class="comment-section" >
        <div class="container">
              <h3 style="padding-top: 4%">
                O Portal da Prefeitura de Arraial do Cabo está em processo de Manutenção.
                Em Breve estaremos normalizados.
              </h3>
              <p style="text-align: center; padding-top: 2%">Se precisar de Ajuda Mande sua Manifestação <a href="{{ route('web_ombudsman') }}">AQUI</a></p>
        </div>
      </section>
@endsection


@section('page-script')
  {{-- Page js files --}}
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js"></script>
  <script>

    $(document).ready(function() {
        $("#news-slider").owlCarousel({
            items:3,
            itemsDesktop:[1199,3],
            itemsDesktopSmall:[1000,2],
            itemsMobile:[600,1],
            pagination:true,
            navigationText:false,
            autoPlay:true,
        });

        let maxHeight = 0;
        $('#news-slider .post-slide').each(function(i,e){
            let currentHeight = $(e).height();
            maxHeight = (currentHeight > maxHeight) ? currentHeight : maxHeight;
            console.log(maxHeight);
        })
        $('#news-slider').height(`${maxHeight}px`)
    });
  </script>

  <!-- SHORTCUT NAV-BUTTON -->
  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const carousel = document.querySelector('.team-boxed .row.person');
      const prevButton = document.querySelector('.carousel-nav.prev');
      const nextButton = document.querySelector('.carousel-nav.next');

      // Função para centralizar o primeiro item visível no mobile
      function centerFirstItem() {
        if (window.innerWidth <= 767 && carousel) {
          const firstItem = carousel.querySelector('.item');
          if (firstItem) {
            const itemWidth = firstItem.offsetWidth;
            const viewportWidth = carousel.offsetWidth;
            const scrollOffset = (itemWidth - viewportWidth) / 2;
            carousel.scrollLeft = -scrollOffset; // Ajusta a posição inicial
          }
        }
      }

      // Executa a centralização inicial
      centerFirstItem();

      // Reexecuta ao redimensionar a janela
      window.addEventListener('resize', centerFirstItem);

      // Funcionalidade de navegação
      if (carousel && prevButton && nextButton) {
        prevButton.addEventListener('click', function () {
          carousel.scrollBy({ left: -carousel.offsetWidth * 0.8, behavior: 'smooth' });
        });

        nextButton.addEventListener('click', function () {
          carousel.scrollBy({ left: carousel.offsetWidth * 0.8, behavior: 'smooth' });
        });
      }
    });
  </script>
@endsection

