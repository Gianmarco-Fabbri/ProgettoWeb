document.addEventListener("DOMContentLoaded", function() {
    const container = document.getElementById("ordini-container");

    /* Utente non loggato / utente loggato senza ordini */
    function showNoOrdersMessage() {
        container.innerHTML = `
            <div class="col-12 text-center py-5">
                <div class="alert alert-success" style="background-color: #f4fbf8; border-color: #0a5738;">
                    <h2 class="alert-heading" style="color: #0a5738;">Nessun ordine effettuato</h2>
                    <p style="color: #0a5738;">Inizia a fare acquisti nel nostro negozio!</p>
                    <a href="index.php" class="btn btn-success" style="background-color: #0a5738; border-color: #0a5738;">
                        Ritorna alla Home
                    </a>
                </div>
            </div>
        `;
    }

    /* E-mail della sessione */
    fetch("ajax/api-sessione_email.php")
      .then(response => response.json())
      .then(sessionData => {
          if (sessionData.error) {
              console.error("Utente non autenticato");
              showNoOrdersMessage();
              return;
          }
          const email = sessionData.email;
          fetch("ajax/ordini/api-ordini.php?email=" + encodeURIComponent(email))
            .then(response => response.json())
            .then(ordiniData => {
                if (!ordiniData.success || !ordiniData.ordini.length) {
                    showNoOrdersMessage();
                    return;
                }
                
                const ordini = ordiniData.ordini;
                ordini.forEach(order => {
                    let stato = (order[2]) ? "Spedito" : "In elaborazione";
                    
                    const cardHTML = `
                        <div class="col-12 col-md-6 col-lg-4">
                            <div class="card h-100 border-success shadow-sm">
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-8">
                                            <h2 class="card-title text-success fs-5 fs-md-4" style="color: #0a5738!important;">
                                                Ordine #${order[0]}
                                            </h2>                                
                                            <p class="text-muted mb-1">Data ordine: ${order[1]}</p>
                                            <ul class="list-unstyled">
                                                <li>Spedizione: ${order[2]}</li>
                                                <li>Arrivo: ${order[3]}</li>
                                            </ul>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="badge rounded-pill" style="background-color: #0a5738; color: #f4fbf8;">
                                                    ${stato}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-transparent border-success">
                                    <div class="d-grid gap-2">
                                        <button class="btn btn-outline-success shadow-sm" type="button"
                                                style="border-color: #0a5738; color: #0a5738;"
                                                onmouseover="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8';"
                                                onmouseout="this.style.backgroundColor='transparent'; this.style.color='#0a5738';"
                                                onfocus="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8';"
                                                onblur="this.style.backgroundColor='transparent'; this.style.color='#0a5738';"
                                                onclick="window.location.href='tracking.php?ordine=${order[0]}'">
                                            Traccia ordine
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                    container.innerHTML += cardHTML;
                });
            })
            .catch(err => {
                console.error("Errore nella fetch degli ordini:", err);
                showNoOrdersMessage();
            });
      })
      .catch(err => {
          console.error("Errore nel recupero dell'email:", err);
          showNoOrdersMessage();
      });
});
