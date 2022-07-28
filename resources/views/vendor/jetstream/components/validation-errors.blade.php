@if ($errors->any())
    <div {{ $attributes }} >
        <div class="alert alert-soft-danger" role="alert">
            <h3 class="mb-0">Whoops!</h3>
            <h5>{{ __('Something went wrong.') }}</h5>

            <ul class="mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
