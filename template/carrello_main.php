<?php
session_start();
require_once 'bootstrap.php'; // Carica il database

$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>

<div class="container py-4">
    <h1 class="mb-4">Il tuo carrello</h1>
    <section class="row">
        <div class="col-lg-8 mb-4">
            <div class="row g-3">
                <?php if (empty($cart)): ?>
                    <p>Il tuo carrello è vuoto.</p>
                <?php else: ?>
                    <?php foreach ($cart as $idProdotto => $quantita): ?>
                        <?php
                        $prodotto = $dbh->getKitByCodice($idProdotto);
                        if (!$prodotto) {
                            continue;
                        }

                        // Debug prezzo
                        $prezzo = isset($prodotto['prezzo']) ? $prodotto['prezzo'] : "N/A";
                        ?>
                        <article class="col-12 p-3 shadow-sm">
                            <div class="row align-items-center g-3">
                                <div class="col-4 col-md-3">
                                    <img src="img/<?php echo htmlspecialchars($prodotto['img']); ?>" class="img-fluid rounded" alt="Prodotto"/>
                                </div>
                                <div class="col-8 col-md-6">
                                    <h2 class="h5 mb-1"><?php echo htmlspecialchars($prodotto['nome']); ?></h2>
                                    <p class="text-muted small mb-0">Prezzo: €<?php echo $prezzo; ?></p>
                                </div>
                                <div class="col-12 col-md-3">
                                    <div class="d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center gap-2">
                                            <label for="quantity<?php echo $idProdotto; ?>" class="form-label mb-0">Quantità:</label>
                                            <input type="number" id="quantity<?php echo $idProdotto; ?>" 
                                                   value="<?php echo $quantita; ?>" min="1" 
                                                   class="form-control form-control-sm w-50"
                                                   onchange="aggiornaQuantita('<?php echo $idProdotto; ?>', this.value)">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <aside class="col-lg-4">
            <div class="card p-3 shadow-sm sticky-top">
                <h3 class="h5 mb-3">Riepilogo ordine</h3>
                
                <?php if (!empty($cart)): ?>
                    <dl class="row small mb-3">
                        <?php
                        $subtotale = 0;
                        foreach ($cart as $idProdotto => $quantita) {
                            $prezzoKit = $dbh->getKitPrezzo($idProdotto);

                            if ($prezzoKit !== null) {
                                $subtotale += $prezzoKit * $quantita;
                            }
                        }
                        $sconto = 1.52;
                        $totale = $subtotale - $sconto;
                        ?>
                        <dt class="col-6">Subtotale:</dt>
                        <dd class="col-6 text-end">€<?php echo number_format($subtotale, 2); ?></dd>
                        <dt class="col-6 text-success">Sconto punti:</dt>
                        <dd class="col-6 text-end text-success">-€<?php echo number_format($sconto, 2); ?></dd>
                    </dl>
                    <h4 class="h5 text-primary mb-3">Totale: €<?php echo number_format($totale, 2); ?></h4>
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-secondary btn-sm" onclick="window.location.href='index.php'">
                            Continua acquisti
                        </button>
                        <button id="svuotaCarrelloBtn" class="btn btn-outline-danger btn-sm">
                            Svuota carrello
                        </button>
                        <button class="btn btn-success btn-sm" onclick="window.location.href='pagamento.php'">
                            Procedi al pagamento
                        </button>
                    </div>
                <?php else: ?>
                    <p class="text-muted">Non ci sono prodotti nel carrello.</p>
                <?php endif; ?>
            </div>
        </aside>
    </section>
</div>
