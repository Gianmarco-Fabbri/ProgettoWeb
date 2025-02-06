<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta charset="UTF-8"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous"/>
    <title><?php echo isset($templateParams["titolo"]) ? $templateParams["titolo"] : "Benessere Market"; ?></title>
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- Header -->
    <header class="bg-light py-3 px-4 d-flex justify-content-between align-items-center">
        <a href="venditore.php">
            <img src="img/logo.png" alt="Logo benessere market" width="80" height="80"/> 
        </a>
        <nav>
            <ul class="nav">
                <li class="nav-item">
                    <a href="notifiche.php" class="nav-link text-success fw-bold">
                        <img src="img/ring.png" alt="Icona Ring" width="25"/> Notifiche
                    </a>
                </li>
                <li class="nav-item">
                    <a href="profilo.php" class="nav-link text-success fw-bold">
                        <img src="img/icon.png" alt="Icona Profilo" width="25"/> Profilo
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Main -->
    <main>
        <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }
        ?>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h3 class="text-success">Benessere Market</h3>
                    <ul class="list-unstyled">
                        <li><a href="chi_siamo_venditore.php" class="text-success text-decoration-none">Chi siamo</a></li>
                        <li><a href="contatti_venditore.php" class="text-success text-decoration-none">Contatti</a></li>
                        <li><a href="brand_venditore.php" class="text-success text-decoration-none">Brand</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="text-success">Area Venditore</h3>
                    <ul class="list-unstyled">
                        <li><a href="gestione_prodotti.php" class="text-success text-decoration-none">Gestione Prodotti</a></li>
                        <li><a href="venditoreOrdini.php" class="text-success text-decoration-none">Gestione Ordini</a></li>
                        <li><a href="venditoreRecensioni.php" class="text-success text-decoration-none">Recensioni</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h3 class="text-success">Informazioni</h3>
                    <ul class="list-unstyled">
                        <li><a href="come_vendere.php" class="text-success text-decoration-none">Come vendere</a></li>
                        <li><a href="privacy_policy_venditore.php" class="text-success text-decoration-none">Privacy Policy</a></li>
                        <li><a href="cookie_policy_venditore.php" class="text-success text-decoration-none">Cookie Policy</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <?php
    if (isset($templateParams["js"])) {
        foreach ($templateParams["js"] as $jsFile) {
            echo '<script src="' . $jsFile . '"></script>';
        }
    }
    ?> 
</body>
</html>
