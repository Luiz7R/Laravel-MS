<nav class="main-menu" style="margin-top: 56px;">
    <ul>
        <li>
            <a href="/painel">
                <i class="fa fa-home fa-2x"></i>
                <span class="nav-text">
                    Dashboard
                </span>
            </a>
        </li>
        <li>
            <a href="/products">
                <i class="fa fa-store fa-2x"></i>
                <span class="nav-text">
                    Products
                </span>
            </a>
        </li> 
        <li>
            <a href="/categories">
                <i class="fa fa-bar-chart-o fa-2x"></i>
                <span class="nav-text">
                    Categories
                </span>
            </a>
        </li>                        
        <li>
            <a href="/statistics">
                <i class="fa fa-bar-chart-o fa-2x"></i>
                <span class="nav-text">
                    Graphs and Statistics
                </span>
            </a>
        </li>
    </ul>
    <ul class="logout">
        <li>
           <a href="#">
                 <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                    Logout
                </span>
            </a>
        </li>  
    </ul>
</nav>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
         <a class="navbar-brand" href="/">Manage</a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                 <span class="navbar-toggler-icon"></span>
         </button>              
         <div class="collapse navbar-collapse" id="navbarNav">
             <ul class="navbar-nav">
                 <li class="nav-item">
                     <a class="nav-link active" aria-current="page" href="">Home</a>
                 </li>
             </ul>
         </div>
         <div class="d-flex">
              <div class="usr">
                 <span class="text-white">{{ Auth::user()->name }}</span>                     
              </div>
              <form method="POST" action="{{ route('msLogout') }}">
                   @csrf
                   @method('POST')
                       <button type="submit" class="btn btn-default text-white">Logout</button> 
              </form>                      
        </div>           
    </div>
</nav>