<div class="col-12 col-md-6 col-lg-3">
    @if(isset($book))
        <div class="card testimonial-card mt-2 mb-3 quote-card aqua-gradient">
            <div class="avatar avatar-circle mx-auto mt-4">
                <img class="avatar-img" src="{{ Storage::url($book->image) }}" width="75" height="79"
                     alt="Image Description">
                <span class="bi bi-quote avatar-status avatar-sm-status avatar-status-dark"></span>
            </div>
            <div class="card-body pt-3">
                <p class="mb-0"><i class="fas fa-quote-left"></i> {!! isset($book->content) ? $book->content : '' !!}</p>
            </div>
            <div class="card-footer border-top-0 pt-1">
                <div class="footer-title">
                    <p class="fs-4 fw-bold mb-1">{{ isset($book->title) ? $book->title : '' }}</p>
                    <p class="footer-sub-title">{{ isset($book->name) ? $book->name : '' }}, <span class="text-primary">Groomsman</span></p>
                </div>
            </div>
        </div>
    @endif
</div>
