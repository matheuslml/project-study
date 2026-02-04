@php
$configData = Helper::applClasses();
@endphp
@extends('admin/layouts/fullLayoutMaster')

@section('title', 'Área Não Autorizada')

@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/pages/page-misc.css'))}}">
@endsection

@section('content')
<!-- Not authorized-->
<div class="misc-wrapper">
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Você não possui acesso para esta área do Sistema! 🔐</h2>
      <p class="mb-2">Para mais informações procure seu administrador.</p>
      <a class="btn btn-primary mb-1 btn-sm-block" href="{{route('dashboard')}}">Voltar Para Dashboard</a>
      @if($configData['theme'] === 'dark')
      <img class="img-fluid" src="{{asset('images/pages/not-authorized-dark.svg')}}" alt="Not authorized page" />
      @else
      <img class="img-fluid" src="{{asset('images/pages/not-authorized.svg')}}" alt="Not authorized page" />
      @endif
    </div>
  </div>
</div>
<!-- / Not authorized-->
</section>
<!-- maintenance end -->
@endsection
