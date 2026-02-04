@extends('layouts.web_base')


@section('content')
  <!--
  ============================
  PageTitle #14 Section
  ============================
  -->
  <section class="page-title page-title-14" id="page-title">
    <div class="page-title-wrap bg-overlay bg-overlay-dark-3">
      <div class="bg-section"><img src="{{ isset($banner->image) ? (asset('storage/images/banners/' . $banner->image)) : ''}}" alt="{{ isset($banner->title) ? $banner->title : '' }}"/></div>
      <div class="container">
        <div class="row">
          <div class="col-12 col-lg-6">
            <div class="section-title">
              <h2>Ouvidoria</h2>
              <!-- End .breadcrumb-->
            </div>
            <!-- End .title-->
          </div>
          <!-- End .col-12-->
        </div>
        <!-- End .row-->
      </div>
      <!-- End .container-->
    </div>
  </section>
  <!-- End #page-title-->
  <section id="costumer-service">
    <div class="container">
      <!-- <div class="section-title">
          <h2>Ouvidoria</h2>
      </div> -->
      <div class="row">
        <!-- FORMULÁRIO -->
        <div class="col-md-4">
          <div class="contact-card">
            <div class="contact-body">
              <h5 class="card-heading">Manifestação</h5>
              <p class="card-desc">Ficamos agradecidos pelo seu comentário.</p>
                @if(session()->exists('success'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>SUCESSO! </strong> {{ session('success')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
                @if(session()->exists('error'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>ERRO! </strong> {{ session('error')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
              <form name="ouvidoria_form" method="POST" action="{{ route('ombudsman_store') }}">
                @csrf
                <input type="text" name="access_id" id="access_id" hidden>
                <div class="mb-20">
                  <div class="row">
                    <div class="mb-3 identificado" style="display: none;">
                      <!-- <label class="form-label" for="name">Nome</label> -->
                      <input class="form-control" type="text" id="name" name="name" placeholder="Nome Completo" />
                    </div>
                    <div class="mb-3 identificado" style="display: none;">
                      <!-- <label class="form-label" for="email">E-mail</label> -->
                      <input class="form-control" type="text" id="email" name="email" placeholder="E-mail" />
                    </div>
                    <div class="mb-3 hidden-form" style="display: none;">
                      <label class="form-label" for="type_request_id">Tipo</label>
                      <select class="form-control" id="type_request_id" onclick="info()" name="type_request_id">
                        @foreach($type_requests as $request)
                          <option value="{{$request->id}}">{{$request->title}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="mb-3 hidden-form" style="display: none;">
                      <!-- <label class="form-label" for="title">Assunto</label> -->
                      <input class="form-control" type="text" id="title" name="title" placeholder="Assunto" />
                    </div>
                    <div class="mb-3 hidden-form" style="display: none;">
                      <label class="form-label" for="content">Mensagem </label>
                      <textarea class="form-control" id="content" placeholder="Add other data" name="content" cols="30" rows="5"> </textarea>
                    </div>
                  </div>
                </div>
                <div> 
                  <div class="row">
                    <div class="col-12 hidden-form" style="display: none;">
                      <button type="submit" class="btn btn-success">Enviar manifestação <i class="energia-arrow-right"></i></button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- End .contact-body -->
        </div> 
        <div class="col-md-8 ouvidoria">
          <p class="heading-subtitle">Ajude a melhorar o nosso trabalho.</p>
          <h4 class="card-title">Formulário de Manifestação da População</h4>
          <p class="heading-desc">Escolha entre identificado ou anônimo, o modo de fazer sua manifestação.</p>
          <div class="contact-action">
            <button class="btn btn-success" onclick="identificado()"><a>Identificado</a></button>
            <button class="btn btn-success" onclick="anonimo()"><a>Anônimo</a></button>
          </div>
          <div class="ombudsman-info">
            <img style="margin:10px;" src="{{ asset('assets-web/images/icons/noteicon-2.png')}}" alt="icon"/>
            <p style="margin:10px;">Uma manifestação feita não tem resposta ao manifestante. Para mais dúvidas, nos telefone: <a href="tel:{{isset($unit) ? $unit->phone : ''}}">{{isset($unit) ? $unit->phone : ''}}</a></p>
          </div>

          <!-- OUVIDORIA INFO -->
          <div class="container info">
            <div class="type-info">
              <h5 class="card-title">Atendimento Presencial</h5>
              <p>Rua Tókio, nº 76, Baleia- Arraial do Cabo (sede).</p>
              <p>De segunda a sexta-feira, das 9h às 17h.</p>
              <p>WhatsApp: (22) xxxxxxxxxx.</p>
              <p>Para entrar em contato com a Secretaria do Ambiente e 
                Saneamento, preencha o formulário ou envie um e-mail para
                <a href="mailto:gab.ambiente@arraial.rj.gov.br">nosso contato</a>.</p>
            </div>
          </div>

          <!-- DENUNCIA AMBIENTAL -->
          <div class="container denuncia" style="display: none;">
            <div class="type-info">
              <h5 class="card-title">Denúncia Ambiental</h5>
              <p>Antes de fazer sua denúncia ambiental ou solicitar uma 
                fiscalização ambiental leia atentamente as informações 
                abaixo:</p>
              <div>
                <p>DENÚNCIAS E FISCALIZAÇÕES DE COMPETÊNCIA DA SEMAS</p>
                <div style="width:auto;">
                    <img src="../../../assets-web/img/content/denuncias-ambientais-1.png">
                </div>
              </div>
              <div>
                <img src="../../../assets-web/img/content/denuncias-ambientais-2.png">
              </div>
              <p>Para entrar em contato com o setor de Fiscalização da  
                Secretaria do Ambiente e Saneamento de Arraial do Cabo, 
                preencha o formulário ou envie um e-mail para
                <a href="mailto:fiscalizacaosemas@arraial.rj.gov.br">nosso contato</a>.</p>
              <p>* Para denúncias de crimes ambientais, 
                acesse a página da fiscalização ambiental.</p>
              <button class="btn btn-success"><a href="{{ route('web_services.fiscalization') }}">
                Fiscalização Ambiental</a></button>
            </div>
          </div>

          <!-- ATENDIMENTO LICENCIAMENTO -->
          <div class="container licenciamento" style="display: none;">
            <div class="type-info">
              <h5 class="card-title">Atendimento ao Licenciamento</h5>
              <p>Recebe, expede e encaminha documentos e processos 
                administrativos relacionados, especificamente, ao Sistema 
                Estadual de Licenciamento Ambiental.</p>
              <p>Para entrar em contato com o setor de Licenciamento  da  
                Secretaria do Ambiente e Saneamento de Arraial do Cabo, 
                preencha o formulário ou envie um e-mail para
                <a href="mailto:XXX@arraial.rj.gov.br">nosso contato</a>.</p>
              <p>* Para denúncias de crimes ambientais, 
                <a href="{{ route('web_services.fiscalization') }}">acesse o link</a>.</p>
              <p>ATENÇÃO</p>
              <p>1. A abertura de processo referente ao licenciamento não é 
                feita de maneira eletrônica, apenas presencial no Protocolo 
                Geral da prefeitura;</p>
              <p>2. Procure anexar todos os documentos solicitados nos checklists 
                de cada atividade na abertura do processo;</p>
              <p>3. Confira os checklists
              <a href="{{ route('web_services.environmentlicensing.checklist') }}">aqui</a>.</p>
            </div>
          </div>

          <!-- ATENDIMENTO PODA -->
          <div class="container poda" style="display: none;">
            <div class="type-info">
              <div class="type-info">
                <h5 class="card-title">Atendimento à Poda</h5>
                <p>Recebe, expede e encaminha documentos e processos 
                  administrativos relacionados, especificamente, 
                  ao Setor de Poda Municipal.</p>
                <p>Para entrar em contato com o setor de Poda  da  
                  Secretaria do Ambiente e Saneamento de Arraial do Cabo, 
                  preencha o formulário ou envie um e-mail para
                  <a href="mailto:poda.semas@arraial.rj.gov.br">nosso contato</a>.</p>
              </div>
              <div>
                <h5 class="card-title">Atenção</h5>
                <p>A abertura de processo referente à Poda pode ser
                  feita através do
                  <a href="{{ route('web_services.pruning') }}">link</a>.</p>
                <p>Procure anexar todos os documentos solicitados;</p>
              </div>
            </div>
          </div>
        </div>

        
      </div>
    </div>
    <!-- End .contact-panel-->
    <!-- </div> -->
    <!-- End .container-->
  </section>
@endsection
<script>
  function anonimo() {
      $(".identificado").fadeOut();
      $(".hidden-form").fadeIn();
      var access = document.getElementById("access_id");
      access.value = 2;
  }

  function identificado() {
      $(".identificado").fadeIn();
      $(".hidden-form").fadeIn();
      var access = document.getElementById("access_id");
      access.value = 1;
  }

  function info(){
    var type_option = document.getElementById("type_request_id");
    var type_text = type_option.options[type_option.selectedIndex].text;
    
    if (type_text == 'Denúncia Ambiental') {
      $(".info").hide();
      $(".denuncia").fadeIn(1000);
      $(".licenciamento").hide();
      $(".poda").hide();
    }
    
    else if (type_text == 'Atendimento ao Licenciamento'){
      $(".info").hide();
      $(".denuncia").hide();
      $(".licenciamento").fadeIn(1000);
      $(".poda").hide();
    }

    else if (type_text == 'Atendimento à Poda'){
      $(".info").hide();
      $(".denuncia").hide();
      $(".licenciamento").hide();
      $(".poda").fadeIn(1000);
    }

    else{
      $(".info").fadeIn(1000);
      $(".denuncia").hide();
      $(".licenciamento").hide();
      $(".poda").hide();
    }
  }
</script>