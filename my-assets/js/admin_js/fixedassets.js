  "use strict";
 function supplier_due(id){
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + 'Fixedassets/supplier_previous',
            type: 'post',
            data: {supplier_id:id,csrf_test_name:csrf_test_name}, 
            success: function (msg){
                 var obj = JSON.parse(msg);
                $("#previous").val(obj.previous);
                $("#address").val(obj.address);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
    }

 "use strict";
    function supplier_info(sl) {

    var supplier_id = $('#supplier_id').val();
 supplier_due(supplier_id);

}

 "use strict";
function product_pur_or_list(sl) {

    var supplier_id = $('#supplier_id').val();
    if (supplier_id == 0) {
        alert('Please select supplier !');
        return false;
    }

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
        var item_code = $('#item_code_'+sl).val();
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        $.ajax( {
          url: base_url + "Fixedassets/searchafixedasset",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            item_code:item_code,
            csrf_test_name:csrf_test_name
          },
          success: function( data ) {
            response( data );
          }
        });
      },
       focus: function( event, ui ) {
           $(this).val(ui.item.label);
           return false;
       },
       select: function( event, ui ) {
            $(this).parent().parent().find(".autocomplete_hidden_value").val(ui.item.value); 
            var sl = $(this).parent().parent().find(".sl").val(); 

            var asset_item_code  = ui.item.value;
            var base_url    = $('.baseUrl').val();
            var available_quantity    = 'available_quantity_'+sl;
            var item_price    = 'item_price_'+sl;
            var item_name    = 'item_name_'+sl;
            var csrf_test_name = $('[name="csrf_test_name"]').val();
            $.ajax({
                type: "POST",
                url: base_url+"Fixedassets/retrieve_asset_data",
                 data: {asset_item_code:asset_item_code,csrf_test_name:csrf_test_name},
                cache: false,
                success: function(data)
                {
                    console.log(data);
                   var  obj = JSON.parse(data);
                    $('#'+item_price).val(obj.purchase_price);
                    $('#'+item_name).val(obj.item_name);
                  
                } 
            });

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keydown.autocomplete', '.item_code', function() {
       $(this).autocomplete(options);
   });

}



var limits = 500;

 "use strict";
    function addPurchaseOrderField1Fixedassets(divName){

   var row = $("#fixpurchaseTable tbody tr").length;
       var count = row + 1;
        if (count == limits)  {
            alert("You have reached the limit of adding " + count + " inputs");
        }
        else{
            var newdiv = document.createElement('tr');
            var tabin="item_code_"+count,
             tabindex = count * 4 ,
           newdiv = document.createElement("tr"),
            tab1 = tabindex + 1,
            tab2 = tabindex + 2,
            tab3 = tabindex + 3,
            tab4 = tabindex + 4,
            tab5 = tabindex + 5,
            tab6 = tab5 + 1,
            tab7 = tab6 +1;
           


            newdiv.innerHTML ='<td class="span3 supplier"><input type="text" name="item_codesss" required class="form-control item_code productSelection" onkeypress="product_pur_or_list('+ count +');" placeholder="Item code" id="item_code_'+ count +'" tabindex="'+tab1+'" > <input type="hidden" class="autocomplete_hidden_value item_code_'+ count +'" name="item_code[]" id="SchoolHiddenId"/>  <input type="hidden" class="sl" value="'+ count +'">  </td> <td class="span3 "><input type="text" name="item_name" class="form-control item_name " placeholder="Item Name" id="item_name_'+ count +'" tabindex="5" readonly> </td>  <td class="text-right"><input type="text" name="item_qty[]" tabindex="'+tab2+'" required  id="cartoon_'+ count +'" class="form-control text-right store_cal_' + count + '" onkeyup="calculate_store(' + count + ');" onchange="calculate_store(' + count + ');" placeholder="0.00" value="" min="0"/>  </td><td class="test"><input type="text" name="item_price[]" onkeyup="calculate_store('+ count +');" onchange="calculate_store('+ count +');" id="item_price_'+ count +'" class="form-control item_price_'+ count +' text-right" placeholder="0.00" value="" min="0" tabindex="'+tab3+'"/></td><td class="text-right"><input class="form-control total_price text-right total_price_'+ count +'" type="text" name="total_price[]" id="total_price_'+ count +'" value="0.00" readonly="readonly" /> </td><td> <input type="hidden" id="total_discount_1" class="" /><input type="hidden" id="all_discount_1" class="total_discount" /><button type="button" class="btn btn-danger" tabindex="12" onclick="deleteRowfix(this)"><i class="fa fa-close"></i></button></td>';
            document.getElementById(divName).appendChild(newdiv);
            document.getElementById(tabin).focus();
            document.getElementById("add_invoice_item").setAttribute("tabindex", tab5);
            document.getElementById("add_purchase").setAttribute("tabindex", tab6);
           
            count++;

            $("select.form-control:not(.dont-select-me)").select2({
                placeholder: "Select option",
                allowClear: true
            });
        }
    }

    //Calculate store product
     "use strict";
    function calculate_store(sl) {
       
        var totle = 0;
        var gr_tot= 0;
        var item_ctn_qty    = $("#cartoon_"+sl).val();
        var vendor_rate = $("#item_price_"+sl).val();
        var total_price     = item_ctn_qty * vendor_rate;
        $("#total_price_"+sl).val(total_price.toFixed(2));

       
        //Total Price
        $(".total_price").each(function() {
            isNaN(this.value) || 0 == this.value.length || (totle += parseFloat(this.value))
        });

        $("#total").val(totle.toFixed(2,2));
         var gr_tot = totle;
          $("#grandTotal").val(gr_tot.toFixed(2));
       
    }

    "use strict";
    function deleteRowfix(t) {
    var a = $("#fixpurchaseTable > tbody > tr").length;
    if (1 == a) alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e), 
        calculate_store();
    }
}