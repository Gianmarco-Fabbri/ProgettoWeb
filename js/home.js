function generaKitConsigliati(kit) {
    let result = `<section>
        <h1>Kit consigliati</h1>
        <ul>`;
    for (let i = 0; i < kit.length; i++) {
        result += `<li>
            <a href="product.php?nome=${encodeURIComponent(kit[i].nome)}&codiceKit=${encodeURIComponent(kit[i].codiceKit)}&img=${encodeURIComponent(kit[i].img)}&prezzo=${encodeURIComponent(kit[i].prezzo)}">
                <img src="img/${kit[i].img}" alt="${kit[i].nome}"/> 
            </a>
            <p>${kit[i]["nome"]}<br/>€${kit[i]["prezzo"]} (IVA inclusa)</p>
        </li>`;
    }
    result += `</ul>
    </section>`;
    return result;
}

function generaOfferte(offerte) {
    let result = `<section>
        <h1>Offerte Esclusive</h1>
        <ul>`;
    for (let i = 0; i < offerte.length; i++) {
        let prezzoOriginale = offerte[i]["prezzo"];
        let prezzoScontato = (prezzoOriginale * (1 - offerte[i]["scontoProdotto"] / 100)).toFixed(2);

        result += `<li>
            <a href="product.php?nome=${encodeURIComponent(offerte[i].nome)}&codiceProdotto=${encodeURIComponent(offerte[i].codiceProdotto)}&img=${encodeURIComponent(offerte[i].img)}&prezzo=${encodeURIComponent(prezzoScontato)}">
                <img src="img/${offerte[i]["img"]}" alt="${offerte[i]["nome"]}"/> 
            </a>
            <p>${offerte[i]["nome"]}<br/> 
               Prezzo originale: €${prezzoOriginale}<br/>
               Prezzo scontato: €${prezzoScontato} (IVA inclusa)
            </p>
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

async function caricaOfferte() {
    console.log("Eseguo caricaOfferte()...");
    const url = 'ajax/api-offerte-esclusive.php';
    try {
        const response = await fetch(url);
        console.log("Response status:", response.status);

        if (response.ok) {
            const json = await response.json();
            console.log("Offerte ricevute:", json);

            const main = document.querySelector("main");
            if (main) {
                console.log("Main trovato, inserisco HTML...");
                main.innerHTML += generaOfferte(json);
            } else {
                console.error("Elemento <main> non trovato nel DOM");
            }
        } else {
            console.error("Errore nella risposta:", response.status);
        }
    } catch (error) {
        console.error("Errore durante il fetch:", error);
    }
}

caricaKit();
caricaOfferte();
