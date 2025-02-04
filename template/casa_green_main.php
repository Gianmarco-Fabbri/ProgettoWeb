<div class="container mt-4">
    <div class="row">
        <aside class="col-md-3 bg-white border rounded p-3 mb-4">
            <h2 class="text-success fs-4">Filtri</h2> 

            <h3 class="fs-5">Recensioni</h3>
            <label for="starFilter" class="visually-hidden">Filtra per recensioni:</label>     
            
            <h3 class="fs-5">Prezzo</h3>
            <div class="mb-3">
                <div class="d-flex justify-content-between small mb-2">
                    <label id="displayMinPrice" for="minPriceInput">€ 0</label>
                    <label id="displayMaxPrice" for="maxPriceInput">€ 100</label>
                </div>
                <input type="range" class="form-range" id="minPriceInput" min="0" max="100" value="0">
                <input type="range" class="form-range" id="maxPriceInput" min="0" max="100" value="100">
                </div>

            
            <div class="d-flex justify-content-end">
                <button class="btn text-secondary d-flex align-items-center"
                        style="transition: color 0.3s ease;"
                        onmouseover="this.classList.add('text-success')" 
                        onfocus="this.classList.add('text-success')"
                        onmouseleave="this.classList.remove('text-success')">
                    &#x21bb; Ripristina filtri
                </button>
                <button class="btn btn-success">Filtra</button>
            </div>                   
        </aside>

        <section class="col-md-9">
            <h2 class="text-success">Prodotti</h2>
            <div class="row row-cols-2 row-cols-md-4 g-4">
                <div class="col text-center">
                    <a href="../html/product.html">
                        <img src="../img/kit1.png" alt="Kit skin care" class="img-fluid">
                    </a>
                    <p>Kit skin care <br> <strong>€19.99</strong> (IVA inclusa)</p>
                </div>
                <div class="col text-center">
                    <a href="../html/product.html">
                        <img src="../img/kit2.png" alt="Kit dopo barba" class="img-fluid">
                    </a>
                    <p>Kit dopo barba <br> <strong>€15.99</strong> (IVA inclusa)</p>
                </div>
                <div class="col text-center">
                    <a href="../html/product.html">
                        <img src="../img/kit3.png" alt="Kit balsami" class="img-fluid">
                    </a>
                    <p>Kit balsami <br> <strong>€9.99</strong> (IVA inclusa)</p>
                </div>
                <div class="col text-center">
                    <a href="../html/product.html">
                        <img src="../img/kit4.png" alt="Kit maschere viso" class="img-fluid">
                    </a>
                    <p>Kit maschere viso <br> <strong>€19.99</strong> (IVA inclusa)</p>
                </div>
            </div>
        </section>
    </div>
</div>