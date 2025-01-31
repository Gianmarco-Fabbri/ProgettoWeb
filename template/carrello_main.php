<link rel="stylesheet" href="./css/carrell.css">

<div class="container py-4">
    <h1 class="mb-4">Il tuo carrello</h1>      
    <section class="row">
        <div class="col-lg-8 mb-4">
            <div class="row g-3">
                <article class="col-12 p-3 shadow-sm">
                    <div class="row align-items-center g-3">
                        <div class="col-4 col-md-3">
                            <img src="../img/kit4.png" class="img-fluid rounded" alt="Prodotto"/>
                        </div>
                        <div class="col-8 col-md-6">
                            <h2 class="h5 mb-1">Prodotto 1</h2>
                            <p class="text-muted small mb-0">Descrizione breve del prodotto</p>
                        </div>
                        <div class="col-12 col-md-3">
                            <div class="d-flex flex-column gap-2">
                                <div class="d-flex align-items-center gap-2">
                                    <label for="quantity1" class="form-label mb-0">Quantità:</label>
                                    <input type="number" id="quantity1" value="1" min="1" 
                                        class="form-control form-control-sm w-50"/>
                                </div>
                                <p class="fw-bold mb-0">Prezzo: $21,42</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <aside class="col-lg-4">
            <div class="card p-3 shadow-sm sticky-top">
                <h3 class="h5 mb-3">Riepilogo ordine</h3>
                <div class="d-flex flex-column gap-2 mb-3">
                    <label for="points" class="form-label small">Punti da applicare</label>
                    <div class="d-flex gap-2">
                        <input type="text" id="points" class="form-control form-control-sm" 
                            placeholder="Inserisci punti"/>
                        <button class="btn btn-success btn-sm flex-shrink-0">Applica</button>
                    </div>
                </div>
                
                <dl class="row small mb-3">
                    <dt class="col-6">Subtotale:</dt>
                    <dd class="col-6 text-end">$42,58</dd>
                    <dt class="col-6 text-success">Sconto punti:</dt>
                    <dd class="col-6 text-end text-success">-$1,52</dd>
                </dl>
                
                <h4 class="h5 text-primary mb-3">Totale: $41,06</h4>
                
                <div class="d-grid gap-2">
                    <button 
                        class="btn btn-outline-secondary btn-sm"
                        onclick="window.location.href='index.html'">
                        Continua acquisti</button>
                    <button 
                        id="svuotaCarrelloBtn" 
                        class="btn btn-outline-danger btn-sm"
                        data-svuota-carrello>
                        Svuota carrello
                    </button>
                    <button 
                        class="btn btn-success btn-sm"
                        onclick="window.location.href='pagamento.html'">
                        Procedi al pagamento
                    </button>
                </div>
            </div>
        </aside>
    </section>
</div>