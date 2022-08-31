@props(['house'])

<form method="POST" action="{{ route('dash.switch-house') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="house_id" value="{{ $house->HouseID }}">
    <span class="d-flex justify-content-start align-items-center">
       <i class="bi bi-house me-1"></i>
        <a href="#" class="nav-link" x-on:click.prevent="$root.submit();">
         {{ $house->HouseName }}
    </a>
    </span>
</form>
