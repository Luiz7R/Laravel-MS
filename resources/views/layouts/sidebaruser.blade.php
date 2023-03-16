<div class="wthvr">
<link rel="stylesheet" href="{{ asset('css/styletopbar.css') }}">
    <div class="sidebar-hym">
        <ul id="menu-sdbr-hm">
            <div class="sdb-hbm">
                <a href="#" class="sidebarBtn sdb-btn" style="padding-left: 20px; margin=bottom: 100px;">
                    <svg width="30" height="20" viewBox="0 0 30 20" fill="none" xmlns="https://www.w3.org/2000/svg" class="IconSandwich" data-testid="drawerButton">
                        <path d="M0.75 0.5H29.25V3.66667H0.75V0.5ZM0.75 8.41667H29.25V11.5833H0.75V8.41667ZM0.75 16.3333H29.25V19.5H0.75V16.3333Z" fill="#fff">
                        </path>
                    </svg>  
                </a>
            </div>
            <div class="mn-hm-ls" style="margin-top: 20px;">
                <a href="#"><li><span class="txtSdbar">Conta</span></li></a>
                <a href="#"><li><span class="txtSdbar">Pedidos</span></li></a>
                <a href="#"><li><span class="txtSdbar">Favoritos</span></li></a>
                <a href="#"><li><span class="txtSdbar">Novos Produtos</span></li></a>
                <a href="#"><li><span class="txtSdbar">Mais Procurados</span></li></a>
                @if (Auth::user()->user_type) 
                    <a href="/painel"><li><span class="txtSdbar">Painel</span></li></a>
                @endif 
            </div>
        </ul>
        <div class="sidebar-hym1">
        </div>
    </div>
    <div class="sdb-hbm">
        <button class="sidebarBtn sdb-btn btn-ajs">
            <a href="#" class="" style="">
                <svg width="30" height="20" viewBox="0 0 30 20" fill="currentColor" xmlns="https://www.w3.org/2000/svg" class="IconSandwich" data-testid="drawerButton">
                    <path d="M0.75 0.5H29.25V3.66667H0.75V0.5ZM0.75 8.41667H29.25V11.5833H0.75V8.41667ZM0.75 16.3333H29.25V19.5H0.75V16.3333Z" fill="#fff">
                    </path>
                </svg>  
            </a>
        </button>
    </div>
</div>

<script>
$(document).ready(() => {
    $('.mdiv-hym').click(() => {
        $('.sidebar-hym').removeClass('active');
    })
    $('.sch-br-hym').click(() => {
        $('.sidebar-hym').removeClass('active');
    })
})
</script>
