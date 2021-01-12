
    function checkboxcheck(sl){
        var check_id    ='check_id_'+sl;
        var total_qntt  ='total_qntt_'+sl;
        var product_id  ='product_id_'+sl;
        var total_price  ='total_price_'+sl;
        var discount  ='discount_'+sl;
        var price_item = 'price_item_'+sl;
            if($('#'+check_id).prop("checked") == true){
                document.getElementById(total_qntt).setAttribute("required","required");
                document.getElementById(product_id).setAttribute("name","product_id[]");
                 document.getElementById(total_qntt).setAttribute("name","product_quantity[]");
                document.getElementById(total_price).setAttribute("name","total_price[]");
                document.getElementById(discount).setAttribute("name","discount[]");
                document.getElementById(price_item).setAttribute("name","product_rate[]");
            }
            else if($('#'+check_id).prop("checked") == false){
                document.getElementById(total_qntt).removeAttribute("required");
                document.getElementById(product_id).removeAttribute("name");
                document.getElementById(total_qntt).removeAttribute("name");
                document.getElementById(total_price).removeAttribute("name");
                document.getElementById(discount).removeAttribute("name");
                document.getElementById(price_item).removeAttribute("name");

            }
        };


    //Quantity calculat
        "use strict";
    function quantity_calculate(item) {
         var a = 0,o = 0,d = 0,p = 0;
        var sold_qty = $("#sold_qty_" + item).val();
        var quantity = $("#total_qntt_" + item).val();
        var price_item = $("#price_item_" + item).val();
        var discount = $("#discount_" + item).val();
        if(parseInt(sold_qty) < parseInt(quantity)){
            alert("You can not return more than sold/stock Quantity!");
            $("#total_qntt_"+item).val("");
        }
        if (parseInt(quantity) > 0) {
            var price = (quantity * price_item);
            var dis = price * (discount / 100);
            $("#all_discount_" + item).val(dis);
            var ttldis = $("#all_discount_" + item).val();

            //Total price calculate per product
            var temp = price - ttldis;
            $("#total_price_" + item).val(temp);//

            $(".total_price").each(function () {
                isNaN(this.value) || o == this.value.length || (a += parseFloat(this.value));
            }),
                    $("#grandTotal").val(a.toFixed(2, 2));

                  $(".total_discount").each(function () {
                isNaN(this.value) || p == this.value.length || (d += parseFloat(this.value));
            }),
                    $("#total_discount_ammount").val(d.toFixed(2, 2));
        }

    }

   function checkrequird(sl) {
   var  quantity=$('#total_qntt_'+sl).val();
   var check_id    ='check_id_'+sl;
    if (quantity > 0){

    document.getElementById(check_id).setAttribute("required","required");
    }else{
        document.getElementById(check_id).removeAttribute("required");
    }
}

      $(document).ready(function () {
            "use strict";
        $('input[type=checkbox]').each(function () {
            if (this.nextSibling.nodeName != 'label') {
                $(this).after('<label for="' + this.id + '"></label>')
            }
        })


    $('#add_invoice').prop("disabled", true);
    $('input:checkbox').click(function () {
        if ($(this).is(':checked')) {
            $('#add_invoice').prop("disabled", false);
        } else {
            if ($('.chk').filter(':checked').length < 1) {
                $('#add_invoice').attr('disabled', true);
            }
        }
    });
    })

function checkqty(sl)
{
  var sold_qty = $('#sold_qty_'+sl).val();
  var quant=$('#total_qntt_'+sl).val();
  if (isNaN(quant))
  {
    alert("Must Input Number");
    document.getElementById("total_qntt_"+sl).value = '';
    return false;
  }
  if (parseInt(quant) < 1)
  {
    alert(":You can not return less than 1");
     document.getElementById("total_qntt_"+sl).value = '';
    return false;
  }
  if (parseInt(quant) > parseInt(sold_qty))
  {
       setTimeout(function(){
    alert("You can not return more than sold/available qty");
    document.getElementById("total_price_"+sl).value = '';
    document.getElementById("discount_"+sl).value = '';
    document.getElementById("total_qntt_"+sl).value = '';
       }, 500);
    return false;
  }




}

    function manufacturer_checkbox(sl){
        var check_id    ='check_id_'+sl;
        var total_qntt  ='total_qntt_'+sl;
        var product_id  ='product_id_'+sl;
        var total_price ='total_price_'+sl;
        var discount  ='discount_'+sl;
        var price_item  ='price_item_'+sl;

        if($('#'+check_id).prop("checked") == true){
            document.getElementById(total_qntt).setAttribute("required","required");
            document.getElementById(product_id).setAttribute("name","product_id[]");
            document.getElementById(total_qntt).setAttribute("name","product_quantity[]");
            document.getElementById(total_price).setAttribute("name","total_price[]");
            document.getElementById(discount).setAttribute("name","discount[]");
            document.getElementById(price_item).setAttribute("name","product_rate[]");
        }
        else if($('#'+check_id).prop("checked") == false){
            document.getElementById(total_qntt).removeAttribute("required");
            document.getElementById(product_id).removeAttribute("name");
            document.getElementById(total_qntt).removeAttribute("name");
            document.getElementById(total_price).removeAttribute("name");
            document.getElementById(discount).removeAttribute("name");
            document.getElementById(total_qntt).removeAttribute("name");
            document.getElementById(price_item).removeAttribute("name");
        }
    };
