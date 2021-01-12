         window.onload = function () {
          var text_input = document.getElementById('add_item');
        text_input.focus();
        text_input.select();

        $('body').addClass("sidebar-mini sidebar-collapse");
    }
  // capture barcode scanner input
    $(function($){
    var barcodeScannerTimer;
    var barcodeString = '';

$('#add_item').on('keypress', function (e) {
    barcodeString = barcodeString + String.fromCharCode(e.charCode);

    clearTimeout(barcodeScannerTimer);
    barcodeScannerTimer = setTimeout(function () {
        processbarcodeGui();
    }, 300);
});


 function processbarcodeGui() {

    if (barcodeString != '') {  
         var product_id = barcodeString;
         var exist = $("#SchoolHiddenId_" + product_id).val();
         var qty = $("#total_qntt_" + product_id).val();
         var add_qty = parseInt(qty)+1;
          var csrf_test_name = $('[name="csrf_test_name"]').val();
          var base_url = $('#base_url').val();
         if(product_id == exist){
            $("#total_qntt_" + product_id).val(add_qty);
           quantity_calculate(product_id);
            calculateSum();
            invoice_paidamount();
           document.getElementById('add_item').value = '';
           document.getElementById('add_item').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
                url: base_url + 'Cinvoice/gui_pos_invoice',
                data: {product_id: product_id,csrf_test_name:csrf_test_name},
                success: function (data) {
                    if (data == false) {
                        alert('This Product Not Found !');
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
                        quantity_calculate();
                         calculateSum(barcodeString);
                        invoice_paidamount();
                    } else {
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item').value = '';
                        document.getElementById('add_item').focus();
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

 $(document).ready(function() {
    var barcodeScannerTimer;
    var barcodeString = '';
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var base_url = $('#base_url').val();
           $('#add_item_m_g').keydown(function (e) {
        if (e.keyCode == 13) {
            var product_id = $(this).val();
        var product_id = $(this).val();
        var exist = $("#SchoolHiddenId_" + product_id).val();
         var qty = $("#total_qntt_" + product_id).val();
         var add_qty = parseInt(qty)+1;
         if(product_id == exist){
            $("#total_qntt_" + product_id).val(add_qty);
           quantity_calculate(product_id);
            calculateSum();
            invoice_paidamount();
           document.getElementById('add_item_m_g').value = '';
           document.getElementById('add_item_m_g').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
             url: base_url + 'Cinvoice/gui_pos_invoice',
                data: {product_id: product_id,csrf_test_name:csrf_test_name},
                success: function (data) {
                    if (data == false) {
                        alert('This Product Not Found !');
                        document.getElementById('add_item_m_g').value = '';
                        document.getElementById('add_item_m_g').focus();
                        quantity_calculate(product_id);
                         calculateSum();
                       
                        invoice_paidamount();
                    } else {
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item_m_g').value = '';
                        document.getElementById('add_item_m_g').focus();
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
        }
    });
     });


    








