<div>
    <div class="card border-0 text-white bg-transparent" style="box-shadow: 0px 11px 24px rgba(132, 133, 133, 0.16)">
        <a href="#" class="" data-fancybox="photo"
           data-src="{{ $photo->getFileUrl('path') }}"
           data-caption="{{ $photo->description }}"
           data-sizes="(max-width: 600px) 480px, 800px"
        >
            <img
                src="{{ $photo->getFileUrl('path') }}"
                class="card-img"/>
            <div
                class="p-4 rounded d-flex align-items-center justify-content-center "
                style="background: rgba(0,0,0, 0.3); position: absolute; top: 0; bottom: 0; left: 0; right: 0; display: none"

            >
                <div>
                    <p class="card-text text-white">{{ str($photo->description)->limit(20) }}</p>
                </div>
            </div>
        </a>
    </div>
</div>
