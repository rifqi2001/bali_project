<section class="page-section bg-light" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase">Informasi Tiket</h2>
            <h3 class="section-subheading text-muted">Temukan berbagai pilihan tiket dan layanan terbaik kami.</h3>
        </div>
        <div class="row text-center">
            @foreach($ticketPrices as $ticket)
                <div class="col-md-6">
                    <div class="custom-card">
                        <div class="custom-card-header bg-primary text-white">
                            <h4 class="my-0">Tiket Anak-Anak</h4>
                        </div>
                        <div class="custom-card-body">
                            <h5 class="custom-card-title">Hari Biasa (Senin-Jumat)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->child_price_weekday, 0, ',', '.') }}</p>
                            <h5 class="custom-card-title">Weekend (Sabtu-Minggu)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->child_price_weekend, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-card">
                        <div class="custom-card-header bg-primary text-white">
                            <h4 class="my-0">Tiket Dewasa</h4>
                        </div>
                        <div class="custom-card-body">
                            <h5 class="custom-card-title">Hari Biasa (Senin-Jumat)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->adult_price_weekday, 0, ',', '.') }}</p>
                            <h5 class="custom-card-title">Weekend (Sabtu-Minggu)</h5>
                            <p class="custom-card-text">Rp. {{ number_format($ticket->adult_price_weekend, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
