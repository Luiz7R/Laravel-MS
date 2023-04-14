<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>  
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    @include('layouts.main.mainbar')
    @include('layouts.navbar-items')
    <header>
		<h4 class="text-center">Checkout</h4>
	</header>
	<main>
        <div class="card">
            <div class="card-body">
                @foreach($checkoutItens as $item)
                
                <div class="row">
                    <div class="col-sm-3 p-4">
                        <p>{{ $item->product->name }}</p>
                    </div>
                    <div class="col-sm-3 p-4">
                        <p id="price-{{$item->id}}" class="price-prod" data-price="{{ $item->price }}">
                            {{ currency_format($item->price) }}
                        </p>
                    </div>
                    <div class="col-sm-3">
                          <div class="card-quantity">
                              Quant.
                              <p data-product-id="{{ $item->id }}">{{ $item->quantity }}</p>
                          </div>
                    </div>
                </div>
                <div class="divider-prod"></div>
                @endforeach
                <div class="row">
                    <p class="text-center">Total: {{ $total }}</p>
                </div>
            </div>
            <form action="{{ route('postCheckout') }}" method="POST">
                @csrf
                @method('POST')
			    <button type="submit">Checkout</button>
		    </form>
	</main>
</body>
</html>