function generaKitConsigliati(kit) {
    let result = `<section>
        <h1>Kit consigliati</h1>
        <ul>`;
    for (let i = 0; i < kit.length; i++) {
        result += `<li>
            <a href="../html/product.html">
                <img src="img/${kit[i]["img"]}" alt="${kit[i]["nome"]}"/> 
            </a>
            <p>${kit[i]["nome"]}<br/> ${kit[i]["prezzo"]} (IVA inclusa)</p>
        </li>`;
    }
    result += `</ul>
    </section>`;
    return result;
}

async function caricaKit() {
    const url = 'ajax/api-kit_consigliati.php';
    try {
        const response = await fetch(url);
        if (response.ok) {
            const json = await response.json();
            console.log("Dati ricevuti:", json);
            const main = document.querySelector("main");
            if (main) {
                main.innerHTML += generaKitConsigliati(json);
            } else {
                console.error("Elemento <main> non trovato nel DOM");
            }
        } else {
            console.error("Errore nella risposta: ", response.status);
        }
    } catch (error) {
        console.error("Errore durante il fetch:", error);
    }
}


caricaKit();