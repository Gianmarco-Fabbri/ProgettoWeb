<div class="container my-5">
    <section class="bg-white p-4 rounded shadow-sm border">
        <h1 class="fw-bold text-success text-center">Valuta il tuo acquisto!</h1>
        <div class="d-flex flex-column flex-md-row align-items-center justify-content-between mb-4">
            
            <div class="text-center text-md-start mb-3 mb-md-0 me-md-4">
                <h2 class="fw-bold">Nome prodotto</h2>
                <p class="text-muted fs-4">Prezzo€</p> 

                <!-- Immagine per desktop -->
                <div class="d-none d-md-block text-center">
                    <!-- Immagine dinamica -->
                    <img src="" alt="Immagine Prodotto" 
                            class="img-fluid" 
                            style="max-width: 120px; height: auto; object-fit: contain;">
                </div>
            </div>
    
            <!-- Immagine per mobile -->
            <div class="d-block d-md-none">
                <!-- Immagine dinamica -->
                <img src="." alt="Immagine Prodotto" 
                        class="img-fluid" 
                        style="max-width: 80px; height: auto; object-fit: contain;">
            </div>
        </div>
    
        <form id="review-form">
            <div class="text-center mb-3">
                <div id="rating-stars" class="d-inline-flex">
                    <span class="star fs-2 text-secondary" data-value="1">★</span>
                    <span class="star fs-2 text-secondary" data-value="2">★</span>
                    <span class="star fs-2 text-secondary" data-value="3">★</span>
                    <span class="star fs-2 text-secondary" data-value="4">★</span>
                    <span class="star fs-2 text-secondary" data-value="5">★</span>
                </div>
            </div>
    
            <div id="rating" class="d-inline-flex mb-3">
                <span class="bi bi-star-fill fs-2 star-rating text-warning" data-value="1"></span>
                <span class="bi bi-star-fill fs-2 star-rating text-secondary" data-value="2"></span>
                <span class="bi bi-star-fill fs-2 star-rating text-secondary" data-value="3"></span>
                <span class="bi bi-star-fill fs-2 star-rating text-secondary" data-value="4"></span>
                <span class="bi bi-star-fill fs-2 star-rating text-secondary" data-value="5"></span>
            </div>
            <p class="mt-2 fs-4">Valutazione: <span id="rating-value" class="fw-semibold fs-4">1</span></p>
            <input type="hidden" id="rating-value-input" name="rating" value="1">
    
            <div class="mb-4">
                <label for="comment" class="form-label fs-5 text-dark">Commento:</label>
                <textarea id="comment" name="comment" class="form-control shadow-sm" rows="5" placeholder="Dicci di più!" required></textarea>
            </div>
    
            <div class="d-flex justify-content-center justify-content-md-end">
                <a href="" class="btn btn-outline-secondary me-2 px-4 py-2 rounded-pill shadow-sm hover-shadow" role="button">
                    <span class="bi bi-x-circle me-2"></span>Annulla
                </a>
                <button type="submit" class="btn px-4 py-2 rounded-pill shadow-sm hover-shadow" style="background-color:#0a5738; color:#FFFFFF">
                    <span class="bi bi-send me-2"></span>Invia Recensione
                </button>
            </div>
        </form>
    </section>
    
</div>