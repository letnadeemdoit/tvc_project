<x-guest-layout>
    @include('partials.sub-page-hero-section', ['title' => 'House Blog'])

    {{--  center text row  --}}
    <section class="">
{{--        <div class="blog-text shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">--}}
{{--            <h1 class="text-primary font-vintage mb-0">House Blog</h1>--}}
{{--        </div>--}}
{{--        <h1 class="pt-2 text-center poppins-bold">Read the best stories here</h1>--}}
        <livewire:blog.blog-list :user="$user" />
    </section>


    @push('scripts')
        <script>
            $(document).ready(function(){

                var list = $(".item");
                var numToShow = 12;
                var button = $("#next");
                var numInList = list.length;
                list.hide();
                if (numInList > numToShow) {
                    button.show();
                }
                list.slice(0, numToShow).show();

                button.click(function(){
                    var showing = list.filter(':visible').length;
                    list.slice(showing - 1, showing + numToShow).fadeIn();
                    var nowShowing = list.filter(':visible').length;
                    if (nowShowing >= numInList) {
                        button.hide();
                    }
                });

            });
        </script>
{{--        <script>--}}
{{--            $(document).ready(function(){--}}

{{--                var list = $(".blog-tabs");--}}
{{--                var numToShow = 5;--}}
{{--                var button = $("#next-categories");--}}
{{--                var numInList = list.length;--}}
{{--                list.hide();--}}
{{--                if (numInList > numToShow) {--}}
{{--                    button.show();--}}
{{--                }--}}
{{--                list.slice(0, numToShow).show();--}}

{{--                button.click(function(){--}}
{{--                    var showing = list.filter(':visible').length;--}}
{{--                    list.slice(showing - 1, showing + numToShow).fadeIn();--}}
{{--                    var nowShowing = list.filter(':visible').length;--}}
{{--                    if (nowShowing >= numInList) {--}}
{{--                        button.hide();--}}
{{--                    }--}}
{{--                });--}}

{{--            });--}}
{{--        </script>--}}


    @endpush()

</x-guest-layout>


