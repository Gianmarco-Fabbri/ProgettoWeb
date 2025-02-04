document.addEventListener('DOMContentLoaded', function() {
    const params = new URLSearchParams(window.location.search);
    const orderId = params.get('ordine');

    if (!orderId) {
        console.error("ID ordine mancante");
        return;
    }

    fetch(`ajax/tracking/api-tracking.php?ordine=${encodeURIComponent(orderId)}`)
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                console.error("Errore API:", data.error);
                return;
            }

            document.getElementById('order-id').textContent = data.order.codiceOrdine;
            document.getElementById('data-ordine').textContent = data.order.dataArrivo;
            document.getElementById('order-total').textContent = data.total;
            document.getElementById('order-payment').textContent = data.order.tipoPagamento;
            document.getElementById('customer-info').innerHTML = 
                `${data.customer.nome} ${data.customer.cognome}<br>${data.customer.telefono}`;

            /* Step del tracking */
            const stato = parseInt(data.order.statoOrdine, 10);
            
            const updateStep = (step, date, isActive) => {
                /* Desktop */
                const circle = document.getElementById(`step-${step}-circle`);
                const dateElement = document.getElementById(`step-${step}-date`);
                
                /* Mobile */
                const circleMobile = document.getElementById(`step-${step}-circle-mobile`);
                const dateElementMobile = document.getElementById(`step-${step}-date-mobile`);

                if (isActive) {
                    circle.style.backgroundColor = '#0a5738';
                    circle.style.color = '#f4fbf8';
                    if(circleMobile) {
                        circleMobile.style.backgroundColor = '#0a5738';
                        circleMobile.style.color = '#f4fbf8';
                        circleMobile.style.border = 'none';
                    }
                }

                if(dateElement) dateElement.textContent = date;
                if(dateElementMobile) dateElementMobile.textContent = date;
            };

            updateStep(1, stato >= 1 ? `Completato il ${data.order.dataSpedizione}` : '', stato >= 1);
            updateStep(2, stato >= 2 ? `Spedito il ${data.order.dataSpedizione}` : '', stato >= 2);
            updateStep(3, stato >= 3 ? `In transito` : '', stato >= 3);
            updateStep(4, stato >= 4 ? `In consegna` : '', stato >= 4);
            updateStep(5, stato >= 5 ? `Consegnato il ${data.order.dataArrivo}` : '', stato >= 5);
        })
        .catch(error => console.error('Errore fetch:', error));
});