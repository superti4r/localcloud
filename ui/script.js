const formUpload = document.getElementById('form-upload');
const progressBar = document.getElementById('progress-bar');
const inputFile = document.getElementById('input-file');

formUpload.addEventListener('submit', (e) => {
  e.preventDefault();
  progressBar.style.display = 'block';
  const file = inputFile.files[0];
  const formData = new FormData();
  formData.append('file', file);
  const xhr = new XMLHttpRequest();

  xhr.upload.addEventListener('progress', (e) => {
    if (e.lengthComputable) {
      const percent = Math.round((e.loaded / e.total) * 100);
      const progress = progressBar.querySelector('.progress-bar');
      progress.style.width = `${percent}%`;
      progress.textContent = `${percent}%`;
    }
  });

  xhr.addEventListener('load', () => {
    if (xhr.status === 200) {
      const progress = progressBar.querySelector('.progress-bar');
      progress.style.width = '100%';
      progress.textContent = '100%';
      alert('File berhasil diunggah!');
      setTimeout(() => {
        progressBar.style.display = 'none';
        location.reload();
      }, 1000);
    }
  });

  xhr.addEventListener('error', () => {
    alert('Terjadi kesalahan saat mengunggah file.');
  });

  xhr.open('POST', 'upload.php', true);
  xhr.send(formData);
});