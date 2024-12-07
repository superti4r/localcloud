<?php
$allowed_extensions = ['pdf', 'docx', 'xlsx', 'pptx', 'jpg', 'png', 'zip', 'rar', 'mp4', 'mp3', 'txt', 'exe'];
$max_size = 1024 * 1024 * 1024; // 1GB

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $file_name = $_FILES['file']['name'];
  $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_size = $_FILES['file']['size'];
  $file_tmp_name = $_FILES['file']['tmp_name'];

  if (in_array($file_extension, $allowed_extensions) && $file_size <= $max_size) {
    if (move_uploaded_file($file_tmp_name, 'uploads/' . $file_name)) {
      echo 'File berhasil diunggah!';
    } else {
      echo 'Terjadi kesalahan saat mengunggah file.';
    }
  } else {
    echo 'File tidak valid! Ukuran file melebihi 1 GB atau ekstensi tidak diperbolehkan.';
  }
}