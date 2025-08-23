document.addEventListener('DOMContentLoaded', function() {
    const editors = document.querySelectorAll('.ckeditor');

    editors.forEach(textarea => {
        ClassicEditor
            .create(textarea, {
                language: 'fa',
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', 'strikethrough',
                    'subscript', 'superscript', '|',
                    'fontColor', 'fontBackgroundColor', 'fontSize', 'fontFamily', '|',
                    'link', 'blockQuote', 'code', 'codeBlock', '|',
                    'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent', 'alignment', '|',
                    'insertTable', 'tableColumn', 'tableRow', 'mergeTableCells', '|',
                    'highlight', 'selectAll', '|',
                    'undo', 'redo',
                    'imageUpload', 'imageStyle:full/side/inline', 'imageTextAlternative', 'mediaEmbed'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    });
});
