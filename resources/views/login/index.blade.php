<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Halaman Login</title>

        <link rel="stylesheet" href="{{ asset('/') }}assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic">
        <link rel="stylesheet" href="{{ asset('/') }}assets/fonts/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/styles.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/swiper-bundle.min.css">
        <link rel="stylesheet" href="{{ asset('/') }}assets/css/login.css">
    </head>
    <body id="page-top" data-bs-spy="scroll" data-bs-target="#mainNav" data-bs-offset="57" style="background: rgb(255,255,255);color: rgb(0,0,0);">
        <nav class="navbar navbar-light navbar-expand-lg fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top" style="color: rgb(0,0,0);">
                    <img src="assets/img/logo.png" width="60"> Perpus
                </a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" href="#about" style="color: rgba(0,0,0,0.7);">About</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio" style="color: rgba(0,0,0,0.7);">Galeri</a></li>
                        <li class="nav-item"><a class="nav-link" data-bs-toggle="modal" href="#login" style="color: rgba(0,0,0,0.7);font-weight: bold;">Login</a></li>

                    </ul>
                </div>
            </div>
        </nav>
        <header class="text-center text-white d-flex masthead" style="background: url(&quot;assets/img/Desain%20tanpa%20judul%20(2).png&quot;) top / cover no-repeat;">
            <div class="container my-auto">
                <div class="row">
                    <div class="col-6 text-start" style="height: 100px;margin: auto;">
                        <h1 class="text-primary" style="font-weight: bold;color: rgb(197,30,30);">Perpustakaan</h1>
                        <h2 class="text-primary mb-5">SMKN 1 CIBINONG</h2>
                        <a class="btn btn-primary btn-xl" role="button" data-bs-toggle="modal" href="#login">pinjam sekarang!</a>

                    </div>
                    <div class="col-6">
                        <div class="swiper books-slider" style="margin: auto;">
                            <div class="swiper-wrapper">
                                <a href="#" class="swiper-slide"><img src="assets/img/books/book-1.png" alt=""></a>
                                <a href="#" class="swiper-slide"><img src="assets/img/books/book-2.png" alt=""></a>
                                <a href="#" class="swiper-slide"><img src="assets/img/books/book-3.png" alt=""></a>
                                <a href="#" class="swiper-slide"><img src="assets/img/books/book-4.png" alt=""></a>
                                <a href="#" class="swiper-slide"><img src="assets/img/books/book-5.png" alt=""></a>
                                <a href="#" class="swiper-slide"><img src="assets/img/books/book-6.png" alt=""></a>
                            </div>
                            <img src="assets/img/books/stand.png"alt="" class="stand">
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <section id="about" class="bg-primary" style="background: rgb(255,255,255);">
            <div class="container">
                <div class="row">
                    <div class="col offset-lg-8 text-center mx-auto">
                        <h3 class="text-white section-heading" style="font-weight: bold;">ABOUT</h3>
                        <hr class="light my-4">
                        <div class="accordion" role="tablist" id="accordion-1">
                            <div class="accordion-item">
                                <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-1" aria-expanded="false" aria-controls="accordion-1 .item-1">Anggota PERPUS</button></h2>
                                <div class="accordion-collapse collapse item-1" role="tabpanel" data-bs-parent="#accordion-1">
                                    <div class="accordion-body">
                                        <p class="mb-4"><br><strong>Anggota Perpustakaan</strong>&nbsp;adalah<br>terdiri dari civitas kelas 10-13 di SMKN 1 CIBINONG. Salah satu<br>keuntungan jika civitas mendaftar sebagai anggota perpustakaan adalah<br>dapat meminjam buku yang tersedia di perpustakaan.<br><br></p>
                                        <p class="text-start mb-1">Beberapa syarat untuk mendaftar menjadi anggota perpustakaan, yaitu:<br></p>
                                        <ol>
                                            <li class="text-start">Merupakan Siswa/i Aktif di kelas 10-13 di SMKN 1 CIBINONG<br></li>
                                            <li class="text-start">Siswa/i harus registrasi terlebih dahulu yang telah disediakan di halaman login lalu, pilih registrasi<br></li>
                                            <li class="text-start">Siswa/i memberikan foto 3x4 ke staff perpus bersamaan dengan pengambilan kartu anggota (non-digital) Atau untuk cek informasi lainnya bisa cek di&nbsp;<a href="https://smkn1cibinong.sch.id/main/#">smkn1cibinong.sch.id</a><br></li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-2" aria-expanded="false" aria-controls="accordion-1 .item-2">Cara kerja PERPUS</button></h2>
                                <div class="accordion-collapse collapse item-2" role="tabpanel" data-bs-parent="#accordion-1">
                                    <div class="accordion-body">
                                        <p class="mb-0"><br><br><strong>Koleksi Buku Perpustakaan</strong>&nbsp;menyediakan lebih dari 1000<br>buku fiksi dan non-fiksi dari berbagai genre sesuai dengan selera<br>civitas. Civitas bisa meminjam buku jika sudah terdaftar pada<br>keanggotaan perpustakaan yaitu dengan sebanyak 3(tiga) buku per masa<br>peminjaman anggota dengan waktu pengembalian paling lama 10(sepuluh)<br>hari per masa peminjaman. Apabila, civitas melewati waktu pengembalian<br>yang telah ditetapkan maka akan dikenekan denda sebesar Rp.2000,- per<br>hari ketelatannya. Civitas wajib membayar denda kepada staff<br>perpustakaan.<br><br><br></p>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header" role="tab"><button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#accordion-1 .item-3" aria-expanded="false" aria-controls="accordion-1 .item-3">Lokasi PERPUS</button></h2>
                                <div class="accordion-collapse collapse item-3" role="tabpanel" data-bs-parent="#accordion-1">
                                    <div class="accordion-body">
                                        <p class="mb-0"><br><strong>Lokasi Perpustakaan</strong>&nbsp;berada di lantai 2(dua) Gedung A<br>SMKN 1 CIBINONG. Civitas dapat melalui beberapa akses jalan menuju<br>perpustakaan SMKN 1 CIBINONG, yaitu 2 akses terdekatnya:<br><br>1. Dari gerbang utama berjalan lurus menuju pintu utama<br>lalu, kalian akan melewati ruang informasi lurus terus sampai didepan<br>berada lapangan, tengok kesebelah kanan kalian akan melihat tangga,<br>naiki tangga dan belok ke kanan, perpusutakaan akan ada disamping<br>kalian.<br><br>2. Dari gerbang utama belok kesebelah kanan melewati koridor<br>uks, lurus terus sampai melihat tangga di sebelah kanan posisi tangga<br>sebelum kolam ikan dan setelah toilet setelah itu naiki tangga belok ke<br>kiri lurus terus sampai ada lab software belok ke kanan, lurus terus<br>maka kalian akan menemukan perpustakaan dengan posisi disebelah kiri.<br><br><br></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="services">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <h2 class="text-primary section-heading" style="font-weight: bold;">Perpus Web</h2>
                        <hr class="my-4">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3 text-center">
                        <div class="mx-auto service-box mt-5"><i class="fa fa-book fa-4x text-primary mb-3 sr-icons" data-aos="zoom-in" data-aos-duration="200" data-aos-once="true"></i>
                            <h3 class="mb-3">Books</h3>
                            <p class="text-muted mb-0">mempunyai berbagai jenis buku</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center">
                        <div class="mx-auto service-box mt-5"><i class="fa fa-paper-plane fa-4x text-primary mb-3 sr-icons" data-aos="zoom-in" data-aos-duration="200" data-aos-delay="200" data-aos-once="true"></i>
                            <h3 class="mb-3">Fast</h3>
                            <p class="text-muted mb-0">tidak antri dan tidak bertele-tele</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center">
                        <div class="mx-auto service-box mt-5"><i class="fa fa-newspaper-o fa-4x text-primary mb-3 sr-icons" data-aos="zoom-in" data-aos-duration="200" data-aos-delay="400" data-aos-once="true"></i>
                            <h3 class="mb-3">Up to Date</h3>
                            <p class="text-muted mb-0">buku yang dibutuhkan tersedia</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 text-center">
                        <div class="mx-auto service-box mt-5"><i class="fa fa-heart fa-4x text-primary mb-3 sr-icons" data-aos="fade" data-aos-duration="200" data-aos-delay="600" data-aos-once="true"></i>
                            <h3 class="mb-3">Insight<br></h3>
                            <p class="text-muted mb-0">menambah wawasan dan pengetahuan</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="portfolio" class="p-0"></section>
        <section class="text-white bg-dark mb-5" style="background: rgb(0,0,0);">
            <div class="container text-center">
                <h2 class="mb-4">Galeri!</h2>
                <div class="row g-0 popup-gallery">
                    <div class="col-sm-6 col-lg-4"><a class="portfolio-box" href="assets/img/fullsize/1.jpg"><img class="img-fluid" src="assets/img/thumbnails/1.jpg">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded"><span>Category</span></div>
                                    <div class="project-name"><span>Project Name</span></div>
                                </div>
                            </div>
                        </a></div>
                    <div class="col-sm-6 col-lg-4"><a class="portfolio-box" href="assets/img/fullsize/2.jpg"><img class="img-fluid" src="assets/img/thumbnails/2.jpg">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded"><span>Category</span></div>
                                    <div class="project-name"><span>Project Name</span></div>
                                </div>
                            </div>
                        </a></div>
                    <div class="col-sm-6 col-lg-4"><a class="portfolio-box" href="assets/img/fullsize/3.jpg"><img class="img-fluid" src="assets/img/thumbnails/3.jpg">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded"><span>Category</span></div>
                                    <div class="project-name"><span>Project Name</span></div>
                                </div>
                            </div>
                        </a></div>
                    <div class="col-sm-6 col-lg-4"><a class="portfolio-box" href="assets/img/fullsize/4.jpg"><img class="img-fluid" src="assets/img/thumbnails/4.jpg">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded"><span>Category</span></div>
                                    <div class="project-name"><span>Project Name</span></div>
                                </div>
                            </div>
                        </a></div>
                    <div class="col-sm-6 col-lg-4"><a class="portfolio-box" href="assets/img/fullsize/5.jpg"><img class="img-fluid" src="assets/img/thumbnails/5.jpg">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded"><span>Category</span></div>
                                    <div class="project-name"><span>Project Name</span></div>
                                </div>
                            </div>
                        </a></div>
                    <div class="col-sm-6 col-lg-4"><a class="portfolio-box" href="assets/img/fullsize/6.jpg"><img class="img-fluid" src="assets/img/thumbnails/6.jpg">
                            <div class="portfolio-box-caption">
                                <div class="portfolio-box-caption-content">
                                    <div class="project-category text-faded"><span>Category</span></div>
                                    <div class="project-name"><span>Project Name</span></div>
                                </div>
                            </div>
                        </a></div>
                </div>
            </div>
        </section>
        <section class="d-lg-flex align-items-lg-center h-50" id="contact">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-center mx-auto m">
                        <hr class="my-4">
                        <p>"Aku rela dipenjara bersama buku, karena dengan buku aku bebas." - Moh. Hatta<br></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <footer class="footer-basic">
                            <div class="social"><a href="#"><i class="icon ion-social-instagram"></i></a><a href="#"><i class="icon ion-social-snapchat"></i></a><a href="#"><i class="icon ion-social-twitter"></i></a><a href="#"><i class="icon ion-social-facebook"></i></a></div>
                            <ul class="list-inline">
                                <li class="list-inline-item"><a href="#">Home</a></li>
                                <li class="list-inline-item"><a href="#">About</a></li>
                                <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
                            </ul>
                            <p class="copyright">Inapthree © 2022</p>
                        </footer>
                    </div>
                </div>
            </div>
        </section>
        <script src="{{ asset('/') }}assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ asset('/') }}https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
        <script src="{{ asset('/') }}https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.js"></script>
        <script src="{{ asset('/') }}assets/js/script.min.js"></script>
        <script src="{{ asset('/') }}assets/js/swiper-bundle.min.js"></script>
        <script src="{{ asset('/') }}assets/js/login.js"></script>


        <!-- MODAL LOGIN -->
        <div class="modal fade" id="login" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="border-bottom: none;">
                        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body row">
                        <div class="col-6">
                            <img src="{{ asset('/') }}assets/img/login.png" width="100%">
                        </div>
                        <div class="col-6">
                           <form action="/login" method="post">
                                @csrf
                                <div class="input-group mb-3">
                                    <input autofocus type="text" class="form-control
                                    @error('username')
                                    is-invalid
                                    @enderror
                                    " placeholder="username" name="username" value="{{ old('username') }}">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="fa-light fa-user"></i>
                                        </div>
                                    </div>
                                    @error('username')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="input-group mb-3">
                                    <input type="password" class="form-control
                                    @error('password')
                                    is-invalid
                                    @enderror
                                    " placeholder="Password" name="password">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: right;">
                                    <button type="submit" class="btn btn-primary">LOGIN</button>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer"  style="border: none;font-size: 12px;">
                            <div>
                                <p>No Have Account? <a href="/register">Register</a>  for member</p>
                                <p>want to register as a staff? <a href="">Register</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- END MODAL LOGIN -->
    </body>
</html>

