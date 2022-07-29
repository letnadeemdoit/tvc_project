<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 37rem;">

            <div class="mb-5">
                <h1 class="display-5">Search <span class="text-primary">House</span></h1>
                <p>Search your house here to have beautiful vacations with your family.</p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4" />

            <form class="bg-light-primary p-4 border-solid">
                {{--        select starts       --}}

                    <h2>Select2 Test</h2>
                    <p>Fluid responsiveness and momentum scrolling on the results drop down </p>

                    <select class="select2" name="country">

                        <optgroup label=" ">
                            <option value="AU" selected> Australia </option>
                            <option value="BR"> Brazil (Brasil) </option>
                            <option value="NZ"> New Zealand </option>
                            <option value="US"> United States </option>
                            <option value="ZA"> South Africa </option>
                        </optgroup>>

                            <optgroup label=" ">
                                <option value="AF"> Afghanistan (‫افغانستان‬‎) </option>
                                <option value="AX"> Åland Islands </option>
                                <option value="AL"> Albania (Shqipëria) </option>
                                <option value="DZ"> Algeria (‫الجزائر‬‎) </option>
                                <option value="AS"> American Samoa </option>
                                <option value="AD"> Andorra </option>
                                <option value="AO"> Angola </option>



                            </optgroup>>

                    </select>

                {{--       select ends         --}}

            </form>
        </div>
    </x-jet-authentication-card>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2({
                });

            });
        </script>
    @endpush
</x-auth-layout>
