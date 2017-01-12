// distributor list
$(function () {
    $("#example1").DataTable();
    $("#example2").DataTable();

});


//district choose as per zones

$('.zones-dropdown').change(function () {
    $(".district-dropdown").empty();
    var zone = $(this).find('option:selected').val();
    zone = $.trim(zone);
    var districts = zonesDistrict[zone];


    $.each(districts, function (i, district) {
        $(".district-dropdown").append(
            $('<option>', {
                value: district,
                text: district,
                id: district
            })
        );

    })
})


//limit date to current
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd
}
if(mm<10){
    mm='0'+mm
}


$(document).ready(function(){
    $("#select").change(function(){
        $( "select option:selected").each(function(){
            if($(this).attr("value")=="Cash"){
                $(".bank-name").attr("type", "hidden");
                $(".bank-name").val("");
                $(".cheque-no").attr("type", "hidden");
                $(".cheque-no").val("");
                $("#bank_name").hide();
                $("#cheque_no").hide();
                $("#amount").show();
            }
            else if($(this).attr("value")=="Collateral"){
                $(".bank-name").attr("type", "hidden");
                $(".bank-name").val("");
                $(".cheque-no").attr("type", "hidden");
                $(".cheque-no").val("");
                $(".amount").attr("type", "hidden");
                $(".amount").val("");
                $("#bank_name").hide();
                $("#cheque_no").hide();
                $("#amount").hide();
                $(".amount").attr("type", "show");
            }
            else if($(this).attr("value")=="Others"){
                $(".bank-name").attr("type", "hidden");
                $(".bank-name").val("");
                $(".cheque-no").attr("type", "hidden");
                $(".cheque-no").val("");
                $(".amount").attr("type", "hidden");
                $(".amount").val("");
                $("#bank_name").hide();
                $("#cheque_no").hide();
                $("#amount").hide();
                $(".amount").attr("type", "show");
            }
            else {
                $("#bank_name").show();
                $("#cheque_no").show();
                $("#amount").show();
                $(".bank-name").attr("type","show");
                $(".cheque-no").attr("type","show");
                $(".amount").attr("type","show");
            }
        });
    }).change();
});


$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

//warehouse disabled for other role
$('.role').change(function () {
    $(".warehouse").prop("disabled", this.value != 4);
});

//datepicker
$(function () {
    $('#date').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#date1').datepicker({
        autoclose: true,
        todayHighlight: true
    });
    $('#date2').datepicker({
        autoclose: true,
        todayHighlight: true
    });
});

//select2
$("select").select2();

today = yyyy+'-'+mm+'-'+dd;
document.getElementById("datefield").setAttribute("max", today);
document.getElementById("datefield1").setAttribute("max", today);
