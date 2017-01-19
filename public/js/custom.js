// distributor list
$(document).ready(function () {

    $("#example1").DataTable();
    $("#example2").DataTable();


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
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }


    function guaranteeForm(gType) {
        if (gType == "Cash") {
            $(".bank-name").attr("type", "hidden");
            $(".bank-name").val("");
            $(".cheque-no").attr("type", "hidden");
            $(".cheque-no").val("");
            $("#bank_name").hide();
            $("#cheque_no").hide();
            $("#amount").show();

        }
        else if (gType == "Collateral") {
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
        else if (gType == "Others") {
            console.log("as" + gType);

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
            console.log(gType);
            $("#bank_name").show();
            $("#cheque_no").show();
            $("#amount").show();
            $(".bank-name").attr("type", "show");
            $(".cheque-no").attr("type", "show");
            $(".amount").attr("type", "show");
        }

    }

    function selectStage(Stage) {
        console.log("hello as"+Stage);
        if (Stage=="Closed") {
            $("#lossreason").show();
            $(".lossreason").attr("type", "show");

        }
        else {
            $("#lossreason").hide();
            $(".lossreason").attr("type", "hide");
            $("#remark").hide();
            $(".remark").attr("type", "hide");
        }

    }

    function visitForm(lossreason) {
        if (lossreason =="Other") {
            $("#remark").show();
            $(".remark").attr("type", "show");
        }
        else {
            $("#remark").hide();
            $(".remark").attr("type", "hide");
        }

    }

    function paymentForm(type) {
        if (type =="Cheque") {
            $("#bankname").show();
            $(".bankname").attr("type", "show");
            $("#chequeno").show();
            $(".chequeno").attr("type", "show");
            $("#chequedate").show();
            $(".chequedate").attr("type", "show");
        }
        else {
            $("#bankname").hide();
            $(".bankname").attr("type", "hide");
            $("#chequeno").hide();
            $(".chequeno").attr("type", "hide");
            $("#chequedate").hide();
            $(".chequedate").attr("type", "hide");

        }

    }


    $("#stage").on('change',function () {
        var stage = $('#stage :selected').text();
        selectStage(stage.trim());
    }).change();


    $("#lossreason").change(function () {
        $("select option:selected").each(function () {
            visitForm($(this).attr("value"));
        });
    }).change();

    $("#type").change(function () {
        $("select option:selected").each(function () {
            paymentForm($(this).attr("value"));
        });
    }).change();

    $("#select").change(function () {
        $("select option:selected").each(function () {
            guaranteeForm($(this).attr("value"));

        });
    }).change();
    if (editGuarantee) {
        guaranteeForm(guaranteeType);
    }


});



$('[data-toggle="popover"]').popover();


//warehouse disabled for other role
$('.role').change(function () {
    $(".warehouse").prop("disabled", this.value != 4);
});

//datepicker

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


//select2
$("select").select2({
    theme: "classic",
    placeholder:"Select Item"
});

today = yyyy + '-' + mm + '-' + dd;
document.getElementById("datefield").setAttribute("max", today);
document.getElementById("datefield1").setAttribute("max", today);