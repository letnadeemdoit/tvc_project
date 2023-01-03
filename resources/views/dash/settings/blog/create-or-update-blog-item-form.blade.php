<x-modals.bs-modal class="modal-lg">
    <div
        x-data="{tokenizeInitialized: false}"
        class="modal-content"
        @modal-is-shown.window="
        $('#amsify').amsifySuggestags();
        let selected = [];
        $('#amsify').amsifySuggestags({
             afterAdd : function(value) {
             selected.push(value);
             @this.set('state.tags', selected, true);
        },
             afterRemove : function(value) {
            if(selected.indexOf(value) > -1){
                 selected.splice(selected.indexOf(value), 1);
            }
             @this.set('state.tags', selected, true);
	    },
        });

        ">
        <div class="modal-header">
            <h5 class="modal-title">
                {{ $blogItem && $blogItem->BlogId ? "Update" : 'Add' }}
                Blog</h5>
            <button
                type="button"
                class="btn-close"
                aria-label="Close"
                wire:ignore
                @click.prevent="hide()"
            ></button>
        </div>
        <div class="modal-body">
            <form wire:submit.prevent="saveBlogItemCU" method="post">
                <div>
                    @if($blogItem && $blogItem->image)
                        <div class="d-flex mb-3">
                            <div class="mx-auto position-relative">
                                <a
                                    href="#"
                                    class="position-absolute" style="right: 5px; top: 5px"
                                    wire:click.prevent="deleteFile"
                                ><i class="bi-trash fs-3 pe-1 pt-1 text-dark text-white"></i></a>
                                <img src="{{ $blogItem->getFileUrl() }}" class="img-thumbnail" style="max-height: 200px"/>
                            </div>
                        </div>
                    @endif
                </div>
                <div>
                    <x-upload-zone wire:model="file"/>
                    <x-jet-input-error for="image"/>
                </div>
                <br/>


                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="checkbox"
                                   value="1"
                                   wire:model.defer="state.is_public"
                                   id="is_public">
                            <label class="form-check-label" for="is_public">
                                Show as a public
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
                        <label class="form-label" for="Subject">Subject:</label>
                        <input
                            type="text"
                            id="Subject"
                            wire:model.defer="state.Subject"
                            name="Subject"
                            class="form-control @error('Subject') is-invalid @enderror"
                            placeholder="Enter blog subject"
                        />
                        @error('Subject')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-12 col-lg-12">
{{--                        <label class="form-label" for="category_id">Select Category:</label>--}}

                        <div class="d-flex justify-content-start align-items-center mb-1">
                            <label class="form-label me-1 me-md-3 mb-0" for="category_id">Select Category:</label>
                            <a href="{{ route('dash.settings.category') }}" class="text-decoration-underline">Add new category</a>
                        </div>

                        <select id="category_id" wire:model.defer="state.category_id"
                                class="form-control">
                            <option value="" selected>Choose Category</option>
                            @forelse($blogCategories as $category)
                                <option value="{{ $category->id }}"
                                        wire:key="category-{{ $category->id }}">{{ $category->name }}</option>
                            @empty
                                <option value="" disabled selected>No category exist To add category go to category section</option>
                            @endforelse
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback d-block">{{$message}}</span>
                        @enderror
                    </div>
                </div>
{{--                    <div class="row">--}}
{{--                        <div class="mb-3 col-12 col-lg-12">--}}
{{--                            <label class="form-label" for="tags">Add Tags:</label>--}}
{{--                            <input type="text"--}}
{{--                                   class="form-control"--}}
{{--                                   id="amsify" name="amsify-tag"--}}
{{--                                   wire:model.defer="state.tags"--}}
{{--                            />--}}
{{--                            <select id="tokenize-tags" class="tokenize-demo form-control" multiple wire:model.defer="state.tags" >--}}
{{--                                @isset($state['tags'])--}}
{{--                                    @if(is_array($state['tags']))--}}
{{--                                        @foreach($state['tags'] as $tag)--}}
{{--                                            <option value="{{ $tag }}" selected>{{ $tag }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    @endif--}}
{{--                                @endisset--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                <div class="row">
                    <div
                        class="mb-3"
                        @modal-is-shown.window="
                        window.tinymce.init({
                            ...window.TINYMCE_DEFAULT_CONFIG,
                            selector: 'textarea#Content',
                            plugins: 'fullscreen image code lists table emoticons insertdatetime',
                            toolbar: 'insertfile undo redo bold italic underline  alignleft aligncenter alignright alignjustify outdent indent numlist bullist link image code fullscreen lineheight | styleselect fontfamily fontsize blocks forecolor backcolor emoticons insertdatetime  table tabledelete | tableprops tablerowprops tablecellprops | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol',
                            /* enable title field in the Image dialog*/
                            insertdatetime_formats: [ '%H:%M:%S', '%I:%M:%S %p', '%Y-%m-%d', '%D' ],
                            image_advtab: true,
                            visual: false,
                            toolbar_mode: 'sliding',
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
                                    @this.set('state.Contents', editor.getContent(), true);
                                });
                            }
                        })
                    "

                    >
                        <label class="form-label" for="board_textarea">Content:</label>
                        <textarea
                            class="form-control @error('Contents') is-invalid @enderror"
                            wire:model.defer="state.Contents"
                            name="Content"
                            placeholder="Write your content here"
                            rows="3"
                            id="Content"

                        ></textarea>
                        @error('Contents')
                        <span class="invalid-feedback">{{$message}}</span>
                        @enderror
                    </div>

                    {{--                    <div class="mb-3 col-12 col-lg-12">--}}
                    {{--                        <label class="form-label" for="title">Content</label>--}}
                    {{--                        <textarea--}}
                    {{--                            class="form-control @error('Content') is-invalid @enderror"--}}
                    {{--                            wire:model.defer="state.Content"--}}
                    {{--                            name="Content"--}}
                    {{--                            placeholder="Content"--}}
                    {{--                            rows="4"--}}
                    {{--                            id="board_textarea"--}}

                    {{--                        ></textarea>--}}
                    {{--                        @error('Content')--}}
                    {{--                        <span class="invalid-feedback">{{$message}}</span>--}}
                    {{--                        @enderror--}}
                    {{--                    </div>--}}


                </div>


                <div class="mb-3 d-flex">
                    <button type="submit" class="btn btn-primary px-5 ms-auto">
                        {{ $blogItem && $blogItem->BlogId ? "Update" : 'Add' }} Blog Item
                    </button>
                </div>

            </form>
        </div>
    </div>
    @push('scripts')
        <script src="{{asset('vendors/tokenize2/tokenize2.min.js')}}"></script>
        <script src="{{asset('vendors/amsify/jquery.amsify.suggestags.js')}}"></script>
    @endpush
</x-modals.bs-modal>
