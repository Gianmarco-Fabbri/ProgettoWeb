<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="../css/style.css"/>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title><?php echo isset($templateParams["titolo"]) ? $templateParams["titolo"] : "Benessere Market"; ?></title>
</head>

<body>
    <header>
        <a href="index.php">
            <img src="../img/logo.png" alt="Logo benessere market"/> 
        </a>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="archivio.php">Archivio</a></li>
                <li><a href="contatti.php">Contatti</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <nav>
        <ul>
            <li><a href="salute.php">Salute</a></li>
            <li><a href="bellezza.php">Bellezza</a></li>
            <li><a href="profumi.php">Profumi</a></li>
            <li><a href="casa_green.php">Casa & Green</a></li>
        </ul>
    </nav>

    <main>
        <?php
        if(isset($templateParams["nome"])){
            require($templateParams["nome"]);
        }
        ?>
    </main>

    <footer>
        <section>
            <h1>Benessere Market</h1>
            <ul>
                <li><a href="chi_siamo.php">Chi siamo</a></li>
                <li><a href="contatti.php">Contatti</a></li>
                <li><a href="brand.php">Brand</a></li>
            </ul>
        </section>

        <section>
            <h1>Area Cliente</h1>
            <ul>
                <li><a href="accedi.php">Accedi</a></li>
                <li><a href="carrello.php">Il mio carrello</a></li>
                <li><a href="ordini.php">I miei ordini</a></li>
            </ul>
        </section>

        <section>
            <h1>Informazioni</h1>
            <ul>
                <li><a href="come_acquistare.php">Come acquistare</a></li>
                <li><a href="privacy_policy.php">Privacy Policy</a></li>
                <li><a href="cookie_policy.php">Cookie Policy</a></li>
            </ul>
        </section>
    </footer>
</body>
</html>
