<div class="container my-5">
    <section class="bg-white p-4 rounded shadow-sm border">
        <h1 class="fw-bold text-success text-center">Lascia una recensione sul nostro servizio!</h1>
        
        <p class="text-muted text-center fs-4">La tua opinione ci aiuta a migliorare!</p>

        <form id="review-form">
            <div class="text-center mb-3">
                <div id="rating-stars" class="d-inline-flex">
                    <span class="star fs-2 text-secondary cursor-default" data-value="1">★</span>
                    <span class="star fs-2 text-secondary cursor-default" data-value="2">★</span>
                    <span class="star fs-2 text-secondary cursor-default" data-value="3">★</span>
                    <span class="star fs-2 text-secondary cursor-default" data-value="4">★</span>
                    <span class="star fs-2 text-secondary cursor-default" data-value="5">★</span>
                </div>
            </div>

            <p class="mt-2 fs-4">Valutazione: <span id="rating-value" class="fw-semibold fs-4">1</span></p>
            <input type="hidden" id="rating-value-input" name="rating" value="1">

            <div class="mb-4">
                <label for="comment" class="form-label fs-5 text-dark">Commento:</label>
                <textarea id="comment" name="comment" class="form-control shadow-sm" rows="5" placeholder="Dicci la tua esperienza!" required></textarea>
            </div>

            <div class="d-flex justify-content-center justify-content-md-end">
                <button type="submit" class="btn px-4 py-2 rounded-pill shadow-sm hover-shadow" style="background-color:#0a5738; color:#FFFFFF">
                    <span class="bi bi-send me-2"></span>Invia Recensione
                </button>
            </div>
        </form>
    </section>
</div>
