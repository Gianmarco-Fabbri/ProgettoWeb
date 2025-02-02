<div class="container py-5" style="max-width: 600px">
    <h1 class="mb-4 text-center" style="color: #0a5738">Acquista i tuoi prodotti</h1>
    <div class="border rounded-3 p-4 mb-4" style="border-color: #0a5738; background-color: #f4fbf8!important;">
        <div class="mb-4">
            <h2 class="mb-3" style="color: #0a5738">Riepilogo prodotti</h2>
            <!-- Aggiunte classi Bootstrap per gestire meglio il layout -->
            <div id="riepilogo-prodotti" class="row g-3">
                <!-- Riepilogo prodotti verrà caricato dinamicamente da pagamento.js -->
            </div>
        </div>
        <div class="mb-4">
            <label for="tipo-spedizione" style="color: #0a5738">Tipo di spedizione</label>
            <select id="tipo-spedizione" class="form-select mb-3" style="border-color: #0a5738">
                <option selected disabled>Seleziona una modalità di spedizione</option>
                <option value="standard">Standard (+5€ - 7 giorni)</option>
                <option value="express">Express (+10€ - 3 giorni)</option>
                <option value="premium">Premium (+15€ - 24h)</option>
            </select>
            <div class="mb-3">
                <label for="indirizzo" style="color: #0a5738">Indirizzo</label>
                <input type="text" id="indirizzo" class="form-control mb-2" value="Via dell'Università" readonly style="border-color: #0a5738">
                <label for="numero" style="color: #0a5738">Numero Civico</label>
                <input type="text" id="numero" class="form-control" value="50" readonly style="border-color: #0a5738">
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-4 py-2 border-top border-bottom" style="border-color: #0a5738!important">
            <span class="h5" style="color: #0a5738">Totale:</span>
            <span id="totale" class="h4 fw-bold" style="color: #0a5738">0.00 €</span>
        </div>
        <div class="mb-4">
            <label for="tipo-carta" style="color: #0a5738">Tipo carta</label>
            <select id="tipo-carta" class="form-select mb-3" style="border-color: #0a5738" required>
                <option selected disabled>Seleziona il tipo di carta</option>
                <option>Visa</option>
                <option>Mastercard</option>
                <option>American Express</option>
            </select>

            <label for="numero-carta" style="color: #0a5738">Numero carta</label>
            <input type="text" 
                    id="numero-carta" 
                    class="form-control mb-3" 
                    placeholder="Numero carta (16 cifre)" 
                    maxlength="16" 
                    required
                    pattern="^\d{16}$" 
                    title="Inserisci 16 cifre numeriche" 
                    style="border-color: #0a5738">

            <div class="row g-2">
                <div class="col-6">
                <label for="scadenza" style="color: #0a5738">Scadenza (MM/YY)</label>
                <input type="text" 
                        id="scadenza" 
                        class="form-control" 
                        placeholder="MM/YY" 
                        maxlength="5"
                        required
                        pattern="^(0[1-9]|1[0-2])\/\d{2}$"
                        title="Inserisci una data nel formato MM/YY (mese tra 01 e 12)" 
                        style="border-color: #0a5738">
                </div>
                <div class="col-6">
                <label for="cvv" style="color: #0a5738">CVV</label>
                <input type="text" 
                        id="cvv" 
                        class="form-control" 
                        placeholder="CVV" 
                        maxlength="3" 
                        required
                        pattern="^\d{3}$" 
                        title="Inserisci 3 cifre numeriche" 
                        style="border-color: #0a5738">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mt-4 pt-2 border-top" style="border-color: #0a5738!important">
            <span style="color: #0a5738">Arrivo previsto:</span>
            <span id="data-consegna" class="fw-bold" style="color: #0a5738">-</span>
        </div>
    </div>
    <div class="d-grid gap-3 d-md-flex justify-content-md-end">
        <button class="btn px-4" 
                style="background-color: #f4fbf8; color: #0a5738; border: 2px solid #0a5738; transition: 0.3s"
                onmouseover="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8'" 
                onmouseout="this.style.backgroundColor='#f4fbf8'; this.style.color='#0a5738'"
                onfocus="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8'"
                onblur="this.style.backgroundColor='#f4fbf8'; this.style.color='#0a5738'"
                onclick="window.location.href='carrello.php'">
            Chiudi
        </button>
        <button id="procediPagamento"
                class="btn px-4"
                style="background-color: #0a5738; color: #f4fbf8; border: 2px solid #0a5738; transition: 0.3s"
                onmouseover="this.style.backgroundColor='#f4fbf8'; this.style.color='#0a5738'" 
                onmouseout="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8'"
                onfocus="this.style.backgroundColor='#f4fbf8'; this.style.color='#0a5738'"
                onblur="this.style.backgroundColor='#0a5738'; this.style.color='#f4fbf8'">
            Acquista ora
        </button>

    </div>
</div>