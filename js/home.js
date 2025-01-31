function generaKitConsigliati(kit) {
    let result = ` <section>
            <h1>Kit consigliati</h1>
            <ul> `;
    for (let i = 0; i < kit.length; i++) { /*cambiare i percorsi alle immagini nel db!*/
        result +=` <li>
        <a href="../html/product.html">
            <img src="${kit[i]["img"]}" alt="${kit[i]["nome"]}"/> 
        </a>
        <p>${kit[i]["nome"]}<br /> ${kit[i]["prezzo"]} (IVA inclusa)</p>
        </li>`;
    }
    result += ``;
}

async function caricaKit() {
    const url = './api-kit_consigliati.php'; /*percorso relativo!!*/

    try {
        const response = await fetch(url);
        if(response.ok) {
            const json = await response.json(); /*trasformo in json la response*/
            const main = document.querySelector("main");
            main.innerHTML += generaKitConsigliati(json);
        }
    } catch (error) {
        
    }
}

caricaKit();
