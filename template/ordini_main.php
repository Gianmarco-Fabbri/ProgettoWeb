<div class="container py-5">
    <h1 class="text-success mb-4" style="color: #0a5738!important;">I miei ordini</h1>

    <div class="row g-4">
        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <img src="../img/kit1.png" class="img-fluid rounded" alt="Prodotto ordinato">
                        </div>
                        <div class="col-8">
                            <h2 class="card-title text-success fs-5 fs-md-4" style="color: #0a5738!important;">
                                Ordine #12346
                            </h2>                                
                            <p class="text-muted mb-1">Data: 29/01/2025</p>
                            <ul class="list-unstyled">
                                <li>Prodotto 1 x2</li>
                                <li>Prodotto 2 x1</li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge rounded-pill" style="background-color: #0a5738; color: #f4fbf8;">
                                    Spedito
                                </span>
                                <strong style="color: #0a5738;">Totale: €49,99</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-success shadow-sm" type="button"
                                style="border-color: #0a5738; color: #0a5738;"
                                onmouseover="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8';"
                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#0a5738';"
                                onfocus="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8';"
                                onblur="this.style.backgroundColor='transparent'; this.style.color='#0a5738';"
                                onclick="window.location.href='tracking.php'">
                            Traccia ordine
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 border-success shadow-sm">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-4">
                            <img src="../img/kit2.png" class="img-fluid rounded" alt="Prodotto ordinato">
                        </div>
                        <div class="col-8">
                            <h2 class="card-title text-success fs-5 fs-md-4" style="color: #0a5738!important;">
                                Ordine #12345
                            </h2>                                
                            <p class="text-muted mb-1">Data: 28/01/2025</p>
                            <ul class="list-unstyled">
                                <li>Prodotto 3 x1</li>
                                <li>Prodotto 4 x3</li>
                            </ul>
                        </div>
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="badge rounded-pill" style="background-color: #0a5738; color: #f4fbf8;">
                                    Consegnato
                                </span>
                                <strong style="color: #0a5738;">Totale: €89,99</strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-transparent border-success">
                    <div class="d-grid gap-2">
                        <button class="btn btn-success shadow-sm" type="button"
                                style="background-color: #0a5738; border-color: #0a5738; color: #f4fbf8;"
                                onmouseover="this.style.backgroundColor='#f4fbf8'; this.style.color='#0a5738';"
                                onmouseout="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8';"
                                onfocus="this.style.backgroundColor='#f4fbf8'; this.style.color='#0a5738';"
                                onblur="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8';"
                                onclick="window.location.href='index.php'">
                            Acquista di nuovo
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- MAIN DA MOSTRARE QUANDO NON SI HA NESSUN ORDINE EFFETTUATO
        <div class="col-12 text-center py-5 d-none">
            <div class="alert alert-success" style="background-color: #f4fbf8; border-color: #0a5738;">
                <h2 class="alert-heading" style="color: #0a5738;">Nessun ordine effettuato</h2>
                <p style="color: #0a5738;">Inizia a fare acquisti nel nostro negozio!</p>
                <a href="../index.php" class="btn btn-success" style="background-color: #0a5738; border-color: #0a5738;">
                    Vai allo shopping
                </a>
            </div>
        </div>
        -->
    </div>
</div>