document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function() {
        let label = this.nextElementSibling;
        let iconSpan = label.querySelector('.file-icon');
        let fileName = this.files[0].name;
        let fileExtension = fileName.split('.').pop().toLowerCase();

        switch(fileExtension) {
            case 'pdf':
                iconSpan.innerHTML = '<i class="fa fa-file-pdf-o"></i>'; // PDF icon
                break;
            case 'doc':
            case 'docx':
                iconSpan.innerHTML = '<i class="fa fa-file-word-o"></i>'; // Word icon
                break;
            default:
                iconSpan.innerHTML = '<i class="fa fa-file-o"></i>'; // default file icon
        }

        label.textContent = ' ' + fileName;
        label.prepend(iconSpan);
    });

    let uploadBox = input.closest('.upload-box');
    uploadBox.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.style.backgroundColor = '#f0f8ff';
    });

    uploadBox.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.style.backgroundColor = '';
    });

    uploadBox.addEventListener('drop', function(e) {
        e.preventDefault();
        this.style.backgroundColor = '';
        // Check the file extension (.pdf or .doc or .docx)
        if (parseInt(fileUpload.files.length) > 1) {
            alert('Bitte nur eine Datei hochladen.');
        } else if (e.dataTransfer.files[0].name.match(/\.(pdf|doc|docx)$/i)) {
            input.files = e.dataTransfer.files;
            input.dispatchEvent(new Event('change')); // Trigger change event manually
        } else {
            alert('Bitte nur PDF- oder Word-Dateien hochladen.');
        }
    });
});
