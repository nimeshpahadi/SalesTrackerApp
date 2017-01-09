<!-- jQuery 2.2.3 -->
{!!Html::script('plugins/jQuery/jquery-2.2.3.min.js') !!}

<!-- jQuery UI 1.11.4 -->
{!!Html::script('https://code.jquery.com/ui/1.11.4/jquery-ui.min.js') !!}
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
{!!Html::script('js/bootstrap.min.js') !!}

<!-- Bootstrap WYSIHTML5 -->
{!!Html::script('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') !!}
<!-- Slimscroll -->

<!-- AdminLTE App -->
{!!Html::script('dist/js/app.min.js') !!}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script>
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass: 'iradio_minimal-blue'
    });

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });
</script>

{!!Html::script('js/custom.js') !!}

<!-- DataTables -->
{!!Html::script('/plugins/datatables/jquery.dataTables.min.js') !!}
{!!Html::script('/plugins/datatables/dataTables.bootstrap.min.js') !!}
{!!Html::script('/plugins/datatables/dataTables.responsive.min.js') !!}
{!!Html::script('/plugins/datatables/responsive.bootstrap.min.js') !!}



{!!Html::script('/leaflet/leaflet.js') !!}


</body>
</html>
























