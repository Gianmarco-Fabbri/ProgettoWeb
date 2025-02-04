<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS Bundle con Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<div class="container my-5">
    <div class="row">
        <section class="col-lg-7">
            <h2 class="fw-bold" style="color: #0a5738">Benvenuto <?php echo $templateParams["cliente"]["nome"]; ?>!</h2>
            <div class="border rounded p-4">
                <h3>Il tuo profilo</h3>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control nomeUtente" id="nome" value="<?php echo $templateParams['cliente']['nome']; ?>" readonly="">
                </div>
                <div class="mb-3">
                    <label for="cognome" class="form-label">Cognome</label>
                    <input type="text" class="form-control cognomeUtente" id="cognome" value="<?php echo $templateParams["cliente"]["cognome"]; ?>" readonly="">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control emailUtente" id="email" value="<?php echo $templateParams["cliente"]["email"]; ?>" readonly="">
                </div>
                <div class="mb-3">
                    <label for="telefono" class="form-label">Numero di telefono</label>
                    <input type="text" class="form-control telefonoUtente" id="telefono" value="<?php echo $templateParams["cliente"]["telefono"]; ?>" readonly="">
                </div>
                <button type="button" class="btn btn-light border" data-bs-toggle="modal" data-bs-target="#modificaProfiloModal">Modifica Profilo</button>
            </div>
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#modificaPasswordModal" style="background-color: #0a5738;color:#FFFFFF;">Cambia password</button>
                <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#eliminaAccountModal" style="background-color: #B00000;color:#FFFFFF;">Elimina account</button>
                <button type="button" id="logoutBtn" class="btn btn-warning" style="background-color:orange; color:#FFFFFF;">Logout</button>
            </div>
        </section>

        <aside class="col-lg-5">
            <!-- Sezione Punti Accumulati con acquisti -->
            <div class="border rounded p-3 mb-4" style="height: 200px; overflow-y: auto; margin-top:46px;">
                <h3>Punti accumulati</h3>
                <ul style="list-style: none; padding: 0; font-size: 1rem;">
                    <li class="mb-2" style="border-bottom: 1px; padding-bottom: 8px;">Punti totali: <?php echo $templateParams["puntiAccumulati"]; ?></li>
                    <li class="text-center mt-3">
                        <a href="carrello.php" style="display: block; background-color: #0a5738; color: white; padding: 12px; border-radius: 5px; text-align: center; text-decoration: none;">Vai al carrello per utilizzare i punti</a>
                    </li>
                </ul>
            </div>

            <!-- Sezione Recensioni -->
            <div class="border rounded p-3" style="height: 310px; overflow-y: auto;">
                <h3>Recensioni</h3>
                <?php if (!empty($templateParams["recensioni"])): ?>
                    <?php foreach ($templateParams["recensioni"] as $recensione): ?>
                        <div class="card mb-3 shadow-sm">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">⭐ <?php echo $recensione["stelle"]; ?>/5</h5>
                                    <small class="text-muted">📅 <?php echo $recensione["data"]; ?></small>
                                </div>
                                <p class="card-text mt-2">"<?php echo $recensione["testoRecensione"]; ?>"</p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-muted">Nessuna recensione disponibile.</p>
                <?php endif; ?>
            </div>
        </aside>
    </div>
</div>

<!-- Modale: modifica profilo -->
<div class="modal fade" id="modificaProfiloModal" tabindex="-1" aria-labelledby="modificaProfiloModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modificaProfiloModalLabel">Modifica il tuo profilo</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modificaProfiloForm">
                    <div class="mb-3">
                        <label for="editNome" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNome" value="<?php echo $templateParams["cliente"]['nome']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editCognome" class="form-label">Cognome</label>
                        <input type="text" class="form-control" id="editCognome" value="<?php echo $templateParams["cliente"]['cognome']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="editTelefono" class="form-label">Telefono</label>
                        <input type="text" class="form-control" id="editTelefono" value="<?php echo $templateParams["cliente"]['telefono']; ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: grey; color:white">Chiudi</button>
                <button type="button" class="btn btn-primary" id="salvaModificheBtn" style="background-color: #0a5738; color:#FFFFFF">Salva modifiche</button>
            </div>
        </div>
    </div>
</div>

<!-- Cambia Password -->
<div class="modal fade" id="modificaPasswordModal" tabindex="-1" aria-labelledby="modificaPasswordLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modificaPasswordLabel">Cambia la tua password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenitore per il messaggio di errore -->
                <div id="message-container" class="message-container text-center" style="color: #B00000; margin-bottom: 15px;"></div>
                
                <form id="cambiaPasswordForm">
                    <!-- Password Attuale -->
                    <div class="mb-3">
                        <label for="passwordAttuale" class="form-label">Password Attuale</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="passwordAttuale" name="passwordAttuale" required>
                            <button class="btn btn-outline-secondary d-flex align-items-center px-3" type="button" 
                                    onclick="toggleVisibility('passwordAttuale', 'togglePasswordAttuale')">
                                <img src="img/eye_close.png" id="togglePasswordAttuale" alt="Mostra/Nascondi Password" width="20">
                            </button>
                        </div>
                    </div>
                    
                    <!-- Nuova Password -->
                    <div class="mb-3">
                        <label for="nuovaPassword" class="form-label">Nuova Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="nuovaPassword" name="nuovaPassword" required>
                            <button class="btn btn-outline-secondary d-flex align-items-center px-3" type="button" 
                                    onclick="toggleVisibility('nuovaPassword', 'togglePasswordNuova')">
                                <img src="img/eye_close.png" id="togglePasswordNuova" alt="Mostra/Nascondi Password" width="20">
                            </button>
                        </div>
                    </div>

                    <!-- Conferma Nuova Password -->
                    <div class="mb-3">
                        <label for="confermaNuovaPassword" class="form-label">Conferma Nuova Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confermaNuovaPassword" name="confermaNuovaPassword" required>
                            <button class="btn btn-outline-secondary d-flex align-items-center px-3" type="button" 
                                    onclick="toggleVisibility('confermaNuovaPassword', 'togglePasswordConferma')">
                                <img src="img/eye_close.png" id="togglePasswordConferma" alt="Mostra/Nascondi Password" width="20">
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="btn" style="background-color: #0a5738; color:#FFFFFF">Cambia Password</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- Elimina Account -->
<div class="modal fade" id="eliminaAccountModal" tabindex="-1" aria-labelledby="eliminaAccountLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminaAccountLabel">Elimina Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Sei sicuro di voler eliminare il tuo account?</p>
                <button type="button" class="btn btn-danger" id="confirmDeleteAccount">Elimina Account</button>
                <div class="message"></div> <!-- Contenitore per i messaggi di successo o errore -->
            </div>
        </div>
    </div>
</div>