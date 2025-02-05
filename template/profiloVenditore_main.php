<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div class="row">
        <section class="col-lg-7">
            <h2 class="fw-bold text-success">
                Benvenuto Venditore, 
                <?php echo isset($templateParams["venditore"]) ? htmlspecialchars($templateParams["venditore"]["email"]) : "Utente"; ?>!
            </h2>

            <div class="border rounded p-4">
                <h3>Il tuo profilo</h3>

                <?php if (isset($templateParams["venditore"])): ?>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" value="<?php echo $templateParams["venditore"]["email"]; ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="telefono" class="form-label">Telefono</label>
                        <input type="text" id="telefono" class="form-control" value="<?php echo $templateParams["venditore"]["telefono"]; ?>" readonly>
                    </div>
                <?php else: ?>
                    <p class="text-danger">Errore: dati venditore non disponibili.</p>
                <?php endif; ?>
                <button type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#modificaProfiloModal">Modifica Profilo</button>
            </div>
        </section>
    </div>
</div>
