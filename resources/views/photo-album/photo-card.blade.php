<div class="brick">
    <div class="card border-0 text-white bg-transparent" style="box-shadow: 0px 11px 24px rgba(132, 133, 133, 0.16)">
        <a href="#" class="" data-fancybox="photo"
           data-src="{{ $photo->getFileUrl('path') }}"
           data-caption="{{ $photo->description }}"
           data-sizes="(max-width: 600px) 480px, 800px"
        >
            <img
                src="{{ $photo->getFileUrl('path') }}"
                class="card-img"/>
        </a>
    </div>
</div>
