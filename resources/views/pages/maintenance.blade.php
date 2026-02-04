@php
$configData = Helper::applClasses();
@endphp
@extends('admin/layouts/fullLayoutMaster')

@section('title', 'Em Manutenção')

@section('page-style')
<link rel="stylesheet" href="{{asset(mix('css/base/pages/page-misc.css'))}}">
@endsection

@section('content')
<!-- Under maintenance-->
<div class="misc-wrapper">
  <div class="misc-inner p-2 p-sm-3">
    <div class="w-100 text-center">
      <h2 class="mb-1">Em Manutenção 🛠</h2>
      <p class="mb-3">Nos desculpe pela inconveniência, estamos trabalhando agora para resolver os problemas.</p>
      <form class="row row-cols-md-auto row justify-content-center align-items-center m-0 mb-2 gx-3" action="javascript:void(0)">
        <div class="col-12 m-0 mb-1">
          <input class="form-control" id="notify-email" type="text" placeholder="john@example.com" />
        </div>
        <div class="col-12 d-md-block d-grid ps-md-0 ps-auto">
          <button class="btn btn-primary mb-1 btn-sm-block" type="submit">Notificar</button>
        </div>
      </form>
      @if($configData['theme'] === 'dark')
      <img class="img-fluid" src="{{asset('images/pages/under-maintenance-dark.svg')}}" alt="Under maintenance page" />
      @else
      <img class="img-fluid" src="{{asset('images/pages/under-maintenance.svg')}}" alt="Under maintenance page" />
      @endif
    </div>
  </div>
@endsection
