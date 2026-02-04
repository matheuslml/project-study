@extends('layouts.web_base')

@section('content')
      <!--
      ============================
      Services Single Section
      ============================
      -->
      <section class="service-single" id="service-single">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-4 order-1">
              <!--
              ============================
              Services Sidebar
              ============================
              -->
              <div class="sidebar sidebar-service">
                <!-- Services-->
                <div class="widget widget-services">
                  <div class="widget-content">
                    <ul class="list-unstyled">
                      <li><a href="{{ route('web_bididng_agreement_index') }}"> <span>contratos</span><i class="energia-arrow-right"></i></a></li>
                      <li><a href="{{ route('web_direct_hire_index') }}"> <span>contratações diretas</span><i class="energia-arrow-right"></i></a></li>
                      <li><a href="{{ route('web_bididng_index') }}"> <span>licitações</span><i class="energia-arrow-right"></i></a></li>

                    </ul>
                  </div>
                </div>
                <!-- End .widget-services -->
                <!-- Download-->
                <div class="widget widget-download">
                  <div class="widget-title">
                    <h5>Arquivos do Contrato</h5>
                  </div>
                  <div class="widget-content">
                    <ul class="list-unstyled">
                      @php
                        $cont = 1;
                      @endphp
                      @foreach($bidding_agreement->files as $file)
                        <li class="{{ ($cont % 2) === 0 ? 'inversed' : '' }}"><a href="{{ route('file_web', $file->id) }}"> <span>{{isset($file->title) ? $file->title : '' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="18" height="18">
                              <g>
                                <g>
                                  <g>
                                    <path class="shp0" d="M2.12 2L2.93 1L14.93 1L15.87 2L2.12 2ZM9 14.5L3.5 9L7 9L7 7L11 7L11 9L14.5 9L9 14.5ZM17.54 2.23L16.15 0.55C15.88 0.21 15.47 0 15 0L3 0C2.53 0 2.12 0.21 1.84 0.55L0.46 2.23C0.17 2.57 0 3.02 0 3.5L0 16C0 17.1 0.9 18 2 18L16 18C17.1 18 18 17.1 18 16L18 3.5C18 3.02 17.83 2.57 17.54 2.23Z"></path>
                                  </g>
                                </g>
                              </g>
                            </svg>
                          </a>
                        </li>
                        @php
                          $cont++;
                        @endphp
                      @endforeach
                    </ul>
                  </div>
                </div>
                <!-- End .widget-download-->
              </div>
              <!-- End .sidebar-->
            </div>
            <div class="col-12 col-lg-8 order-0 order-lg-2">
              <!-- Start .service-entry-->
              <div class="service-entry">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos">
                    <h5>Dados do Contrato</h5>
                    <div class="row">
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Título</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->title }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Origem</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->agreementOrigin) ? $bidding_agreement->agreementOrigin->title : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Situação</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->agreementSituation) ? $bidding_agreement->agreementSituation->title : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Licitação</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->title }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Tipo</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->agreementType) ? $bidding_agreement->agreementType->title : '' }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Processo</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->process }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Contrato</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->contract }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Responsável</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->name }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Tipo de Documento</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->documentType) ? $bidding_agreement->documentType->type : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Documento</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->document }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Supervisor</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->supervisor }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Gerente</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->manager }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Valor</label>
                        <input class="form-control current-balance" type="text" value="{{ isset($bidding_agreement->value) ? str_replace('.',',', $bidding_agreement->value) : ' ' }}" disabled />
                      </div>
                      <div class="col-3 col-md-3">
                        <label class="form-label" for="name">Assinatura</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->date_signature) ? date('d-m-Y', strtotime($bidding_agreement->date_signature)) : '' }}" disabled />
                      </div>
                      <div class="col-3 col-md-3">
                        <label class="form-label" for="name">Início da validação</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->date_validity_init) ? date('d-m-Y', strtotime($bidding_agreement->date_validity_init)) : '' }}" disabled />
                      </div>
                      <div class="col-3 col-md-3">
                        <label class="form-label" for="name">Fim da validação</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->date_validity_end) ? date('d-m-Y', strtotime($bidding_agreement->date_validity_end)) : '' }}" disabled />
                      </div>
                      <div class="col-3 col-md-3">
                        <label class="form-label" for="name">Data do Diário</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->date_diary) ? date('d-m-Y', strtotime($bidding_agreement->date_diary)) : '' }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Objetivo</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->object }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Razões Legais</label>
                        <input class="form-control" type="text" value="{{ $bidding_agreement->legal_reasoning }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Realizado</label>
                        <input class="form-control" type="text" value="{{ isset($bidding_agreement->created_at) ? date('d-m-Y', strtotime($bidding_agreement->created_at)) : ''}}" disabled />
                      </div>
                    </div>

                  </div>
                </div>
              </div>
              <!-- End .service-entry-->
            </div>
            <!-- End .col-lg-8-->
          </div>
          <!-- End .row-->
        </div>
        <!-- End .container-->
      </section>
@endsection

@section('web-script')
  {{-- Vendor js files --}}
  <script src="{{asset(mix('vendors/js/forms/cleave/cleave.min.js'))}}"></script>
  <script src="{{asset(mix('vendors/js/forms/cleave/addons/cleave-phone.br.js'))}}"></script>
@endsection

@section('web-page-script')
  {{-- Page js files --}}
  <script src="{{ asset(mix('js/scripts/forms/expense-input-mask.js')) }}"></script>
@endsection
