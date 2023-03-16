<script src="{{ asset('js/products/index.js') }}"></script>
<div class="modal fade" id="createProductPromoModal" tabindex="-1" aria-labelledby="createProductPromoModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">New Promo Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="POST" action="{{ route('postPromoProduct') }}">
              @csrf
              @method('POST')                    
              <div class="mb-3">
                  <input type="hidden" name="" id="product-id" name="product-id">
                  <label for="categorias" class="col-form-label">Categorias:</label>
                  <select class="form-control" name="category_id" id="categorias">
                      @foreach ( $categories as $categorie)
                              <option value="{{$categorie->id}}"> {{$categorie->category_name}} </option>
                      @endforeach
                  </select>                      
              </div>  
              <div class="mb-3">
                  <label for="name-promo-product" class="col-form-label">Name:</label>
                  <select class="form-control" name="product_id" id="promo_product_select">
                    <option value="0" selected>--- Select ---</option>
                    @foreach ( $productsWithoutPromo as $product)
                            <option value="{{$product->id}}">{{$product->name}}</option>
                    @endforeach
                </select>   
              </div>
              <div class="mb-3">
                  <label for="price" class="col-form-label">Price:</label>
                  <input type="text" class="form-control" id="product-price" name="product-price" disabled>
              </div>
              <div class="mb-3">
                <label for="price" class="col-form-label">Promo Price:</label>
                <input type="text" class="form-control" id="product_promo_price" name="product_promo_price">
              </div>
              <div class="mb-3">
                <label for="start-date" class="col-form-label">Start Date:</label>
                <input type="datetime-local" class="form-control" name="start_date_promo">
              </div>
              <div class="mb-3">
                <label for="end-date" class="col-form-label">End Date:</label>
                <input type="datetime-local" class="form-control" name="end_date_promo">
              </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Create</button>
              </div>
          </form>
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
</div>