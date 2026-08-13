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
            <a class="nav-link scrollto active" href="index.php">Home</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="team.php">Our Team</a>
          </li>
          <li>
            <a class="nav-link scrollto" href="portfolio.php">Projects</a>
          </li>
        </ul>
      </nav>
      <!-- .navbar -->
    </div>
  </header>
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero">
    <div class="video-container">
      <div class="video-overlay"></div>
      <iframe
        class="responsive-iframe"
        src="https://www.youtube.com/embed/gOgPsIN9vs4?playlist=gOgPsIN9vs4&amp;autoplay=1&amp;loop=1&amp;controls=0&amp;mute=1"
        title="YouTube video player"
        frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin"
        allowfullscreen></iframe>
    </div>
  </section>
  <!-- End Hero -->

  <main id="main">
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio">
      <div class="container">
        <div class="section-title m-4" data-aos="fade-up" data-aos-delay="100">
          <h2>New Projects</h2>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <?php
          // Lokasi file JSON
          $projectDataFile = 'projectData.json';

          // Periksa apakah file JSON tersedia
          if (file_exists($projectDataFile)) {
            $projectData = json_decode(file_get_contents($projectDataFile), true) ?? [];
            if ($projectData === null) {
              die('Error: Tidak dapat membaca atau mem-parsing projectData.json');
            }
          } else {
            die('Error: File projectData.json tidak ditemukan');
          }

          // Lokasi direktori gambar
          $directory = 'assets/img/portfolio/';

          // Ambil semua file dalam direktori, kecuali "." dan ".."
          $files = array_diff(scandir($directory), array('.', '..'));

          // Ambil waktu modifikasi setiap file dan simpan dalam array asosiatif
          $fileModTimes = [];
          foreach ($files as $file) {
            if (is_file($directory . $file)) {
              $fileModTimes[$file] = filemtime($directory . $file);
            }
          }

          // Urutkan array berdasarkan tanggal modifikasi (DESCENDING untuk terbaru ke terlama)
          arsort($fileModTimes);

          // Filter hanya file gambar dan ambil 4 file terbaru
          $imageFiles = [];
          foreach ($fileModTimes as $file => $modTime) {
            if (preg_match('/\.(jpg|jpeg|png|gif)$/i', $file)) {
              $imageFiles[$file] = $modTime;
              if (count($imageFiles) >= 4) {
                break;
              }
            }
          }

          // Tampilkan gambar dengan deskripsi jika data ditemukan
          if (!empty($imageFiles)) {
            foreach ($imageFiles as $file => $modTime) {
              $imagePath = $directory . $file;
              $formattedDate = date("Y-m-d H:i:s", $modTime);

              echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4">';
              echo '    <a href="' . htmlspecialchars($imagePath) . '" data-gallery="portfolioGallery" class="portfolio-lightbox" title="';

              // Cek apakah ada data proyek terkait
              if (isset($projectData[$file])) {
                $project = $projectData[$file];

                // Buat deskripsi proyek
                $title = '
            <h5>' . htmlspecialchars($project['title']) . '</h5>
            <p>Owner: ' . htmlspecialchars($project['owner']) . '</p>
            <p>Date Project: ' . htmlspecialchars($project['date']) . '</p>
            <p>Date File: ' . $formattedDate . '</p>
            <p>' . htmlspecialchars($project['description']) . '</p>
            <p>Notes: ' . htmlspecialchars($project['design_note']) . '</p>
            <div class="embed-responsive embed-responsive-16by9">
                <iframe class="embed-responsive-item" src="' . htmlspecialchars($project['youtube']) . '?autoplay=0&loop=1&controls=1" allowfullscreen></iframe>
            </div>';
                echo htmlspecialchars($title) . '">';
              } else {
                // Jika data proyek tidak ditemukan, tampilkan gambar tanpa detail tambahan
                echo 'Project - ' . $formattedDate . '">';
              }

              // Tampilkan gambar
              echo '        <img src="' . htmlspecialchars($imagePath) . '" class="img-fluid" alt="';
              echo isset($project['title']) ? htmlspecialchars($project['title']) : 'Project Image';
              echo '">';
              echo '    </a>';
              echo '</div>';
            }
          } else {
            echo '<p class="text-center">Tidak ada gambar yang ditemukan.</p>';
          }
          ?>

          <div class="mt-2"></div>
        </div>
      </div>
    </section>

    <!-- ======= Brand Section ======= -->
    <div id="brand" style="background-color: white">
      <div
        class="text-center"
        data-aos="fade-in"
        data-aos-delay="100"
        style="background-color: white">
        <h2>Our Brand Partners</h2>
      </div>

      <div class="mx-auto pembatas"></div>

      <br />

      <div class="contain">
        <div class="logo-row" data-aos="fade-in" data-aos-delay="100">
          <img
            src="assets/img/testimonials/AICA_Logo.png"
            alt="Brand 1"
            class="brand-logo" />
          <img
            src="assets/img/testimonials/h_Hettich-480x250.png"
            alt="Brand 2"
            class="brand-logo" />
          <img
            src="assets/img/testimonials/Logo_PROPAN_baru-removebg-preview.png"
            alt="Brand 3"
            class="brand-logo" />
          <img
            src="assets/img/testimonials/logobottega.png"
            alt="Brand 4"
            class="brand-logo" />
          <img
            src="assets/img/testimonials/png-transparent-julius-blum-hinge-cabinetry-furniture-drawer-cutlery-miscellaneous-kitchen-text-removebg-preview.png"
            alt="Brand 5"
            class="brand-logo" />
          <img
            src="assets/img/testimonials/wisma-sehati-logo.png"
            alt="Brand 6"
            class="brand-logo" />
        </div>
      </div>
    </div>
    <!-- End Brand Section -->

    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container">
        <div class="row no-gutters" data-aos="fade-in">
          <div class="col-md-12 col-sm-12 d-flex align-items-stretch">
            <div class="icon-boxes d-flex flex-column justify-content-center">
              <div class="row">
                <div
                  class="col-md-12 icon-box text-center"
                  data-aos="fade-up"
                  data-aos-delay="100">
                  <p>
                    DICASA started as a interior concept in 2014. Today,
                    DICASA provides one stop solution for home owners who seek
                    to have finer interior solutions for their homes. As part
                    of Design Group, our designers are trained to help the
                    customers realize their vision of dream home with ease by
                    providing a comprehensive experience from interior design
                    and construction, kitchen and wardrobe customization, fine
                    furnishing solutions & home décor.
                  </p>
                  <h2>OUR MISSION</h2>
                  <p>
                    Create value for our customers by offering relent- less
                    exceptional quality furnishings & services.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- End About Section -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">
    <video
      class="fullscreen"
      autoplay
      loop
      muted
      id="fullscreen-video"
      style="width: 100%; height: 50vh; object-fit: cover">
      <source src="assets/video/Footer.mp4" type="video/mp4" />
    </video>

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