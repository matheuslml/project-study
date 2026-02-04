@php
$configData = Helper::applClasses();
@endphp
@extends('admin/layouts/fullLayoutMaster')

@section('title', 'Esqueceu a senha')

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
      <img src="{{ isset($unit->logo) ? (asset('storage/images/units/' . $unit->logo)) : '' }}" class="logo-gmac"  alt="logo" style="width: 15%;">
    </a>
    <!-- /Brand logo-->

    <!-- Left Text-->
    <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
      <div class="w-100 d-lg-flex align-items-center justify-content-center px-5">
        @if($configData['theme'] === 'dark')
        <img class="img-fluid" src="{{asset('images/pages/forgot-password-v2-dark.svg')}}" alt="Forgot password V2" />
        @else
        <img class="img-fluid" src="{{asset('images/pages/forgot-password-v2.svg')}}" alt="Forgot password V2" />
        @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Forgot password-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">Esqueceu sua Senha? 🔒</h2>
        <p class="card-text mb-2">Entre com seu e-mail e nós vamos as instruções para alterar sua Senha.</p>
        <form class="auth-forgot-password-form mt-2" action="{{ route('password.email') }}" method="POST">
          @csrf()
          <div class="mb-1">
            <label class="form-label" for="email">E-mail</label>
            <input class="form-control" id="email" type="text" name="email" placeholder="john@example.com" aria-describedby="email" autofocus="" tabindex="1" />
          </div>
          <button class="btn btn-primary w-100" tabindex="2" type="submit">Enviar e-mail</button>
        </form>
        <p class="text-center mt-2">
          <a href="{{url('/login')}}">
            <i data-feather="chevron-left"></i> Voltar para Login
          </a>
        </p>
        <div class="col-12 col-sm-8 col-md-6 col-lg-12 pt-4" style="text-align: center;">
            <img src="{{isset($copyright->logo_url) ? (asset('storage/images/copyrights/' . $copyright->logo_url)) : ''}}" style="width: 50%;" class="logo-gmac"  alt="logo">
        </div>
      </div>
    </div>
    <!-- /Forgot password-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-forgot-password.js'))}}"></script>
@endsection
