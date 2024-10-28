<div id="notificationsSection" class="card">
    <div class="card-header">
        <h4 class="card-title">Notifications</h4>
    </div>

    <!-- Body -->
    <form wire:submit.prevent="updateNotificationPreferences" class="card-body">
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="calendar_email_list">Changes to calendar distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="calendar_email_list"
                class="form-control @error('calendar_email_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.calendar_email_list"
            ></textarea>
                @error('calendar_email_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification email anytime that a vacation is inserted, updated or deleted from the calendar.</span>
            </div>
        </div>
{{--        <div class="row mb-4">--}}
{{--            <label class="col-sm-3 col-form-label form-label" for="vacation_approval_email_list">Vacation approval distribution list:</label>--}}
{{--            <div class="col-sm-9">--}}
{{--            <textarea--}}
{{--                id="vacation_approval_email_list"--}}
{{--                class="form-control @error('vacation_approval_email_list') is-invalid @enderror"--}}
{{--                placeholder="Separate multiple emails by comma, leave blank for no notification"--}}
{{--                rows="4"--}}
{{--                wire:model.defer="state.vacation_approval_email_list"--}}
{{--            ></textarea>--}}
{{--                @error('vacation_approval_email_list')--}}
{{--                <span class="invalid-feedback">{{ $message }}</span>--}}
{{--                @enderror--}}
{{--                <span class="form-text">Use this option to send out a notification email when Scheduler or Guest Vacation approved or disapproved.</span>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="request_to_use_house_email_list">Request to Use House distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="request_to_use_house_email_list"
                class="form-control @error('request_to_use_house_email_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.request_to_use_house_email_list"
            ></textarea>
                @error('request_to_use_house_email_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification request to Use House</span>
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="blog_email_list">New blog items is added distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="blog_email_list"
                class="form-control @error('blog_email_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.blog_email_list"
            ></textarea>
                @error('blog_email_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification email that contains the contents of a newly created blog (only the initial blog not the comments)</span>
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="local_guide_email_list">New local guide item is added distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="local_guide_email_list"
                class="form-control @error('local_guide_email_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.local_guide_email_list"
            ></textarea>
                @error('local_guide_email_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification email that contains the contents of a newly created local guide (only the initial local guide not the comments)</span>
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="guest_book_email_list">New guest book item is added distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="guest_book_email_list"
                class="form-control @error('guest_book_email_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.guest_book_email_list"
            ></textarea>
                @error('guest_book_email_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification email that contains the contents of a newly created guest book (only the initial guest book not the comments)</span>
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="photo_email_list">New photo is added distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="photo_email_list"
                class="form-control @error('photo_email_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.photo_email_list"
            ></textarea>
                @error('photo_email_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification email that contains the contents of a newly created photo (only the initial photo not the comments)</span>
            </div>
        </div>
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="food_item_list">New food items is added distribution list:</label>
            <div class="col-sm-9">
            <textarea
                id="food_item_list"
                class="form-control @error('food_item_list') is-invalid @enderror"
                placeholder="Separate multiple emails by comma, leave blank for no notification"
                rows="4"
                wire:model.defer="state.food_item_list"
            ></textarea>
                @error('food_item_list')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
                <span class="form-text">Use this option to send out a notification email that contains the contents of a newly created food (only the initial food not the comments)</span>
            </div>
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <x-jet-action-message class="text-success me-2" on="saved"/>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <!-- End Body -->
</div>
