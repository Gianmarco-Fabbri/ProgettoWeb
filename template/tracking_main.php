<div class="container py-3 py-md-5">
    <section class="text-center">
        <div class="row g-3 mb-5 text-start">

            <!-- Box Informazioni Cliente -->
            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Informazioni cliente</h5>
                    <p id="customer-info" class="mb-1">
                        <!-- Dati dinamici -->
                    </p>
                </div>
            </div>

            <!-- Box Riepilogo Ordine -->
            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Riepilogo ordine</h5>
                    <p class="mb-1">
                        Ordine #<span id="order-id"></span><br>
                        Totale: €<span id="order-total"></span><br>
                        Pagamento: <span id="order-payment"></span>
                    </p>
                </div>
            </div>

            <!-- Box Indirizzo Consegna -->
            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Indirizzo consegna</h5>
                    <p class="mb-1">Via dell'Università 50<br>📦 Consegna prevista: <span id="data-ordine"></span></p>
                </div>
            </div>
        </div>

        <!-- Tracking Steps - Desktop -->
        <div class="mb-5 d-none d-md-block">
            <div class="d-flex justify-content-between align-items-start position-relative">
                <!-- Linea di connessione -->
                <div class="position-absolute w-100 border-top" style="top: 20px; border-color: #0a5738 !important;"></div>
                
                <!-- Step 1 -->
                <div class="d-flex flex-column align-items-center" style="z-index: 1;">
                    <div id="step-1-circle" class="tracking-step-circle"></div>
                    <span class="tracking-step-label">Elaborazione ordine</span>
                    <small id="step-1-date" class="tracking-step-date"></small>
                </div>

                <!-- Step 2 -->
                <div class="d-flex flex-column align-items-center" style="z-index: 1;">
                    <div id="step-2-circle" class="tracking-step-circle"></div>
                    <span class="tracking-step-label">Partenza magazzino</span>
                    <small id="step-2-date" class="tracking-step-date"></small>
                </div>

                <!-- Step 3 -->
                <div class="d-flex flex-column align-items-center" style="z-index: 1;">
                    <div id="step-3-circle" class="tracking-step-circle"></div>
                    <span class="tracking-step-label">Transito magazzino</span>
                    <small id="step-3-date" class="tracking-step-date"></small>
                </div>

                <!-- Step 4 -->
                <div class="d-flex flex-column align-items-center" style="z-index: 1;">
                    <div id="step-4-circle" class="tracking-step-circle"></div>
                    <span class="tracking-step-label">In consegna</span>
                    <small id="step-4-date" class="tracking-step-date"></small>
                </div>

                <!-- Step 5 -->
                <div class="d-flex flex-column align-items-center" style="z-index: 1;">
                    <div id="step-5-circle" class="tracking-step-circle"></div>
                    <span class="tracking-step-label">Consegnato</span>
                    <small id="step-5-date" class="tracking-step-date"></small>
                </div>
            </div>
        </div>

        <!-- Tracking Steps - Mobile -->
        <div class="d-md-none">
            <div class="position-relative ms-4">
                <!-- Linea verticale -->
                <div id="line-mobile" class="position-absolute h-100 border-start" style="left: 19px; border-color: #0a5738 !important;"></div>

                <!-- Step 1 -->
                <div class="d-flex align-items-center mb-4">
                    <div id="step-1-circle-mobile" class="tracking-step-circle-mobile"></div>
                    <div class="ms-3">
                        <p class="mb-0" style="color: #0a5738;">Elaborazione ordine</p>
                        <small id="step-1-date-mobile" class="text-muted"></small>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="d-flex align-items-center mb-4">
                    <div id="step-2-circle-mobile" class="tracking-step-circle-mobile"></div>
                    <div class="ms-3">
                        <p class="mb-0" style="color: #0a5738;">Partenza magazzino</p>
                        <small id="step-2-date-mobile" class="text-muted"></small>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="d-flex align-items-center mb-4">
                    <div id="step-3-circle-mobile" class="tracking-step-circle-mobile"></div>
                    <div class="ms-3">
                        <p class="mb-0" style="color: #0a5738;">Transito magazzino</p>
                        <small id="step-3-date-mobile" class="text-muted"></small>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="d-flex align-items-center mb-4">
                    <div id="step-4-circle-mobile" class="tracking-step-circle-mobile"></div>
                    <div class="ms-3">
                        <p class="mb-0" style="color: #0a5738;">In consegna</p>
                        <small id="step-4-date-mobile" class="text-muted"></small>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="d-flex align-items-center">
                    <div id="step-5-circle-mobile" class="tracking-step-circle-mobile"></div>
                    <div class="ms-3">
                        <p class="mb-0" style="color: #0a5738;">Consegnato</p>
                        <small id="step-5-date-mobile" class="text-muted"></small>
                    </div>
                </div>
            </div>
        </div>

        <div style="margin-top: 0.6rem"></div>

        <!-- Sezione Recensioni -->
        <div class="mx-auto mb-4" style="max-width: 600px;">
            <div class="mb-3 p-3 rounded-3" style="background-color: #f4fbf8; border: 1px solid #0a5738;">
                <p class="mb-2">📦 Il tuo ordine è in viaggio! Controlla qui gli aggiornamenti in tempo reale.</p>
                <button class="btn btn-track px-4 py-2" onclick="window.location.href='recensioni.php'">
                    Lascia una Recensione
                </button>
            </div>
        </div>
    </section>
</div>