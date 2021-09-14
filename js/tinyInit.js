
tinymce.init({
    selector: 'textarea#editor',
    height: 600,
    menubar: false,
    plugins: [
        'advlist autolink lists link image charmap print preview anchor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table paste code help wordcount'
    ],
    toolbar: 'undo redo | formatselect | ' +
        'bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter ' +
        'alignright alignjustify | bullist numlist | ' +
        'removeformat | help',
    help_tabs: [
        'shortcuts', 'keyboardnav', 'versions'
    ],
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});