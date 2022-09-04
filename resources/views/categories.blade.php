<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Categories</title>

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
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="createCategoryModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="{{ route('postCategory') }}">
                        <div class="modal-body">
                            @csrf
                            @method('POST')
                            <div class="mb-3">                   
                            </div>  
                            <div class="mb-3">
                            <label for="name" class="col-form-label">Category Name:</label>
                            <input type="text" class="form-control" id="category_name" name="category_name">
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

        <div class="modal fade" id="uploadCategoryModal" tabindex="-1" aria-labelledby="uploadCategoryModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="PUT" id="updateCategory">
                        <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">                   
                            </div>  
                            <div class="mb-3">
                            <label for="name" class="col-form-label">Category Name:</label>
                            <input type="text" class="form-control" id="categoryName" name="category_name">
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
        
        <div class="modal" id="deleteCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="titleModalDeleteProduct">Delete Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
                    </div>
                    <div class="modal-body" style="">
                        Are you sure you want to delete the Category?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="btnDeleteCategory">Delete</button>
                    </div>  
                </div>     
            </div>    
        </div>

        <div class="row mDiv">
            <div class="col">
                <div class="btnn np">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCategoryModal" id="createCategorie">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </div>
                <div class="card">
                    <div class="card-header text-center" style="color: black; font-size: 20px;">
                        Categories
                    </div>
                    <div class="card-body">
                        <table class="table table-dark table-striped">
                            <thead>
                                <tr>
                                    <td class="text-center">Category Name</td>
                                    <td class="text-center">Edit</td>
                                    <td class="text-center">Delete</td>
                                </tr>
                            </thead>  
                            <tbody>                      
                                @foreach ( $categories as $categorie )
                                <tr>
                                    <td class="text-center">{{ $categorie->category_name }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary edit" data-bs-toggle="modal" data-bs-target="#uploadCategoryModal" id="uploadCategory" data-cat="{{ $categorie->id }}">
                                            <i class="fas fa-pen-nib"></i>
                                        </button>
                                    </td>
                                    <td class="text-center">
                                        <button class="btn btn-danger del" data-bs-toggle="modal" data-bs-target="#deleteCategoryModal" id="deleteCategory" data-cat="{{ $categorie->id }}">
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

    $("#createCategoryModal").click(function(){
        // $('input[name=category_name]').val('')
    })

    $('.edit').click(function(){
        var idCategory = $(this).data('cat') 
        var url = '{{ route('getCategory', ":id") }}' 
        url = url.replace(":id", idCategory)

        var urlUpd = '{{ route('updateCategory', ":id") }}'
        urlUpd = urlUpd.replace(':id', idCategory)
        $("#updateCategory").attr('action', urlUpd)

        $.ajax({
            type: 'ajax',
            method: 'get',
            async: false,
            url: url,
            dataType: 'json',
            success: function(data)
            {
                $('#categoryName').val(data.category_name)
            }
        })
    })

    $("#updateCategory").submit(function(e){
        e.preventDefault();

        var formAction = $("#updateCategory").attr('action');
        var data = $('#updateCategory').serializeArray();

        var categoryName = data[2].value;
        var validate = '';

        if ( categoryName != "" )
        {
             validate += '1';
        }

        if ( validate == '1' )
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
                        location.reload();
                     },
                     error: function(response)
                     {
                        console.error("Request has failed, contact the support team");
                     }
            })             
        }        
    })

    $('.del').click(function(){

        var idCategory = $(this).data("cat")
        var url = '{{ route('deleteCategory', ":id") }}'
        url = url.replace(':id', idCategory)

        $('#btnDeleteCategory').unbind().click(function() {

            $.ajax
            ({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                async:false,
                url: url,
                dataType: 'json',
                success: function(response)
                {
                    $('#deleteCategoryModal').modal('hide');
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