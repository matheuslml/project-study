<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<link rel="shortcut icon" href="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->icon) : ''}}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($unit->name) ? $unit->name : '' }}</title>


    @component('web.components.styles')


    @endcomponent
</head>

    <body>
        <!-- ======= Top Bar ======= -->
        <section id="topbar">
            <div class="clearfix">
                <div class="contact-info float-start">
                    <a href="mailto:grc@{{ isset($unit->email) ? $unit->email : '' }}"><i class="fa fa-envelope"></i>{{ isset($unit->email) ? $unit->email : '' }}</a>
                    <a
                    href="
                    {{ isset($unit) ?
                        'https://api.whatsapp.com/send/?phone=%2B' .
                            $unit->phone .
                            '&text&type=phone_number&app_absent=0'
                            : ''
                    }}" ><i class="fab fa-whatsapp"></i> {{ isset($unit->phone) ? $unit->phone : '' }}</a>
                </div>


                <div class="social-links-topbar float-end " >
                    @if(isset($unit))
                        @foreach($unit->socialmedia as $social_media)
                            <a class="share-facebook" href="{{$social_media->pivot->url}}"><i class="{{ $social_media->logo }}"></i></a>
                        @endforeach
                    @endif
                </div>
                <div class="topbar-bar float-end d-none d-lg-block" >
                    <p>|</p>
                </div>
                <div class="topbar-text float-end d-none d-lg-block" >
                    <a href="https://transparencia.arraial.modernizacao.com.br/">
                        <p>Acesso a</p>
                        <p>Informação</p>
                    </a>
                </div>
                <div class="topbar-img float-end d-none d-lg-block" >
                    <a href="https://arraial.egov.modernizacao.com.br/" class="">
                        <img src="{{ isset($web_footer->float_icon_url) ? asset('storage/images/webfooters/' . $web_footer->float_icon_url) : '' }}"
                        class="" alt="icon"/>
                    </a>
                </div>
            </div>
        </section>
        <!-- ======= Header ======= -->
        <header id="header" >
            <div class="" style="margin-left: 2%;">

              <div class="logo float-start d-none d-xl-block">
                  <a href="{{ route('web_home') }}"><img class="img-profile"
                src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}"></a>
              </div>
              <div class="logo float-start d-lg-none">
                <img class="img-profile"
                  src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}">
              </div>

              <nav class="nav-menu float-start d-none d-lg-block" style="margin-left: 2%">
                <ul>
                  <li class="{{ (request()->is('/')) || (request()->is('/')) ? 'active' : '' }}">
                    <a href="{{ route('web_home') }}">Início</a></li>
                  <li class="drop-down {{ (request()->is('institucional*')) || (request()->is('institucional*')) ? 'active' : '' }}">
                    <a href="">Institucional</a>
                    <ul>
                      <li class="{{ (request()->is('institucional/estrutura')) || (request()->is('institucional/estrutura')) ? 'active' : '' }}">
                        <a href="">Estrutura Organizacional</a>
                      </li>
                      @foreach ($institucional_pages as $institucional_page)
                          <li class="">
                              <a href="{{ route('pagina_web', $institucional_page->meta_keywords) }}">{{ $institucional_page->meta_keywords }}</a>
                          </li>
                      @endforeach
                      <li class="{{ (request()->is('institucional/unidadesconservacao')) || (request()->is('institucional/unidadesconservacao')) ? 'active' : '' }}">
                    </ul>
                  </li>
                  <li class="drop-down {{ (request()->is('servicos*')) || (request()->is('faq')) ? 'active' : '' }}">
                    <a href="">Serviços</a>
                    <ul>
                      @foreach ($service_pages as $service_page)
                          @if ($service_page->meta_keywords != 'Matrícula')
                              <li class="">
                                  <a href="{{ route('pagina_web', $service_page->meta_keywords) }}">{{ $service_page->meta_keywords }}</a>
                              </li>
                          @endif
                      @endforeach
                      <li class="{{ (request()->is('ouvidoria')) || (request()->is('ouvidoria')) ? 'active' : '' }}">
                        <a href="{{ route('web_faq') }}">FAQ</a>
                      </li>
                      <li class="{{ (request()->is('ouvidoria')) || (request()->is('ouvidoria')) ? 'active' : '' }}">
                        <a href="{{ route('web_ombudsman') }}">Ouvidoria</a>
                      </li>
                    </ul>
                  </li>
                  <li class="drop-down {{ (request()->is('programas*')) || (request()->is('programas*')) ? 'active' : '' }}">
                    <a href="">Programas</a>
                    <ul>
                      @foreach ($categories as $category)
                          <li class="">
                              <a href="{{ route('project_category_web', $category->id) }}">{{ $category->title }}</a>
                          </li>
                      @endforeach
                    </ul>
                  </li>
                  <li class="drop-down {{ (request()->is('publicacoes')) || (request()->is('publicacao*')) ? 'active' : '' }}">
                    <a href="">Publicações</a>
                    <ul>
                      <li class="{{ (request()->is('gallery_web_index')) || (request()->is('gallery_web_index')) ? 'active' : '' }}">
                        <a href="{{ route('gallery_web_index') }}">Galeria</a>
                      </li>
                      <li class="{{ (request()->is('noticias_web')) || (request()->is('noticias_web')) ? 'active' : '' }}">
                          <a href="{{ route('noticias_web_index') }}">Noticias</a>
                        </li>
                    </ul>
                  </li>
                  <li class="drop-down {{ (request()->is('publicacoes')) || (request()->is('publicacao*')) ? 'active' : '' }}">
                    <a href="">Publicações Oficiais</a>
                    <ul>
                      <li class="{{ (request()->is('official_diary_web_index')) || (request()->is('official_diary_web_index')) ? 'active' : '' }}">
                        <a href="{{ route('official_diary_web_index') }}">Diário Oficial</a>
                      </li>
                    </ul>
                  </li>
                  <li  {{ (request()->is('transparencia*')) || (request()->is('transparencia*')) ? 'active' : '' }}">
                    <a href="https://transparencia.arraial.modernizacao.com.br">Transparência</a>
                    <!--<ul>
                      <li><a href="{{ route('web_expense_index') }}">Despesas</a></li>
                      <li><a href="{{ route('web_legislacoes_index') }}">Legislações</a></li>
                      <li><a href="{{ route('web_revenue_index') }}">Receitas</a></li>
                    </ul>-->
                  </li>
                  @foreach ($service_pages as $service_page)
                      @if ($service_page->meta_keywords == 'Matrícula')
                          <li class="{{ (request()->is('pagina_web/Matrícula')) ? 'active' : '' }}">
                              <a href="{{ route('pagina_web', $service_page->meta_keywords) }}">Matricule-se</a>
                          </li>
                      @endif
                  @endforeach

                  <li class="drop-down"> <a href="">Servidor</a>
                    <ul>
                      <li class="">
                        <a class="employee-menu-link" href="{{ route('login') }}">Login</a></li>
                      <li class="">
                        <a href="https://mail.hostinger.com/">E-mail</a></li>
                      <li class=""><a href="{{ route('links_uteis') }}">Telefones Úteis</a></li>
                    </ul>
                  </li>

                </ul>
              </nav><!-- .nav-menu -->

            </div>
          </header><!-- End Header -->

        <main id="main">
            @include('flash::message')

            @yield('content')
        </main>
         <!-- ======= Footer ======= -->
        <footer id="footer">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-sm-12 col-xs-12">
                           <div class="card p-3 p-md-4 text-white">

                                <h2 class="my-3" style="color: black; background-color: white"> Acesse nossa Ouvidoria e faça um comentário!</h2>

                                <div class="row d-flex my-2 pr-2 pr-md-5 div1">
                                    <div class="col-4">
                                        <button class="btn text-white px-4 py-2" style="width: 100%"> Acessar </button>
                                    </div>
                                </div>

                            </div>
                    </div>
                </div>


            </div>
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-lg-4 col-md-6 footer-newsletter">
                            <iframe src="{{ isset($unit->google_maps_iframe) ? $unit->google_maps_iframe : '' }}" height="100%" width="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="col-12 col-lg-3 col-md-6 footer-info">
                            <img class="img-profile-footer-home" src="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->logo) : ''}}" >
                            <div class="col-12 text-footer-phone">
                                <p class="mt-2">
                                    {{ isset($unit->organization) ? $unit->organization->title : ''}} <br>
                                    {{ isset($unit) ? $unit->address : '' }}<br>
                                    {{ isset($unit->organization) ? $unit->operation : '' }}<br><br>
                                </p>
                                <a  href="mailto:{{ isset($unit->email) ? $unit->email : '' }}"><i class="fa fa-envelope"></i> {{ isset($unit->email) ? $unit->email : '' }}</a><br>                    <a
                                href="
                                {{ isset($unit) ?
                                    'https://api.whatsapp.com/send/?phone=%2B' .
                                        $unit->phone .
                                        '&text&type=phone_number&app_absent=0'
                                        : ''
                                }}" ><i class="fab fa-whatsapp"></i> {{ isset($unit->phone) ? $unit->phone : '' }}</a><br>
                                <a  href="{{ isset($unit) ? $unit->operation : '' }}"><i class="fa fa-home"></i> {{ isset($unit->operation) ? $unit->operation : '' }}</a>
                            </div>
                        </div>

                        <div class="col-12 col-lg-2 col-md-6 footer-links  text-footer-phone">
                            {!! html_entity_decode((isset($web_footer->content_left) ? $web_footer->content_left : ''), ENT_QUOTES, 'UTF-8') !!}
                        </div>
                        <div class="col-12 col-lg-2 col-md-6 footer-links  text-footer-phone" style="padding-left: 4%";>
                            {!! html_entity_decode((isset($web_footer->content_right) ? $web_footer->content_right : ''), ENT_QUOTES, 'UTF-8') !!}
                        </div>


                    </div>
                </div>
            </div>

            <div class="container b-5 px-3 pt-3 text-muted text-center text-small">
                <div class="row develop-by">
                    <div class="col-12 text-center " >
                        <a style="color: white;" href="{{ isset($copyright->link_url) ? $copyright->link_url : '' }}"><p class="mb-1"> Desenvolvido pela {{ isset($copyright->company_name) ? $copyright->company_name : '' }}</p></a>
                    </div>
                    <div class="col-12" >
                        @php
                            $verifica_logo = false;
                        @endphp
                        @if (isset($web_footer->logos))
                            @foreach ( $web_footer->logos as $logo)
                                <a href="{{ $logo->link_url }}">
                                    <img
                                        {{ $verifica_logo ? "style=\"padding-left:10px;margin-left:10px;border-left:1px solid #858796;\"" : '' }}
                                        src="{{asset('storage/images/webfooters/' . $logo->logo_url)}}"
                                        alt="{{ $logo->title }}"
                                    />
                                </a>
                                @if ($verifica_logo)
                                    @php
                                        $verifica_logo = false;
                                    @endphp
                                @else
                                    @php
                                        $verifica_logo = true;
                                    @endphp
                                @endif
                            @endforeach
                        @endif
                        @if (isset($copyright->logo_url))
                            <a href="{{ isset($copyright->link_url) ? $copyright->link_url : '' }}"><img src="{{asset('storage/images/copyrights/' . $copyright->logo_url)}}" height="50" style="padding-left:10px;margin-left:10px;border-left:1px solid #858796;" alt="{{ $copyright->company_name }}"></a>
                        @endif
                    </div>
                </div>
            </div>
        </footer><!-- End Footer -->
        <div vw class="enabled">
            <div vw-access-button class="active"></div>
            <div vw-plugin-wrapper>
              <div class="vw-plugin-top-wrapper"></div>
            </div>
          </div>
          <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
          <script>
            new window.VLibras.Widget('https://vlibras.gov.br/app');
          </script>

            <a href="https://arraial.egov.modernizacao.com.br/" class="back-to-top-link"><img src="{{ isset($web_footer->float_icon_url) ? asset('storage/images/webfooters/' . $web_footer->float_icon_url) : '' }}" class="" alt="icon"/></a>
        @component('web.components.scripts')

        @endcomponent
    {{-- JS Script --}}
    @yield('js-script')
    {{-- JS Script --}}
    </body>
</html>
