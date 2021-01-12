//Add Input Field Of Row
"use strict";
function addInputField(t) {
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
    var limits = 500;
     var taxnumber = $("#txfieldnum").val();
    var tbfild ='';
    for(var i=0;i<taxnumber;i++){
        var taxincrefield = '<input id="total_tax'+i+'_'+count+'" class="total_tax'+i+'_'+count+'" type="hidden"><input id="all_tax'+i+'_'+count+'" class="total_tax'+i+'" type="hidden" name="tax[]">';
         tbfild +=taxincrefield;
    }
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name_" + count,
            tabindex = count * 5,
            e = document.createElement("tr"),
            tab1 = tabindex + 1,
            tab2 = tabindex + 2,
            tab3 = tabindex + 3,
            tab4 = tabindex + 4,
            tab5 = tabindex + 5,
            tab6 = tabindex + 6,
            tab7 = tabindex + 7,
            tab8 = tabindex + 8,
            tab9 = tabindex + 9,
            tab10 = tabindex + 10,
            tab11 = tabindex + 11;
        e.innerHTML = "<td><input type='text' name='product_name' onkeyup='invoice_productList(" + count + ")' onkeypress='invoice_productList(" + count + ")' class='form-control productSelection' placeholder='Medicine Name' id='" + a + "' required tabindex='"+tab1+"'><input type='hidden' class='autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='product_id_" + count + "'/></td><td><select class='form-control' required id='batch_id_" + count + "'  name='batch_id[]' onchange='product_stock(" + count + ")' tabindex='"+tab2+"'><option></option></select>     <td><input type='text' name='available_quantity[]' id='available_quantity_" + count + "' class='form-control text-right available_quantity_" + count + "' value='0' readonly='readonly' /></td> <td id='expire_date_" + count + "'></td><td><input class='form-control text-right unit_" + count + " valid' value='None' readonly='' aria-invalid='false' type='text'></td><td> <input type='text' name='product_quantity[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='total_qntt_" + count + " form-control text-right allownumericwithdecimal' placeholder='0.00' min='0' tabindex='"+tab3+"' required/></td><td><input type='text' name='product_rate[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' class='price_item"+count+" form-control text-right allownumericwithdecimal' required placeholder='0.00' readonly min='0' tabindex='"+tab4+"'/></td><td><input type='text' name='discount[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right allownumericwithdecimal' placeholder='0.00' min='0' tabindex='"+tab5+"' /><input type='hidden' value='' name='discount_type' id='discount_type_" + count + "'></td><td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></td><td>" + tbfild + "<input type='hidden' id='all_discount_" + count + "' class='total_discount dppr'/><a tabindex='"+tab6+"' style='text-align: right;' class='btn btn-danger'  value='Delete' onclick='deleteRow(this)'><i class='fa fa-close'></i></a></td>", 
        document.getElementById(t).appendChild(e), 
        document.getElementById(a).focus(),
        document.getElementById("add_invoice_item").setAttribute("tabindex", tab7);
        document.getElementById("invdcount").setAttribute("tabindex", tab8);
         document.getElementById("paidAmount").setAttribute("tabindex", tab9);
        document.getElementById("full_paid_tab").setAttribute("tabindex", tab10);
        document.getElementById("add_invoice").setAttribute("tabindex", tab11);
        count++
    }
}

//Edit invoice field
"use strict";
function editInputField(t) {
    var row = $("#normalinvoice tbody tr").length;
    var count = row + 1;
    var limits = 500;
    if (count == limits) alert("You have reached the limit of adding " + count + " inputs");
    else {
        var a = "product_name" + count,
            tabindex = count * 5,
            e = document.createElement("tr"),
            tab1 = tabindex + 1,
            tab2 = tabindex + 2,
            tab3 = tabindex + 3,
            tab4 = tabindex + 4,
            tab5 = tabindex + 5,
            tab6 = tabindex + 6,
            tab7 = tabindex + 7,
            tab8 = tabindex + 8,
            tab9 = tabindex + 9;
        e.innerHTML = "<td><input type='text' name='product_name' onkeyup='invoice_productList(" + count + ");' class='form-control productSelection' placeholder='Product Name' id='" + a + "' required tabindex='"+tab1+"'><input type='hidden' class='autocomplete_hidden_value  product_id_" + count + "' name='product_id[]' id='SchoolHiddenId'/></td><td><select class='form-control' id='batch_id_" + count + "' name='batch_id[]' onchange='product_stock(" + count + ")'><option></option></select>     <td><input type='text' name='available_quantity[]' id='available_quantity_" + count + "' class='form-control text-right available_quantity_" + count + "' value='0' readonly='readonly' /></td> <td id='expire_date_" + count + "'></td><td><input class='form-control text-right unit_" + count + " valid' value='None' readonly='' aria-invalid='false' type='text'></td><td> <input type='text' name='product_quantity[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='total_qntt_" + count + "' class='total_qntt_" + count + " form-control text-right' placeholder='0.00' min='0' tabindex='"+tab2+"'/></td><td><input type='text' name='product_rate[]' readonly onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='price_item_" + count + "' readonly class='price_item"+count+" form-control text-right' required placeholder='0.00' min='0' tabindex='"+tab3+"'/></td><td><input type='text' name='discount[]' onkeyup='quantity_calculate(" + count + "),checkqty(" + count + ");' onchange='quantity_calculate(" + count + ");' id='discount_" + count + "' class='form-control text-right' placeholder='0.00' min='0' tabindex='"+tab4+"' /><input type='hidden' value='' name='discount_type' id='discount_type_" + count + "'></td><td class='text-right'><input class='total_price form-control text-right' type='text' name='total_price[]' id='total_price_" + count + "' value='0.00' readonly='readonly'/></td><td><input type='hidden' id='total_tax_" + count + "' class='total_tax_" + count + "' /><input type='hidden' id='all_tax_" + count + "' class=' total_tax' name='tax[]'/><input type='hidden'  id='total_discount_" + count + "' class='total_tax_" + count + "' /><input type='hidden' id='all_discount_" + count + "' class='total_discount'/><button tabindex='"+tab5+"' style='text-align: right;' class='btn btn-danger' type='button' value='Delete' onclick='deleteRow(this)'>Delete</button></td>", 
        document.getElementById(t).appendChild(e), 
        document.getElementById(a).focus(),
        document.getElementById("add_invoice_item").setAttribute("tabindex", tab6);
        document.getElementById("paidAmount").setAttribute("tabindex", tab7);
        document.getElementById("full_paid_tab").setAttribute("tabindex", tab8);
        document.getElementById("add_invoice_item").setAttribute("tabindex", tab9);
        count++
    }
}

//Quantity calculat
"use strict";
function quantity_calculate(item) {
    var quantity    = $("#total_qntt_" + item).val();
    var price_item  = $("#price_item_" + item).val();
    var discount    = $("#discount_" + item).val();
    var invoice_discount = $("#invdcount").val();
    var total_tax   = $("#total_tax_" + item).val();
    var total_discount = $("#total_discount_" + item).val();
    var dis_type    = $("#discount_type_" + item).val();
    var taxnumber = $("#txfieldnum").val();

var available_quantity = $("#available_quantity_" + item).val();
    if (parseInt(quantity) > parseInt(available_quantity)) {
        var message = "You can Sale maximum " + available_quantity + " Items";
         $("#total_qntt_" + item).val('');
        var quantity = 0;
         alert(message);
        $("#total_price_" + item).val(0);
        for(var i=0;i<taxnumber;i++){
        $("#all_tax"+i+"_" + item).val(0);
         
    }
       
        
    }
        

    if (quantity > 0 || discount > 0) {
        if (dis_type == 1) {
           var price = quantity * price_item;
            var dis = +(price * discount / 100)+  + invoice_discount;
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var temp = price - dis;
            var ttletax = 0;
            $("#total_price_" + item).val(temp);
             for(var i=0;i<taxnumber;i++){
           var tax = (temp-ttletax) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }


        }else if(dis_type == 2){
            var price = quantity * price_item;
            // Discount cal per product
            var dis   = discount * quantity;
            $("#all_discount_" + item).val(dis);

            //Total price calculate per product
             var temp = price - dis;
            $("#total_price_" + item).val(temp);

            var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (temp-ttletax) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }

        }else if(dis_type == 3){
             var total_price = quantity * price_item;
             var dis =  discount;
            // Discount cal per product
            $("#all_discount_" + item).val(dis);
            //Total price calculate per product
            var price = total_price - dis;
            $("#total_price_" + item).val(price);

             var ttletax = 0;
             for(var i=0;i<taxnumber;i++){
           var tax = (price-ttletax) * $("#total_tax"+i+"_" + item).val();
           ttletax += Number(tax);
            $("#all_tax"+i+"_" + item).val(tax);
    }
        }
    }else {
        var n = quantity * price_item;
        var c = quantity * price_item * total_tax;
        $("#total_price_" + item).val(n), 
        $("#all_tax_" + item).val(c)
    }
    calculateSum();
    invoice_paidamount();
}
//Calculate Sum
"use strict";
function calculateSum() {
document.getElementById("change").value = '';
  var taxnumber = $("#txfieldnum").val();

    var t = 0,
        a = 0,
        e = 0,
        o = 0,
        f = 0,
        p = 0,
        ad = 0,
        tx = 0,
        ds = 0,
     invdis =  $("#invdcount").val();
    //Total Tax
      for(var i=0;i<taxnumber;i++){
      
var j = 0;
    $(".total_tax"+i).each(function () {
        isNaN(this.value) || 0 == this.value.length || (j += parseFloat(this.value))
    });
            $("#total_tax_amount"+i).val(j.toFixed(2, 2));
             
    }
    //Total Discount
    $(".total_discount").each(function() {
        isNaN(this.value) || 0 == this.value.length || (p += parseFloat(this.value))
    }), 
    
    $("#total_discount_ammount").val(p.toFixed(2,2)), 

     $(".totalTax").each(function () {
        isNaN(this.value) || 0 == this.value.length || (f += parseFloat(this.value))
    }),
            $("#total_tax_amount").val(f.toFixed(2, 2)),

    //Total Price
    $(".total_price").each(function() {
        isNaN(this.value) || 0 == this.value.length || (t += parseFloat(this.value))
    }),
     $(".dppr").each(function () {
        isNaN(this.value) || 0 == this.value.length || (ad += parseFloat(this.value))
    }), 

    o = a.toFixed(2,2), 
    e = t.toFixed(2,2),
    tx = f.toFixed(2, 2),
    ds = p.toFixed(2, 2);

    var test = +tx + +e + -ds+ -invdis+ + ad;
    var totaldiscount = +ds + +invdis;
    $("#grandTotal").val(test.toFixed(2, 2));
     $("#total_discount_ammount").val(totaldiscount.toFixed(2, 2));
 var previous    = $("#previous").val();
 var gt          = $("#grandTotal").val();
   
   var grnt_totals = +gt+ +previous;
   $("#n_total").val(grnt_totals.toFixed(2,2));
   invoice_paidamount();

}

//Invoice Paid Amount
"use strict";
function invoice_paidamount() {
    var d = 0;
    var t = $("#n_total").val(),
        a = $("#paidAmount").val(),
        e = t - a;
        d = a - t;
        if(e > 0){
    $("#dueAmmount").val(e.toFixed(2,2))
}else{
  $("#dueAmmount").val(0)   
   $("#change").val(d.toFixed(2,2))

}
}
//Stock Limit
"use strict";
function stockLimit(t) {
    var a = $("#total_qntt_" + t).val(),
        e = $(".product_id_" + t).val(),
        csrf_test_name = $('[name="csrf_test_name"]').val(),
        o = $(".baseUrl").val();
    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e,csrf_test_name:csrf_test_name
        },
        cache: !1,
        success: function(e) {
            if (a > Number(e)) {
                var o = "You can purchase maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0")
            }
        }
    })
}

"use strict";
function stockLimitAjax(t) {
    var a = $("#total_qntt_" + t).val(),
        e = $(".product_id_" + t).val(),
     csrf_test_name = $('[name="csrf_test_name"]').val(),
        o = $(".baseUrl").val();
    $.ajax({
        type: "POST",
        url: o + "Cinvoice/product_stock_check",
        data: {
            product_id: e,csrf_test_name:csrf_test_name
        },
        cache: !1,
        success: function(e) {
            if (a > Number(e)) {
                var o = "You can purchase maximum " + e + " Items";
                alert(o), $("#qty_item_" + t).val("0"), $("#total_qntt_" + t).val("0"), $("#total_price_" + t).val("0.00"), calculateSum()
            }
        }
    })
}

//Invoice full paid
"use strict";
function full_paid() {
    var grandTotal = $("#n_total").val();
    $("#paidAmount").val(grandTotal);
    invoice_paidamount();
    calculateSum();
}

"use strict";
function invoice_discount(){
   var gt = $("#n_total").val();
   var invdis    = $("#invdcount").val();
   var grnt_totals = gt-invdis;
   
   $("#total_discount_ammount").val(grnt_totals.toFixed(2,2))
   $("#invtotal").val(grnt_totals.toFixed(2,2))
   $("#dueAmmount").val(grnt_totals.toFixed(2,2))

}
//Delete a row of table
"use strict";
function deleteRow(t) {
    var a = $("#normalinvoice > tbody > tr").length;
    if (1 == a) alert("There only one row you can't delete.");
    else {
        var e = t.parentNode.parentNode;
        e.parentNode.removeChild(e), 
        calculateSum();
        invoice_paidamount();
    }
}
var count = 2,
    limits = 500;


$(document).ready(function() {
     "use strict";
   var frm = $("#insert_sale");
    var output = $("#output");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            dataType : 'json',
            data : frm.serialize(),
            success: function(data) 
            {
                if (data.status == true) {
                    output.empty().html(data.message).addClass('alert-success').removeClass('alert-danger').removeClass('hide');
              
                    $("#inv_id").val(data.invoice_id);
                  $('#printconfirmodal').modal('show');
                   if(data.status == true && event.keyCode == 13) {
                 
        }
                  
                } else {
                    output.empty().html(data.exception).addClass('alert-danger').removeClass('alert-success').removeClass('hide');
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });


 $("#printconfirmodal").on('keydown', function ( e ) {
var key = e.which || e.keyCode;
if (key == 13) {
   $('#yes').trigger('click');
}
});

  "use strict";
function cancelprint(){
   location.reload();
}




  "use strict";
function product_stock(sl) {

            var  batch_id    = $('#batch_id_'+sl).val();
            var dataString   = 'batch_id='+ batch_id;
            var product_id   = $('#product_id_'+sl).val();
            var available_quantity = 'available_quantity_'+sl;
            var product_rate = 'product_rate_'+sl;
            var expire_date  = 'expire_date_'+sl;
             var csrf_test_name = $('[name="csrf_test_name"]').val();
            var base_url     = $('#base_url').val();
             $.ajax({
                type: "POST",
                url: base_url+"Cinvoice/retrieve_product_batchid",
                data: {batch_id:batch_id,product_id:product_id,csrf_test_name:csrf_test_name},
                cache: false,
                success: function(data)
                {
                    
                   var obj = JSON.parse(data);
                    var today = new Date();
                    var dd = today.getDate();
                    var mm = today.getMonth()+1; 
                    var yyyy = today.getFullYear();

                    if(dd<10){
                       var dd='0'+dd;
                    }
                    if(mm<10){
                       var mm='0'+mm;
                    }
                    var today = yyyy+'-'+mm+'-'+dd;

                   var aj = new Date(today);
                   var exp = new Date(obj.expire_date);
                    if (aj >= exp) {
                     alert('Date Expired Please Select another');
                      $('#batch_id_'+sl)[0].selectedIndex = 0;
                      $('#'+expire_date).html('<p style="color:red;align:center">'+obj.expire_date+'</p>');
                       document.getElementById('expire_date_'+sl).innerHTML = '';
                    }else{
                       $('#'+expire_date).html('<p style="color:green;align:center">'+obj.expire_date+'</p>');
                    }
                    $('#'+available_quantity).val(obj.total_product);

                }
             });

            $(this).unbind("change");
            return false;



}

     "use strict";
  function checkqty(sl)
{

  var quant=$("#total_qntt_"+sl).val();
  var price=$("#price_item_"+sl).val();
  var dis=$("#discount_"+sl).val();
  if (isNaN(quant))
  {
    alert("must_input_numbers");
    document.getElementById("total_qntt_"+sl).value = '';
    return false;
  }
  if (isNaN(price))
  {
    alert("must_input_numbers");
     document.getElementById("price_item_"+sl).value = '';
    return false;
  }
  if (isNaN(dis))
  {
    alert("must_input_numbers");
     document.getElementById("discount_"+sl).value = '';
    return false;
  }
}
//discount and paid check
  "use strict";
function checknum(){
      var dis=$("#invdcount").val();
      var paid=$("#paidAmount").val();
      if (isNaN(dis))
  {
    alert("must_input_numbers");
     document.getElementById("invdcount").value = '';
    return false;
  }
  if (isNaN(paid))
  {
    alert("must_input_numbers");
     document.getElementById("paidAmount").value = '';
    return false;
  }
    }

     "use strict";
function customer_due(id){
    var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        $.ajax({
            url: base_url + 'Cinvoice/previous',
            type: 'post',
            data: {customer_id:id,csrf_test_name:csrf_test_name}, 
            success: function (msg){
                $("#previous").val(msg);
            },
            error: function (xhr, desc, err){
                 alert('failed');
            }
        });        
    }

  "use strict";
function customer_autocomplete(sl) {

    var customer_id = $('#customer_id').val();
     var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var customer_name = $('#customer_name').val();
         
        $.ajax( {
          url: base_url + "Cinvoice/customer_autocomplete",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            customer_id:customer_name,
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
            $(this).parent().parent().find("#autocomplete_customer_id").val(ui.item.value); 
            var customer_id          = ui.item.value;
            customer_due(customer_id);

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '#customer_name', function() {
       $(this).autocomplete(options);
   });

}


 "use strict";
function invoice_productList(sl) {

        var priceClass = 'price_item'+sl;
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        var unit = 'unit_'+sl;
        var tax = 'total_tax_'+sl;
        var discount_type = 'discount_type_'+sl; 
        var batch_id = 'batch_id_'+sl;

    // Auto complete
    var options = {
        minLength: 0,
        source: function( request, response ) {
            var product_name = $('#product_name_'+sl).val();
        $.ajax( {
          url: base_url + "Cinvoice/autocompleteproductsearch",
          method: 'post',
          dataType: "json",
          data: {
            term: request.term,
            product_name:product_name,
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
                $(this).val(ui.item.label);
                var id=ui.item.value;
                var dataString = 'product_id='+ id;
                var base_url = $('.baseUrl').val();

                $.ajax
                   ({
                        type: "POST",
                        url: base_url+"Cinvoice/retrieve_product_data_inv",
                        data: {
                            product_id:id,
                            csrf_test_name:csrf_test_name
                        },
                        cache: false,
                        success: function(data)
                        {
                            var obj = jQuery.parseJSON(data);
                                for (var i = 0; i < (obj.txnmber); i++) {
                            var txam = obj.taxdta[i];
                            var txclass = 'total_tax'+i+'_'+sl;
                           $('.'+txclass).val(txam);
                            }

                         $('.'+priceClass).val(obj.price);
                            $('.'+unit).val(obj.unit);
                            $('.'+tax).val(obj.tax);
                            $('#txfieldnum').val(obj.txnmber);
                            $('#'+discount_type).val(obj.discount_type);
                            $('#'+batch_id).html(obj.batch);
                            quantity_calculate(sl);
                            
                        } 
                    });

            $(this).unbind("change");
            return false;
       }
   }

   $('body').on('keypress.autocomplete', '.productSelection', function() {
       $(this).autocomplete(options);
   });

}


$(document).ready(function(){
  "use strict";
    $('#full_paid_tab').keydown(function(event) {
        if(event.keyCode == 13) {
 $('#add_invoice').trigger('click');
        }
    });
});
 
 $(document).ready(function() {
 $("#newcustomer").submit(function(e){
        e.preventDefault();
        var customeMessage   = $("#customeMessage");
        var customer_id      = $("#autocomplete_customer_id");
        var customer_name    = $("#customer_name");
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: $(this).serialize(),
            beforeSend: function()
            {
                customeMessage.removeClass('hide');
               
            },
            success: function(data)
            {

                if (data.status == true) {
                    customeMessage.addClass('alert-success').removeClass('alert-danger').html(data.message);
                    customer_id.val(data.customer_id);
                    customer_name.val(data.customer_name);
                     $("#cust_info").modal('hide');
                } else {
                    customeMessage.addClass('alert-danger').removeClass('alert-success').html(data.exception);
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }

        });

    });
 });


     
    window.onload = function () {
        var text_input = document.getElementById('add_item_p');
        $('body').addClass("sidebar-mini sidebar-collapse");
    }

       window.onload = function () {
        var text_input = document.getElementById('add_item');
        $('body').addClass("sidebar-mini sidebar-collapse");
    }
     $(function($){
        var barcodeScannerTimer;
        var barcodeString = '';
        $('#add_item_m').keydown(function (e) {
        if (e.keyCode == 13) {
        var product_id = $(this).val();
        var product_id = $(this).val();
        var exist = $("#product_id_" + product_id).val();
        var qty = $("#total_qntt_" + product_id).val();
        var add_qty = parseInt(qty)+1;
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
         if(product_id == exist){
            $("#total_qntt_" + product_id).val(add_qty);
           quantity_calculate(product_id);
            calculateSum();
            invoice_paidamount();
           document.getElementById('add_item_m').value = '';
           document.getElementById('add_item_m').focus();       
         }else{
            $.ajax({
                type: "post",
                async: false,
                url: base_url + 'Cinvoice/insert_pos_invoice',
                data: {product_id: product_id,csrf_test_name:csrf_test_name},
                success: function (r) {
                   
                        $("#hidden_tr").css("display", "none");
                        document.getElementById('add_item_m').value = '';
                        document.getElementById('add_item_m').focus();
                        $('#normalinvoice tbody').append(r);
                       
                        calculateSum();
                        invoice_paidamount();
                   
                },
                error: function () {
                    alert('Request Failed, Please check your code and try again!');
                }
            });
        }
        }
    });
          });




    $(document).ready(function() {
      var frm = $("#pos_sale_insert");
      var output = $("#output");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            dataType : 'json',
            data : frm.serialize(),
            success: function(data) 
            {
                if (data.status == true) {
                    output.empty().html(data.message).addClass('alert-success').removeClass('alert-danger').removeClass('hide');
                    $("#inv_id").val(data.invoice_id);
                  $('#printconfirmodal').modal('show');
                   if(data.status == true && event.keyCode == 13) {
                  
        }
                  
                } else {
                    output.empty().html(data.exception).addClass('alert-danger').removeClass('alert-success').removeClass('hide');
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

     $("#printconfirmodal").on('keydown', function ( e ) {
    var key = e.which || e.keyCode;
    if (key == 13) {
       $('#yes').trigger('click');
    }
});


   $(document).ready(function() {

   var frm = $("#gui_sale_insert");
    var output = $("#output");
    frm.on('submit', function(e) {
        e.preventDefault(); 
        $.ajax({
            url : $(this).attr('action'),
            method : $(this).attr('method'),
            dataType : 'json',
            data : frm.serialize(),
            success: function(data) 
            {
                if (data.status == true) {
                    output.empty().html(data.message).addClass('alert-success').removeClass('alert-danger').removeClass('hide');
                    $("#inv_id").val(data.invoice_id);
                  $('#printconfirmodal').modal('show');
                   if(data.status == true && event.keyCode == 13) {
                  
        }
              
                } else {
                    output.empty().html(data.exception).addClass('alert-danger').removeClass('alert-success').removeClass('hide');
                }
            },
            error: function(xhr)
            {
                alert('failed!');
            }
        });
    });
     });

     $("#printconfirmodal").on('keydown', function ( e ) {
    var key = e.which || e.keyCode;
    if (key == 13) {
       $('#yes').trigger('click');
    }
});



 function onselectimage(id){
        var product_id = id;
         var exist = $("#product_id_" + product_id).val();
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
                        quantity_calculate(product_id);
                         calculateSum();
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
    

 }



 $('body').on('keyup', '#product_name', function() {
        var product_name = $(this).val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl').val();
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id,csrf_test_name:csrf_test_name},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('<h1 class"srcalrt">Product not found !</h1>');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('Request Failed, Please check your code and try again!');
            }
        });
    });

  $('body').on('change', '#category_id', function() {
        var product_name = $('#product_name').val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl').val();
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id,csrf_test_name:csrf_test_name},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('<h1 class"srcalrt">Product not found !</h1>');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('Request Failed, Please check your code and try again!');
            }
        });
    }); 

        $('body').on('click', '#search_button', function() {
        var product_name = $('#product_name').val();
        var category_id = $('#category_id').val();
        var myurl= $('#posurl').val();
        var csrf_test_name = $('[name="csrf_test_name"]').val();
        var base_url = $('#base_url').val();
        $.ajax({
            type: "post",
            async: false,
            url: myurl,
            data: {product_name: product_name,category_id:category_id,csrf_test_name:csrf_test_name},
            success: function(data) {
                if (data == '420') {
                    $("#product_search").html('<h1 class"srcalrt text-center">Product not found !</h1>');
                }else{
                    $("#product_search").html(data); 
                }
            },
            error: function() {
                alert('Request Failed, Please check your code and try again!');
            }
        });
    });   



function detailsmodal(productname,stock,model,unit,price,image){
    $("#detailsmodal").modal('show');
    var base_url = document.getElementById("baseurl").value;
    document.getElementById("modal_productname").innerHTML = productname;
    document.getElementById("modal_productstock").innerHTML = stock;
    document.getElementById("modal_productmodel").innerHTML = model;
    document.getElementById("modal_productunit").innerHTML = unit;
    document.getElementById("modal_productprice").innerHTML = price;
    document.getElementById("modalimg").innerHTML ='<img src="' + image + '" alt="image" style="width:100px; height:60px;" />';
}


    $(document).on('click', '.taxbutton', function(e) {
      var $this = $(this);
      var icon = $this.find('i');
      if (icon.hasClass('fa fa-angle-double-up')) {
        $this.find('i').removeClass('fa fa-angle-double-up').addClass('fa fa-angle-double-down');
      } else {
        $this.find('i').removeClass('fa fa-angle-double-down').addClass('fa fa-angle-double-up');
      }
    });

    $(document).ready(function() {
      $(".paymentpart").click(function () {
      var  $header = $(this);
      var  $content = $header.next();
      $content.slideToggle(500, function () {
      $header.html(function () {
         
            return $content.is(":visible") ? "<span  class='btn btn-warning'><i class='fa fa-angle-double-down'></i></span>" : "<span  class='btn btn-warning'><i class='fa fa-angle-double-up'></i></span>";
        });
    });

});
});


