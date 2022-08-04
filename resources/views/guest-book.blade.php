<x-guest-layout>
    @push('stylesheets')
        <style>
            .quote-card .avatar {
                width: 5rem !important;
                height: 5rem !important;
            }

            .quote-card .avatar .avatar-status {
                background: #000;
                padding: 10px;
            }

            .quote-card .bi.bi-quote {
                font-size: 18px;
                color: #fff;
            }
        </style>
    @endpush

    @include('partials.sub-page-hero-section',["title" => 'Guest Book'])

        <section class="mx-auto my-5">
            <div class="container  pt-5">
                <div class="row">
                    @foreach($guestbook as $book)
                    @include('dash.guest-book.book-item.book-item-card')
                    @endforeach
                </div>
            </div>
        </section>


</x-guest-layout>

