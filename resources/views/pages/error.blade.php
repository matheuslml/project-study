@php
$configData = Helper::applClasses();
@endphp
@extends('admin/layouts/fullLayoutMaster')

@section('title', 'Error 404')

@section('page-style')
  {{-- Page Css files --}}
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/page-misc.css')) }}">
@endsection
@section('content')
<!-- Error page-->
<div class="misc-wrapper">
  <div class="misc-inner p-2 p-sm-3">
      <div class="w-100 text-center">
          <h2 class="mb-1">Página não encontrada 🕵🏻‍♀️</h2>
          <p class="mb-2">Atenção! 😖 O endereço não foi encontrado no Servidor.</p>
          <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('dashboard')}}">Voltar Para Dashboard</a>
          @if($configData['theme'] === 'dark')
          <img class="img-fluid" src="{{asset('images/pages/error-dark.svg')}}" alt="Error page" />
          @else
          <img class="img-fluid" src="{{asset('images/pages/error.svg')}}" alt="Error page" />
          @endif
    </div>
  </div>
</div>
<!-- / Error page-->
@endsection
