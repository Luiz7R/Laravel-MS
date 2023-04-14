<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script> 
</head>
    <body>
        @include('layouts.main.mainbar')
        @include('layouts.navbar-items')
        <div class="products-container" style="margin-top: 1%;">
            <div class="prod-itens">
                <h3 class="cat-title text-center">Promoção</h3>
                <div class="row row-margin">
                    @foreach ( $productsPromo as $productPromo )
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
                                        <form id="submit-cart" method="POST">
                                             {{-- action="{{ route('postBasket') }}" method="post"> --}}
                                            @csrf
                                            @method('POST')
                                            <input type="hidden" name="product">
                                            <input type="hidden" name="quantity">
                                        <button type="submit" class="add-to-cart btn btn-primary">Add to Cart</button>
                                        </form>
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
        <script>
            var form = document.getElementById('submit-cart');
            form.addEventListener('submit', function(e) {
                e.preventDefault();
            });
        </script>
    </body>
</html>