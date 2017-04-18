    // distributor list
    $(document).ready(function () {

        $("#example1").DataTable({
            "pageLength": 25
        });
        $("#example2").DataTable({
            "pageLength": 25
        });


    // select2
        $("select").select2({
            theme: "classic",
            placeholder: "Select Item",
            allowClear: true
        });


    // district choose as per zones
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

    // using ajax for area dropdown
    $('.district-dropdown').change(function () {
        $(".area-dropdown").empty();
        var district = $(this).find('option:selected').val();
        district = $.trim(district);

        $.ajax({
            type: 'GET',
            url: app_url + '/find/customer_area',
            data: {dist: district},
            success: function (data) {
                $.each(data, function (i, area) {
                    $(".area-dropdown").append(
                        $('<option>', {
                            value: i,
                            text: area,
                            id: area
                        })
                    );
                })
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });

    })


    // limit date to current
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
        else if (gType == "Collateral" || gType == "Others") {
            $(".bank-name").attr("type", "hidden");
            $(".bank-name").val("");
            $(".cheque-no").attr("type", "hidden");
            $(".cheque-no").val("");
            $(".amount").attr("type", "hidden");
            $(".amount").val("");
            $("#bank_name").hide();
            $("#cheque_no").hide();
            $("#amount").hide();
        }

        else {
            $("#bank_name").show();
            $("#cheque_no").show();
            $("#amount").show();
            $(".bank-name").attr("type", "show");
            $(".cheque-no").attr("type", "show");
            $(".amount").attr("type", "show");
        }

    }

    function selectStage(Stage) {
        if (Stage == "Closed") {
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
        if (lossreason == "Other") {
            $("#remark").show();
            $(".remark").attr("type", "show");
        }
        else {
            $("#remark").hide();
            $(".remark").attr("type", "hide");
        }

    }

    function paymentForm(type) {
        if (type == "Cheque") {
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
            $(".date").attr("type", "hide");
            $(".date").val("");
        }

    }

    //aaaaa ,"disabled"
    function userform(rid) {

        if (rid != 4) {
            $("#ware").hide();
            $("#warehouse_id").hide();
        }
        else {
            $("#ware").show();
            $("#warehouse_id").show();
        }
    }


    // aaaaa
    $("#roles").change(function () {
        userform($(this).val());
    }).change();

    $("#stage").on('change', function () {
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

    if (edituser) {
        userform(roletype);
    }


    });


    $(".customer_approval").change(function () {
        var status = $(this).val();
        var distId = $(this).attr("data-dist");

        if (status != "") {
            $('.customer-approval-modal').modal('show');

            $('#sales_approval_input').val(status);
            $('#distributor_id').val(distId);
        }

    });


    $('[data-toggle="popover"]').popover();

    // datepicker
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


    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("datefield").setAttribute("max", today);
    document.getElementById("datefield1").setAttribute("max", today);