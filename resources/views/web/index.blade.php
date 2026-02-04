@extends('layouts.web_base')

@section('content')

  <!-- SUBMENU -->
  <div class="submenu border-bottom py-5">
    <nav class="submenu2">
      <ul>
        <li><a href="{{ route('services.environmentlicensing.home') }}">
          <img src="img/icons/submenu-licenc-amb-icon.png">
          <h7>LICENCIAMENTO AMBIENTAL</h7></a></li>
        <li><a href="{{ route('services.environmenteducation') }}">
          <img src="img/icons/submenu-educ-amb-icon.png">
          <h7>EDUCAÇÃO AMBIENTAL</h7></a></li>
        <li><a href="{{ route('institutional.conservationunits') }}">
          <img src="img/icons/submenu-unid-conserv-icon.png">
          <h7>UNIDADES DE CONSERVAÇÃO</h7></a></li>
        <li><a href="{{ route('ombudsman') }}">
          <img src="img/icons/submenu-crime-amb-icon.png">
          <h7>DENÚNCIA DE CRIME AMBIENTAL</h7></a></li>
        <li><a href="{{ route('utilities.balneabilityofbeaches') }}">
          <img src="img/icons/submenu-baln-praias-icon.png">
          <h7>BALNEABILIDADE DE PRAIAS</h7></a></li>
      </ul>
    </nav>
  </div>

  <!-- ======= About Us Section ======= -->
  <section id="about" class="about">
      <div class="container">

          <div class="row no-gutters">

            <div class="row">
              <div class="col-lg-6 d-flex flex-column justify-content-top about-content">
                <div class="p-4 p-md-5 mb-4 text-white rounded bg-dark">
                  <div class="col-md-6 px-0">
                    <h5 class="display-4 fst-italic">Notícia Principal</h5>
                    <p class="lead my-3">Multiple lines of text that form the lede, informing new readers quickly and efficiently about what’s most interesting in this post’s contents.</p>
                    <p class="lead mb-0"><a class="text-white fw-bold" href="#">Continue lendo...</a></p></div></div>
              </div>

              <div class="col-lg-6 d-flex flex-column justify-content-top about-content">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-0">Notícia 1</h4>
                    <div class="mb-1 text-muted">Fev 12</div>
                    <p class="card-text mb-auto">Aqui será adicionada uma breve descrição da notícia como prévia do que será informado para auxiliar a captar a atenção do leitor.</p>
                    <a href="#" class="stretched-link">Continue lendo...</a></div>
                  <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect>
                      <text x="35%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg></div>
                </div>

                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                  <div class="col p-4 d-flex flex-column position-static">
                    <h4 class="mb-0">Notícia 2</h4>
                    <div class="mb-1 text-muted">Jan 25</div>
                    <p class="card-text mb-auto">Aqui será adicionada uma breve descrição da notícia como prévia do que será informado para auxiliar a captar a atenção do leitor.</p>
                    <a href="#" class="stretched-link">Continue lendo...</a></div>
                  <div class="col-auto d-none d-lg-block">
                    <svg class="bd-placeholder-img" width="200" height="250" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                      <title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect>
                      <text x="35%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg></div>
                </div>

              </div>
            </div>

          </div>
        </div>
  </section><!-- End About Us Section -->

  <!-- ======= Contact Us Section ======= -->
  <section id="contact" class="contact">
      <div class="container">

        <div class="section-title">
          <h2>Canais de Comunicação e Denúncias:</h2>
        </div>

        <div class="row">

          <div class="col-lg-6 d-flex align-items-stretch" data-aos="fade-up">
            <div class="info-box">
              <i class="bx bx-map"></i>
                <h3>Site</h3>
              <p><a href="{{route('ombudsman')}}">semas.arraial.rj.gov.br/ouvidoria</a></p>
            </div>
          </div>

          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="info-box">
              <i class="bx bx-envelope"></i>
                <h3>Email</h3>
              <p>gab.ambiente@arraial.rj.gov.br</p>
            </div>
          </div>
          <div class="col-lg-3 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
            <div class="info-box ">
              <i class="bx bx-phone-call"></i>
                <h3>Telefone</h3>
              <p> (22) 99758 7280 (whatsapp)</p>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Contact Us Section -->

  <script src="{{asset('js/animanumbers.js')}}"></script>

@endsection
