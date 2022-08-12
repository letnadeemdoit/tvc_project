<x-guest-layout>
    @include('partials.sub-page-hero-section', ['title' => 'House Blog'])

    {{--  center text row  --}}
    <section class="bg-map bg-light pt-5">
        <div class="blog-text shadow-1-strong rounded text-center  d-flex justify-content-center align-items-center">
            <h1 class="text-primary font-vintage mb-0">House Blog</h1>
        </div>
        <h1 class="pt-2 text-center poppins-bold">Read the best stories here</h1>
        <livewire:blog.blog-list :user="$user" />
    </section>

</x-guest-layout>


