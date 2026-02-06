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
              </div>
              <!-- End .sidebar-->
            </div>
            <div class="col-12 col-lg-8 order-0 order-lg-2">
              <!-- Start .service-entry-->
              <div class="service-entry">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos">
                    <h5>Dados do Vencedor da Contratação Direta</h5>
                    <div class="row">
                      <div class="col-4 col-md-4">
                        <label class="form-label" for="name">Tipo</label>
                        <input class="form-control" type="text" value="{{$person->personable_type==='App\Models\LegalPerson'
                                                                          ? 'Pessoa Jurídica'
                                                                          : 'Pessoa Física' }}"
                                                                          disabled />
                      </div>
                      <div class="col-8 col-md-8" {{$person->personable_type==='App\Models\LegalPerson' ? 'hidden' : ''}}>
                        <label class="form-label" for="name">Nome Completo</label>
                        <input class="form-control" type="text" value="{{ $person->full_name }}" disabled />
                      </div>
                      <div class="col-8 col-md-8" {{$person->personable_type==='App\Models\LegalPerson' ? '' : 'hidden'}}>
                        <label class="form-label" for="name">Nome da Empresa</label>
                        <input class="form-control" type="text" value="{{ $person->personable->company_name }}" disabled />
                      </div>
                      <div class="col-12 col-md-12" {{$person->personable_type==='App\Models\LegalPerson' ? '' : 'hidden'}}>
                        <label class="form-label" for="name">Nome do Representante Legal</label>
                        <input class="form-control" type="text" value="{{ $person->personable->legal_responsible }}" disabled />
                      </div>
                      @foreach($person->documents as $document)
                        <div class="col-6 col-md-6">
                          <label class="form-label" for="name">Tipo de Documento</label>
                          <input class="form-control" type="text" value="{{ $document->document_type->type }}" disabled />
                        </div>
                        <div class="col-6 col-md-6">
                          <label class="form-label" for="name">Documento</label>
                          <input class="form-control" type="text" value="{{ $document->document }}" disabled />
                        </div>
                      @endforeach
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
