<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slippers</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script> 
</head>
<style>
    .no-slippers {
        padding: 8px;
        margin-left: -28px;
        background-color: #f2dede;
        color: #a94442;
        border: 1px solid #ebccd1;
        border-radius: 4px;
    }

</style>
<body>
    @include('layouts.main.mainbar')
    @include('layouts.navbar-items')
    <div class="products-container" style="margin-top: 1%;">
        <div class="prod-itens">
            <h3 class="cat-title text-center">Slippers</h3>
            <div class="row row-margin">
                @if( !count($slippers) ) 
                    <div class="no-slippers">
                        Sorry, we don't have any slippers at the moment.
                    </div>
                @else
                    @foreach ( $slippers as $slipper )
                    <div class="col-md-2 col-product">
                        <div class="card product-card-i" style="margin-top: 1rem;">
                            <div class="card-body">
                                <div>
                                    <img src={{ asset('img/prodc-img.jpg') }} class="img-fluid" alt="Product 1">
                                    <div class="product">
                                        <h5>{{ $slipper->name }}</h5>
                                    </div>
                                    <p>{{ currency_format($slipper->price) }}</p>
                                    <button class="add-to-cart btn btn-primary" onclick="addToCart($slipper)">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif 
            </div>
        </div>
    </div>
</body>
</html>