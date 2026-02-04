<!-- BEGIN: Footer-->
<footer class="footer footer-light {{($configData['footerType'] === 'footer-hidden') ? 'd-none':''}} {{$configData['footerType']}}">
  <p class="clearfix mb-0">
    <span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy {{ isset($copyright->year) ? $copyright->year : '' }}
      <a class="ms-25" href="{{ isset($copyright->link_url) ? $copyright->link_url : '' }}" target="_blank"> - {{ isset($copyright->company_name) ? $copyright->company_name : '' }}</a>,
      <span class="d-none d-sm-inline-block">Todos os direitos reservados.</span>
    </span>
    <span class="float-md-end d-none d-md-block">Desenvolvido pela {{ isset($copyright->company_name) ? $copyright->company_name : '' }}</span>
  </p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->
