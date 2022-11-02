@if ($errors->any())
    <div {{ $attributes->class(['alert alert-soft-danger px-4 pt-4']) }} role="alert">
        <h3 class="mb-0">Whoops! <small>{{ __('Something went wrong.') }}</small></h3>
        <ul class="mt-2">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
