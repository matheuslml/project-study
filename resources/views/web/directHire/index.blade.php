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
                <div class="title">
                  <h1 class="title-heading" style="color: rgb(41, 27, 27); font-family: 'Helvetica Neue', sans-serif; font-size: 55px; font-weight: bold; letter-spacing: -1px; line-height: 1; text-align: left;">Contratação Direta</h1>
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
                <!-- busca avançada-->
                <div class="widget widget-services">
                  <div class="widget-title">
                    <h5>Busca Avançada</h5>
                  </div>
                  <div class="widget-content">
                    <form  method="post" action="{{ route('bidding_web_index_filter') }}">
                      @csrf
                      <div class="row transparency-info">
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="title">Assunto</label>
                          <input class="form-control" type="text" id="title" name="title"  />
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="modality_id">Modalidade</label>
                          <select class="form-control" id="modality_id" name="modality_id">
                            @foreach($modalities as $modality)
                                <option value="{{ $modality->id }}">{{ $modality->title }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="situation_id">Situação</label>
                          <select class="form-control" id="situation_id" name="situation_id">
                            @foreach($situations as $situation)
                                <option value="{{ $situation->id }}">{{ $situation->title }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="bidding">Licitação</label>
                          <input class="form-control" type="text" id="bidding" name="bidding"  />
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="process">Processo</label>
                          <input class="form-control" type="text" id="process" name="process"  />
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="published_at">Publicação</label>
                          <input class="form-control" type="date" id="published_at" name="published_at"  />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn--secondary w-100">Filtrar pesquisa <i class="energia-arrow-right"></i></button>
                        </div>
                      </div>
                    </form>
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
                    <h5>Contratações Diretas</h5>
                    <div class="table-responsive">
                      @if (count($direct_hires) >= 1)
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                                <th>Contratação Ditreta</th>
                                <th>Modalidade</th>
                                <th>Situação</th>
                                <th>Publicação</th>
                                <th style="text-align: right;">Funções</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($direct_hires as $direct_hire)
                                  <tr>
                                      <td>{{$direct_hire->title}}</td>
                                      <td>{{isset($direct_hire->modality) ? $direct_hire->modality->title : ''}}</td>
                                      <td>{{isset($direct_hire->situation) ? $direct_hire->situation->title : ''}}</td>
                                      <td>{{ isset($direct_hire->published_at) ? date('d-m-Y H:i', strtotime($direct_hire->published_at)) : '' }}</td>
                                      <td style="text-align: right;">
                                      <a href="{{ route('web_direct_hire_show', $direct_hire->id) }}"> <span>ver mais </span> <i class="energia-arrow-right"></i></a>
                                    </td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                                <th>Contratação Ditreta</th>
                                <th>Modalidade</th>
                                <th>Situação</th>
                                <th>Publicação</th>
                                <th style="text-align: right;">Funções</th>
                          </tfoot>
                        </table>
                      @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-times"></i> Não existem Legislações Armazenadas.
                        </div>
                      @endif
                      <div class="d-flex justify-content-center" style="margin-top: 3%;">
                        {{ $direct_hires->links()}}
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
