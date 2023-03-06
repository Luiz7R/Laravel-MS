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
    <div class="main-bar">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
                @include('layouts.sidebaruser')
                <div class="container-fluid sch-br-hym">
                    <a class="navbar-brand" href="#" style="color: white;">WYN</a>
                    <div class="collapse navbar-collapse" id="navbarScroll">
                        <div id="searchBarWYN">
                            <form class="d-flex">
                                <input class="form-control me-2 input-sc-bar" type="search" placeholder="Search our Products" aria-label="Search">
                                <button class="btn btn-primary" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="sc-yqins frqwe">
        <div class="sc-wyqnX woeqn">
            <nav class="er-qwEik yIieaqw">
                <div class="sc-ueqnd Kmied">
                    <span>Categorias</span>
                </div>
                <a href="/lancamentos" id="lancamentosMenuSuperior" class="sc-ueqnd Kmied">Lançamentos</a>
                <div class="sc-qYoend lmqup"></div>
                <a href="/ofertas" id="ofertasMenuSuperior" class="sc-ueqnd Kmied">Eletrônicos</a>
                <div class="sc-qYoend lmqup"></div>
                <a href="/ofertas" id="ofertasMenuSuperior" class="sc-ueqnd Kmied">Oferta Do Dia</a>
                <div class="sc-qYoend lmqup"></div>
                <a href="/ofertas" id="ofertasMenuSuperior" class="sc-ueqnd Kmied">Pc Gamer</a>
                <div class="sc-qYoend lmqup"></div>
                <a href="/ofertas" id="ofertasMenuSuperior" class="sc-ueqnd Kmied">Consoles</a>
                <div class="sc-qYoend lmqup"></div>
                <a href="/ofertas" id="ofertasMenuSuperior" class="sc-ueqnd Kmied">App</a>
            </nav>
        </div>
    </div>
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
                        {{-- @foreach ( $productPromotion as $productPromo )
                        <div class="col-md-2 col-product">
                            <div class="card product-card-i">
                                <div class="card-body">
                                    <div class="product">
                                        <img src={{ asset('img/prodc-img.jpg') }} class="img-fluid" alt="Product 1">
                                        <h3>{{ $productPromo->name }}</h3>
                                        <p>{{ currency_format($productPromo->price) }}</p>
                                        <button class="add-to-cart btn btn-primary" onclick="addToCart($productPromo)">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach --}}
                    </div>
                    <div class="most-sale">
                        <h3 class="cat-title-sales text-center">Mais Vendidos</h3>
                        <div class="row row-margin">
                            @foreach ( $mostSales as $sold )
                            <div class="col-md-2 col-product">
                                <div class="card product-card-i">
                                    <div class="card-body">
                                        <div class="product">
                                            <img src={{ asset('img/prodc-img.jpg') }} class="img-fluid" alt="Product 1">
                                            <h3>{{ $sold->name }}</h3>
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
            {{-- <img src={{ asset('img/prodc-img.jpg') }} alt="" /> --}}
            
            {{-- {{ $products }} --}}
        </div>
    </main>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('.sidebarBtn').click(function() {
            $('.sidebar-hym').toggleClass('active');
            $('.sidebarBtn').toggleClass('toggle');
        })
    })

    function Nav() {
  var width = document.getElementById("mySidenav").style.width;
  if (width === "0px" || width == "") {
    document.getElementById("mySidenav").style.width = "250px";
    $('.animated-icon').toggleClass('open');
  }
  else {
    document.getElementById("mySidenav").style.width = "0px";
    $('.animated-icon').toggleClass('open');
  }
}
Nav()
</script>
</html>