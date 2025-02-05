 <!-- Main -->
 <main class="container my-5 flex-grow-1">
        <h1 class="text-success text-center mb-4">Gestione Offerte</h1>

        <!-- Form per aggiungere un prodotto in offerta -->
        <div class="card p-4 mb-4 shadow-sm">
            <h3 class="text-success mb-3">Aggiungi un prodotto in offerta</h3>
            <form>
                <div class="mb-3">
                    <label for="productSelect" class="form-label">Seleziona il Prodotto</label>
                    <select class="form-select">
                        <option selected>Seleziona un prodotto</option>
                        <option value="1">Nome Prodotto 1</option>
                        <option value="2">Nome Prodotto 2</option>
                        <option value="3">Nome Prodotto 3</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="discountPercentage" class="form-label">Sconto (%)</label>
                    <input type="number" class="form-control" placeholder="Inserisci lo sconto" step="1" min="1" max="100">
                </div>
                <button type="submit" class="btn btn-success">Aggiungi Offerta</button>
            </form>
        </div>

        <!-- Lista Prodotti in Offerta -->
        <div class="card p-4 shadow-sm">
            <h3 class="text-success mb-3">Prodotti in Offerta</h3>
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Prezzo Originale</th>
                        <th>Sconto</th>
                        <th>Prezzo Scontato</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="../img/prodotto1.jpg" alt="Prodotto" width="50"></td>
                        <td>Nome Prodotto</td>
                        <td>€19.99</td>
                        <td>20%</td>
                        <td>€15.99</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Rimuovi Offerta</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../img/prodotto2.jpg" alt="Prodotto" width="50"></td>
                        <td>Altro Prodotto</td>
                        <td>€29.99</td>
                        <td>15%</td>
                        <td>€25.49</td>
                        <td>
                            <button class="btn btn-danger btn-sm">Rimuovi Offerta</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
