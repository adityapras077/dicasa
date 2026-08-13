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
        <div class="section-title m-4" data-aos="fade-up" data-aos-delay="100">
            <h2>All Projects</h2>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="100">
            <?php
            // Lokasi file JSON
            $projectDataFile = 'projectDatas.json';

            // Periksa apakah file JSON tersedia
            if (file_exists($projectDataFile)) {
                $projectData = json_decode(file_get_contents($projectDataFile), true) ?? [];
                if ($projectData === null) {
                    die('Error: Tidak dapat membaca atau mem-parsing projectData.json');
                }
            } else {
                die('Error: File projectData.json tidak ditemukan');
            }

            // Urutkan data proyek berdasarkan tanggal secara descending
            usort($projectData, function ($a, $b) {
                return strtotime($b['date']) - strtotime($a['date']);
            });

            // Tampilkan daftar proyek tanpa batasan (semua proyek ditampilkan)
            if (!empty($projectData)) {
                foreach ($projectData as $project) {
                    $imagePath = 'assets/img/portfolio/';
                    $thumbnailImage = isset($project['image'][0]) ? $imagePath . htmlspecialchars($project['image'][0]) : 'assets/img/no-image.jpg'; // Tampilkan gambar pertama sebagai thumbnail, atau gambar pengganti jika tidak ada

                    $formattedDate = date("Y-m-d", strtotime($project['date']));

                    echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-4 project-item" data-project-id="' . htmlspecialchars($project['id']) . '">';
                    echo '   <a href="#" class="portfolio-link" data-bs-toggle="modal" data-bs-target="#projectModal">';
                    echo '       <img src="' . htmlspecialchars($thumbnailImage) . '" class="img-fluid" alt="' . htmlspecialchars($project['title']) . '" loading="lazy">';
                    echo '       <div class="portfolio-info">';
                    echo '           <h4>' . htmlspecialchars($project['title']) . '</h4>';
                    echo '           <p>' . $formattedDate . '</p>';
                    echo '       </div>';
                    echo '   </a>';
                    echo '</div>';
                }
            } else {
                echo '<p class="text-center">Tidak ada proyek yang ditemukan.</p>';
            }
            ?>
        </div>
    </div>
</section>

<div class="modal fade" id="projectModal" tabindex="-1" aria-labelledby="projectModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="projectModalLabel">Project Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body"  data-aos-delay="100">
        <h4 id="modal-title"></h4>
        <p><strong>Owner:</strong> <span id="modal-owner"></span></p>
        <p><strong>Date Project:</strong> <span id="modal-date"></span></p>
        <p id="modal-description"></p>
        <p><strong>Notes:</strong> <span id="modal-notes"></span></p>

        <div id="projectCarousel" class="carousel slide mb-3">
          <div class="carousel-inner" id="carousel-inner"></div>
          <button class="carousel-control-prev" type="button" data-bs-target="#projectCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#projectCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const projectItems = document.querySelectorAll('.project-item');
    const modalTitle = document.getElementById('modal-title');
    const modalOwner = document.getElementById('modal-owner');
    const modalDate = document.getElementById('modal-date');
    const modalDescription = document.getElementById('modal-description');
    const modalNotes = document.getElementById('modal-notes');
    const carouselInner = document.getElementById('carousel-inner');
    const projectCarouselElement = document.getElementById('projectCarousel');
    const projectModal = document.getElementById('projectModal');

    const projectData = <?php echo json_encode($projectData); ?>;

    projectItems.forEach(item => {
        item.addEventListener('click', function () {
        const projectId = this.dataset.projectId;
        const selectedProject = projectData.find(p => p.id === projectId);
        if (!selectedProject) return;

        // Isi data teks
        modalTitle.textContent = selectedProject.title || '';
        modalOwner.textContent = selectedProject.owner || '';
        modalDate.textContent = new Date(selectedProject.date).toLocaleDateString();
        modalDescription.textContent = selectedProject.description || '';
        modalNotes.textContent = selectedProject.design_note || '';

        // Reset carousel
        carouselInner.innerHTML = '';

        let isFirst = true;

        // Tambahkan gambar ke carousel
        (selectedProject.image || []).forEach(img => {
            const item = document.createElement('div');
            item.className = 'carousel-item' + (isFirst ? ' active' : '');
            const imgTag = document.createElement('img');
            imgTag.src = 'assets/img/portfolio/' + img;
            imgTag.className = 'd-block w-100 rounded shadow-sm';
            imgTag.alt = 'Project Image';
            item.appendChild(imgTag);
            carouselInner.appendChild(item);
            isFirst = false;
        });

        // Tambahkan video jika ada
        if (selectedProject.youtube) {
            const item = document.createElement('div');
            item.className = 'carousel-item' + (isFirst ? ' active' : '');
            const ratioDiv = document.createElement('div');
            ratioDiv.className = 'ratio ratio-16x9';
            const iframe = document.createElement('iframe');
            iframe.src = selectedProject.youtube + '?autoplay=0&loop=0&controls=1';
            iframe.allowFullscreen = true;
            iframe.title = 'YouTube video';
            ratioDiv.appendChild(iframe);
            item.appendChild(ratioDiv);
            carouselInner.appendChild(item);
        }

        // Re-init carousel
        const bsInstance = bootstrap.Carousel.getInstance(projectCarouselElement);
        if (bsInstance) bsInstance.dispose();
        new bootstrap.Carousel(projectCarouselElement, { interval: true });
        });
    });

    projectModal.addEventListener('hidden.bs.modal', function () {
        // Optional: Bersihkan iframe agar video berhenti
        carouselInner.querySelectorAll('iframe').forEach(iframe => {
        iframe.src = iframe.src;
        });

        const bsCarousel = bootstrap.Carousel.getInstance(projectCarouselElement);
        if (bsCarousel) bsCarousel.dispose();
    });
    });
</script>

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