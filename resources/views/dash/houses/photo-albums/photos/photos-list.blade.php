<div>
    @push('stylesheets')
        <style>
            .massonary-container {
                width: 100%;
                display: block;
                margin: 0 auto;
            }
            .masonry {
                column-count: 2;
                column-gap: 5px;
            }
            @media (min-width: 768px) {
                .masonry {
                    column-count: 3;
                }
            }
            @media (min-width: 992px) {
                .masonry {
                    column-count: 4;
                }
            }
            @media (min-width: 1199px) {
                .masonry {
                    column-count: 4;
                }
            }
            .masonry .brick {
                box-sizing: border-box;
                -webkit-column-break-inside: avoid;
                page-break-inside: avoid;
                break-inside: avoid;
                counter-increment: brick-counter;
                margin-bottom: 12px;
                margin-left: 6px;
            }
            .masonry img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 6px;
            }

        </style>
    @endpush
    <div class="masonry">
        @foreach($data as $dt)
            <div
                class="brick"
                x-data="{mouseIn: false}"
                @mouseenter="mouseIn = true"
                @mouseleave="mouseIn = false"
            >
                <div
                    class="card border-0 rounded shadow"
                >
                    <img src="{{ $dt->getFileUrl('path') }}" class="card-img rounded" />
                    <div
                        class="p-4 rounded d-flex align-items-center justify-content-center "
                        style="background: rgba(0,0,0, 0.3); position: absolute; top: 0; bottom: 0; left: 0; right: 0; display: none"

                    >
                       <div x-show="mouseIn">
                           <p class="card-text text-white">{{ str($dt->description)->limit(20) }}</p>
                           <div class="d-flex justify-content-center">
                               <button
                                   class="btn btn-primary btn-xs me-2"
                                   wire:click.prevent="$emit('showPhotoCUModal', true, {{$dt->PhotoId}})"
                               >
                                   <i class="bi bi-pencil-fill"></i>
                               </button>
                               <button
                                   class="btn btn-danger btn-xs d-inline-block"
                                   wire:click.prevent="destroy({{$dt->PhotoId}})"
                               >
                                   <i class="bi bi-trash-fill"></i>
                               </button>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
