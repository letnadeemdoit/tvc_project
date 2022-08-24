
<x-guest-layout>
    @push('stylesheets')
    @endpush

    @include('partials.sub-page-hero-section', ['title' => 'Local Guide'])

    <section class=" bg-light">
        <div class="section-padding">
        <div class="bg-guide shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">Local Guide</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read Local Guide reviews here</h1>
        </div>
        <livewire:local-guide.local-guide-list :user="$user" />
    </section>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('nav.navecation ul li a').click(function(){
                    $('li a').removeClass("active");
                    $(this).addClass("active");
                });
            });
        </script>
    @endpush()
</x-guest-layout>

