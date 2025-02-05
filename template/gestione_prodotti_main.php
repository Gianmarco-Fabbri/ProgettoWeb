<main class="container my-5 flex-grow-1">
        <h1 class="text-success text-center mb-4">Gestione Prodotti</h1>

        <!-- Form per aggiungere un nuovo prodotto -->
        <div class="card p-4 mb-4 shadow-sm">
            <h3 class="text-success mb-3">Aggiungi un nuovo prodotto</h3>
            <form action="processa_prodotto.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="codiceProdotto" class="form-label">Codice Prodotto</label>
                    <input type="text" class="form-control" id="codiceProdotto" name="codiceProdotto" value="PXX" readonly>
                </div>
                <div class="mb-3">
                    <label for="productImage" class="form-label">Immagine del Prodotto</label>
                    <input type="file" class="form-control" id="productImage" name="productImage" required>
                </div>
                <div class="mb-3">
                    <label for="productName" class="form-label">Nome Prodotto</label>
                    <input type="text" class="form-control" id="productName" name="productName" placeholder="Inserisci il nome" required>
                </div>
                <div class="mb-3">
                    <label for="productDescription" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="productDescription" name="productDescription" rows="3" placeholder="Inserisci una descrizione" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="productPrice" class="form-label">Prezzo (€)</label>
                    <input type="number" class="form-control" id="productPrice" name="productPrice" placeholder="Inserisci il prezzo" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="productCategory" class="form-label">Categoria</label>
                    <select class="form-control" id="productCategory" name="productCategory" required>
                        <option value="BELLEZZA">Bellezza</option>
                        <option value="SALUTE">Salute</option>
                        <option value="CASA & GREEN">Casa & Green</option>
                        <option value="PROFUMI">Profumi</option>
                    </select>
                </div>

                <!-- Campi nascosti per dati automatici -->
                <input type="hidden" id="dataAggiunta" name="dataAggiunta" value="<?php echo date('Y-m-d'); ?>">
                <input type="hidden" id="numeroRecensioni" name="numeroRecensioni" value="0">
                <input type="hidden" id="inOfferta" name="inOfferta" value="0">

                <button type="submit" class="btn btn-success">Aggiungi Prodotto</button>
            </form>
        </div>

        <!-- Lista Prodotti -->
        <div class="card p-4 shadow-sm">
            <h3 class="text-success mb-3">Prodotti in catalogo</h3>
            <table class="table table-striped">
                <thead class="table-success">
                    <tr>
                        <th>Codice</th>
                        <th>Immagine</th>
                        <th>Nome</th>
                        <th>Descrizione</th>
                        <th>Prezzo</th>
                        <th>Categoria</th>
                        <th>Azioni</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>P23</td>
                        <td><img src="../img/prodotto1.jpg" alt="Prodotto" width="50"></td>
                        <td>Nome Prodotto</td>
                        <td>Descrizione breve del prodotto</td>
                        <td>€19.99</td>
                        <td>Bellezza</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Modifica</button>
                            <button class="btn btn-danger btn-sm">Elimina</button>
                        </td>
                    </tr>
                    <tr>
                        <td>P24</td>
                        <td><img src="../img/prodotto2.jpg" alt="Prodotto" width="50"></td>
                        <td>Altro Prodotto</td>
                        <td>Descrizione breve del prodotto</td>
                        <td>€29.99</td>
                        <td>Salute</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Modifica</button>
                            <button class="btn btn-danger btn-sm">Elimina</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
