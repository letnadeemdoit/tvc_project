<div id="notificationsSection" class="card">
    <div class="card-header">
        <h4 class="card-title">Notifications</h4>
    </div>

    <!-- Body -->
    <form wire:submit.prevent="updateNotificationPreferences" class="card-body">
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="calendar_email_list">Send email when calendar
                changes:</label>
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
        <div class="row mb-4">
            <label class="col-sm-3 col-form-label form-label" for="blog_email_list">Send email when new blog items are
                added:</label>
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
        <div class="d-flex align-items-center justify-content-end">
            <x-jet-action-message class="text-success me-2" on="saved"/>
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
    <!-- End Body -->
</div>
