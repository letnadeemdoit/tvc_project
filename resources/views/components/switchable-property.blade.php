@props(['house'])

<form method="POST" action="{{ route('dash.switch-house') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="house_id" value="{{ $house->HouseID }}">

    <a href="#" class="dropdown-item" x-on:click.prevent="$root.submit();">
        <i class="bi bi-house me-1"></i>  {{ $house->HouseName }}
    </a>
</form>
