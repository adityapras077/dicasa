<?php
$message = ""; // Status message

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $filePath = 'projectDatas.json';
        $currentData = json_decode(file_get_contents($filePath), true) ?? [];

        $uploadDir = 'assets/img/portfolio/';
        $imageNames = [];
        $uploadErrors = [];

        if (!empty($_FILES['image']['name'][0])) {
            foreach ($_FILES['image']['tmp_name'] as $index => $tmpName) {
                $originalName = basename($_FILES['image']['name'][$index]);
                $targetPath = $uploadDir . $originalName;

                $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
                $allowedExts = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

                if (!in_array($ext, $allowedExts)) {
                    $uploadErrors[] = "$originalName bukan file gambar yang valid.";
                    continue;
                }

                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                if (move_uploaded_file($tmpName, $targetPath)) {
                    $imageNames[] = $originalName;
                } else {
                    $uploadErrors[] = "Gagal upload $originalName.";
                }
            }
        }

        if (empty($_POST['title']) || empty($_POST['owner']) || empty($_POST['date']) || empty($_POST['description'])) {
            $message = "Semua bidang wajib diisi!";
            logError("Form tidak lengkap: " . json_encode($_POST));
        } else {
            $nextId = "project-" . (count($currentData) + 1);

            if (empty($imageNames)) {
                $imageNames = ['dicasa.jpg'];
            }

            $newData = [
                'id'          => $nextId,
                'title'       => trim($_POST['title']),
                'owner'       => trim($_POST['owner']),
                'date'        => trim($_POST['date']),
                'description' => trim($_POST['description']),
                'design_note' => trim($_POST['design_note'] ?? ''),
                'image'       => $imageNames, // Otomatis berisi ['dicasa.jpg'] jika tidak ada foto diinput
                'youtube'     => trim($_POST['youtube'] ?? '')
            ];

            if (!empty($newData['youtube']) && !filter_var($newData['youtube'], FILTER_VALIDATE_URL)) {
                $message = "URL YouTube tidak valid!";
                logError("URL YouTube tidak valid: " . $newData['youtube']);
            } else {
                $currentData[] = $newData;
                if (file_put_contents($filePath, json_encode($currentData, JSON_PRETTY_PRINT))) {
                    $message = "Data berhasil ditambahkan!";
                } else {
                    $message = "Gagal menyimpan data!";
                    logError("Gagal menyimpan ke JSON file: " . json_encode($newData));
                }
            }
        }

        if (!empty($uploadErrors)) {
            $message .= "<br>" . implode('<br>', $uploadErrors);
            logError("Upload error: " . implode('; ', $uploadErrors));
        }
    } catch (Exception $e) {
        $message = "Terjadi kesalahan internal!";
        logError("Exception: " . $e->getMessage());
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>DICASA Interior</title>
    <meta content="DICASA Interior" name="description" />
    <meta content="Interior" name="keywords" />
    <!-- Favicons -->
    <link href="assets/img/Logo.png" rel="icon" />
    <link href="assets/img/Logo.png" rel="apple-touch-icon" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,800;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <!-- Vendor CSS Files -->
    <link href="assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />
    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet" />
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center">Tambah Project Data</h4>
                    </div>
                    <div class="card-body">
                        <?php if (!empty($message)): ?>
                            <div class="alert alert-<?php echo strpos($message, 'berhasil') !== false ? 'success' : 'danger'; ?>" role="alert">
                                <?= htmlspecialchars($message); ?>
                            </div>
                        <?php endif; ?>
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Gambar Proyek (boleh lebih dari 1)</label>
                                <input type="file" class="form-control" id="image" name="image[]" multiple>
                                <small class="text-muted">Dapat menyimpan banyak gambar</small>
                            </div>
                            <div class="mb-3" id="imagePreview" style="display: flex; flex-wrap: wrap; gap: 10px;"></div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Judul</label>
                                <input type="text" class="form-control" id="title" name="title" placeholder="Masukkan judul proyek" required>
                            </div>
                            <div class="mb-3">
                                <label for="owner" class="form-label">Owner</label>
                                <input type="text" class="form-control" id="owner" name="owner" placeholder="Nama pemilik proyek" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Deskripsi</label>
                                <textarea class="form-control" id="description" name="description" rows="3" placeholder="Deskripsi proyek" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="design_note" class="form-label">Catatan Desain</label>
                                <textarea class="form-control" id="design_note" name="design_note" rows="3" placeholder="Catatan tambahan tentang desain"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="youtube" class="form-label">URL Video YouTube</label>
                                <input type="url" class="form-control" id="youtube" name="youtube" placeholder="https://www.youtube.com/watch?v=example">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                        </form>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a href="index.php" class="btn btn-secondary">Kembali ke Halaman Utama</a>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
</body>
<script>
document.getElementById('image').addEventListener('change', function(event) {
    const previewContainer = document.getElementById('imagePreview');
    previewContainer.innerHTML = ''; // Bersihkan preview sebelumnya

    const files = event.target.files;

    Array.from(files).forEach(file => {
        if (!file.type.startsWith('image/')) return;

        const reader = new FileReader();
        reader.onload = function(e) {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.width = '100px';
            img.style.height = '100px';
            img.style.objectFit = 'cover';
            img.style.border = '1px solid #ddd';
            img.style.borderRadius = '8px';
            previewContainer.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});
</script>

<!-- Vendor JS Files -->
<script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="assets/vendor/aos/aos.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>
</html>