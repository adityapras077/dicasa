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
  /* Make page a column flex layout so footer sticks to bottom when content is short */
  html, body {
    height: 100%;
    margin: 0;
    padding: 0;
  }

  body {
    display: flex;
    flex-direction: column;
    min-height: 100vh;
  }

  /* Let main grow to fill available space */
  main {
    flex: 1 0 auto;
  }

  /* Header and footer should not stretch */
  #header {
    flex: 0 0 auto;
  }

  #footer {
    flex-shrink: 0;
  }

  /* Keep responsive behaviour already present */
  @media (max-width: 640px) {
    #main-navbar {
      margin-bottom: 0rem;
    }

    .navbar {
      margin-bottom: 0rem;
    }

    #team {
      margin-top: -5.5rem;
    }
  }

  /* Section title styling */
  .section-title h2 {
    color: #1d1250;
    padding: 45px 0;
  }

  @media (max-width: 640px) {
    .section-title h2 {
      padding: 15px 0;
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
            <a class="nav-link scrollto active" href="team.php">Our Team</a>
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

  <main id="main">
    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
      <div class="container">
        <div class="section-title" data-aos="fade-up" data-aos-delay="100">
          <h2>Design Team</h2>
        </div>

        <div class="row">
          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="member" data-aos="fade-up">
              <div class="pic">
                <img
                  src="assets/img/team/Direktur.jpg"
                  class="img-fluid"
                  alt="" />
              </div>
              <div class="member-info">
                <h4>Mr. F</h4>
                <span>Direktur Utama</span>
                <!-- <div class="social">
                    <a href=""><i class="bi bi-twitter"></i></a>
                    <a href=""><i class="bi bi-facebook"></i></a>
                    <a href=""><i class="bi bi-instagram"></i></a>
                    <a href=""><i class="bi bi-linkedin"></i></a>
                  </div> -->
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="member" data-aos="fade-up" data-aos-delay="150">
              <div class="pic">
                <img
                  src="assets/img/team/Manager.jpg"
                  class="img-fluid"
                  alt="" />
              </div>
              <div class="member-info">
                <h4>Mr. F</h4>
                <span>Direktur</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="member" data-aos="fade-up" data-aos-delay="150">
              <div class="pic">
                <img
                  src="assets/img/team/Specialis.jpg"
                  class="img-fluid"
                  alt="" />
              </div>
              <div class="member-info">
                <h4>Miss. A</h4>
                <span>Assisten Direktur</span>
              </div>
            </div>
          </div>

          <div class="col-lg-3 col-md-3 col-sm-6 col-6">
            <div class="member" data-aos="fade-up" data-aos-delay="300">
              <div class="pic">
                <img
                  src="assets/img/team/Specialis.jpg"
                  class="img-fluid"
                  alt="" />
              </div>
              <div class="member-info">
                <h4>Miss. A</h4>
                <span>Planner</span>
              </div>
            </div>
          </div>
        </div>
        
        <div
          class="mx-auto pembatas"
          data-aos="fade-up"
          data-aos-delay="300"></div>

        <br />
      </div>
    </section>
    <!-- End Team Section -->
  </main>
  <!-- End #main -->

  <!-- ======= Footer ======= -->
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