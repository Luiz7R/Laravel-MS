<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Basket</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">    
    <link rel="stylesheet" href="{{ asset('css/stylesHome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <script type="text/javascript" src="{{ asset('js/jquery.min.js') }}"></script>    
    <script type="text/javascript" src="{{ asset('js/popper.min.js') }}"></script>   
    <script type="text/javascript" src="{{ asset('js/bootstrap.min.js') }}"></script>          
</head>
<body class="bd">
    @include('layouts.main.mainbar')
    @include('layouts.navbar-items')
    <h1>Basket</h1>

    <div class="modal" id="removeProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="titleModalRemoveProduct">Remove Product</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> 
              </div>
              <div class="modal-body" style="">
                  Are you sure you want to remove from Basket?
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger" id="btnRemoveProduct">Remove</button>
              </div>  
          </div>     
      </div>    
    </div>

    <div class="card">
        <div class="card-body">
            @foreach($basketItems as $item)
            <div class="row">
                <div class="col-sm-3 p-4">
                    <p>{{ $item->product->name }}</p>
                </div>
                <div class="col-sm-3 p-4">
                    <p id="price-{{$item->id}}" class="price-prod" data-price="{{ $item->product->price }}">
                        {{ currency_format($item->product->price) }}
                    </p>
                </div>
                <div class="col-sm-3">
                      <div class="card-quantity">
                          Quant.
                          <input class="form-control qnt" 
                            type="number" name="quantity" 
                            min="1"
                            id="quantity-{{ $item->id }}"
                            data-product-id="{{ $item->id }}"
                            onclick="updateValue({{ $item->id }}, this)" 
                            value="{{ $item->quantity }}">
                      </div>
                </div>
                <div class="col-sm-3 p-4">
                  <button class="btn btn-danger del" data-bs-toggle="modal" data-bs-target="#removeProductModal" id="removeProductBasket" data-product="{{ $item->id }}">
                    <i class="far fa-trash-alt"></i>
                  </button>
                </div>
            </div>
            <div class="divider-prod"></div>
            @endforeach
        </div>
        <div class="card-footer">
          <div class="buttons">
            <button class="btn-basket back" onclick="goBack()">Go Back</button>
            <button type="button" class="btn-basket checkout">Go to Checkout</button>
          </div>
        </div>
    </div>

    <script>
          $(document).ready(function() {
              let productsPrice = document.querySelectorAll('.price-prod');
              
              productsPrice.forEach(element => {
                  let id = element.id.replace("price-", "");
                  let quantidade = $("#quantity-"+id);
                  let resposta = quantidade.val() * element.dataset.price;
                  element.innerText = maskDolar(resposta)
              });
          })


          function goBack() {
            window.history.back();
          }
          function goToCheckout() {
            window.location.href = "https://example.com/checkout";
          }

          function updateValue(id, quantidade) {
            let basketPrice = $('#price-'+id);

            if ( quantidade.value == 1 ) {
              basketPrice.text(maskDolar(basketPrice.data('price')))
              return;
            }
            const resposta = basketPrice.data('price') * quantidade.value
            basketPrice.text(maskDolar(resposta))
          }

          $(document).on('change', '.qnt', function() {
            var productId = $(this).data('product-id');
            var newQuantity = $(this).val();
            let patchurl = '/basket/' + productId;

            $.ajax({
              url: patchurl,
              type: 'PATCH',
              data: { quantity: newQuantity },
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success: function(response) {
                console.log('Quantity updated successfully');
              },
              error: function(jqXHR, textStatus, errorThrown) {
                console.error('Error updating quantity: ' + textStatus);
              }
            });
          });

          $('.del').click(function(){
              var idProductBasket = $(this).data("cat")
              var url = '{{ route('removeProduct', ":id") }}'
              url = url.replace(':id', idProductBasket)

              $('#btnRemoveProduct').unbind().click(function() {

                  $.ajax
                  ({
                      type: "DELETE",
                      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                      async:false,
                      url: url,
                      dataType: 'json',
                      success: function(response)
                      {
                          $('#removeProductModal').modal('hide');
                          location.reload();
                      },
                      error: function()
                      {
                          console.error("Request has failed, contact the support team");
                      }
                  }) 

              });                
          })

          function maskDolar(valor) {
            return valor.toLocaleString("en-US", {style: "currency", currency: "USD"});
          }
    </script>

</body>