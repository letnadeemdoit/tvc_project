<div>
    <div class="">
        <div class="row"data-masonry='{"percentPosition": true }'>

            @if(isset($data))
                @foreach($data as $dt)
                    <div class="col-md-3 mb-4">
                        <div class="card shadow-lg">
                            <img class="card-img-top"
                                 src="{{$dt->getFileUrl()}}"
                                 alt="photo image"
                            >
                            <div class="card-body">
                                <p class="card-text">{!! $dt->description ?? '' !!}</p>
                            </div>
                            <div class="d-flex mt-2" aria-label="Edit group">
                                <a class="btn btn-outline-info rounded-2 mx-3 mb-1 w-50" href="#!"
                                   wire:click="$emit('showPhotoCUModal', true, {{$dt->PhotoId}})"
                                >
                                    <i class="bi-pencil me-1"></i> Edit
                                </a>

                                <button
                                    type="button"
                                    class="btn btn-outline-danger rounded-2 mx-3 mb-1 w-50 btn-sm"
                                    wire:click.prevent="destroy({{$dt->PhotoId}})"
                                >
                                    <i class="bi-trash"></i>
                                </button>

                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
