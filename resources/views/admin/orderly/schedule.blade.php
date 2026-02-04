@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Agenda')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/calendars/fullcalendar.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/tether-theme-arrows.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/tether.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/shepherd.min.css')) }}">
@endsection

@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-calendar.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-tour.css')) }}">
@endsection

@section('content')
<!-- Full calendar start -->
<section id="ras-orderly">
  <div class="app-calendar overflow-hidden border">
    <div class="row g-0">
      <!-- Sidebar -->
      <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
        <div class="sidebar-wrapper">
          @can('Criar RAS')
            <div class="card-body d-flex justify-content-center">
              <a
                class="btn btn-primary w-100" href="{{route('ras.create')}}"
              >
                <span class="align-middle">Adicionar RAS</span>
              </a>
            </div>
          @endcan
          <div class="card-body pb-0">
            <h5 class="section-label mb-1">
              <span class="align-middle">Filtro</span>
            </h5>
            <div class="form-check mb-1">
              <input type="checkbox" class="form-check-input select-all" id="select-all" checked />
              <label class="form-check-label" for="select-all">Ver Todos</label>
            </div>
            <div class="calendar-events-filter">
              <div class="form-check form-check-danger mb-1">
                <input
                  type="checkbox"
                  class="form-check-input input-filter"
                  id="personal"
                  data-value="personal"
                  checked
                />
                <label class="form-check-label" for="personal">Pessoal</label>
              </div>
              <div class="form-check form-check-primary mb-1">
                <input
                  type="checkbox"
                  class="form-check-input input-filter"
                  id="business"
                  data-value="business"
                  checked
                />
                <label class="form-check-label" for="business">Geral</label>
              </div>
            </div>
          </div>
        <div class="card-body">
          <div class="btn btn-outline-primary" id="tour">Iniciar Guia</div>
        </div>
        </div>
        <div class="mt-auto">
          <img
            src="{{asset('images/pages/calendar-illustration.png')}}"
            alt="Calendar illustration"
            class="img-fluid"
          />
        </div>
      </div>
      <!-- /Sidebar -->

      <!-- Calendar -->
      <div class="col position-relative">
        <div class="card shadow-none border-0 mb-0 rounded-0">
          <div class="card-body pb-0">
            <div id="calendar"></div>
          </div>
        </div>
      </div>
      <!-- /Calendar -->
      <div class="body-content-overlay"></div>
    </div>
  </div>
  <!-- Calendar Add/Update/Delete event modal-->
  <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
    <div class="modal-dialog sidebar-lg">
      <div class="modal-content p-0">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
        <div class="modal-header mb-1">
          <h5 class="modal-title">RAS</h5>
        </div>
        <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
          <form class="event-form needs-validation" data-ajax="false">
            <div class="mb-1">
              <label for="title" class="form-label">Título</label>
              <input type="text" class="form-control" id="title" name="title" placeholder="título" required />
            </div>
            <div class="mb-1 position-relative">
              <label for="vacancy" class="form-label">Vagas</label>
              <input type="text" class="form-control" id="vacancy" name="vacancy" />
            </div>
            <div class="mb-1 position-relative">
              <label for="start-date" class="form-label">Data e Hora de Início</label>
              <input type="text" class="form-control" id="start-date" name="started_at" placeholder="Start Date" />
            </div>
            <div class="mb-1 position-relative">
              <label for="end-date" class="form-label">Data e Hora de Término</label>
              <input type="text" class="form-control" id="end-date" name="ended_at" placeholder="End Date" />
            </div>
            <div class="mb-1 position-relative">
              <label for="location" class="form-label">Localização</label>
              <input type="text" class="form-control" id="location" name="location" />
            </div>
            <div class="mb-1 position-relative">
              <label for="description" class="form-label">Descrição</label>
              <input type="text" class="form-control" id="description" name="description" />
            </div>
            <div class="mb-1 d-flex">
              <a class="btn btn-primary update-event-btn">Ver</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!--/ Calendar Add/Update/Delete event modal-->
</section>
<!-- Full calendar end -->
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/calendar/fullcalendar.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/forms/validation/jquery.validate.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/tether.min.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/shepherd.min.js')) }}"></script>
@endsection

@section('page-script')
  <!-- Page js files -->
  <script src="{{ asset(mix('js/scripts/pages/orderly-calendar-events.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/orderly-calendar.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/help/ras.js')) }}"></script>
@endsection
