<?php
//menyertakan code dari file koneksi
include "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hafiz Daily's Journal</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        /* THEME MODE */
        body.dark-mode {
            background-color: #121212;
            color: white;
        }

        .dark-mode .navbar,
        .dark-mode footer {
            background-color: #1f1f1f !important;
        }

        .dark-mode .card {
            background-color: #2a2a2a;
            color: white;
        }

        /* CUSTOM STYLE */
        .theme-btn {
            border: none;
            padding: 8px 12px;
            border-radius: 8px;
            margin-left: 6px;
            cursor: pointer;
        }

        .btn-dark-mode {
            background-color: #212529;
            color: white;
        }

        .btn-light-mode {
            background-color: #dc3545;
            color: white;
        }

        .profile-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #dc3545;
        }

        /* SCROLL BUTTONS */
        .scroll-btn {
            position: fixed;
            right: 20px;
            width: 45px;
            height: 45px;
            background: rgba(0, 123, 255, 0.4);
            backdrop-filter: blur(4px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            cursor: pointer;
            z-index: 9999;
            transition: 0.25s;
        }

        .scroll-btn:hover {
            transform: scale(1.1);
            background: rgba(0, 123, 255, 0.6);
        }

        #scrollDown {
            bottom: 20px;
        }

        #scrollUp {
            bottom: 75px;
            display: none;
        }
    </style>
</head>

<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top shadow-sm">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Hafiz Daily's Journal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item"><a class="nav-link" href="#HOME">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#ARTICLE">Article</a></li>
                    <li class="nav-item"><a class="nav-link" href="#GALLERY">Gallery</a></li>
                    <li class="nav-item"><a class="nav-link" href="#SCHEDULE">Schedule</a></li>
                    <li class="nav-item"><a class="nav-link" href="#PROFILE">Profile</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Login</a>
                </ul>

                <!-- THEME SWITCHER -->
                <div class="d-flex ms-3">
                    <button id="darkBtn" class="theme-btn btn-dark-mode">
                        <i class="bi bi-moon-fill"></i>
                    </button>
                    <button id="lightBtn" class="theme-btn btn-light-mode">
                        <i class="bi bi-brightness-high-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- HERO -->
    <section id="HOME" class="text-center p-5 bg-info-subtle text-sm-start">
        <div class="container">
            <div class="d-sm-flex flex-sm-row-reverse align-items-center">
                <img src="https://i.ibb.co.com/hFz09zRk/IMG-2179.jpg" class="img-fluid" width="300">
                <div>
                    <h1 class="fw-bold display-5">Create Memories, Save Memories, Everyday</h1>
                    <h4 class="lead">Mencatat semua kegiatan sehari-hari yang ada tanpa terkecuali</h4>
                </div>
            </div>
        </div>
    </section>

    <!-- ARTICLE -->
    <section id="ARTICLE" class="text-center p-5">
        <div class="container">
            <h1 class="fw-bold display-4 pb-3">Article</h1>
            <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                				<?php
        $sql = "SELECT * FROM article ORDER BY tanggal DESC";
        $hasil = $conn->query($sql); 

        while($row = $hasil->fetch_assoc()){
 
        ?>

                <!-- Card 1 -->
                <div class="col">
                    <div class="card h-100">
                    <img src="img/<?=$row["gambar"]?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?= $row["judul"]?></h5>
                            <p class="card-text">
                                <?= $row["isi"]?>
        </p>
                        </div>
                        <div class="card-footer">
                            <small class="text-body-secondary">
                                <?= $row["tanggal"]?>
                            </small>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>

    </section>

    <!-- GALLERY -->
    <section id="GALLERY" class="text-center p-5 bg-info-subtle">
        <div class="container">
            <h1 class="fw-bold display-6 pb-3">Gallery</h1>
            <div id="carouselExample" class="carousel slide">
                <div class="carousel-inner">
                    <div class="carousel-item active"><img src="https://i.ibb.co.com/B5QJxpDg/IMG-0781.png"
                            class="d-block w-100" alt="..."></div>
                    <div class="carousel-item"><img
                            src="https://i.ibb.co.com/ym2FPzyf/22398091-83d7-4021-95ea-233977653baa.jpg"
                            class="d-block w-100" alt="..."></div>
                    <div class="carousel-item"><img
                            src="https://i.ibb.co.com/Df8wBYpT/8ac0e5ca-5541-49db-9fa0-e089b07b5831.jpg"
                            class="d-block w-100" alt="..."></div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>
    </section>
    <!-- SCHEDULE -->
<section id="SCHEDULE" class="text-center p-5">
    <div class="container">
        <h1 class="fw-bold display-6 pb-4">Schedule</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-danger">
                    <tr>
                        <th>No</th>
                        <th>Hari</th>
                        <th>Kegiatan</th>
                        <th>Waktu</th>
                        <th>Tempat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Senin</td>
                        <td>Kuliah Pemrograman Web</td>
                        <td>08:00 - 10:00</td>
                        <td>Lab Komputer</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Selasa</td>
                        <td>Belajar Mandiri</td>
                        <td>19:00 - 21:00</td>
                        <td>Rumah</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Jumat</td>
                        <td>Olahraga</td>
                        <td>16:00 - 17:30</td>
                        <td>Lapangan</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>


    <!-- FOOTER -->
    <footer class="text-center p-4 bg-body-tertiary">
        <div class="container">
            <h5 class="fw-bold mb-3"></h5>
            <div class="d-flex justify-content-center gap-4">
                <a href="https://instagram.com" target="_blank" class="text-dark fs-3"><i
                        class="bi bi-instagram"></i></a>
                <a href="https://twitter.com" target="_blank" class="text-dark fs-3"><i class="bi bi-twitter"></i></a>
                <a href="https://wa.me/6281234567890" target="_blank" class="text-dark fs-3"><i
                        class="bi bi-whatsapp"></i></a>
            </div>
            <p class="mt-3 text-secondary">&copy; 2025 Hafiz Daily's Journal. All rights reserved.</p>
        </div>
    </footer>

    <!-- SCROLL BUTTON HTML -->
    <div id="scrollUp" class="scroll-btn">↑</div>
    <div id="scrollDown" class="scroll-btn">↓</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- THEME SWITCHER -->
    <script>
        const darkBtn = document.getElementById('darkBtn');
        const lightBtn = document.getElementById('lightBtn');
        const body = document.body;

        darkBtn.addEventListener('click', () => {
            body.classList.add('dark-mode');
        });
        lightBtn.addEventListener('click', () => {
            body.classList.remove('dark-mode');
        });
    </script>

    <!-- SCROLL SCRIPT -->
    <script>
        const sections = document.querySelectorAll("section");
        let currentIndex = 0;

        // Scroll ke bawah
        document.getElementById("scrollDown").onclick = function () {
            currentIndex++;
            if (currentIndex >= sections.length) currentIndex = sections.length - 1;
            sections[currentIndex].scrollIntoView({ behavior: "smooth" });
        };

        // Scroll ke atas
        document.getElementById("scrollUp").onclick = function () {
            currentIndex = 0;
            sections[0].scrollIntoView({ behavior: "smooth" });
        };

        // Tampilkan tombol UP setelah scroll
        window.addEventListener("scroll", () => {
            const scrollUpBtn = document.getElementById("scrollUp");
            scrollUpBtn.style.display = window.scrollY > 300 ? "flex" : "none";
        });
    </script>

</body>

</html>