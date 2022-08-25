<div class="card card-lg form-check form-check-select-stretched h-100 zi-1 border border-primary">
    <div class="card-header text-center">
        <span class="card-subtitle fw-bold">Basic</span>
        <h2 class="card-title display-3 text-dark">Free</h2>
        <p class="card-text">Forever free</p>
    </div>

    <div class="card-body d-flex justify-content-center">
        <!-- List Checked -->
        <ul class="list-checked list-checked-primary mb-0">
            <li class="list-checked-item">1 user</li>
            <li class="list-checked-item">Front plan features</li>
            <li class="list-checked-item">Front plan features</li>
            <li class="list-checked-item">Front plan features features</li>
            <li class="list-checked-item">Front plan features</li>
            <li class="list-checked-item">Front plan features</li>
            <li class="list-checked-item">1 app</li>
        </ul>
        <!-- End List Checked -->
    </div>

    <div class="card-footer border-0 text-center">
        <form action="" wire:submit.prevent="payPal" method="post">
            <div class="d-grid mb-2">
                <button type="submit" class="form-check-select-stretched-btn btn btn-outline-primary">Select plan</button>
            </div>
        </form>
    </div>
</div>
