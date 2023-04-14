$(document).ready(function () {
    $("#promo_product_select").on("change", function () {
        let selectedValue = $(this).val();
        if (selectedValue == 0) {
            $("#product-price").val("");
            $("#product-promo-price").val("");
        }
        fillProductAttrs(selectedValue);
    });
});

function fillProductAttrs(id) {
    let url = `/api/v1/product/${id}`;

    $.ajax({
        type: "ajax",
        method: "get",
        async: false,
        url: url,
        dataType: "json",
        beforeSend: function() {
            $('.spinner-container').show();
        },
        success: function (data) {
            $("product-id-promo").val(id);
            $("#product-price").val(data.price);
            $("#category_id").val(data.category_id);
        },
        complete: function() {
            $('.spinner-container').hide();
        }
    });
}
