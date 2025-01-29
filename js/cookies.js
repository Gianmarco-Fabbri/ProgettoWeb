document.addEventListener("DOMContentLoaded", function () {
    if (!localStorage.getItem("cookiesAccepted")) {
        let banner = document.createElement("div");
        banner.id = "cookieBanner";
        banner.className = "position-fixed bottom-0 w-100 bg-light shadow p-3 text-center";
        banner.innerHTML = `
            <p class="mb-2 text-success">
                Questo sito utilizza cookie per migliorare l'esperienza dell'utente. 
                <a href="cookie_policy.html" class="text-success fw-bold">Leggi di più</a>.
            </p>
            <button id="acceptCookies" class="btn btn-success">Accetta</button>
        `;
        document.body.appendChild(banner);

        document.getElementById("acceptCookies").addEventListener("click", function () {
            localStorage.setItem("cookiesAccepted", "true");
            document.getElementById("cookieBanner").remove(); 
        });
    }
});
