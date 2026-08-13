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
  <link
    href="assets/vendor/bootstrap/css/bootstrap.min.css"
    rel="stylesheet" />
  <link
    href="assets/vendor/bootstrap-icons/bootstrap-icons.css"
    rel="stylesheet" />
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet" />
  <link
    href="assets/vendor/glightbox/css/glightbox.min.css"
    rel="stylesheet" />
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet" />
</head>

<style>
  @media (max-width: 640px) {
    .navbar {
      margin-bottom: 0rem;
    }

    #main-navbar {
      margin-bottom: 0rem;
    }
  }
</style>

<body>
  <!-- ======= Header ======= -->
  <header id="header">
    <div id="main-navbar" class="navbar">
      <div
        class="container d-flex align-items-center justify-content-between position-relative">
        <img
          src="assets/img/Loho.png"
          alt=""
          class="mx-auto"
          style="max-width: 16rem; padding: 12px; margin: 0" />
      </div>
    </div>

    <div
      class="d-flex align-items-center justify-content-between position-relative">
      <nav
        id="navbar"
        class="navbar mx-auto justify-content-center col-12"
        style="z-index: 998; background-color: grey">
        <ul>
          <li>
            <a class="nav-link scrollto" href="index.php">Home</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="team.php">Our Team</a>
          </li>
          <li>
            <a class="nav-link scrollto active" href="portfolio.php">Projects</a>
          </li>
        </ul>
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  <!-- End Header -->

  <main id="main">
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title" data-aos="fade-in" data-aos-delay="100">
          <h2>Projects</h2>
          <style>
            .section-title h2 {
              color: #1d1250;
              padding: 25px 0;
            }

            @media (max-width: 640px) {
              .section-title h2 {
                padding: 0 -25px;
              }
            }
          </style>
        </div>

        <div class="row portfolio-container" data-aos="fade-up">
          <?php
          // File JSON yang berisi data proyek
          $projectDataFile = 'projectData.json';

          // Ambil data proyek dari file JSON
          $projectData = json_decode(file_get_contents($projectDataFile), true) ?? [];

          // Lokasi direktori gambar
          $directory = 'assets/img/portfolio/';

          // Periksa apakah direktori valid
          if (!is_dir($directory)) {
            die("Direktori $directory tidak ditemukan.");
          }

          // Ambil semua file dalam direktori
          $files = array_diff(scandir($directory), array('.', '..'));

          // Ambil waktu modifikasi setiap file dan simpan dalam array asosiatif
          $fileModTimes = [];
          foreach ($files as $file) {
            if (is_file($directory . $file)) {
              $fileModTimes[$file] = filemtime($directory . $file);
            }
          }

          // Urutkan file berdasarkan tanggal modifikasi (DESCENDING untuk terbaru ke terlama)
          arsort($fileModTimes);

          // Filter file hanya yang berupa gambar
          $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
          $imageFiles = [];
          foreach ($fileModTimes as $file => $modTime) {
            $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
            if (in_array($extension, $validExtensions)) {
              $imageFiles[$file] = $modTime;
            }
          }

          // Jika tidak ada gambar ditemukan
          if (empty($imageFiles)) {
            echo "<p class='text-center'>Tidak ada gambar yang ditemukan di direktori.</p>";
          } else {
            // Tampilkan gambar beserta deskripsi dari projectData.json
            foreach ($imageFiles as $file => $modTime) {
              $imagePath = $directory . $file; // Path penuh gambar
              $formattedDate = date("Y-m-d H:i:s", $modTime);

              echo '<div class="col-lg-3 col-md-3 col-sm-6 col-6 portfolio-item filter-exterior">';
              echo '    <a href="' . htmlspecialchars($imagePath) . '" data-gallery="portfolioGallery" class="portfolio-lightbox" title="';

              // Cek apakah file ini ada dalam projectData
              if (isset($projectData[$file])) {
                $project = $projectData[$file];

                // Title untuk lightbox berisi detail deskripsi proyek
                $title = '
            <h5>' . htmlspecialchars($project['title']) . '</h5>
            <p>Owner: ' . htmlspecialchars($project['owner']) . '</p>
            <p>Date: ' . $formattedDate . '</p>
            <p>' . htmlspecialchars($project['description']) . '</p>
            <p>Notes: ' . htmlspecialchars($project['design_note']) . '</p>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="' . htmlspecialchars($project['youtube']) . '?autoplay=0&loop=1&controls=1" allowfullscreen></iframe>
            </div>';

                echo htmlspecialchars($title) . '">';
              } else {
                // Jika data proyek tidak ditemukan, tampilkan hanya gambar dengan tanggal modifikasi
                echo 'Project - ' . $formattedDate . '">';
              }

              // Gambar
              echo '        <img src="' . htmlspecialchars($imagePath) . '" class="img-fluid" alt="Project Image">';
              echo '    </a>';
              echo '</div>';
            }
          }
          ?>

        </div>
      </div>
    </section>
    <!-- End Portfolio Section -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="col-12 text-center text-white">
      <div class="footer-logo">
        <img
          src="assets/img/Loho.png"
          alt="Logo"
          class="img-fluid m-4"
          style="max-width: 10rem; padding: 0" />
      </div>
      <div class="container">
        <div class="row footer-description">
          <p>
            Office <br />
            Cendana Icon Plaza no 120 Lippo Karawaci Tangerang
            <br /><br />Manufacture <br />
            Jl. Manunggal V, Parigi Baru, Kec. Pd. Aren, Kota Tangerang
            Selatan, Banten
          </p>
        </div>
        <div class="copyright">
          &copy; Copyright <strong><span>Dicasa Interior</span></strong>. All Rights Reserved
        </div>
        <div class="credits">Designed by <a href="#">Dicasa Interior</a></div>
        <div class="mb-3"></div>
      </div>
    </div>
  </footer>
  <!-- End Footer -->

  <a
    href="#"
    class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <a
    href="https://wa.me/6281806065408"
    class="contact-button d-flex align-items-center justify-content-center"><i class="bi bi-whatsapp"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>