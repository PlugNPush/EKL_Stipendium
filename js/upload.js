document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function() {
        let label = this.nextElementSibling;
        let iconSpan = label.querySelector('.file-icon');
        let fileName = this.files[0].name;
        let fileExtension = fileName.split('.').pop().toLowerCase();

        switch(fileExtension) {
            case 'pdf':
                iconSpan.innerHTML = '&#128209;'; // PDF icon
                break;
            case 'doc':
            case 'docx':
                iconSpan.innerHTML = '&#128187;'; // Word icon
                break;
            default:
                iconSpan.innerHTML = '&#128196;'; // default file icon
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
        input.files = e.dataTransfer.files;
        input.dispatchEvent(new Event('change')); // Trigger change event manually
    });
});
