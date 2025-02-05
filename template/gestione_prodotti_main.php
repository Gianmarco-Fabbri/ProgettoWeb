<!-- Main -->
<main class="container my-5 flex-grow-1">
        <h1 class="text-success text-center mb-4">Gestione Prodotti</h1>

        <!-- Form per aggiungere un nuovo prodotto -->
        <div class="card p-4 mb-4 shadow-sm">
            <h3 class="text-success mb-3">Aggiungi un nuovo prodotto</h3>
            <form>
                <div class="mb-3">
                    <label for="productImage" class="form-label">Immagine del Prodotto</label>
                    <input type="file" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="productName" class="form-label">Nome Prodotto</label>
                    <input type="text" class="form-control" placeholder="Inserisci il nome">
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Descrizione</label>
                    <textarea class="form-control" rows="3" placeholder="Inserisci una descrizione"></textarea>
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Prezzo (€)</label>
                    <input type="number" class="form-control" placeholder="Inserisci il prezzo" step="0.01">
                </div>
                <button type="submit" class="btn btn-success">Aggiungi Prodotto</button>
            </form>
        </div>

        <!-- Lista Prodotti -->
        <div class="card p-4 shadow-sm">
            <h3 class="text-success mb-3">Prodotti in catalogo</h3>
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Prezzo</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img src="../img/prodotto1.jpg" alt="Prodotto" width="50"></td>
                        <td>Nome Prodotto</td>
                        <td>Descrizione breve del prodotto</td>
                        <td>€19.99</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Modifica</button>
                            <button class="btn btn-danger btn-sm">Elimina</button>
                        </td>
                    </tr>
                    <tr>
                        <td><img src="../img/prodotto2.jpg" alt="Prodotto" width="50"></td>
                        <td>Altro Prodotto</td>
                        <td>Descrizione breve del prodotto</td>
                        <td>€29.99</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Modifica</button>
                            <button class="btn btn-danger btn-sm">Elimina</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
