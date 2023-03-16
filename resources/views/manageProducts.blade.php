<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Products</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>          
</head>
<body class="bd">
    @include('layouts.navbar')
    <div class="container mh">
        <div class="card cd-products">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="produtos-tab" data-bs-toggle="tab"
                        data-bs-target="#produtos-tab-pane" type="button" role="tab" 
                        aria-controls="produtos-tab-pane" aria-selected="true">Products</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="registerPromo-tab" data-bs-toggle="tab" 
                    data-bs-target="#registerPromo-tab-pane" type="button" role="tab" 
                    aria-controls="registerPromo-tab-pane" aria-selected="false">Register Promotion</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="produtos-tab-pane" role="tabpanel" aria-labelledby="produtos-tab" tabindex="0">
                    @include('layouts.listProducts.list-products')
                </div>
                <div class="tab-pane fade" id="registerPromo-tab-pane" role="tabpanel" aria-labelledby="registerPromo-tab" tabindex="0">
                    @include('layouts.registerPromo.register-promo')
                </div>
            </div>
        </div>
    </div>
</body>
</html>

{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Products</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>       
</head>
<body class="bd">
    @include('layouts.navbar')
    <div class="container mh">
        <div class="card cd-products">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="produtos-tab" data-bs-toggle="tab"
                        data-bs-target="#produtos-tab-pane" type="button" role="tab" 
                        aria-controls="produtos-tab-pane" aria-selected="true">Products</button>
                </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="registerPromo-tab" data-bs-toggle="tab" 
                  data-bs-target="#registerPromo-tab-pane" type="button" role="tab" 
                  aria-controls="registerPromo-tab-pane" aria-selected="false">Register Promotion</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="produtos-tab-pane" role="tabpanel" aria-labelledby="produtos-tab" tabindex="0">
                    @include('layouts.listProducts.list-products')
                </div>
                <div class="tab-pane fade" id="registerPromo-tab-pane" role="tabpanel" aria-labelledby="registerPromo-tab" tabindex="0">
                    @include('layouts.registerPromo.register-promo')
                </div>
            </div>
        </div>
    </div>
    
    <script>

    $(function() {
        $('.main-menu').hover(function() {
            $('.container').css('margin-left', '255px');
        }, function() {
            // on mouseout, reset the margin left
            $('.container').css('margin-left', '60px');
        });
    }); 

    $('.edit').click(function(){
        var idProduct = $(this).data('pro') 
        var url = '{{ route('getProduct', ":id") }}' 
        url = url.replace(":id", idProduct)

        var urlUpd = '{{ route('updateProduct', ":id") }}'
        urlUpd = urlUpd.replace(':id', idProduct)
        $("#updateProduct").attr('action', urlUpd)

        $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: url,
            dataType: 'json',
            success: function(data)
            {
                $('input[name=name]').val(data.name)
                $('input[name=price]').val(data.price)
                $('#categorias option[value="'+data.category_id+'"]').attr('selected', 'selected')
            }
        })
    })

    $("#updateProduct").submit(function(e){
        e.preventDefault();

        var formAction = $("#updateProduct").attr('action');
        var data = $('#updateProduct').serializeArray();

        var name = data[3].value;
        var price = data[4].value;
        var validate = '';

        if ( name != "" )
        {
             validate += '1';
        }
        if ( price != "" )
        {
            validate += '2';
        }

        if ( validate == '12' )
        {

            $.ajax({
                     type: 'ajax',
                     method: 'PUT',
                     url: formAction,
                     data: data,
                     async: false,
                     dataType: 'json',
                     success:  function(response)
                     {
                        $('#uploadProductModal').modal('hide');
                        // location.reload();
                     },
                     error: function(response)
                     {
                        console.error("Request has failed, contact the support team");
                     }
            })             
        }        
    })

    $('.del').click(function(){

        var idProduct = $(this).data("pro")
        var url = '{{ route('deleteProduct', ":id") }}'
        url = url.replace(':id', idProduct)

        $('#btnDeleteProduct').unbind().click(function() {

            $.ajax
            ({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async:false,
                url: url,
                dataType: 'json',
                success: function(response)
                {
                    $('#deleteProductModal').modal('hide');
                    location.reload();
                },
                error: function()
                {
                    console.error("Request has failed, contact the support team");
                }
            }) 

        });                
    })

    </script>

</body>
</html> --}}