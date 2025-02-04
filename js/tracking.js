document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const orderId = params.get('ordine');

    if (!orderId) {
        console.error("ID ordine non fornito.");
        return;
    }

    fetch("ajax/tracking/api-tracking.php?ordine=" + encodeURIComponent(orderId))
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error("Errore nell'API:", data.error);
                return;
            }

            const order = data.order;
            const customer = data.customer;
            const products = data.products;
            const total = data.total;

            // Aggiorna il riepilogo ordine
            document.getElementById('order-id').textContent = order.codiceOrdine;
            document.getElementById('data-ordine').textContent = order.dataArrivo;
            document.getElementById('order-total').textContent = `€ ${total}`;
            document.getElementById('order-payment').textContent = order.tipoPagamento;
            
            // Aggiorna informazioni cliente
            if (customer) {
                document.getElementById('customer-info').innerHTML = `
                    Nome: ${customer.nome} <br>Cognome: ${customer.cognome}<br>
                    Telefono: ${customer.telefono}
                `;
            }

            const stato = parseInt(order.statoOrdine, 10);
            
            function updateStep(stepNumber, text, isCompleted) {
                const stepCircleDesktop = document.querySelector(`#step-${stepNumber}-circle`);
                const stepCircleMobile = document.querySelector(`#step-${stepNumber}-circle-m`);
                const stepTextDesktop = document.querySelector(`#step-${stepNumber}-date`);
                const stepTextMobile = document.querySelector(`#step-${stepNumber}-date-m`);
                
                if (isCompleted) {
                    stepCircleDesktop.style.backgroundColor = "#0a5738"; // Verde per step completato
                    stepCircleDesktop.style.color = "#f4fbf8";
                    stepCircleMobile.style.backgroundColor = "#0a5738";
                    stepCircleMobile.style.color = "#f4fbf8";
                } else {
                    stepCircleDesktop.style.backgroundColor = "#f4fbf8"; // Bianco per step non completato
                    stepCircleDesktop.style.color = "#0a5738";
                    stepCircleDesktop.style.border = "2px solid #0a5738";

                    stepCircleMobile.style.backgroundColor = "#f4fbf8";
                    stepCircleMobile.style.color = "#0a5738";
                    stepCircleMobile.style.border = "2px solid #0a5738";
                }

                stepTextDesktop.textContent = text;
                stepTextMobile.textContent = text;
            }

            updateStep(1, stato >= 1 ? `Completato il ${order.dataSpedizione}` : "", stato >= 1);
            updateStep(2, stato >= 2 ? `Spedito il ${order.dataSpedizione}` : "", stato >= 2);
            updateStep(3, stato >= 3 ? `In transito` : "", stato >= 3);
            updateStep(4, stato >= 4 ? `In consegna` : "", stato >= 4);
            updateStep(5, stato >= 5 ? `Consegnato il ${order.dataArrivo}` : "", stato >= 5);
        })
        .catch(err => {
            console.error("Errore nel recupero dei dati:", err);
        });
});
