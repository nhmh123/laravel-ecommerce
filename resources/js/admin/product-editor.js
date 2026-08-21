function openFileManager(callback, meta) {
    const width = window.innerWidth * 0.8;
    const height = window.innerHeight * 0.8;

    let url = `/laravel-filemanager?editor=${meta.fieldname}`;
    url += meta.filetype === 'image'
        ? '&type=Images'
        : '&type=Files';

    tinymce.activeEditor.windowManager.openUrl({
        url,
        title: 'File Manager',
        width,
        height,
        resizable: true,
        close_previous: false,

        onMessage: (api, message) => {
            callback(message.content);
        }
    });
}

$(function () {
    tinymce.init({
        selector: '#product-description',
        height: 400,
        menubar: false,
        relative_urls: false,

        plugins: [
            'advlist',
            'autolink',
            'lists',
            'link',
            'image',
            'charmap',
            'preview',
            'searchreplace',
            'visualblocks',
            'code',
            'fullscreen',
            'media',
            'table',
        ],

        powerpaste_word_import: 'merge',
        powerpaste_googledocs_import: 'merge',
        powerpaste_html_import: 'merge',

        toolbar:
            'undo redo | blocks | ' +
            'bold italic underline | ' +
            'alignleft aligncenter alignright | ' +
            'bullist numlist | ' +
            'link image media | table | ' +
            'removeformat | code fullscreen',

        file_picker_callback: openFileManager,
    });
});
