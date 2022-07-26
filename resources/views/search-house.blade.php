<x-auth-layout>
    @include('layouts.partials.navigation-menu-top-guest')
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>
        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="max-width: 37rem;">

            <div class="mb-5">
                <h1 class="display-4 popping-bold">Search <span class="text-primary">House</span></h1>
                <p>Search your house here to have beautiful vacations with your family.</p>
            </div>

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <x-jet-validation-errors class="mb-4" />

            <form class="bg-light-primary p-4 border-solid rounded-2">

                <div class="d-block d-md-flex">
                    <div class="t-dropdown-block w-75">
                        <div class="t-dropdown-select">
                            <input type="text" class="t-dropdown-input py-3" placeholder="Search & select your house..." />
                            <span class="t-select-btn border-start-0">
                            </span>
                        </div>
                        <ul class="t-dropdown-list">
                            <li class="t-dropdown-item">Item 1</li>
                            <li class="t-dropdown-item">Item 2</li>
                            <li class="t-dropdown-item">Item 3</li>
                            <li class="t-dropdown-item">Item 4</li>
                            <li class="t-dropdown-item">Item 5</li>
                            <li class="t-dropdown-item">Item 6</li>
                            <li class="t-dropdown-item">Item 7</li>
                            <li class="t-dropdown-item">Item 8</li>
                            <li class="t-dropdown-item">Item 9</li>
                            <li class="t-dropdown-item">Item 10</li>
                            <li class="t-dropdown-item">Item 11</li>
                            <li class="t-dropdown-item">Item 12</li>
                        </ul>
                    </div>



                    <button class="btn bg-primary text-white ms-0 ms-md-3  mt-2 mt-md-0 btn-text">Go to House</button>
                </div>
            </form>
        </div>
    </x-jet-authentication-card>
    @push('scripts')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
                integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script>
            $(document).ready(function () {
                $('.t-dropdown-input').on('click', function() {
                    $(this).parent().next().slideDown('fast');
                });

                $('.t-select-btn').on('click', function() {
                    $('.t-dropdown-list').slideUp('fast');

                    if(!$(this).prev().attr('disabled')){
                        $(this).prev().trigger('click');
                    }
                });

                $('.t-dropdown-input').width($('.t-dropdown-select').width() - $('.t-select-btn').width() - 13);

                $('.t-dropdown-list').width($('.t-dropdown-select').width());

                $('.t-dropdown-input').val('');

                $('li.t-dropdown-item').on('click', function() {
                    var text = $(this).html();
                    $(this).parent().prev().find('.t-dropdown-input').val(text);
                    $('.t-dropdown-list').slideUp('fast');
                });

                $(document).on('click', function(event) {
                    if ($(event.target).closest(".t-dropdown-input, .t-select-btn").length)
                        return;
                    $('.t-dropdown-list').slideUp('fast');
                    event.stopPropagation();
                });
// END //

            });
        </script>
    @endpush
</x-auth-layout>
