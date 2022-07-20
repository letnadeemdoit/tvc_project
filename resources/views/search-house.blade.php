<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 25rem;">

                <div class="mb-5">
                    <h1 class="display-5">Search <span class="text-primary">House</span></h1>
                    <p>Search your house here to have beautiful vacations with your family.</p>
                </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4"/>

            <form>

                <h3>New test</h3>
                <div class="input-group dropdown">
                    <input type="text" class="form-control countrycode dropdown-toggle" value="(+47)">
                    <ul class="dropdown-menu">
                        <li><a href="#" data-value="+47">Norway (+47)</a></li>
                        <li><a href="#" data-value="+1">USA (+1)</a></li>
                        <li><a href="#" data-value="+55">Japan (+55)</a></li>
                    </ul>
                    <span role="button" class="input-group-addon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></span>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
    @push('scripts');
    <script>
        alert("hello");
    </script>
    @endpush
</x-auth-layout>
