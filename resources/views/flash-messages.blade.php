@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block"
         x-data="{ shown: false, timeout: null }"
         x-init="clearTimeout(timeout); shown = true; timeout = setTimeout(() => { shown = false }, 3000);"
         x-show.transition.out.opacity.duration.500ms="shown"
         x-transition:leave.opacity.duration.500ms
         style="display: none;">
        <strong>{{ session('success') }}</strong>
    </div>
@endif
