@extends('layouts.web_base')


@section('content')

<style>
.pdfobject-container { height: 30rem; border: 1rem solid rgba(0,0,0,.1); }
</style>

    <section id="projects">
        <div class="container">
            <div class="section-title mb-0 pb-0 mt-4">
              <h1 style="font-size: 250%; font-weight: 900">{{ isset($file->title) ? $file->title : '' }}</h1>
              <h3>Arquivo Detalhado</h3>
            </div>
            <div class="service-entry">
                <div class="entry-content">
                  <div class="entry-introduction entry-infos my-5" style="height: 700px">
                    <a href="{{ url()->previous() }}"><i class="fa fa-arrow-left mr-2"></i> Voltar</a>
                    <div id="pdf" style="height:100%"></div>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.2.7/pdfobject.js"></script>
                    @if (isset($file))
                        <script>
                            if(PDFObject.supportsPDFs){
                                PDFObject.embed("{{ asset('storage/files/' . $file->url) }}", "#pdf");
                            }
                            else {
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
    </section>
@endsection
