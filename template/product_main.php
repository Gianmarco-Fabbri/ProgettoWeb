<div style="background-color: white;">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <div class="bg-light rounded d-flex align-items-center justify-content-center"
                     style="min-height: 500px; background-color: #f4fbf8!important;">
                    <!-- Placeholder per l'immagine del prodotto -->
                    <img id="productImg" src="../img/default.png" alt="Immagine prodotto">
                </div>
            </div> 
            <div class="col-lg-7">
                <div class="bg-white p-4 rounded shadow-sm">
                    <!-- Placeholder per il nome del prodotto -->
                    <h1 id="productNome" class="h2 font-weight-bold mb-3">Nome del prodotto</h1>
                    
                    <a href="recensioni.php" class="d-block mb-3 text-decoration-none text-success fw-bold">Scrivi una recensione</a>

                    <div class="d-flex flex-column flex-md-row align-items-md-center mb-4">
                        <div class="me-md-4 text-success">
                            <!-- Placeholder per il prezzo -->
                            <p id="productPrezzo" class="display-4 fw-bold mb-0">Prezzo</p>
                            <small class="text-muted">(IVA inclusa)</small>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-6">
                            <!-- Placeholder per il codice del prodotto -->
                            <p id="productCodice" class="mb-0 text-muted">Codice prodotto: </p>
                        </div>
                        <div class="col-6">
                            <p class="mb-0 text-muted">Disponibilità: <span class="text-success">Disponibile</span></p>
                        </div>
                    </div>
                    <!-- Campo nascosto per memorizzare l'id del prodotto -->
                    <input type="hidden" id="idProdotto" value="12345" />
                    <div class="mb-4">
                        <label for="quantita" class="form-label fw-bold">Quantità:</label>
                        <input type="number" id="quantita" class="form-control" value="1" style="max-width: 100px;"/>
                    </div>
                    <button id="addToCartButton" class="btn btn-success d-block w-100 mb-3 py-3 shadow-sm hover-scale">
                        AGGIUNGI AL CARRELLO
                    </button>
                    <div class="d-flex justify-content-between mb-4">
                        <a href="#" class="text-decoration-none text-success fw-bold hover-underline">Aggiungi alla lista dei desideri</a>
                        <a href="#" class="text-decoration-none text-success fw-bold hover-underline">Aggiungi alla lista di confronto</a>
                    </div>
                    <div class="border-top pt-3">
                        <p class="mb-1 fw-bold">Destinazione:</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">Corriere BRT €5,00</span>
                            <span class="text-muted">4/6 gg</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
