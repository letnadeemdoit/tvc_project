<x-auth-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            {{--            <x-jet-authentication-card-logo />--}}
        </x-slot>

        <div class="w-100 content-space-t-4 content-space-t-lg-2 content-space-b-1" style="height: 100vh; overflow-y: scroll">
            <div style="max-width: 35rem;margin: auto">

                <!-- Form -->
                {{--            <x-jet-validation-errors class="mb-4"/>--}}

                @if (session('status'))
                    <div
                        x-data="{ shown: false, timeout: null }"
                        x-init="clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 10000);"
                        x-show.transition.out.opacity.duration.1500ms="shown"
                        x-transition:leave.opacity.duration.1500ms
                        style="display: none;"
                        class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif
                <div class="mb-5 text-center text-lg-start">
                    <h1 class="display-4 poppins-bold mb-2">Create your <span class="text-primary">Account.</span></h1>
                    <small class="text-muted mb-3 d-block">To keep track of your vacation home in use.</small>
                </div>

                <livewire:register />

                <div class="text-center">
                    <p>Already have an account? <a href="{{route('login')}}" class="text-decoration-underline text-primary">Login</a>
                    </p>
                </div>
                <!-- second fieldset ends -->
            </div>
        </div>
    </x-jet-authentication-card>

{{--    @push('scripts')--}}
{{--        <script>--}}
{{--            $(function() {--}}
{{--                // INITIALIZATION OF DROPZONE--}}
{{--                // =======================================================--}}
{{--                HSCore.components.HSDropzone.init('.js-dropzone', {--}}
{{--                    url: "{{ route('register') }}",--}}
{{--                    autoProcessQueue: false,--}}
{{--                    accept: function(file) {--}}
{{--                        console.log(file);--}}
{{--                        let fileReader = new FileReader();--}}

{{--                        fileReader.readAsDataURL(file);--}}
{{--                        fileReader.onloadend = function() {--}}

{{--                            let content = fileReader.result;--}}
{{--                            console.log(content);--}}
{{--                            $('#file').files = [content];--}}
{{--                            file.previewElement.classList.add("dz-success");--}}
{{--                        }--}}
{{--                        file.previewElement.classList.add("dz-complete");--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endpush--}}
</x-auth-layout>
