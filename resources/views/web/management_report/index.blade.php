@extends('layouts.web_base')

@section('content')
    <section class="management-report">
        <div class="container">
            <div class="section-title mt-4">
                <h2>Relatório de Gestão</h2>
            </div>
            <!-- <article class="blog-post">
                <h2 class="blog-post-title mb-1">Sample blog post</h2>
                    <p class="blog-post-meta">January 1, 2021 by <a href="#">Mark</a></p>

                    <p>This blog post shows a few different types of content that's supported and styled with Bootstrap. Basic typography, lists, tables, images, code, and more are all supported as expected.</p>
                    <hr>
                    <p>This is some additional paragraph placeholder content. It has been written to fill the available space and show how a longer snippet of text affects the surrounding content. We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.</p>
            </article> -->

                <!-- SHORTCUT ICONS -->
            <div class="team-boxed">
                <div class="container">
                    <div class="row person">
                        @foreach ($management_reports as $management_report)
                            <div class="col-md-3 col-lg-3 item">
                                @if (isset($management_report->file))
                                    <a href="{{ route('file_web', $management_report->file->id) }}">
                                        <div class="box">
                                            <i class="fas fa-file-alt fa-3x" style="color:#3CB347"></i>
                                            <p class="name">
                                                {{ 
                                                    \Carbon\Carbon::parse($management_report->initial_date)->format('M')
                                                    . ' - ' .
                                                    \Carbon\Carbon::parse($management_report->final_date)->format('M')
                                                }}
                                            </p>
                                            <h3>{{date('Y', strToTime($management_report->initial_date))}}</h3>
                                        </div>
                                    </a>
                                @else
                                    <div class="box bg-danger">
                                        <i class="fas fa-file-alt fa-3x " style="color:#3CB347"></i>
                                            <p class="name">
                                                {{ 
                                                    \Carbon\Carbon::parse($management_report->initial_date)->format('M')
                                                    . ' - ' .
                                                    \Carbon\Carbon::parse($management_report->final_date)->format('M')
                                                }}
                                            </p>
                                            <h3>{{date('Y', strToTime($management_report->initial_date))}}</h3>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
