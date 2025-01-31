<div class="container py-3 py-md-5">
    <section class="text-center">
        <div class="row g-3 mb-5 text-start">
            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Informazioni cliente</h5>
                    <p class="mb-1">Mario Rossi<br>Via Roma 123, 00100 Roma<br>📞 333 1234567</p>
                </div>
            </div>
            
            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Riepilogo ordine</h5>
                    <p class="mb-1">Ordine #12345<br>3 prodotti<br>Totale: € 149,99<br>Spedizione: Standard</p>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="p-3 border border-2 rounded-3" style="border-color: #0a5738 !important; color: #0a5738;">
                    <h5 class="mb-3 fw-bold">Indirizzo consegna</h5>
                    <p class="mb-1">Casa<br>Via Milano 45, 20100 Milano<br>📦 Consegna prevista: 25/05/2024</p>
                </div>
            </div>
        </div>

        <!-- Step del tracking: -->
        <div class="mb-5">
            <!-- Visualizzazione Desktop -->
            <div class="d-none d-md-flex flex-nowrap justify-content-between align-items-start mb-4">
                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div class="d-flex align-items-center justify-content-center mb-2" 
                            style="width: 40px; height: 40px; border-radius: 50%; background-color: #0a5738; color: #f4fbf8; font-weight: bold;">
                        1
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Elaborazione ordine</span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div class="d-flex align-items-center justify-content-center mb-2" 
                            style="width: 40px; height: 40px; border-radius: 50%; background-color: #0a5738; color: #f4fbf8; font-weight: bold;">
                        2
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Partenza magazzino</span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div class="d-flex align-items-center justify-content-center mb-2" 
                            style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; border: 2px solid #0a5738; font-weight: bold;">
                        3
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Transito magazzino</span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div class="d-flex align-items-center justify-content-center mb-2" 
                            style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; border: 2px solid #0a5738; font-weight: bold;">
                        4
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">In consegna</span>
                </div>

                <div class="d-none d-md-block flex-grow-1 border-top mt-4 mx-2" style="border-color: #0a5738 !important"></div>

                <div class="d-flex flex-column align-items-center" style="min-width: 90px;">
                    <div class="d-flex align-items-center justify-content-center mb-2" 
                            style="width: 40px; height: 40px; border-radius: 50%; background-color: #f4fbf8; color: #0a5738; border: 2px solid #0a5738; font-weight: bold;">
                        5
                    </div>
                    <span class="text-center" style="color: #0a5738; font-size: 0.8rem;">Consegnato</span>
                </div>
            </div>

            <!-- Visualizzazione Mobile -->
            <div class="d-md-none">
                <div class="d-flex flex-column position-relative" style="margin-left: 20px;">
                    <!-- Linea verticale -->
                    <div class="position-absolute start-0 h-100" 
                        style="width: 2px; background-color: #0a5738; margin-left: 19px;"></div>

                    <!-- Steps -->
                    <div class="d-flex align-items-start mb-4">
                        <div class="d-flex align-items-center justify-content-center me-3" 
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
                            <small class="text-muted">Completato il 20/05/2024</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="d-flex align-items-center justify-content-center me-3" 
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
                            <small class="text-muted">Spedito il 21/05/2024</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="d-flex align-items-center justify-content-center me-3" 
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
                            <small class="text-muted">Stimato per il 23/05/2024</small>
                        </div>
                    </div>

                    <div class="d-flex align-items-start mb-4">
                        <div class="d-flex align-items-center justify-content-center me-3" 
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
                        </div>
                    </div>

                    <div class="d-flex align-items-start">
                        <div class="d-flex align-items-center justify-content-center me-3" 
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
                        </div>
                    </div>
                </div>
            </div>
    </div>
        </div>

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