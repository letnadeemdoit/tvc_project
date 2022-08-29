    <x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $localGuide && $localGuide->id ? "Update" . ($localGuide->title ? " '$localGuide->title'" : '') : 'Add' }}
                Local Guide</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveLocalGuideCU" method="post">

                @if($localGuide && $localGuide->image)
                    <div class="d-flex mb-3">
                        <div class="mx-auto position-relative">
                            <a
                                href="#"
                                class="position-absolute" style="right: 5px; top: 5px"
                                wire:click.prevent="deleteFile"
                            ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>
                            <img src="{{ $localGuide->getFileUrl() }}" class="img-thumbnail" style="max-height: 200px" />
                        </div>
                    </div>
                @endif
                <x-upload-zone wire:model="file" />
                <x-jet-input-error for="image" />
                <br />


                <div class="mb-3">
                    <label class="form-label" for="title">Select Category</label>
                    <select name="local_guide_category_id" id="local_guide_category_id"
                            wire:model.defer="state.category_id"
                            class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Select Your Category...</option>
                        @if(isset($localGuideCategories))
                            @foreach($localGuideCategories as $lgc)
                                <option value="{{$lgc->id}}">{{$lgc->name}}</option>
                            @endforeach
                        @endif
                    </select>
                    @error('category_id')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label" for="title">Title</label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="state.title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Title"
                    />
                    @error('title')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>
                <div
                    class="mb-3"
                    x-data
                    x-init="() => {
                            googleMaps.load().then(function (google) {
                                $refs.office_address.style.height = '5px';
                                var options = {
                                    componentRestrictions: { country: 'us' },
                                    fields: ['address_components', 'geometry'],
                                    types: ['address'],
                                };

                                let autocomplete = new google.maps.places.Autocomplete($refs.office_address, options);

                                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                                    var address = '';
                                    var zipcode = '';
                                    var country = '';
                                    var state = '';
                                    var city = '';

                                    $wire.set('state.address', $refs.office_address.value, true);
                                    let place = autocomplete.getPlace();

                                     // Get each component of the address from the place details,
                                    // and then fill-in the corresponding field on the form.
                                    // place.address_components are google.maps.GeocoderAddressComponent objects
                                    // which are documented at http://goo.gle/3l5i5Mr
                                    for (const component of place.address_components) {
                                        // @ts-ignore remove once typings fixed
                                        const componentType = component.types[0];

                                        switch (componentType) {
                                            case 'street_number': {
                                                break;
                                            }

                                            case 'route': {

                                                break;
                                            }

                                            case 'postal_code': {
                                                zipcode = component.long_name;
                                                break;
                                            }

                                            case 'postal_code_suffix': {

                                                break;
                                            }

                                            case 'locality':
                                                city = component.long_name;
                                                break;

                                            case 'administrative_area_level_1': {
                                                state = component.short_name;
                                                break;
                                            }

                                            case 'country': {
                                                country = component.long_name;
                                                break;
                                            }
                                        }
                                    }

                                    $wire.set('state.address_components', {city,state,country, zipcode}, true);

                                });
                            });
                        }
                        "
                >
                    <label class="fw-bold mb-2" for="office_address">Address</label>
                    <input
                        id="office_address"
                        x-ref="office_address"
                        type="text" class="form-control"
                        name="address"
                        wire:model.defer="state.address"
                    />
                </div>

{{--                <div class="mb-3">--}}
{{--                    <label class="form-label" for="title">Address1</label>--}}
{{--                    <input--}}
{{--                        type="text"--}}
{{--                        id="address"--}}
{{--                        wire:model.defer="state.address"--}}
{{--                        name="address"--}}
{{--                        class="form-control"--}}
{{--                        placeholder="Address Url"--}}
{{--                    />--}}

{{--                </div>--}}
                <div class="mb-3">
                    <label class="form-label" for="title">Date & Time</label>
                    <input
                        type="datetime-local"
                        id="datetime"
                        wire:model.defer="state.datetime"
                        name="datetime"
                        class="form-control"
                    />

                </div>


                <div
                    class="mb-3"
                    @modal-is-shown.window="
                        window.tinymce.init({
                        ...window.TINYMCE_DEFAULT_CONFIG,
                        selector: 'textarea#description',
                          plugins: 'fullscreen image code lists',
  toolbar: 'insertfile undo redo | bold italic underline | styleselect fontfamily fontsize blocks lineheight  alignleft aligncenter alignright alignjustify | numlist bullist outdent indent fullscreen forecolor backcolor | link image | code',
  /* enable title field in the Image dialog*/
  image_title: false,

  block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6',

  line_height_formats: '1 1.2 1.4 1.6 2',

  font_size_formats: '8pt 10pt 12pt 14pt 16pt 18pt 24pt 36pt 48pt',

  font_family_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; AkrutiKndPadmini=Akpdmi-n',

  formats: {
    // Changes the alignment buttons to add a class to each of the matching selector elements
    alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,img', classes: 'left' },
    aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,img', classes: 'center' },
    alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,img', classes: 'right' },
    alignjustify: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,img', classes: 'full' }
  },

  browser_spellcheck: true,

  paste_block_drop: false,

  paste_data_images: true,

  /* enable automatic uploads of images represented by blob or data URIs*/
  automatic_uploads: true,
  /*
    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
    images_upload_url: 'postAcceptor.php',
    here we add custom filepicker only to Image dialog
  */
  file_picker_types: 'image',
  /* and here's our custom image picker*/
  file_picker_callback: (cb, value, meta) => {
    const input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');

    input.addEventListener('change', (e) => {
      const file = e.target.files[0];

      const reader = new FileReader();
      reader.addEventListener('load', () => {
        /*
          Note: Now we need to register the blob in TinyMCEs image blob
          registry. In the next release this part hopefully won't be
          necessary, as we are looking to handle it internally.
        */
        const id = 'blobid' + (new Date()).getTime();
        const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        const base64 = reader.result.split(',')[1];
        const blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        /* call the callback and populate the Title field with the file name */
        cb(blobInfo.blobUri(), { title: file.name });
      });
      reader.readAsDataURL(file);
    });

    input.click();
  },
                        setup: function(editor) {
                                editor.on('change', function(e) {
                                    @this.set('state.description', editor.getContent(), true);
                                });
                            }
                        })
                    "
                >
                    <label class="form-label" for="description">Description</label>
                    <textarea
                        class="form-control"
                        wire:model.defer="state.description"
                        name="description"
                        placeholder=""
                        rows="3"
                        id="description"

                    ></textarea>
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $localGuide && $localGuide->id ? "Update" : 'Add' }} Local Guide
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
