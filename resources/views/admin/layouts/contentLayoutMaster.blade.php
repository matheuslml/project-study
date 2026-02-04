@isset($pageConfigs)
{!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

<!DOCTYPE html>
@php
$configData = Helper::applClasses();
@endphp

<html class="loading {{ ($configData['theme'] === 'light') ? '' : $configData['layoutTheme']}}"
lang="pt-br"
data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
@if($configData['theme'] === 'dark') data-layout="dark-layout" @endif>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="Painel Administrativo">
  <meta name="keywords" content="">
  <meta name="author" content="{{ isset($unit->name) ? $unit->name : '' }}">
  <title>Painel Administrativo</title>
  <link rel="apple-touch-icon" href="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->icon) : ''}}">
  <link rel="shortcut icon" type="image/x-icon" href="{{isset($unit->logo) ? asset('storage/images/units/' . $unit->icon) : ''}}">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

  {{-- Include core + vendor Styles --}}
  @include('panels/styles')

</head>
<!-- END: Head-->
<body class="vertical-layout vertical-menu-modern {{$configData['contentLayout']}} {{$configData['blankPageClass']}} {{ $configData['bodyClass']}} {{$configData['verticalMenuNavbarType']}} {{$configData['sidebarClass']}} {{$configData['footerType']}}"
data-open="click"
data-menu="vertical-menu-modern"
data-col="{{$configData['showMenu'] ? $configData['contentLayout'] : '1-column' }}"
data-framework="laravel"
data-asset-path="{{ asset('/')}}">


  {{-- Include Navbar --}}
  @include('panels.navbar')

  @include('panels.sidebar')


  <!-- BEGIN: Content-->
  <div class="app-content content {{ $configData['pageClass'] }}">
    <!-- BEGIN: Header-->
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>

    <div class="content-wrapper {{ $configData['layoutWidth'] === 'boxed' ? 'container-xxl p-0' : '' }}">

      <div class="{{ $configData['contentsidebarClass'] }}">
        <div class="content-body">
          {{-- Include Page Content --}}
          @yield('content')
        </div>
      </div>

      <div class="{{ $configData['sidebarPositionClass'] }}">
        <div class="sidebar">
          {{-- Include Sidebar Content --}}
          @yield('content-sidebar')
        </div>
      </div>
    </div>
  </div>
  <!-- End: Content-->
<!-- BEGIN: Body-->
<!-- END: Body-->

  @if($configData['blankPage'] == false) <!-- @include('content/pages/customizer') --><!--  @include('content/pages/buy-now') --> @endif

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

{{-- include footer --}}
@include('panels/footer')

{{-- include default scripts --}}
@include('panels/scripts')

<script type="text/javascript">
  $(window).on('load', function() {
    if (feather) {
      feather.replace({
        width: 14,
        height: 14
      })
    }
  })
</script>
</body>
</html>
