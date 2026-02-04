@foreach (session('flash_notification', collect())->toArray() as $message)
    @if ($message['overlay'])
        @include('flash::modal', [
            'modalClass' => 'flash-modal',
            'title'      => $message['title'],
            'body'       => $message['message']
        ])
    @else
        @if ($message['level'] === 'success' )
            <div class="alert alert-success pb-2" role="alert">
                <h4 class="alert-heading">Sucesso</h4>
                @if ($message['important'])
                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                    >&times;</button>
                @endif
                <div class="alert-body">
                    {!! $message['message'] !!}
                </div>
            </div>
        @endif
        @if ($message['level'] === 'danger' )
            <div class="alert alert-danger pb-2" role="alert">
                <h4 class="alert-heading">Erro</h4>
                @if ($message['important'])
                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                    >&times;</button>
                @endif
                <div class="alert-body">
                    {!! $message['message'] !!}
                </div>
            </div>
        @endif
        @if ($message['level'] === 'warning' )
            <div class="alert alert-warning pb-2" role="alert">
                <h4 class="alert-heading">Alerta</h4>
                @if ($message['important'])
                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                    >&times;</button>
                @endif
                <div class="alert-body">
                    {!! $message['message'] !!}
                </div>
            </div>
        @endif
        @if ($message['level'] === 'info' )
            <div class="alert alert-info pb-2" role="alert">
                <h4 class="alert-heading">Alerta</h4>
                @if ($message['important'])
                    <button type="button"
                            class="close"
                            data-dismiss="alert"
                            aria-hidden="true"
                    >&times;</button>
                @endif
                <div class="alert-body">
                    {!! $message['message'] !!}
                </div>
            </div>
        @endif
    @endif
@endforeach
{{ session()->forget('flash_notification') }}