<x-guest-layout>
    @push('stylesheets')

    @endpush

    @include('partials.sub-page-hero-section',["title" => 'Bulletin Board']);
    <section class="bg-waves bg-light">
        <div class="container  pt-5">
            <div class="row text-center">
                <div class="features-img shadow-1-strong rounded  text-white d-flex justify-content-center">
                    <h1 class="text-primary font-jost">Vacation House</h1>
                </div>
{{--                <h3 class="pt-2">Choose your Category</h3>--}}
            </div>
            @if(isset($board))
                <div class="row">
                    <div class="col-12 col-md-6 mx-auto">
                        <img src="/images/bulletin-images/house-1.png" class="card-img-top" alt="..." />
                    </div>
                    {{--                @livewire('bulletin-board.board-item-card')--}}
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        {!! isset($board->Board) ? $board->Board : '' !!}
                    </div>
                </div>
            @endif
{{--            <div class="row my-5  category-cards">--}}
{{--                    <div class="col-12 col-md-6 mx-auto">--}}
{{--                        @if(isset($board))--}}
{{--                            <div class="card">--}}

{{--                                <div class="card-body">--}}
{{--                                    <h3 class="card-title">--}}
{{--                                        {{ isset($board->Audit_user_name) ? $board->Audit_user_name : ''}}--}}
{{--                                    </h3>--}}
{{--                                    <h5 class="">--}}
{{--                                        {{ isset($board->Audit_Role) ? $board->Audit_Role : ''}}--}}
{{--                                    </h5>--}}
{{--                                    <h5 class="">--}}
{{--                                        {{ isset($board->Audit_FirstName) ? $board->Audit_FirstName : ''}}--}}
{{--                                    </h5>--}}

{{--                                    <div class="card-text">--}}
{{--                                        {!! isset($board->Board) ? $board->Board : '' !!}--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                --}}{{--                @livewire('bulletin-board.board-item-card')--}}
{{--            </div>--}}
        </div>
    </section>

</x-guest-layout>

