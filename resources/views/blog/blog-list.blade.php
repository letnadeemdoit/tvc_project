<div class="container pt-5">
    <ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
        <li class="nav-item">
            <a href="3" class="nav-link active">
                ALL
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/> BEACH
                HOUSE
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <img src="/images/blog-images/building-house.svg" width="30px" class="me-2 d-none d-md-inline-block"/>TOWN
                HOUSE
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <img src="/images/blog-images/tiny-house.svg" width="30px" class="me-2 d-none d-md-inline-block"/>TINY
                HOUSE
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <img src="/images/blog-images/pool.svg" width="30px" class="me-2 d-none d-md-inline-block"/>POOL HOUSE
            </a>
        </li>
    </ul>

    <div class="row">
        @foreach($data as $dt)
            <livewire:blog.post-card :post="$dt" />
        @endforeach
    </div>

    <div class="d-flex">
        <div class="mx-auto">
            {{ $data->links() }}
        </div>
    </div>
</div>

</div>
