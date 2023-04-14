<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Releases</title>
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
            <h3 class="cat-title text-center">Releases</h3>
            <div class="row">
                @foreach ( $releases as $release )
                    <div class="col-sm-6 col-md-3 col-lg-3 col-product" style="padding-top: 1rem;">
                        <div class="card product-card-i">
                            <div class="card-body">
                                <div>
                                    <form action="{{ route('postProductBasket') }}" method="POST" id="submit-cart">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="product" value="{{ $release->id }}">
                                        <input type="hidden" name="quantity" value="1">

                                        <img src={{ asset('img/prodc-img.jpg') }} class="img-fluid" alt="Product 1">
                                        <div class="product">
                                            <h5>{{ $release->name }}</h5>
                                        </div>
                                        <p>{{ currency_format($release->price) }}</p>
                                        <button type="submit" class="add-to-cart btn btn-primary">Add to Cart</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>