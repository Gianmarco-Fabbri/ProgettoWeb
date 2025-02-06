document.addEventListener("DOMContentLoaded", function() {    
    document.getElementById("salvaModificheBtn").addEventListener("click", function() {
        salvaModificheProfilo();
    });
});

async function salvaModificheProfilo() {
    try {
        const nome = document.getElementById("editNome").value.trim();
        const cognome = document.getElementById("editCognome").value.trim();
        const telefono = document.getElementById("editTelefono").value.trim();
        const formData = new FormData();
        
        formData.append("nome", nome);
        formData.append("cognome", cognome);
        formData.append("telefono", telefono);

        const response = await fetch("ajax/profilo/api-modificaProfilo.php", {
            method: "POST",
            credentials: "same-origin",
            body: formData
        });

        const text = await response.text();
        let data;
        try {
            data = JSON.parse(text);
        } catch (error) {
            throw new Error("ERRORE: La risposta del server non è un JSON valido!");
        }

        if (data.success) {
            alert(data.message);
            
            document.getElementById("nome").value = nome;
            document.getElementById("cognome").value = cognome;
            document.getElementById("telefono").value = telefono;

            document.activeElement.blur();

            let modalEl = document.getElementById("modificaProfiloModal");
            let modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
        } else {
            alert("Errore: " + data.message);
        }
    } catch (error) {
        alert("Errore nella connessione al server: " + error.message);
    }
}