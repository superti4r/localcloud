<?php
$file_name = $_GET['file'];

if (file_exists('uploads/' . $file_name)) {
  header('Content-Disposition: attachment; filename="' . $file_name . '"');
  header('Content-Type: application/octet-stream');
  readfile('uploads/' . $file_name);
  exit;
} else {
  echo 'File tidak ditemukan!';
}