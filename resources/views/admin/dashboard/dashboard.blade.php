
@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Áreta de Trabalho')

@section('vendor-style')
  <!-- vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  @endsection

@section('content')
<!-- Dashboard Analytics Start -->
<section id="dashboard-analytics">

  <div class="row match-height" hidden>
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header">
          <div>
            <h2 class="fw-bolder mb-0">00</h2>
            <p class="card-text">RAS Abertos</p>
          </div>
          <div class="avatar bg-light-primary p-50 m-0">
            <div class="avatar-content">
              <i data-feather="book-open" class="font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header">
          <div>
            <h2 class="fw-bolder mb-0">00</h2>
            <p class="card-text">Total de RAS</p>
          </div>
          <div class="avatar bg-light-success p-50 m-0">
            <div class="avatar-content">
              <i data-feather="book" class="font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3 col-sm-6 col-12">
      <div class="card">
        <div class="card-header">
          <div>
            <h2 class="fw-bolder mb-0">{{ count(Auth::user()->notifications->where('status_id', 2)) }}</h2>
            <p class="card-text">Notficações</p>
          </div>
          <div class="avatar bg-light-danger p-50 m-0">
            <div class="avatar-content">
              <i data-feather="bell" class="font-medium-5"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

<div class="row match-height">
  <!-- Profile Card -->
  <div class="col-lg-4 col-md-6 col-12">
    <div class="card card-profile">
      <img
        src="{{asset('images/banner/banner.png')}}"
        class="img-fluid card-img-top"
        alt="Profile Cover Photo"
      />
      <div class="card-body">
        <div class="profile-image-wrapper">
          <div class="profile-image">
            <div class="avatar">
              <img src="{{ Auth::user() && isset(Auth::user()->profile_photo_path) ? asset(Auth::user()->profile_photo_path) : asset('images/portrait/small/avatar-icon.png') }}" alt="Profile Picture" />
            </div>
          </div>
        </div>
        <h3>{{ Auth::user()->name }}</h3>
        <span class="badge badge-light-primary profile-badge">{{ isset(Auth::user()->occupations->first()->title) ? Auth::user()->occupations->first()->title : 'Desenvolvedor' }}</span>
        <hr class="mb-2" />
      </div>
    </div>
  </div>
  <!--/ Profile Card -->

  <!-- Developer Meetup Card -->
  <div class="col-lg-4 col-md-6 col-12" hidden>
    <div class="card card-developer-meetup">
      <div class="meetup-img-wrapper rounded-top text-center">
        <img src="{{asset('images/illustration/email.svg')}}" alt="Meeting Pic" height="170" />
      </div>
      <div class="card-body">
        <div class="meetup-header d-flex align-items-center">
          <div class="meetup-day">
            <h3 class="mb-0">{{ date('d') }}</h3>
          </div>
          <div class="my-auto">
            <h4 class="card-title mb-25">RAS do dia</h4>
            <p class="card-text mb-0">apenas os RAS do dia de hoje</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Developer Meetup Card -->

  <!-- Employee Task Card -->
  <div class="col-lg-4 col-md-6 col-12" hidden>
    <div class="card card-employee-task">
      <div class="card-header">
        <h4 class="card-title">Lista de RAS</h4>
        <a href=""><i data-feather="calendar" class="font-medium-3 cursor-pointer"></i></a>
      </div>
      <div class="card-body">
      </div>
    </div>
  </div>
  <!--/ Employee Task Card -->

</div>
</section>
<!-- Dashboard Analytics end -->
@endsection

@section('vendor-script')
  <!-- vendor files -->
  <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/jquery.dataTables.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/datatables.buttons.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.bootstrap5.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/dataTables.responsive.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/tables/datatable/responsive.bootstrap5.js')) }}"></script>
@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/dashboard-analytics.js')) }}"></script>
@endsection
