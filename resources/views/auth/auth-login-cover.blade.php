@php
$configData = Helper::applClasses();
@endphp
@extends('admin/layouts/fullLayoutMaster')

@section('title', 'Página de LOGIN')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/authentication.css')) }}">
@endsection

@section('content')
<div class="auth-wrapper auth-cover">
  <div class="auth-inner row m-0">
    <!-- Brand logo-->
    <a class="brand-logo" href="#">
      <img src="{{ isset($unit->logo) ? (asset('storage/images/units/' . $unit->logo)) : '' }}" class="logo-gmac"  alt="logo" style="width: 10%;">
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
          <img class="img-fluid" src="{{ asset('images/illustration/create-account.svg')}}" alt="Login V2" style="width: 40%;" />
          @else
          <img class="img-fluid" src="{{ asset('images/illustration/create-account.svg')}}" alt="Login V2" style="width: 40%;"  />
          @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Login-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto" >
        <h2 class="card-title fw-bold mb-1">Seja bem Vindo ao Sistema do {{ isset($unit->name) ? $unit->name : '' }}!</h2>
        <p class="card-text mb-2">Por favor entre com sua conta para poder acessar o painel de controle</p>
        <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
          @csrf
          <div class="mb-1">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" id="email" type="text" name="email" placeholder="email@example.com" aria-describedby="email" autofocus="" tabindex="1" />
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Senha</label>
              <a href="{{ route('auth-forgot-password') }}">
                <small>Esqueceu a Senha?</small>
              </a>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" tabindex="2" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="form-check">
              <input class="form-check-input" id="remember_me" type="checkbox" tabindex="3" />
              <label class="form-check-label" for="remember_me"> Lembrar</label>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="4">Entrar</button>
        </form>
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 pt-4" style="text-align: center;">
            <img src="{{isset($copyright->logo_url) ? (asset('storage/images/copyrights/' . $copyright->logo_url)) : ''}}" style="width: 50%;" class="logo-gmac"  alt="logo">
        </div>

      </div>
    </div>
    <!-- /Login-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-login.js'))}}"></script>
@endsection
