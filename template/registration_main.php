<div class="container py-5">
    <div class="row justify-content-center align-items-stretch">
        <section class="col-lg-6 col-md-8 d-flex">
            <div class="card p-4 shadow-sm border-0 bg-light w-100 h-100">
                <h1 class="text-center mb-4 text-success fw-bold">Crea un account</h1>

                <form action="#" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Email</label>
                        <input type="email" id="username" name="username" class="form-control" 
                                placeholder="esempio@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" 
                                    placeholder="Inserisci la tua password" required>
                            <button class="btn btn-outline-secondary d-flex align-items-center px-3" type="button" 
                                    onclick="toggleVisibility('password', 'toggle-password')">
                                <img src="../img/eye_close.png" 
                                        id="toggle-password" 
                                        alt="Mostra/Nascondi Password" 
                                        width="20">
                            </button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label fw-bold">Conferma Password</label>
                        <div class="input-group">
                            <input type="password" id="confirm-password" name="confirm-password" class="form-control" 
                                    placeholder="Conferma la tua password" required>
                            <button class="btn btn-outline-secondary d-flex align-items-center px-3" type="button" 
                                    onclick="toggleVisibility('confirm-password', 'toggle-confirm-password')">
                                <img src="../img/eye_close.png" 
                                        id="toggle-confirm-password" 
                                        alt="Mostra/Nascondi Password" 
                                        width="20">
                            </button>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success w-100 fw-bold">Registrati</button>
                    </div>
                </form>
            </div>
        </section>
        <aside class="col-lg-6 col-md-8 d-flex">
            <div class="card p-4 shadow-sm border-0 bg-light w-100 h-100 text-center">
                <div class="mb-3">
                    <img src="../img/newsletter.png" alt="Icona Newsletter" class="img-fluid" width="80">
                    <h2 class="text-success fw-bold mt-2">Iscriviti alla Newsletter</h2>
                </div>
                <p class="text-dark">
                    Rimani aggiornato sulle ultime offerte e prodotti per la tua routine di benessere.
                </p>
                <div class="d-flex align-items-center justify-content-center gap-2 mb-3">
                    <input type="checkbox" id="newsletter" name="newsletter">
                    <label for="newsletter" class="text-dark">Ricevi novità sui prodotti</label>
                </div>
                <h3 class="text-success fw-bold">Vantaggi di essere registrati:</h3>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0">✓ Tracking degli ordini</li>
                    <li class="list-group-item border-0">✓ Scrivere recensioni</li>
                    <li class="list-group-item border-0">✓ Accumulo punti fedeltà</li>
                </ul>
            </div>
        </aside>
    </div>
</div>