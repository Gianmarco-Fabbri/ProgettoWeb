<div class="container py-5">
    <div class="row justify-content-center align-items-stretch">
        <section class="col-lg-6 col-md-8 d-flex">
            <div class="card p-4 shadow-sm border-0 bg-light w-100 h-100">
                <h1 class="text-center mb-4 text-success fw-bold">Crea un account</h1>

                <form id="registration-form" action="#" method="post">
                    <div class="mb-3">
                        <label for="first_name" class="form-label fw-bold">Nome</label>
                        <input type="text" id="first_name" name="first_name" class="form-control" 
                                placeholder="Inserisci il tuo nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_name" class="form-label fw-bold">Cognome</label>
                        <input type="text" id="last_name" name="last_name" class="form-control" 
                                placeholder="Inserisci il tuo cognome" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" id="username" name="username" class="form-control" 
                                placeholder="Scegli un username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <input type="email" id="email" name="email" class="form-control" 
                                placeholder="esempio@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label fw-bold">Telefono</label>
                        <input type="tel" id="phone" name="phone" class="form-control" 
                                placeholder="Inserisci il tuo numero di telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <input type="password" id="password" name="password" class="form-control" 
                                    placeholder="Inserisci la tua password" required>
                            <button class="btn btn-outline-secondary d-flex align-items-center px-3" type="button" 
                                    onclick="toggleVisibility('password', 'toggle-password')">
                                <img src="img/eye_close.png" 
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
                                <img src="img/eye_close.png" 
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

            <div id="message-box" class="alert d-none"></div>
            </div>
        </section>
        
    </div>
</div>