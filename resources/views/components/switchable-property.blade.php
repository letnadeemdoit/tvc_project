@props(['house'])

<form method="POST" action="{{ route('dash.switch-house') }}" x-data>
    @method('PUT')
    @csrf

    <!-- Hidden Team ID -->
    <input type="hidden" name="house_id" value="{{ $house->HouseID }}">
    <span class="d-flex justify-content-start align-items-center">
       <i class="bi bi-house me-1 mb-0 text-primary"></i>
        <a href="#" class="nav-link mb-0" style="padding-top: 0 !important;" x-on:click.prevent="$root.submit();">

            @if(!is_null($house->primary_house_name) && $house->primary_house_name !== '')
                {{ $house->primary_house_name }}
            @else
                {{ $house->HouseName }}
            @endif

            <span class="fs-10">
                @if(!is_null($house->primary_house_name) && $house->primary_house_name !== '')
                   ({{ $house->HouseName }})
                @endif
            </span>

    </a>
    </span>
</form>
