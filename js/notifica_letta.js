document.addEventListener("DOMContentLoaded", function () {
    const pulsantiSegnaLetta = document.querySelectorAll(".segna-letta");

    pulsantiSegnaLetta.forEach((button) => {
        button.addEventListener("click", function () {
            let notifica = this.closest(".list-group-item");
            notifica.remove();
        });
    });
});
