document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("review-form");
    const ratingStars = document.querySelectorAll(".star-rating");
    const ratingValue = document.getElementById("rating-value");
    const ratingInput = document.getElementById("rating-value-input");

    if (!reviewForm) {
        console.error("Errore: il form delle recensioni non è stato trovato.");
        return;
    }

    // Gestione delle stelle di valutazione
    ratingStars.forEach(star => {
        star.addEventListener("click", function () {
            const selectedValue = parseInt(this.getAttribute("data-value"));
            ratingValue.textContent = selectedValue;
            ratingInput.value = selectedValue;

            ratingStars.forEach(s => {
                s.classList.remove("text-warning");
                s.classList.add("text-secondary");
            });

            for (let i = 0; i < selectedValue; i++) {
                ratingStars[i].classList.remove("text-secondary");
                ratingStars[i].classList.add("text-warning");
            }
        });
    });

    // Gestione dell'invio del form
    reviewForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const comment = document.getElementById("comment").value.trim();
        const rating = ratingInput.value;
        const productId = 123; // Da aggiornare con l'ID del prodotto dinamico
        const userId = 1; // Da prendere dalla sessione utente

        if (!comment || !rating) {
            alert("Tutti i campi sono obbligatori.");
            return;
        }

        const reviewData = {
            rating: rating,
            comment: comment,
            product_id: productId,
            user_id: userId
        };

        try {
            const response = await fetch("ajax/api-recensioni.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify(reviewData)
            });

            const result = await response.json();

            if (result.success) {
                alert("Recensione inviata con successo!");
                reviewForm.reset();
                ratingValue.textContent = "1";
                ratingInput.value = "1";
                ratingStars.forEach(s => s.classList.add("text-secondary"));
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error("Errore nell'invio della recensione:", error);
            alert("Errore di connessione. Riprova più tardi.");
        }
    });
});
