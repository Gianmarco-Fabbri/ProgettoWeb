<main class="container my-5 flex-grow-1">
        <h1 class="text-success text-center mb-4">Gestione Prodotti</h1>

        <!-- Form per aggiungere un nuovo prodotto -->
        <div class="card p-4 mb-4 shadow-sm">
            <h3 class="text-success mb-3">Aggiungi un nuovo prodotto</h3>
            <form id="aggiungiProdottoForm" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="codiceProdotto" class="form-label">Codice Prodotto</label>
                    <input type="text" class="form-control" id="codiceProdotto" name="codiceProdotto" value="PXX" readonly>
                </div>
                <div class="mb-3">
                    <label for="img" class="form-label">Immagine del Prodotto</label>
                    <input type="file" class="form-control" id="img" name="img" required>
                </div>
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome Prodotto</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Inserisci il nome" required>
                </div>
                <div class="mb-3">
                    <label for="descrizione" class="form-label">Descrizione</label>
                    <textarea class="form-control" id="descrizione" name="descrizione" rows="3" placeholder="Inserisci una descrizione" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="prezzo" class="form-label">Prezzo (€)</label>
                    <input type="number" class="form-control" id="prezzo" name="prezzo" placeholder="Inserisci il prezzo" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select class="form-control" id="categoria" name="categoria" required>
                        <option value="Bellezza">Bellezza</option>
                        <option value="Salute">Salute</option>
                        <option value="Casa & Green">Casa & Green</option>
                        <option value="Profumi">Profumi</option>
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
        <!-- Lista Prodotti -->
<div class="card p-4 shadow-sm">
    <h3 class="text-success mb-3">Prodotti in catalogo</h3>

    <!-- Contenitore per lo scrolling orizzontale -->
    <div class="table-responsive">
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
            <tbody id="tabellaProdotti">
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
</div>

    </main>
