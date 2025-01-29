    document.addEventListener("DOMContentLoaded", function () {
    const stars = document.querySelectorAll(".star");
    const ratingValue = document.getElementById("rating-value");
    const ratingInput = document.getElementById("rating-value-input");

    // Imposta la prima stella come selezionata di default
    function setDefaultRating() {
        let value = 1;
        ratingValue.textContent = value;
        ratingInput.value = value;

        stars.forEach(s => {
            s.style.cursor = "pointer";
            if (s.getAttribute("data-value") <= value) {
                s.classList.remove("text-secondary");
                s.classList.add("text-warning");
            } else {
                s.classList.remove("text-warning");
                s.classList.add("text-secondary");
            }
        });
    }

    setDefaultRating()

    stars.forEach(star => {
        star.addEventListener("click", function () {
            let value = this.getAttribute("data-value");
            ratingValue.textContent = value;
            ratingInput.value = value;

            // Cambia colore delle stelle selezionate
            stars.forEach(s => {
                if (s.getAttribute("data-value") <= value) {
                    s.classList.remove("text-secondary");
                    s.classList.add("text-warning");
                } else {
                    s.classList.remove("text-warning");
                    s.classList.add("text-secondary");
                }
            });
        });

        // Effetto hover per mostrare anteprima della valutazione
        star.addEventListener("mouseover", function () {
            let value = this.getAttribute("data-value");
            stars.forEach(s => {
                if (s.getAttribute("data-value") <= value) {
                    s.classList.add("text-warning");
                    s.classList.remove("text-secondary");
                } else {
                    s.classList.add("text-secondary");
                    s.classList.remove("text-warning");
                }
            });
        });

        // Ripristina il valore reale quando il mouse esce
        star.addEventListener("mouseout", function () {
            let value = ratingInput.value;
            stars.forEach(s => {
                if (s.getAttribute("data-value") <= value) {
                    s.classList.add("text-warning");
                    s.classList.remove("text-secondary");
                } else {
                    s.classList.add("text-secondary");
                    s.classList.remove("text-warning");
                }
            });
        });
    });
});