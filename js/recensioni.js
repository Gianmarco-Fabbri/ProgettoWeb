document.addEventListener("DOMContentLoaded", function () {
    const reviewForm = document.getElementById("review-form");
    const ratingStars = document.querySelectorAll(".star");
    const ratingValue = document.getElementById("rating-value");
    const ratingInput = document.getElementById("rating-value-input");

    if (!reviewForm) {
        console.error("Errore: il form delle recensioni non è stato trovato.");
        return;
    }

    // Gestione delle stelle
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

    // Invio della recensione
    reviewForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const comment = document.getElementById("comment").value.trim();
        const rating = ratingInput.value;

        if (!comment || !rating) {
            alert("Tutti i campi sono obbligatori.");
            return;
        }

        const reviewData = {
            valutazione: rating,
            testo: comment
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
                ratingStars.forEach(s => {
                s.classList.remove("text-warning");
                s.classList.add("text-secondary");
                });
                console.log("Reindirizzamento a:", "/ProgettoWeb/profilo.php"); // Debug
                window.location.href = "/ProgettoWeb/profilo.php";
            } else {
                alert(result.message);
            }
        } catch (error) {
            console.error("Errore nell'invio della recensione:", error);
            alert("Errore di connessione. Riprova più tardi.");
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const firstStar = document.querySelector(".star[data-value='1']");
    if (firstStar) {
        firstStar.classList.remove("text-secondary");
        firstStar.classList.add("text-warning");
    }
});
