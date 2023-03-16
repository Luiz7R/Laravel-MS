<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Homepage</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script> 
</head>

<body style="width: 100%; overflow-x: hidden;">
    @include('layouts.main.mainbar')
    @include('layouts.navbar-items')
    <div class="mdiv-hym">
    <main class="mn-content">
        <div class="its-cont" style="background-color: black;">
            <div class="bn-prnc">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active" data-bs-interval="4000" style="background-color: black;">
                        <div style="width: 800px; height: 377px;"></div>
                        {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                      </div>
                      <div class="carousel-item" data-bs-interval="2000" style="background-color: red;">
                        <div style="width: 800px; height: 377px;"></div>
                        {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                      </div>
                      <div class="carousel-item"  data-bs-interval="2000" style="background-color: rgb(218, 132, 4);">
                        <div style="width: 800px; height: 377px;"></div>
                        {{-- <img src="..." class="d-block w-100" alt="..."> --}}
                      </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="products-container">
                <div class="prod-itens">
                    <h3 class="cat-title text-center">Promoção</h3>
                    <div class="row row-margin">
                        @foreach ( $productPromotion as $productPromo )
                        <div class="col-md-2 col-product">
                            <div class="card product-card-i">
                                <div class="card-body">
                                    <div>
                                        <img src={{ asset('img/prodc-img.jpg') }} class="img-fluid" alt="Product 1">
                                        <div class="product">
                                            <h5>{{ $productPromo->product->name }}</h5>
                                        </div>
                                        <p>{{ currency_format($productPromo->promo_price) }}</p>
                                        <button class="add-to-cart btn btn-primary" onclick="addToCart($productPromo)">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="most-sale">
                        <h3 class="cat-title-sales text-center">Mais Vendidos</h3>
                        <div class="row row-margin">
                            @foreach ( $mostSales as $sold )
                            <div class="col-md-2 col-product">
                                <div class="card product-card-i">
                                    <div class="card-body">
                                        <div>
                                            <img src={{ asset('img/prodc-img.jpg') }} class="img-fluid" alt="Product 1">
                                            <div class="product">
                                                <h5>{{ $sold->name }}</h5>
                                            </div>
                                            <p>{{ currency_format($sold->price) }}</p>
                                            <button class="add-to-cart btn btn-primary" onclick="addToCart($sold)">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div> 
                        <div class="divider-prod"></div>
                    </div>
                </div>  
            </div>        
        </div>
    </main>
    </div>
</body>
</html>