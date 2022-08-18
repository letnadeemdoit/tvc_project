<ul class="nav nav-tabs border-bottom-0 blog-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a href="3" class="nav-link active">
            ALL
        </a>
    </li>
    @foreach($categories as $category)
    <li class="nav-item">
        <a href="#" class="nav-link">
            @if($category->image)
            <img
                src="{{$category->getFileUrl('image')}}"
                class="avatar-initials me-2 d-none d-md-inline-block"
                width="30px"
                alt="img"
            />
            @else
            <img src="/images/blog-images/beach.svg" width="30px" class="me-2 d-none d-md-inline-block"/>
            @endif
            {{ $category->name }}
        </a>
    </li>
    @endforeach
</ul>
