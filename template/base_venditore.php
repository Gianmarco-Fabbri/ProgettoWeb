<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <link rel="stylesheet" type="text/css" href="css/style-venditore.css"/>
    <title>Area Venditore</title>
</head>

<body>
    <header class="bg-white py-3 text-center">
        <a href="index.php">
            <img src="img/logo.png" alt="Logo benessere market"/> 
        </a>
        <nav class="mt-3">
            <ul class="list-inline">
                <li class="list-inline-item"><a href="notifiche.php" class="text-dark">
                    <img src="img/ring.png" alt="Icona Ring"/> Notifiche</a></li>
                <li class="list-inline-item ms-3"><a href="profilo.php" class="text-dark">
                    <img src="img/icon.png" alt="Icona Profilo"/> Profilo</a></li>
            </ul>
        </nav>
    </header>

    <main class="container my-5">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div>
                    <h2>Gestione Prodotti</h2>
                    <p>Gestisci il catalogo, aggiungi o modifica prodotti.</p>
                    <a href="gestione_prodotti.php">Vai</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div>
                    <h2>Prodotti in Offerta</h2>
                    <p>Metti in offerta i tuoi prodotti per i clienti.</p>
                    <a href="offerte.php">Vai</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div>
                    <h2>Gestione Ordini</h2>
                    <p>Controlla gli ordini ricevuti e il loro stato.</p>
                    <a href="ordini_venditore.php">Vai</a>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div>
                    <h2>Recensioni</h2>
                    <p>Visualizza i feedback dei clienti sui tuoi prodotti.</p>
                    <a href="recensioni.php">Vai</a>
                </div>
            </div>
        </div>
    </main>

    <footer class="bg-light text-center py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Benessere Market</h5>
                    <ul>
                        <li><a href="chi_siamo.php">Chi siamo</a></li>
                        <li><a href="contatti.php">Contatti</a></li>
                        <li><a href="brand.php">Brand</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Area Venditore</h5>
                    <ul>
                        <li><a href="gestione_prodotti.php">Gestione Prodotti</a></li>
                        <li><a href="ordini_venditore.php">Gestione Ordini</a></li>
                        <li><a href="recensioni.php">Recensioni</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Informazioni</h5>
                    <ul>
                        <li><a href="come_vendere.php">Come vendere</a></li>
                        <li><a href="privacy_policy.php">Privacy Policy</a></li>
                        <li><a href="cookie_policy.php">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
