<div class="container py-5">
    <section class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card shadow-sm p-4 border-0" style="background-color: #f4fbf8;">
                <h1 class="text-center mb-4 text-success fw-bold">Contattaci</h1>
                
                <p class="text-center">
                    Hai domande, suggerimenti o necessiti di assistenza? Siamo qui per aiutarti! Puoi contattarci in diversi modi, 
                    e il nostro team sarà lieto di risponderti il prima possibile.
                </p>

                <h2 class="mt-4 text-success fw-bold">Come puoi contattarci?</h2>
                
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 bg-transparent">
                        <h3 class="text-dark fw-semibold">📧 Email:</h3> 
                        Scrivici all’indirizzo <a href="mailto:assistenza@benessere.it" class="text-success fw-bold">
                        assistenza@benessere.it</a> per ricevere supporto o informazioni.
                    </li>
                    <li class="list-group-item border-0 bg-transparent">
                        <h3 class="text-dark fw-semibold">📞 Telefono:</h3> 
                        Chiamaci al numero <a href="tel:+393489775723" class="text-success fw-bold">+39 348 9775 723</a>. 
                        Siamo disponibili dal <strong>lunedì al venerdì, dalle 08:00 alle 18:30</strong>.
                    </li>
                    <li class="list-group-item border-0 bg-transparent">
                        <h3 class="text-dark fw-semibold d-flex align-items-center">
                            <img src="../img/instagram.png" alt="Instagram logo" width="24" height="24" class="me-2"> 
                            Instagram:
                        </h3>                            
                        Seguici su <a href="https://www.instagram.com/benessere_market" 
                        target="_blank" class="text-success fw-bold">Instagram</a> per rimanere aggiornato su novità, offerte e consigli!
                    </li>
                    <li class="list-group-item border-0 bg-transparent">
                        <h3 class="text-dark fw-semibold">📝 Modulo di contatto:</h3> 
                        Compila il modulo qui sotto con la tua richiesta e ti risponderemo al più presto.
                    </li>
                </ul>

                <h2 class="mt-4 text-success fw-bold">Modulo di contatto</h2>
                
                <form action="/invia-contatto" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">Nome e Cognome:</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Il tuo nome completo" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Il tuo indirizzo email" required>
                    </div>

                    <div class="mb-3">
                        <label for="subject" class="form-label fw-bold">Oggetto:</label>
                        <input type="text" id="subject" name="subject" class="form-control" placeholder="Oggetto del messaggio" required>
                    </div>

                    <div class="mb-3">
                        <label for="message" class="form-label fw-bold">Messaggio:</label>
                        <textarea id="message" name="message" class="form-control" rows="5" placeholder="Scrivi il tuo messaggio qui..." required></textarea>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg shadow-sm">
                            Invia messaggio
                        </button>
                    </div>
                </form>

                <h2 class="mt-5 text-success fw-bold">La nostra sede</h2>

                <div class="alert alert-success text-center">
                    <p class="mb-0">
                        <strong>Benessere & Natura</strong><br>
                        Via del Benessere, 123<br>
                        00100 Roma, Italia
                    </p>
                </div>

                <p class="text-center">
                    Puoi anche venire a trovarci presso la nostra sede per scoprire i nostri prodotti e ricevere assistenza personalizzata!
                </p>

                <div class="text-center mt-4">
                    <button onclick="window.location.href='index.php'" class="btn btn-success btn-lg shadow-sm">
                        Torna alla home
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>