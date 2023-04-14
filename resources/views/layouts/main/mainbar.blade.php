<div class="main-bar">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light"> 
            @include('layouts.sidebaruser')
            <div class="container-fluid sch-br-hym">
                <a class="navbar-brand" href="/" style="color: white;">WYN</a>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <div id="searchBarWYN">
                        <form class="d-flex" method="GET" id="productsSearch" action="{{ route('ProductsPage') }}">
                            <input class="form-control me-2 input-sc-bar" id="msSearch" name="msSearch" type="search" placeholder="Search our Products" aria-label="Search">
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="user-logged">
                        <span class="text-white">{{ Auth::user()->name }}</span>                
                    </div>
                    <form method="POST" action="{{ route('msLogout') }}">
                        @csrf
                        @method('POST')
                            <button type="submit" class="btn btn-default text-white">Logout</button> 
                   </form> 
                   <div class="basket">
                        <a href="/basket">
                            <form action="{{ route('listBasket') }}" method="POST">
                                @csrf
                            </form>
                            <span class="text-white">Basket</span>
                        </a>
                   </div>
                </div>
            </div>
        </nav>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.sidebarBtn').click(function() {
            $('.sidebar-hym').toggleClass('active');
            $('.sidebarBtn').toggleClass('toggle');
        })
    })

    $('#productsSearch').on('click', function(e) {
        let search = $('#msSearch').val();

        if ( !search ) {
              e.preventDefault();
              return;
        }
        let url = '{{ route('ProductsPage', ":msSearch") }}' 
        url = url.replace(":msSearch", search)

        $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: url,
            dataType: 'json',
            success: function(data)
            {
                console.log(data)
            }
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