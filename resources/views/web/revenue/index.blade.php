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
      <!-- End #page-title-->
      <!--
      ============================
      Services Single Section
      ============================
      -->
      <section class="service-single mb-8" id="service-single">
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
                  <div class="widget-title">
                    <h5>Busca Avançada</h5>
                  </div>
                  <div class="widget-content">
                    <form  method="post" action="{{ route('revenue_web_index_filter') }}">
                      @csrf
                      <div class="form-row transparency-info">
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="description">Descrição</label>
                          <input class="form-control" type="text" id="description" name="description"  />
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="category_id">Tipos</label>
                          <select class="form-control" id="category_id" name="category_id">
                            @foreach($types as $type)
                                <option value="{{ $type->id }}">{{ $type->title }}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="date">Registro</label>
                          <input class="form-control" type="date" id="date" name="date"  />
                        </div>
                        <div class="col-12">
                          <button type="submit" class="btn btn-primary w-100 mt-3">Filtrar pesquisa <i class="energia-arrow-right"></i></button>
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
                    <h5>Receitas</h5>
                    <div class="table-responsive">
                      @if (count($revenues) >= 1)
                        <table class="table">
                          <thead class="table-dark">
                            <tr>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th style="text-align: right;">Funções</th>
                            </tr>
                          </thead>
                          <tbody>
                              @foreach($revenues as $revenue)
                                  <tr>
                                        <td>{{$revenue->description}}</td>
                                        <td>{{isset($revenue->type) ? $revenue->type->title : ''}}</td>
                                        <td>{{ isset($revenue->receipt_at) ? date('d-m-Y', strtotime($revenue->receipt_at)) : '' }}</td>
                                        <td style="text-align: right;">
                                        <a href="{{ route('web_revenue_show', $revenue->id) }}"> <span>ver mais </span> <i class="energia-arrow-right"></i></a>
                                        </td>
                                  </tr>
                              @endforeach
                          </tbody>
                          <tfoot>
                                <th>Descrição</th>
                                <th>Tipo</th>
                                <th>Data</th>
                                <th style="text-align: right;">Funções</th>
                          </tfoot>
                        </table>
                      @else
                        <div class="alert alert-info" role="alert">
                            <i class="fas fa-times"></i> Não existem Receitas Armazenadas.
                        </div>
                      @endif
                      <div class="d-flex justify-content-center" style="margin-top: 3%;">
                        {{ $revenues->links()}}
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
