<?php
include 'upload.php';
$files = scandir('uploads');
$ip_address = gethostbyname(gethostname());
$upload_dir = 'uploads';
$total_space = disk_total_space($upload_dir);
$free_space = disk_free_space($upload_dir);
$used_space = $total_space - $free_space;
$total_space_gb = round($total_space / 1024 / 1024 / 1024, 2);
$free_space_gb = round($free_space / 1024 / 1024 / 1024, 2);
$used_space_gb = round($used_space / 1024 / 1024 / 1024, 2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Local Cloud</title>
  <link rel="stylesheet" href="ui/framework.css">
  <link rel="stylesheet" href="ui/native.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h1 class="text-center mb-4">Local Cloud v1</h1>
    <div class="alert alert-info text-center">
      Akses secara lokal: <strong>http://<?php echo $ip_address; ?>/sharingweb</strong>
    </div>
    <div class="alert alert-success text-center">
      Penyimpanan tersedia: <strong><?php echo $free_space_gb; ?> GB dari <?php echo $total_space_gb; ?> GB</strong>
    </div>
    <div class="card shadow-sm p-4">
      <form action="upload.php" method="post" enctype="multipart/form-data" id="form-upload">
        <div class="mb-3">
          <label for="input-file" class="form-label">Pilih file untuk diunggah</label>
          <input type="file" name="file" class="form-control" id="input-file" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Unggah</button>
        <div class="progress mt-3" style="display:none;" id="progress-bar">
          <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%">0%</div>
        </div>
      </form>
    </div>
    <div class="mt-4">
      <h2 class="text-center">File Terupload</h2>
      <ul class="list-group">
        <?php foreach ($files as $file) : ?>
          <?php if ($file !== '.' && $file !== '..') : ?>
            <li class="list-group-item text-center">
            <span class="d-block mb-2"><?php echo htmlspecialchars($file); ?></span>
            <a href="download.php?file=<?php echo urlencode($file); ?>" class="btn btn-success btn-sm w-100">Download</a>
          </li>
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>

  <footer class="text-center mt-5 py-3">
    <p>Made with <span style="color: #e25555;">&hearts;</span> superti4r</p>
  </footer>

  <script src="ui/script.js"></script>
</body>
</html>
