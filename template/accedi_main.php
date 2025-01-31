<div class="d-flex justify-content-center align-items-center" style="min-height: 100vh; padding: 5%;">
    <section style="width: 100%; max-width: 450px;">
        <form action="#" method="post"  class="bg-light p-4 shadow rounded" style="font-family: Arial, sans-serif;">
            <div class="mb-3">
                <label for="username" class="form-label fw-bold" style="color: #0a5738;">Email</label>
                <input type="email" id="username" name="username" class="form-control" 
                        placeholder="esempio@email.com" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold" style="color: #0a5738;">Password</label>
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
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success w-100 fw-bold">Registrati</button>
            </div>
            <div class="text-center mt-4">
                <p style="font-size: medium; color: #0a5738;">
                    Non hai un account? <a href="registration.html" style="color: #0a5738; font-weight: bold;">Registrati ora</a>
                </p>
            </div>
        </form>
    </section>
</div>