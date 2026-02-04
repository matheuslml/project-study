@php
$configData = Helper::applClasses();
@endphp
@extends('admin/layouts/fullLayoutMaster')

@section('title', 'Resetar Senha')

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
         <img src="{{asset('images/pages/reset-password-v2-dark.svg')}}" class="img-fluid" alt="Register V2" />
        @else
         <img src="{{asset('images/pages/reset-password-v2.svg')}}" class="img-fluid" alt="Register V2" />
        @endif
      </div>
    </div>
    <!-- /Left Text-->

    <!-- Reset password-->
    <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
      <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
        <h2 class="card-title fw-bold mb-1">Alterar Senha 🔒</h2>
        <p class="card-text mb-2">É melhor que a Senha seja diferente de senhas anteriores. </p>
        <form class="auth-reset-password-form mt-2" action="{{ route('password.update') }}" method="POST">
          @csrf()
          <input type="hidden" name="token" value="{{ $request->route('token') }}">
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="email">E-mail</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="email" type="email" name="email" value="{{old('email', $request->email)}}" aria-describedby="email" autofocus="" tabindex="1" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password">Nova Senha</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password" type="password" name="password" placeholder="············" aria-describedby="password" autofocus="" tabindex="2" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <div class="mb-1">
            <div class="d-flex justify-content-between">
              <label class="form-label" for="password_confirmation">Confirmar Senha</label>
            </div>
            <div class="input-group input-group-merge form-password-toggle">
              <input class="form-control form-control-merge" id="password_confirmation" type="password" name="password_confirmation" placeholder="············" aria-describedby="password_confirmation" tabindex="3" />
              <span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span>
            </div>
          </div>
          <button class="btn btn-primary w-100" tabindex="3">Confirmar alteração</button>
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
    <!-- /Reset password-->
  </div>
</div>
@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>
@endsection

@section('page-script')
<script src="{{asset(mix('js/scripts/pages/auth-reset-password.js'))}}"></script>
@endsection
