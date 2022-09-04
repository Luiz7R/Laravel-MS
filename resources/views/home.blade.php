<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home - Manage</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/chart.js') }}"></script>    
</head>
<body class="bd">
    @include('layouts.navbar')
    <div class="container mh">
        <div class="row mDiv">
            <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Registered Products</h5>
                        <span class="txt">{{ $products->count() }}</span>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                   <div class="card-body text-center">
                       <h5>Registered Categories</h5>
                       <span class="txt">{{ $categories->count() }}</span>
                   </div>
                </div>
           </div>
           <div class="col">
                <div class="card">
                    <div class="card-body text-center">
                        <h5>Sales</h5>
                        <span class="txt">{{ $sales }}</span>
                        {{-- <span class="txt">$ 1.282.721,15</span> --}}
                    </div>
                </div>
            </div>                                    
        </div> 
        <div class="row mDiv">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center" style="color: black; font-size: 20px;">
                        Recent Products Registered
                    </div>
                    <div class="card-body">
                        <ul>
                            @foreach ( $latestProducts as $product )
                                <li class="arrow">{{ $product->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>        
        </div> 
        <div class="row mDiv">
            <div class="col">
                <div class="card">
                    <div class="card-header text-center" style="color: black; font-size: 20px;">
                        Earnings 
                    </div>
                    <div class="card-body">
                        <div class="txt text-center">{{ $earnings }}</div>
                    </div>
                </div>    
            </div>    
        </div>        
    </div>
</body>

<script>
    $(function() {
        $('.main-menu').hover(function() {
            $('.container').css('margin-left', '255px');
        }, function() {
            // on mouseout, reset the margin left
            $('.container').css('margin-left', '60px');
        });
    });  
</script>

</html>