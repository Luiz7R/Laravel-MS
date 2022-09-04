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
        <div class="modal fade" id="createProductModal" tabindex="-1" aria-labelledby="createProductModal" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">New Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('postProduct') }}">
                    @csrf
                    @method('POST')                    
                    <div class="mb-3">
                        <label for="categorias" class="col-form-label">Categorias:</label>
                        <select class="form-control" name="category_id" id="categorias">
                            @foreach ( $categories as $categorie)
                                    <option value="{{$categorie->id}}"> {{$categorie->category_name}} </option>
                            @endforeach
                        </select>                      
                    </div>  
                    <div class="mb-3">
                        <label for="name" class="col-form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="col-form-label">Price:</label>
                        <input type="text" class="form-control" id="price" name="price">
                    </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
        <div class="modal fade" id="uploadProductModal" tabindex="-1" aria-labelledby="uploadProductModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form method="PUT" id="updateProduct">
                      @csrf
                      @method('PUT')                    
                      <div class="mb-3">
                          <label for="categorias" class="col-form-label">Categories:</label>
                          <select class="form-control" name="category_id" id="categorias">
                              @foreach ( $categories as $categorie)
                                      <option value="{{$categorie->id}}"> {{$categorie->category_name}} </option>
                              @endforeach
                          </select>                      
                      </div>  
                      <div class="mb-3">
                          <label for="name" class="col-form-label">Name:</label>
                          <input type="text" class="form-control" id="name" name="name">
                      </div>
                      <div class="mb-3">
                          <label for="price" class="col-form-label">Price:</label>
                          <input type="text" class="form-control" id="price" name="price">
                      </div>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save</button>
                      </div>
                  </form>
              </div>
            </div>
        </div>

        <div class="modal" id="deleteProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModalDeleteProduct">Delete Product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                    </div>
                    <div class="modal-body" style="">
                        Are you sure you want to delete the product?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="btnDeleteProduct">Delete</button>
                    </div>  
                </div>     
            </div>    
        </div>

        <div class="row mDiv">
            <div class="col">
                <div class="btnn np">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductModal" id="createProduct">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
                <div class="card">
                    <div class="card-header text-center" style="color: black; font-size: 20px;">
                        Products
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <td class="text-center">Name</td>
                                    <td class="text-center">Price</td>
                                    <td class="text-center">Edit</td>
                                    <td class="text-center">Delete</td>
                                </tr>
                            </thead>  
                            <tbody>                      
                                @foreach ( $products as $product )
                                <tr>
                                    <td class="text-center">{{ $product->name }}</td>
                                    <td class="text-center">{{ $product->price }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#uploadProductModal" id="uploadProduct" data-pro="{{ $product->id }}">
                                            <i class="fas fa-pen-nib"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger del" data-bs-toggle="modal" data-bs-target="#deleteProductModal" id="deleteProduct" data-pro="{{ $product->id }}">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>    
                                @endforeach
                            </tbody>
                        </table>                        
                    </div>
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
</html>