<x-guest-layout>
@push('stylesheets')

        <style>
            .rate {
                float: left;
                height: 46px;
                padding: 0 10px;
            }
            .rate:not(:checked) > input {
                position:absolute;
                top:-9999px;
            }
            .rate:not(:checked) > label {
                float:right;
                width:1em;
                overflow:hidden;
                white-space:nowrap;
                cursor:pointer;
                font-size:30px;
                color:#ccc;
            }
            .rate:not(:checked) > label:before {
                content: '★ ';
            }
            .rate > input:checked ~ label {
                color: #FFA534;
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
                color: #FFA534;
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
                color: #FFA534;
            }
        </style>

@endpush

@include('partials.sub-page-hero-section', ['title' => 'Local Guide'])


    <div class="container my-5">

        <div class="row my-5">
            <div class="col-lg-6">

{{--                comment Compenent--}}
                <livewire:comment.comment-form :local-guide="$localGuide" />

            </div>
            <div class="col-lg-6">

{{--                Star Rating Component--}}

                <livewire:review.review-form :local-guide="$localGuide" />
            </div>
        </div>

    </div>


</x-guest-layout>
