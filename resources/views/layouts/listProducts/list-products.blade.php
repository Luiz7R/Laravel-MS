<div class="row mDiv">
    @include('layouts.listProducts.add-product-modal')
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
                            <td class="text-center">{{ currency_format($product->price) }}</td>
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