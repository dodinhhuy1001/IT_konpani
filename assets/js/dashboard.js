  $(function() {
        "use strict";
    $('#alldata').datepicker({
        changeMonth: true,
        changeYear: true,
        showButtonPanel: true,
        maxDate: "+0M",
        dateFormat: 'MM yy'
    }).focus(function() {
        var thisCalendar = $(this);
        $('.ui-datepicker-calendar').detach();
        $('.ui-datepicker-close').click(function() {
var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
thisCalendar.datepicker('setDate', new Date(year, month, 1));
        });
    });


    
});
    $( document ).ready(function() {
        "use strict";
var  dismodl=$('#is_modal_shown').val();
var  stockqt=$('#stpcount').val();
var csrf_test_name = $('[name="csrf_test_name"]').val();
var base_url = $('#base_url').val();
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1;
var yyyy = today.getFullYear();


if(dd<10) {
    dd = '0'+dd
} 

if(mm<10) {
    mm = '0'+mm
} 
today = yyyy + '-' + mm + '-' + dd;

 var  expdate=$('#expdate').val();
 var is_modal_shown = 1;
 if (dismodl == '' && stockqt > 0 || dismodl == '' && new Date(expdate) < new Date(today)){

     
        $('#stockmodal').modal('show');   
   
      $.ajax
       ({ 
            type: "POST",
            url: base_url + 'User/modaldisplay',
            data: {is_modal_shown:is_modal_shown,csrf_test_name:csrf_test_name},
            cache: false,
            success: function(data)
            {
            } 
        });
     }



               var bestslabel    = $("#bestsalelabel").val();
               var splitbslabel  = bestslabel.substring(0, bestslabel.length - 1);
               var bestsalelabel = splitbslabel.split(",");
               var total_sales   = $("#total_sales_amount").val();
               var bestsdata     = $("#bestsaledata").val();
               var splitbsdata    = bestsdata.substring(0, bestsdata.length - 1);
               var bestsaledata  = splitbsdata.split(",");

               var bestsalmax    = $("#bestsalemax").val();
   var ctx = document.getElementById("bestsalechart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: bestsalelabel,
            datasets: [
                {
                    label: "Sales Quantity",
                    backgroundColor: "#3BAFA9",
                    strokeColor: "#3bafa9",
                    pointColor: "#3bafa9",
                    pointStrokeColor: "#3bafa9",
                    pointHighlightFill: "#3bafa9",
                    pointHighlightStroke: "#3bafa9",
                    maintainAspectRatio: false,
                    scaleFontColor: "#3bafa9",
                    pointLabelFontColor: "#3bafa9",
                    pointLabelFontSize: 30,
                    data: bestsaledata
                }

            ]
        },
        options: {
            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Medicines'
                        }
                    }],
                yAxes: [{
                        display: true,
                        ticks: {
                            beginAtZero: true,
                            steps: 10,
                            stepValue: 5,
                            max: Number(total_sales)
                        },
                        scaleLabel: {
                            display: true,
                            labelString: 'Sales Quantity'
                        }
                    }]
            },
            "animation": {
                "duration": 1,
                "onComplete": function () {
                    var chartInstance = this.chart,
                            ctx = chartInstance.ctx;

                    ctx.color = '#3bafa9';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'bottom';

                    this.data.datasets.forEach(function (dataset, i) {
                        var meta = chartInstance.controller.getDatasetMeta(i);
                        meta.data.forEach(function (bar, index) {
                            var val = dataset.data[index];
                              if(val > 0){
                            var data = (((dataset.data[index])/total_sales)*100).toFixed(2)+'%';
                                }else{
                                   var data = '';
                                }
                            
                            ctx.fillText(data, bar._model.x, bar._model.y - 20);
                        });
                    });
                }
            }
        }


    });

//Monthly progress bar
    var ctx = document.getElementById("myChart");
var months = $("#months").val();
var splitbslabel  = months.substring(0, months.length - 1);
var monthlabel = splitbslabel.split(",");

var samount = $("#progress_saledata").val();
var splitsamount  = samount.substring(0, samount.length - 1);
var progresssaledata = splitsamount.split(",");

var pamount = $("#progress_purchasedata").val();
var splitpamount  = pamount.substring(0, pamount.length - 1);
var progresspurchasedata = splitpamount.split(",");
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: monthlabel,
datasets: [
{ label: 'Sales',
data: progresssaledata,
backgroundColor :'rgba(59, 175, 169, 1)',
},
{ label: 'Purchase',
data: progresspurchasedata,
backgroundColor :'rgba(192, 192, 192, 1)',
}
]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:true
}
}]
}
}
});




 });

   window.onload = function() {
    var pie_total_sale = $("#pie_total_sale").val();
    var pie_total_purchase = $("#pie_total_purchase").val();
    var pie_total_service  = $("#pie_total_service").val();
    var pie_total_expense  = $("#pie_total_expense").val();
    var pie_total_salary   = $("#pie_total_salary").val();
    var currency = $("#currency").val();
var chart = new CanvasJS.Chart("chartContainerPie", {
    animationEnabled: true,
   
   
    data: [{
        type: "pie",
        startAngle: 240,
        yValueFormatString: "##0.00 " +currency,
        indexLabel: "{label} {y}",
       
        dataPoints: [
            {y: pie_total_sale, label: "Total Sale"},
            {y: pie_total_purchase,label: "Total Purchase"},
            {y: pie_total_expense,label: "Total Expense"},
            {y: pie_total_salary,label: "Employee Salary"},
            {y: pie_total_service,label: "Service "},


        ]
    }]
});
chart.render();


}
  


          
