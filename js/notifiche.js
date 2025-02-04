document.addEventListener('DOMContentLoaded', function() {
    const notificheLista = document.getElementById('notifiche-lista');
    const segnaTutteBtn = document.getElementById('segna-tutte-lette');

    function caricaNotifiche() {
        fetch('ajax/api-notifiche.php')
            .then(response => {
                if (response.status === 401) {
                    console.warn("Utente non autenticato, reindirizzamento alla pagina di login.");
                    window.location.href = "accedi.php"; // Reindirizza alla pagina di login
                    return;
                }
                if (!response.ok) throw new Error('Errore nel caricamento');
                return response.json();
            })
            .then(notifiche => {
                console.log(notifiche);
                if (!notifiche) return;
                
                notificheLista.innerHTML = '';
                notifiche.forEach(notifica => {
                    const notificaElement = document.createElement('div');
                    notificaElement.className = `list-group-item ${notifica.letto ? '' : 'list-group-item-warning'}`;
                    notificaElement.innerHTML = `
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="ms-2 me-auto">
                                <div class="fw-bold">${notifica.tipo.replace(/_/g, ' ')}</div>
                                ${notifica.messaggio}
                                <div class="text-muted mt-1 small">
                                    ${new Date(notifica.data_notifica).toLocaleDateString('it-IT', {
                                        day: '2-digit',
                                        month: '2-digit',
                                        year: 'numeric',
                                        hour: '2-digit',
                                        minute: '2-digit'
                                    })}
                                </div>
                            </div>
                            
                            <div>
                                ${!notifica.letto ? 
                                    `<button class="btn btn-sm btn-outline-success me-2" onclick="segnaLetta(${notifica.id})">
                                        Segna come letta
                                    </button>` : ''
                                }
                                <button class="btn btn-sm btn-outline-danger" onclick="eliminaNotifica(${notifica.id})">
                                    Elimina
                                </button>
                            </div>
                        </div>
                    `;
                    notificheLista.appendChild(notificaElement);
                });
            })
            .catch(error => console.error('Errore:', error));
    }
    

    window.segnaLetta = function(id) {
        fetch('ajax/api-notifiche.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
        .then(response => {
            if (!response.ok) throw new Error('Errore nell\'aggiornamento');
            return response.json();
        })
        .then(() => caricaNotifiche())
        .catch(error => console.error('Errore:', error));
    };

    window.segnaTutteLette = function() {
        fetch('ajax/api-notifiche.php', {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' }
        })
        .then(response => {
            if (!response.ok) throw new Error('Errore nell\'aggiornamento');
            return response.json();
        })
        .then(() => caricaNotifiche())
        .catch(error => console.error('Errore:', error));
    };

    window.eliminaNotifica = function(id) {
        fetch('ajax/api-notifiche.php', {
            method: 'DELETE',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
        .then(response => {
            if (!response.ok) throw new Error('Errore nell\'eliminazione');
            return response.json();
        })
        .then(() => caricaNotifiche())
        .catch(error => console.error('Errore:', error));
    };

    if(segnaTutteBtn) {
        segnaTutteBtn.addEventListener('click', window.segnaTutteLette);
    }
    caricaNotifiche();
});