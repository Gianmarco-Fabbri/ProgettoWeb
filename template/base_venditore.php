<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Area Venditore</title>
</head>

<body class="d-flex flex-column min-vh-100">
    <header class="bg-light py-3 px-4 d-flex justify-content-between align-items-center">
        <a href="#">
            <img src="../img/logo.png" alt="Logo benessere market" width="80" height="80"/> 
        </a>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a href="notifiche.php" class="nav-link text-success fw-bold">
                        <img src="../img/ring.png" alt="Icona Ring" width="25"/> Notifiche
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profilo.php" class="nav-link text-success fw-bold">
                        <img src="../img/icon.png" alt="Icona Profilo" width="25"/> Profilo
                    </a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="container my-5 flex-grow-1">
        <div class="row g-4 d-flex justify-content-center">
            <div class="col-md-6 col-lg-6">
                <div class="p-5 border border-success bg-light rounded text-center shadow-lg">
                    <h2 class="text-success">Gestione Prodotti</h2>
                    <p>Gestisci il catalogo, aggiungi o modifica prodotti.</p>
                    <a href="gestione_prodotti.php" class="btn btn-success">Vai</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="p-5 border border-success bg-light rounded text-center shadow-lg">
                    <h2 class="text-success">Prodotti in Offerta</h2>
                    <p>Metti in offerta i tuoi prodotti per i clienti.</p>
                    <a href="offerte.php" class="btn btn-success">Vai</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="p-5 border border-success bg-light rounded text-center shadow-lg">
                    <h2 class="text-success">Gestione Ordini</h2>
                    <p>Controlla gli ordini ricevuti e il loro stato.</p>
                    <a href="ordini_venditore.php" class="btn btn-success">Vai</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-6">
                <div class="p-5 border border-success bg-light rounded text-center shadow-lg">
                    <h2 class="text-success">Recensioni</h2>
                    <p>Visualizza i feedback dei clienti sui tuoi prodotti.</p>
                    <a href="recensioni.php" class="btn btn-success">Vai</a>
                </div>
            </div>
        </div>
    </main>
    <footer class="bg-light text-center py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="text-success">Benessere Market</h5>
                    <ul class="list-unstyled">
                        <li><a href="chi_siamo.php" class="text-success text-decoration-none">Chi siamo</a></li>
                        <li><a href="contatti.php" class="text-success text-decoration-none">Contatti</a></li>
                        <li><a href="brand.php" class="text-success text-decoration-none">Brand</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-success">Area Venditore</h5>
                    <ul class="list-unstyled">
                        <li><a href="gestione_prodotti.php" class="text-success text-decoration-none">Gestione Prodotti</a></li>
                        <li><a href="ordini_venditore.php" class="text-success text-decoration-none">Gestione Ordini</a></li>
                        <li><a href="recensioni.php" class="text-success text-decoration-none">Recensioni</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="text-success">Informazioni</h5>
                    <ul class="list-unstyled">
                        <li><a href="come_vendere.php" class="text-success text-decoration-none">Come vendere</a></li>
                        <li><a href="privacy_policy.php" class="text-success text-decoration-none">Privacy Policy</a></li>
                        <li><a href="cookie_policy.php" class="text-success text-decoration-none">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
