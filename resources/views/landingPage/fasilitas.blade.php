<section class="page-section" id="fasilitas">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Fasilitas</h2>
            <h3 class="section-subheading text-muted">Fasilitas yang kami tawarkan untuk kenyamanan Anda.</h3>
        </div>
        <!-- Carousel -->
        <div id="facilitiesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <!-- Slide 1 -->
                <div class="carousel-item active">
                    <img src="{{ asset('img/fasilitas/mushola.jpg') }}" class="d-block w-100" alt="Fasilitas 1">
                    <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)); border-radius:10px;">
                        <h5>Mushola</h5>
                        <p>Tempat ibadah yang nyaman</p>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="{{ asset('img/fasilitas/parkirMotor.jpg') }}" class="d-block w-100" alt="Fasilitas 2">
                    <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)); border-radius:10px;">
                        <h5>Parkir Motor</h5>
                        <p>Parkir Kendaraan yang luas</p>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="{{ asset('img/fasilitas/toilet.jpg') }}" class="d-block w-100" alt="Fasilitas 3">
                    <div class="carousel-caption d-none d-md-block" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)); border-radius:10px;">
                        <h5>Toilet</h5>
                        <p>Toilet dan kamar mandi bilas yang bersih</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#facilitiesCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#facilitiesCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>