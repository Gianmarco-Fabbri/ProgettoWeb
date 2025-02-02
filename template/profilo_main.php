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
                
                <!-- Modale Bootstrap -->
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
                            <input type="text" class="form-control" id="editNome">
                        </div>
                        <div class="mb-3">
                            <label for="editCognome" class="form-label">Cognome</label>
                            <input type="text" class="form-control" id="editCognome">
                        </div>
                        <div class="mb-3">
                            <label for="editTelefono" class="form-label">Telefono</label>
                            <input type="text" class="form-control" id="editTelefono">
                        </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                        <button type="button" class="btn btn-primary" id="salvaModificheBtn">Salva modifiche</button>
                    </div>
                    </div>
                </div>
                </div>




            </div>
            <div class="d-flex justify-content-end gap-3 mt-4">
                <button type="button" class="btn" style="background-color: #0a5738;color:#FFFFFF;">Cambia password</button>
                <button type="button" class="btn" style="background-color: #B00000;color:#FFFFFF;">Elimina account</button>
                <button type="button" id="logoutBtn" class="btn btn-warning" style="background-color:orange; color:#FFFFFF;">Logout</button>
            </div>
        </section>

        <aside class="col-lg-5">
            <!-- Sezione Punti Accumulati con acquisti -->
            <div class="border rounded p-3 mb-4" style="height: 200px; overflow-y: auto; margin-top:46px;">
                <h3>Punti accumulati</h3>
                <ul style="list-style: none; padding: 0; font-size: 1rem;">
                    <li class="mb-2" style="border-bottom: 1px; padding-bottom: 8px;">Punti totali: </li>
                    <li class="text-center mt-3">
                        <a href="carrello.php" style="display: block; background-color: #0a5738; color: white; padding: 12px; border-radius: 5px; text-align: center; text-decoration: none;">Vai al carrello per utilizzare i punti</a>
                    </li>
                </ul>
            </div>

            <!-- Sezione Recensioni -->
            <div class="border rounded p-3" style="height: 310px; overflow-y: auto;">
                <h3>Recensioni</h3>
                <p></p>
            </div>
        </aside>
    </div>
</div>
