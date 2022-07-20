<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 30rem;">

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

            <form class="bg-light-primary p-4 border-solid">

                <label for="defaultDropdown fw-bolder mb-2" style="color: #000">House Name</label>
                <div class="d-block d-md-flex">
                    <!-- <input  type="text" class="form-control" id="defaultDropdown" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" />
                    <ul class="dropdown-menu" aria-labelledby="defaultDropdown">
                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                        <li><a class="dropdown-item" href="#">Menu item</a></li>
                    </ul> -->
                    <div class="input-group dropdown">
                        <input type="text" class="form-control countrycode dropdown-toggle" value="(+47)">
                        <ul class="dropdown-menu">
                            <li><a href="#" data-value="+47">Norway (+47)</a></li>
                            <li><a href="#" data-value="+1">USA (+1)</a></li>
                            <li><a href="#" data-value="+55">Japan (+55)</a></li>
                        </ul>
                        <span role="button" class="input-group-addon dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></span>
                    </div>
                    <button class="btn bg-primary text-white ms-0 ms-md-3  mt-2 mt-md-0">Go to House</button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
    @push('scripts')
        <script>
            $(document).ready(function(){
            $(function() {
                $('.dropdown-menu a').click(function() {
                    console.log($(this).attr('data-value'));
                    $(this).closest('.dropdown').find('input.countrycode')
                        .val('(' + $(this).attr('data-value') + ')');
                });
            });
            });
        </script>
    @endpush
</x-auth-layout>
