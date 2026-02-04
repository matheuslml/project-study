@extends('layouts.web_base')

@section('content')

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
                <!-- Download-->
                <div class="widget widget-download">
                  <div class="widget-title">
                    <h5>Arquivos</h5>
                  </div>
                  <div class="widget-content">
                    <ul class="list-unstyled">
                      @php
                        $cont = 1;
                      @endphp
                      @foreach($legislation->files as $file)
                        <li class="{{ ($cont % 2) === 0 ? 'inversed' : '' }}"><a href="{{ route('file_web', $file->id) }}"> <span>{{isset($file->title) ? $file->title : '' }}</span>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" width="40" height="40">
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
            <div class="col-12 col-lg-8 order-0 order-lg-2 pb-4">
              <!-- Start .service-entry-->
              <div class="service-entry pb-4">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos">
                    <h5>Dados da Legislação</h5>
                    <div class="row transparency-info">
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Ementa</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->ementa) ? $legislation->ementa : '' }}" disabled />
                      </div>
                      <div class="col-3 col-md-3">
                        <label class="form-label" for="name">Número</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->number) ? $legislation->number : '' }}" disabled />
                      </div>
                      <div class="col-3 col-md-3">
                        <label class="form-label" for="name">Complemento</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->number_complement) ? $legislation->number_complement : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Categoria</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->category) ? $legislation->category->category : '' }}" disabled />
                      </div>
                      <div class="col-6 col-md-6">
                        <label class="form-label" for="name">Situação</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->situation) ? $legislation->situation->situation : '' }}" disabled />
                      </div>
                      <div class="col-4 col-md-4">
                        <label class="form-label" for="name">Data</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->date) ? date('d-m-Y ', strtotime($legislation->date)) : '' }}" disabled />
                      </div>
                      <div class="col-4 col-md-4">
                        <label class="form-label" for="name">Início</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->initial_term) ? date('d-m-Y ', strtotime($legislation->initial_term)) : '' }}" disabled />
                      </div>
                      <div class="col-4 col-md-4">
                        <label class="form-label" for="name">Fim</label>
                        <input class="form-control" type="text" value="{{ isset($legislation->final_term) ? date('d-m-Y ', strtotime($legislation->final_term)) : '' }}" disabled />
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Assuntos</label>
                        <textarea class="form-control"  disabled >
                          @foreach($legislation->subjects as $subject)
                          {{ $subject->subject . '; ' }}
                          @endforeach
                        </textarea>
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Autores</label>
                        <textarea class="form-control"  disabled >
                          @foreach($legislation->authors as $author)
                          {{ $author->author . '; ' }}
                          @endforeach
                        </textarea>
                      </div>
                      <div class="col-12 col-md-12">
                        <label class="form-label" for="name">Setores</label>
                        <textarea class="form-control"  disabled >
                          @foreach($legislation->units as $unit)
                          {{ $unit->name . '; ' }}
                          @endforeach
                        </textarea>
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
                    <h5>Vínculos</h5>
                    <div class="table-responsive">
                      @if (count($legislation->bonds) >= 1)
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                              <th>Vínculo</th>
                              <th>Número</th>
                              <th>Status</th>
                              <th style="text-align: right;">Funções</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($legislation->bonds as $bond)
                                  <tr>
                                    <td>{{isset($bond->vinculo) ? $bond->vinculo->ementa : '' }}</td>
                                    <td>{{isset($bond->vinculo) ? ($bond->vinculo->number . ' - ' . $bond->vinculo->number_complement) : '' }}</td>
                                    <td>{{isset($bond->status) ? $bond->status : '' }}</td>
                                    <td style="text-align: right;">
                                      <a href="{{ route('web_legislation_show', $bond->vinculo->id) }}"> <span>ver mais </span> <i class="energia-arrow-right"></i></a>
                                    </td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                              <th>Vínculo</th>
                              <th>Número</th>
                              <th>Status</th>
                              <th style="text-align: right;">Funções</th>
                          </tfoot>
                        </table>
                      @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-times"></i> Não existem Vínculos Armazenados.
                        </div>
                      @endif
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
