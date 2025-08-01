<x-modals.bs-modal class="modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ $boardItem && $boardItem->id ? "Update" : 'Add' }}
                Bulletin Board Item</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                wire:ignore
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveBulletinBoardCU" method="post">
                {{--                <x-jet-validation-errors />--}}

                <div>
                    @if($boardItem && $boardItem->image)
                        <div class="d-flex mb-3">
                            <div class="mx-auto">
                                <img src="{{ $boardItem->getFileUrl() }}" class="img-thumbnail rounded" style="max-height: 120px"/>
                            </div>
                        </div>
                    @endif
                </div>

                <div>
                    <x-upload-zone wire:model="file" />
                    <x-jet-input-error for="image"/>
                </div>
                <br/>


                <div class="mb-3">
                    <div class="d-flex justify-content-start align-items-center mb-1">
                        <label class="form-label me-1 me-md-3 mb-0" for="category_id">Select Category:</label>
                        <a href="{{ route('dash.settings.category') }}" class="text-decoration-underline">Add new
                            category</a>
                    </div>
                    <select id="category_id" wire:model.defer="state.category_id" class="form-control">
                        <option value="" selected>Choose Category</option>
                        @forelse($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @empty
                            <option value="" disabled selected>No category exist To add category go to category
                                section
                            </option>
                        @endforelse

                    </select>
                    @error('category_id')
                    <span class="invalid-feedback d-block">{{$message}}</span>
                    @enderror
                </div>

                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value="1"
                                   wire:model.defer="state.is_private"
                                   id="is_public">
                            <label class="form-check-label" for="is_private">
                                Hide this bulletin board item from guest.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label" for="title">Title:</label>
                    <input
                        type="text"
                        id="title"
                        wire:model.defer="state.title"
                        name="title"
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="Bulletin board title"
                    />
                    @error('title')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div
                    class="mb-3"
                    @modal-is-shown.window="
                        window.tinymce.init({
                        ...window.TINYMCE_DEFAULT_CONFIG,
                        selector: 'textarea#board_textarea',
                        plugins: 'fullscreen code lists emoticons insertdatetime',
  toolbar: 'insertfile undo redo | bold italic underline | styleselect fontfamily fontsize blocks lineheight emoticons insertdatetime alignleft aligncenter alignright alignjustify | numlist bullist outdent indent fullscreen forecolor backcolor',
  insertdatetime_formats: [ '%H:%M:%S', '%I:%M:%S %p', '%Y-%m-%d', '%D' ],
  toolbar_mode: 'sliding',
  insertdatetime_formats: ['%H:%M:%S', '%Y-%m-%d', '%I:%M:%S %p', '%D', '%y', '%Y', '%m', '%B', '%b', '%d', '%A', '%a','%H', '%I', '%M' , '%S', '%p', '%%' ],
  /* enable title field in the Image dialog*/


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
                                    @this.set('state.Board', editor.getContent(), true);
                                });
                            }

                        })
                    "

                >
                    <label class="form-label" for="board_textarea">Bulletin Board Detail:</label>
                    <textarea
                        class="form-control @error('Board') is-invalid @enderror"
                        wire:model.defer="state.Board"
                        name="Board"
                        placeholder="Write your detail here"
                        rows="4"
                        id="board_textarea"

                    ></textarea>
                    @error('Board')
                    <span class="invalid-feedback">{{$message}}</span>
                    @enderror
                </div>

                <div class="mb-3 d-flex">
                    <button type="submit"
                            class="btn btn-primary px-5 ms-auto">{{ $boardItem && $boardItem->id ? "Update" : 'Add' }}
                        Bulletin Board Item
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-modals.bs-modal>
