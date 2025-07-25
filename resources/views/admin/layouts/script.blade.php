{{-- <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

<script>
  const quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>    --}}

{{-- Bulk Check --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Shared logic function generator
    function setupBulkDelete(config) {
        const selectAll = document.getElementById(config.selectAllId);
        const checkboxes = document.querySelectorAll(config.checkboxClass);
        const deleteButton = document.getElementById(config.deleteBtnId);
        const form = document.getElementById(config.formId);
        const idsInput = document.getElementById(config.idsInputId);

        if (!selectAll || !checkboxes.length || !deleteButton || !form || !idsInput) {
            return; // One or more elements not found, skip this context
        }

        function updateDeleteButton() {
            const selected = document.querySelectorAll(`${config.checkboxClass}:checked`);
            deleteButton.style.display = selected.length > 1 ? 'inline-block' : 'none';
        }

        // Select All Checkbox
        selectAll.addEventListener('change', function () {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateDeleteButton();
        });

        // Individual Checkbox
        checkboxes.forEach(cb => {
            cb.addEventListener('change', function () {
                const allChecked = document.querySelectorAll(`${config.checkboxClass}:checked`).length === checkboxes.length;
                selectAll.checked = allChecked;
                updateDeleteButton();
            });
        });

        // Submit Handler
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            const selectedIds = Array.from(document.querySelectorAll(`${config.checkboxClass}:checked`))
                                     .map(cb => cb.value);

            if (selectedIds.length > 1) {
                idsInput.value = selectedIds.join(',');
                form.submit();
            } else {
                alert('Please select at least two items to delete.');
            }
        });
    }

    // Config for Posts
    setupBulkDelete({
        selectAllId: 'select-all',
        checkboxClass: '.post-checkbox',
        deleteBtnId: 'bulk-delete-btn',
        formId: 'bulk-delete-form',
        idsInputId: 'bulk-post-ids'
    });

    // Config for Categories
    setupBulkDelete({
        selectAllId: 'select-all',
        checkboxClass: '.category-checkbox',
        deleteBtnId: 'bulk-delete-btn',
        formId: 'bulk-delete-form',
        idsInputId: 'bulk-category-ids'
    });
    
    // Config for Educational Words Englis
    setupBulkDelete({
        selectAllId: 'select-all',
        checkboxClass: '.education-eng-checkbox',
        deleteBtnId: 'bulk-delete-btn',
        formId: 'bulk-delete-form',
        idsInputId: 'bulk-educational-eng'
    });
    
    // Config for Educational Words Chinese
    setupBulkDelete({
        selectAllId: 'select-all',
        checkboxClass: '.education-chn-checkbox',
        deleteBtnId: 'bulk-delete-btn',
        formId: 'bulk-delete-form',
        idsInputId: 'bulk-educational-chn'
    });

    setupBulkDelete({
        selectAllId: 'select-all',
        checkboxClass: '.tags-checkbox',
        deleteBtnId: 'bulk-delete-btn',
        formId: 'bulk-delete-form',
        idsInputId: 'bulk-tags'
    });
});
</script>

<script src="https://cdn.tiny.cloud/1/kitv73e9h5zb8gst8pzfsqvpne0obj8b5ci0fzb1w6xef6tj/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
      tinymce.init({
        selector: '#editor'
      });
</script>
{{-- Enkd Bulk Delete Post --}}

{{-- <script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

<script>
ClassicEditor.create(document.querySelector('#editor'), {
    ckfinder: {
        uploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}'
    },
    simpleUpload: {
        uploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
        withCredentials: false,
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    }
})
.catch(error => {
    console.error(error);
});
</script>   --}}

{{-- Categories Select --}}
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$(document).ready(function() {
    $('#categories').select2({
        placeholder: 'Select Categories...',
        allowClear: true,
        width: '100%'   // Biar full width dan tidak aneh
    });
});
</script>
{{-- Tags Select --}}
<script>
$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});

$(document).ready(function() {
    $('#tags').select2({
        placeholder: 'Select Categories...',
        allowClear: true,
        width: '100%'   // Biar full width dan tidak aneh
    });
});
</script>

{{-- Flatpicker --}}
<script>
    flatpickr("#published", {
        altInput: true,
        altFormat: "F j, Y",
        dateFormat: "Y-m-d",
        allowInput: true
    });
</script>

<script>
FilePond.registerPlugin(FilePondPluginImagePreview);

    // Inisialisasi FilePond
    const inputElement = document.querySelector('input[id="imageInput"]');
    const pond = FilePond.create(inputElement, {
        labelIdle: 'Drag & Drop your files or <span class="filepond--label-action">Browse</span>',
        imagePreviewHeight: 150,
        stylePanelAspectRatio: 0.3,
        allowMultiple: false,
        instantUpload: false
    });
</script>
{{-- File Manager --}}
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
<script>
  $('#lfm').filemanager('image');
</script>


{{-- Auto Generate Slug --}}
<script>
    function slugify(text) {
        return text
            .toString()
            .toLowerCase()
            .trim()
            .replace(/\s+/g, '-')           // ganti spasi dengan dash
            .replace(/[^\w\-]+/g, '')       // hapus karakter non-word
            .replace(/\-\-+/g, '-');        // ganti multiple dash dengan satu
    }

    document.getElementById('title').addEventListener('input', function () {
        const title = this.value;
        const slug = slugify(title);
        document.getElementById('slug').value = slug;
    });
</script>
{{-- End of Auto Generate Slug --}}
