<div class="container py-3 py-md-5">
    <section class="text-center">
        <div class="row g-3 mb-5 text-start">

            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Informazioni cliente</h5>
                    <p id="customer-info" class="mb-1">
                        <!-- Dati cliente saranno inseriti dinamicamente -->
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Riepilogo ordine</h5>
                    <p class="mb-1">
                        Ordine #<span id="order-id"></span><br>
                        Totale: <span id="order-total"></span><br>
                        Pagamento: <span id="order-payment"></span>
                    </p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Indirizzo consegna</h5>
                    <p class="mb-1">Via dell'Università 50<br>📦 Consegna prevista: <span id="data-ordine"></span></p>
                </div>
            </div>
        </div>

        <!-- Desktop -->
        <div class="mb-5">
            <div class="d-none d-md-flex flex-nowrap justify-content-between align-items-start mb-4">
                <!-- STEP 1 -->
                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div id="step-1-circle" class="d-flex align-items-center justify-content-center mb-2" 
                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; font-weight: bold; border: 2px solid #0a5738;">
                        1
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Elaborazione ordine</span>
                    <span id="step-1-date" class="small"></span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <!-- STEP 2 -->
                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div id="step-2-circle" class="d-flex align-items-center justify-content-center mb-2" 
                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; font-weight: bold; border: 2px solid #0a5738;">
                        2
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Partenza magazzino</span>
                    <span id="step-2-date" class="small"></span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <!-- STEP 3 -->
                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div id="step-3-circle" class="d-flex align-items-center justify-content-center mb-2" 
                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; font-weight: bold; border: 2px solid #0a5738;">
                        3
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Transito magazzino</span>
                    <span id="step-3-date" class="small"></span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <!-- STEP 4 -->
                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div id="step-4-circle" class="d-flex align-items-center justify-content-center mb-2" 
                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; font-weight: bold; border: 2px solid #0a5738;">
                        4
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">In consegna</span>
                    <span id="step-4-date" class="small"></span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <!-- STEP 5 -->
                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div id="step-5-circle" class="d-flex align-items-center justify-content-center mb-2" 
                        style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; font-weight: bold; border: 2px solid #0a5738;">
                        5
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Consegnato</span>
                    <span id="step-5-date" class="small"></span>
                </div>
            </div>
        </div>

        <!-- Mobile -->
        <div class="d-md-none">
            <div class="d-flex flex-column position-relative" style="margin-left: 20px;">
                <!-- Linea verticale -->
                <div class="position-absolute start-0 h-100" 
                    style="width: 2px; background-color: #0a5738; margin-left: 19px;"></div>
                <!-- Steps -->
                <div class="d-flex align-items-start mb-4">
                    <div id="step-1-circle" class="d-flex align-items-center justify-content-center me-3" 
                        style="
                            width: 40px; 
                            height: 40px; 
                            border-radius: 50%; 
                            background-color: #0a5738; 
                            color: #f4fbf8; 
                            font-weight: bold;
                            position: relative;
                            z-index: 1;
                        ">
                        1
                    </div>
                    <div>
                        <p class="mb-0 fw-bold" style="color: #0a5738;">Elaborazione ordine</p>
                        <small id="step-1-date" class="text-muted"></small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <div id="step-2-circle" class="d-flex align-items-center justify-content-center me-3" 
                        style="
                            width: 40px; 
                            height: 40px; 
                            border-radius: 50%; 
                            background-color: #0a5738; 
                            color: #f4fbf8; 
                            font-weight: bold;
                            position: relative;
                            z-index: 1;
                        ">
                        2
                    </div>
                    <div>
                        <p class="mb-0 fw-bold" style="color: #0a5738;">Partenza magazzino</p>
                        <small id="step-2-date" class="text-muted"></small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <div id="step-3-circle" class="d-flex align-items-center justify-content-center me-3" 
                        style="
                            width: 40px; 
                            height: 40px; 
                            border-radius: 50%; 
                            background-color: #f4fbf8; 
                            color: #0a5738; 
                            border: 2px solid #0a5738;
                            font-weight: bold;
                            position: relative;
                            z-index: 1;
                        ">
                        3
                    </div>
                    <div>
                        <p class="mb-0" style="color: #0a5738;">Transito magazzino</p>
                        <small id="step-3-date" class="text-muted"></small>
                    </div>
                </div>
                <div class="d-flex align-items-start mb-4">
                    <div id="step-4-circle" class="d-flex align-items-center justify-content-center me-3" 
                        style="
                            width: 40px; 
                            height: 40px; 
                            border-radius: 50%; 
                            background-color: #f4fbf8; 
                            color: #0a5738; 
                            border: 2px solid #0a5738;
                            font-weight: bold;
                            position: relative;
                            z-index: 1;
                        ">
                        4
                    </div>
                    <div>
                        <p class="mb-0" style="color: #0a5738;">In consegna</p>
                        <small id="step-4-date" class="text-muted"></small>
                    </div>
                </div>
                <div class="d-flex align-items-start">
                    <div id="step-5-circle" class="d-flex align-items-center justify-content-center me-3" 
                        style="
                            width: 40px; 
                            height: 40px; 
                            border-radius: 50%; 
                            background-color: #f4fbf8; 
                            color: #0a5738; 
                            border: 2px solid #0a5738;
                            font-weight: bold;
                            position: relative;
                            z-index: 1;
                        ">
                        5
                    </div>
                    <div>
                        <p class="mb-0" style="color: #0a5738;">Consegnato</p>
                        <small id="step-5-date" class="text-muted"></small>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <!-- Sezione recensioni (statico per ora) -->
        <div class="mx-auto mb-4" style="max-width: 600px;">
            <div class="mb-3 p-3 rounded-3" style="background-color: #f4fbf8; color: #0a5738; border: 1px solid #0a5738;">
                <p class="mb-2">Tramite il tracking puoi visualizzare in qualsiasi momento dove si trova il tuo ordine!</p>
                <p class="mb-0">Se questo servizio ha migliorato l'esperienza sul nostro sito puoi lasciare una recensione:</p>
            </div>
            <button class="btn d-flex align-items-center mx-auto px-4 py-2" 
                    style="background-color: #f4fbf8; color: #0a5738; border: 2px solid #0a5738;"
                    onclick="window.location.href='recensioni.php'">
                Lascia una Recensione!
            </button>
        </div>
    </section>
</div>