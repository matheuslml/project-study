@extends('admin/layouts/contentLayoutMaster')

@section('title', 'Receita')

@section('vendor-style')
@endsection

@section('page-style')<style>
.pdfobject-container { height: 30rem; border: 1rem solid rgba(0,0,0,.1); }
</style>
@endsection

@section('content')
  <div class="row">

    <!-- Register-->
    <div class="col-lg-12  ">
      <div class="card ">
        <div class="card-body ">
          <!-- Register-->
          <div class="col-lg-12 align-items-center auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
              @include('flash::message')
              @if ($errors->any())
                <div class="alert alert-danger pb-2" role="alert">
                    <h4 class="alert-heading">Erros:</h4>
                    <div class="alert-body">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
              @endif
              <div class="col-12">
                <div class="row mb-2">
                  <div class="col-10">
                    @include('flash::message')
                    @if ($errors->any())
                      <div class="alert alert-danger pb-2" role="alert">
                          <h4 class="alert-heading">Erros:</h4>
                          <div class="alert-body">
                              <ul>
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach
                              </ul>
                          </div>
                      </div>
                    @endif
                    <form class="form form-horizontal" method="POST" action="{{ route('arquivos.update', $file->id) }}">
                      @csrf()
                      @method('PUT')
                      <div class="row">
                        <div class="col-12">
                          <div class="mb-1 row">
                            <div class="col-sm-12">
                              <input type="text" value="{{ $file->title }}" id="title" class="form-control" name="title" placeholder="Nome do Despesa" />
                            </div>
                          </div>
                        </div>
                        <div class="col-sm-12">
                          <button type="submit" class="btn btn-primary me-1" style="position: relative; float: left;">Editar</button>
                    </form>
                          <form method="POST" name="form-delete" action="{{ route('arquivos.destroy', $file->id) }}">
                              @csrf()
                              @method('delete')
                              <button type="submit" class="btn btn-danger" style="position: relative; float: left;"
                                onclick="return confirm('Tem certeza que deseja deletar o Arquivo?');">Deletar
                              </button>
                          </form>
                        </div>
                      </div>

                  </div>
                  <div class="col-2">
                    <a class="btn btn-primary w-100" href="{{ url()->previous() }}" >Voltar</a>
                  </div>
                </div>
              </div>
              <div id="pdf"></div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.js"></script>
              @if (isset($file))
                  <script>
                      if(PDFObject.supportsPDFs){
                          console.log('Navegador Suporta PDF');
                          PDFObject.embed("{{ asset('storage/files/' . $file->url) }}", "#pdf");
                      }
                      else {
                          console.log("Navegador Não Suporta PDF");
                          window.location.href = '{{ asset('storage/files/' . $file->url) }}';
                      }
                  </script>
              @else
                  <p>Arquivo Não Encontrado</p>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

@section('vendor-script')
<script src="{{asset(mix('vendors/js/forms/select/select2.full.min.js'))}}"></script>
@endsection

@section('page-script')
@endsection
