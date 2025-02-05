<!-- Main -->
<div class="container my-5 flex-grow-1">
    <h1 class="text-success text-center mb-4">Gestione Offerte</h1>

    <!-- Form per aggiungere un prodotto in offerta -->
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8 col-sm-12">
            <div class="card p-4 mb-4 shadow-sm">
                <h3 class="text-success mb-3">Metti in saldo un prodotto!</h3>
                <form id="addOfferForm">
                    <div class="mb-3">
                        <label for="productSelect" class="form-label">Seleziona il Prodotto</label>
                        <select class="form-select" id="productSelect">
                            <option selected>Seleziona un prodotto</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="discountPercentage" class="form-label">Sconto (espresso in €)</label>
                        <input type="number" class="form-control" id="discountPercentage" placeholder="Inserisci lo sconto" step="1" min="1" max="100">
                    </div>
                    <button type="submit" class="btn btn-success w-100">Aggiungi Offerta</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Lista Prodotti in Offerta -->
    <div class="card p-4 shadow-sm">
        <h3 class="text-success mb-3">Prodotti in Offerta</h3>
        <table class="table">
            <thead class="table-success d-none d-md-table-header">
                <tr>
                    <th>Immagine</th>
                    <th>Nome</th>
                    <th class="d-none d-md-table-cell">Prezzo Originale</th>
                    <th>Sconto</th>
                    <th class="d-none d-md-table-cell">Prezzo Scontato</th>
                    <th>Azioni</th>
                </tr>
            </thead>
            <tbody id="offersTableBody">
                <tr>
                    <td colspan="6" class="text-center text-muted">Nessun prodotto in offerta</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
