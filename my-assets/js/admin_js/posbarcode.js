           window.onload = function () {
          var text_input = document.getElementById('add_item_p');
        text_input.focus();
        text_input.select();

        $('body').addClass("sidebar-mini sidebar-collapse");
    }

   $(function($){
    var barcodeScannerTimer;
    var barcodeString = '';
  $('#add_item_p').on('keypress', function (e) {
    barcodeString = barcodeString + String.fromCharCode(e.charCode);
    clearTimeout(barcodeScannerTimer);
    barcodeScannerTimer = setTimeout(function () {
        processBarcode();
    }, 300);
});

function processBarcode() {

    if (!isNaN(barcodeString) && barcodeString != '') {  
         var product_id = barcodeString;
         var exist = $("#product_id_" + product_id).val();
         var qty = $("#total_qntt_" + product_id).val();
          var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
         var add_qty = parseInt(qty)+1;
         if(product_id == exist){
            $("#total_qntt_" + product_id).val(add_qty);
           quantity_calculate(product_id);
            calculateSum();
            invoice_paidamount();
           document.getElementById('add_item_p').value = '';
           document.getElementById('add_item_p').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
                url: base_url + 'Cinvoice/insert_pos_invoice',
                data: {product_id: product_id,csrf_test_name:csrf_test_name},
                success: function (data) {
                    if (data == false) {
                        alert('This Product Not Found !');
                        document.getElementById('add_item_p').value = '';
                        document.getElementById('add_item_p').focus();
                        quantity_calculate(product_id);
                         calculateSum();
                        invoice_paidamount();
                    } else {
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item_p').value = '';
                        document.getElementById('add_item_p').focus();
                        $('#normalinvoice tbody').append(data);
                        calculateSum();
                        invoice_paidamount();
                    }
                },
                error: function () {
                    alert('Request Failed, Please check your code and try again!');
                }
            });
        }
    } else {
        alert('barcode is invalid: ' + barcodeString);
    }

    barcodeString = ''; 
}

});