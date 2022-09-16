<x-settings>
    <x-slot name="title">
        Additional Houses
    </x-slot>
    <x-slot name="headerRightActions">
        <div class="col-sm-auto" x-data>

           @if(isset($maxAdditionalHouse) && $maxAdditionalHouse < 9)
                <a
                    class="btn btn-primary"
                    href="javascript:;"
                    @click.prevent="window.livewire.emit('showAdditionalHouseCUModal', true)"
                >
                    <i class="bi-plus me-1"></i> Add New House
                </a>
            @else
                <a
                    class="btn btn-secondary"
                    href="javascript:;"
                    data-bs-toggle="modal"
                    data-bs-target="#additonalHouseModel"
                >
                    <i class="bi-plus me-1"></i> Add New House
                </a>
           @endif


        </div>
    </x-slot>

    <div class="modal fade hideableModal" id="additonalHouseModel" tabindex="-1"
         aria-labelledby="" aria-hidden="true"
    >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <div>
                      <span class="rounded-circle text-primary border-primary" style="padding: 4px 9px; font-size: 26px; line-height: 75px;border: 3px solid;">
                        <i class="bi-exclamation"></i>
                    </span>
                    </div>

                    <h4 class="fw-bold text-center my-3"
                        style="color: #00000090">You can't Create New Additional House.</h4>
                    <p class="fw-500 fs-15">First of all you need to delete your extra house to create additional house.</p>
                    <div class="btn-group my-2">
                    </div>
                </div>
            </div>
        </div>
    </div>



    <livewire:settings.additional-houses.houses-list :user="$user"/>
    <livewire:settings.additional-houses.create-or-update-house-form :user="$user"/>
</x-settings>
