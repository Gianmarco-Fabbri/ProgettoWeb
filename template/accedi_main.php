<div class="container py-5">
    <div class="row justify-content-center align-items-stretch">
        <section class="col-lg-6 col-md-8 d-flex">  
            <div class="card p-4 shadow-sm border-0 bg-light w-100 h-100">
                <h1 class="text-center mb-4 text-success fw-bold">Accedi</h1>
                  
                <form action="#" method="post" id="login-form" class="bg-light rounded" style="font-family: Arial, sans-serif;">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold" style="color: #0a5738;">Email</label>
                        <input type="email" id="email" name="email" class="form-control" 
                                placeholder="esempio@email.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label fw-bold" style="color: #0a5738;">Password</label>
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
                    <div class="text-center mt-4">
                        <button type="submit" id="accediBtn" class="btn btn-success w-100 fw-bold">Accedi</button>
                    </div>
                    <div class="text-center mt-4">
                        <p style="font-size: medium; color: #0a5738;">
                            Non hai un account? <a href="registrazione.php" style="color: #0a5738; font-weight: bold;">Registrati ora</a>
                        </p>
                    </div>
                    <div id="error-message" class="alert alert-danger mt-3" style="display: none;"></div>
                </form>
            </div>
        </section>
    </div>
</div>
