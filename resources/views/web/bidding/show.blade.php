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
                    <h5>Arquivos da Licitação</h5>
                  </div>
                  <div class="widget-content">
                    <ul class="list-unstyled">
                      @php
                        $cont = 1;
                      @endphp
                      @foreach($bidding->files as $file)
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
                    <h5>Dados da Licitação</h5>
                    <div class="row">
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Nome</label>
                        <input class="form-control" type="text" value="{{ isset($bidding->title) ? $bidding->title : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Modalidade</label>
                        <input class="form-control" type="text" value="{{ isset($bidding->modality) ? $bidding->modality->title : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Situação</label>
                        <input class="form-control" type="text" value="{{ isset($bidding->situation) ? $bidding->situation->title : '' }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Licitação</label>
                        <input class="form-control" type="text" value="{{ $bidding->bidding }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Valor Máximo</label>
                        <input class="form-control current-balance" type="text" value="{{ isset($bidding->value_max) ? str_replace('.',',', $bidding->value_max) : ' ' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">local</label>
                        <input class="form-control" type="text" value="{{ $bidding->local }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Conteúdo</label>
                        <input class="form-control" type="text" value="{{ $bidding->content }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Processo</label>
                        <input class="form-control" type="text" value="{{ $bidding->process }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Publicado</label>
                        <input class="form-control" type="text" value="{{ isset($bidding->published_at) ? date('d-m-Y H:i', strtotime($bidding->published_at)) : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Realizado</label>
                        <input class="form-control" type="text" value="{{ isset($bidding->realized_at) ? date('d-m-Y H:i', strtotime($bidding->realized_at)) : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Publicado</label>
                        <input class="form-control" type="text" value="{{ isset($bidding->published_at) ? date('d-m-Y H:i', strtotime($bidding->published_at)) : '' }}" disabled />
                      </div>


                    </div>

                  </div>
                </div>
              </div>
              <!-- End .service-entry-->

              <!-- Start .service-entry-->
              <div class="service-entry">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos">
                    <h5>Contratos</h5>
                    <div class="table-responsive">
                      @if (count($bidding_agreements) >= 1)
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th>Nome</th>
                              <th>Data</th>
                              <th style="text-align: right;">Funções</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($bidding_agreements as $bidding_agreement)
                                  <tr>
                                    <td>{{$bidding_agreement->title }}</td>
                                    <td>{{ isset($bidding_agreement->created_at) ? date('d-m-Y H:i', strtotime($bidding_agreement->created_at)) : '' }}</td>
                                    <td style="text-align: right;">
                                      <a href="{{ route('web_bididng_agreement_show', $bidding_agreement->id) }}"> <span>ver mais </span> <i class="energia-arrow-right"></i></a>
                                    </td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                            <th>Nome</th>
                            <th>Data</th>
                            <th style="text-align: right;">Funções</th>
                          </tfoot>
                        </table>
                      @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-times"></i> Não existem Contratos Armazenados.
                        </div>
                      @endif
                      <div class="d-flex justify-content-center" style="margin-top: 3%;">
                        {{ $bidding_agreements->links()}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End .service-entry-->

              <!-- Start .service-entry-->
              <div class="service-entry">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos">
                    <h5>Vencedores</h5>
                    <div class="table-responsive">
                      @if (count($bidding_winners) >= 1)
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th>Nome</th>
                              <th>Data</th>
                              <th style="text-align: right;">Funções</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($bidding_winners as $bidding_winner)
                                  <tr>
                                    <td>{{isset($bidding_winner->person) ? $bidding_winner->person->full_name : '' }}</td>
                                    <td>{{ isset($bidding_winner->created_at) ? date('d-m-Y H:i', strtotime($bidding_winner->created_at)) : '' }}</td>
                                    <td style="text-align: right;">
                                      <a href="{{ route('web_bididng_winner_show', $bidding_winner->id) }}"> <span>ver mais </span> <i class="energia-arrow-right"></i></a>
                                    </td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                            <th>Nome</th>
                            <th>Data</th>
                            <th style="text-align: right;">Funções</th>
                          </tfoot>
                        </table>
                      @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-times"></i> Não existem Vencedores Armazenados.
                        </div>
                      @endif
                      <div class="d-flex justify-content-center" style="margin-top: 3%;">
                        {{ $bidding_winners->links()}}
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- End .service-entry-->

              <!-- Start .service-entry-->
              <div class="service-entry">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos">
                    <h5>Itens</h5>
                    <div class="table-responsive">
                      @if (count($bidding->items) >= 1)
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th>Nome</th>
                              <th>Quantidade</th>
                              <th>Custo</th>
                              <th>Vencedor</th>
                              <th>Cadastro</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($bidding->items as $item)
                                  <tr>
                                    <td>{{isset($item->name) ? $item->name : '' }}</td>
                                    <td>{{isset($item->quantity) ? $item->quantity : '' }}</td>
                                    <td>{{isset($item->value) ? $item->value : '' }}</td>
                                    <td>{{isset($item->person) ? $item->person->full_name : '' }}</td>
                                    <td>{{ isset($item->created_at) ? date('d-m-Y H:i', strtotime($item->created_at)) : '' }}</td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                              <th>Nome</th>
                              <th>Quantidade</th>
                              <th>Custo</th>
                              <th>Vencedor</th>
                              <th>Cadastro</th>
                          </tfoot>
                        </table>
                      @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-times"></i> Não existem Itens Armazenados.
                        </div>
                      @endif
                      <div class="d-flex justify-content-center" style="margin-top: 3%;">
                        {{ $bidding_winners->links()}}
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
