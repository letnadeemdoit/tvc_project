<div
    class="card"
    x-data="{
        photoName: null,
        photoPreview: null,
        profilePhotoUploadingProgress: 0,
        reset() {
            this.photoName = null;
            this.photoPreview = null;
            this.profilePhotoUploadingProgress = 0;
        }
    }">
    <!-- Profile Cover -->
    <div class="profile-cover">
        <div class="profile-cover-img-wrapper">
            <img id="profileCoverImg" class="profile-cover-img" src="/images/bulletin-images/bulletin.png" alt="Image Description">

            <!-- Custom File Cover -->
            {{--                                <div class="profile-cover-content profile-cover-uploader p-3">--}}
            {{--                                    <input type="file" class="js-file-attach profile-cover-uploader-input" id="profileCoverUplaoder" data-hs-file-attach-options='{--}}
            {{--                                "textTarget": "#profileCoverImg",--}}
            {{--                                "mode": "image",--}}
            {{--                                "targetAttr": "src",--}}
            {{--                                "allowTypes": [".png", ".jpeg", ".jpg"]--}}
            {{--                             }' />--}}
            {{--                                    <label class="profile-cover-uploader-label btn btn-sm btn-white" for="profileCoverUplaoder">--}}
            {{--                                        <i class="bi-camera-fill"></i>--}}
            {{--                                        <span class="d-none d-sm-inline-block ms-1">Upload header</span>--}}
            {{--                                    </label>--}}
            {{--                                </div>--}}
            <!-- End Custom File Cover -->
        </div>
    </div>
    <!-- End Profile Cover -->

    <!-- Avatar -->
    <label
        class="avatar avatar-xxl avatar-circle avatar-uploader profile-cover-avatar"
        for="profile_photo"
    >
        <img
            class="avatar-img"
            src="{{ $this->user->profile_photo_url }}"
            alt="{{ $this->user->name }}"
        />

        <input
            type="file"
            class="avatar-uploader-input"
            wire:model="photo"
            name="profile_photo"
            id="profile_photo"
            x-on:livewire-upload-start="profilePhotoUploadingProgress = 1"
            x-on:livewire-upload-finish="reset(); @this.save()"
            x-on:livewire-upload-error="reset()"
            x-on:livewire-upload-progress="profilePhotoUploadingProgress = $event.detail.progress"

            x-ref="photo"
            x-on:change="
                photoName = $refs.photo.files[0].name;
                const reader = new FileReader();
                reader.onload = (e) => {
                    photoPreview = e.target.result;
                };
                reader.readAsDataURL($refs.photo.files[0]);
            "
        />

        <span class="avatar-uploader-trigger">
          <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
        </span>
    </label>
    <!-- End Avatar -->

    <!-- Body -->
    <div class="card-body">
        <small class="text-uppercase" style="display: none" x-show="profilePhotoUploadingProgress >  0">Uploading <strong x-text="photoName"></strong> <span x-text="profilePhotoUploadingProgress"></span>%</small>
        <div class="progress mb-3" style="display: none" x-show="profilePhotoUploadingProgress >  0">
            <div
                class="progress-bar"
                role="progressbar"
                x-bind:style="`width: ${profilePhotoUploadingProgress}%`"
                x-bind:aria-valuenow="profilePhotoUploadingProgress"
                aria-valuemin="0"
                aria-valuemax="100"
            ></div>
        </div>
        @error('photo')
            <div class="alert alert-soft-danger" role="alert">
                {{ $message }}
            </div>
        @enderror
        <x-jet-action-message on="saved" class="text-center text-success"/>
        <div class="row">
            <div class="col-sm-5">
                <small class="text-muted fw-bold text-uppercase">username</small>
                <p>{{ $this->user->user_name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <small class="text-muted fw-bold text-uppercase">first name</small>
                <p>{{ $this->user->first_name }}</p>
            </div>
            <div class="col-sm-5">
                <small class="text-muted fw-bold text-uppercase">last name</small>
                <p>{{ $this->user->last_name }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <small class="text-muted fw-bold text-uppercase">email</small>
                <p>{{ $this->user->email }}</p>
            </div>
            <div class="col-sm-5">
                <small class="text-muted fw-bold text-uppercase">role</small>
                <p>{{ $this->user->role }}</p>
            </div>
        </div>
    </div>
    <!-- End Body -->
</div>
