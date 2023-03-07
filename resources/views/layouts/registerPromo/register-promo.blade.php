<div class="row mDiv">
    @include('layouts.registerPromo.add-promo-product-modal')
    <div class="col">
        <div class="btnn np">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createProductPromoModal" id="createProductPromo">
                <i class="fas fa-plus-circle"></i>
            </button>
        </div>
        <div class="card">
            <div class="card-header text-center" style="color: black; font-size: 20px;">
                Promotions Registered
            </div>
            <div class="card-body">
                <table class="table table-dark table-striped">
                    <thead>   
                        <tr>
                            <td class="text-center">Name</td>
                            <td class="text-center">Price</td>
                            <td class="text-center">Promo Price</td>
                            <td class="text-center">Start Date</td>
                            <td class="text-center">End Date</td>
                            <td class="text-center">Edit</td>
                            <td class="text-center">Delete</td>
                        </tr>
                    </thead>  
                    <tbody>
                        @foreach ( $productsPromo as $productPromo )
                        <tr>       
                            <td class="text-center">{{ $productPromo->product->name }}</td>
                            <td class="text-center">{{ currency_format($productPromo->product->price) }}</td>
                            <td class="text-center">{{ currency_format($productPromo->promo_price) }}</td>
                            <td class="text-center">{{ $productPromo->start_date_promo }}</td>
                            <td class="text-center">{{ $productPromo->end_date_promo }}</td>
                            <td class="text-center">
                                <button class="btn btn-primary edit-product-promo" data-bs-toggle="modal" data-bs-target="#uploadProductPromoModal" id="updateProPromo" data-pro-promo="{{ $productPromo->id }}">
                                    <i class="fas fa-pen-nib"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-danger del-product-promo" data-bs-toggle="modal" data-bs-target="#deleteProductPromoModal" id="deleteProductPromo" data-pro-promo="{{ $productPromo->id }}">
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