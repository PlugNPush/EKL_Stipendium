document.getElementById('fileInput').addEventListener('change', function() {
    document.getElementById('fileLabel').textContent = this.files[0].name;
});

const uploadBox = document.querySelector('.upload-box');
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
    document.getElementById('fileInput').files = e.dataTransfer.files;
    document.getElementById('fileLabel').textContent = e.dataTransfer.files[0].name;
});
