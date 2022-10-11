
  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      <b>Version</b> <?php echo SYS_VERSION; ?>
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="https://metropolitanafm.com.br" target="_Blank">Metropolitana FM 98.5</a>.</strong>
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

    
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo URL; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    
    <!-- FastClick -->
    <script src="<?php echo URL; ?>bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo URL; ?>dist/js/adminlte.min.js"></script>
   

    <script src="<?php echo URL; ?>js/application.js"></script>

    <script>
        let url = "<?php echo URL; ?>";
    </script>
<!-- Select2 -->
<script src="<?php echo URL; ?>plugins/select2.js"></script>
<!-- DataTables -->

<script src="<?php echo URL; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo URL; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.1.1/js/responsive.bootstrap.min.js"></script>

<link rel="stylesheet" href="<?php echo URL; ?>plugins/fancybox/fancybox.css">
  <script src="<?php echo URL; ?>plugins/fancybox/fancybox.js"></script>
  <script src="<?php echo URL; ?>plugins/toastr/toastr.min.js"></script>
  <!--script src="<?php echo URL; ?>plugins/mask-money/jquery.maskmoney.min.js"></script-->


<script>
$(document).ready(function() {

// Setup - add a text input to each footer cell
  $('.smarttable thead tr').clone(true).appendTo('.smarttable thead');
  $('.smarttable thead tr:eq(1) th').each(function(i) {
    let title = $(this).text();
    $(this).html('<input type="text" placeholder="Buscar" />');
// Apply the search
    $('input', this).on('keyup change', function() {
      if (table.column(i).search() !== this.value) {
        table
        .column(i)
        .search(this.value)
        .draw();
      }
    });

  });

  let table = $('.smarttable').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
    },
    "responsive": true,
    "orderCellsTop": true
  });

  let table2 = $('.smarttable2').DataTable({
    "language": {
        "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
    },
    
    "responsive": false,
    "orderCellsTop": true
  });

});

$('.selectpicker').selectpicker();
</script>



<script>
    // $(function () {
    //     $('.smarttable').DataTable(
    //         {
    //             "language": {
    //                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
    //             },
    //             text: 'Filter',
    //             action: function (e, dt, node, config) {
    //                 let table = $('#index').DataTable();
    //                 $('#index thead th').each(function (i) {
    //                     let title = $(this).attr('id');
    //                     let html = $(this).html();
    //                     let isInputBox = html.indexOf('<input') != -1;
    //                     if (isInputBox) {
    //                         $(this).html(title);
    //                     }
    //                     else {
    //                         $(this).html('<input type="text" placeholder="Search ' + title + '" />');
    //                         $('input', this).on('keyup change', function () {
    //                             if (table.column(i).search() !== this.value) {
    //                                 table
    //                                     .column(i)
    //                                     .search(this.value)
    //                                     .draw();
    //                             }
    //                         });
            
    //                     }
    //                 });
    //                 window.dispatchEvent(new Event('resize'));  // causes the responsive table to recalculate size
    //             },
    //         {
    //             text: 'Clear Filters',
    //             action: function () {
    //                 let table = $('#index').DataTable();
    //                 table.search("").draw();                           
    //                 table.columns().search('').draw();
    //             }
    //         },
    //         }
    //     )

    //     $('#data tfoot th').each(function() {
    //         let title = $(this).text();
    //         $(this).html('<input type="text" class="form-control" placeholder="Pesquise por ' + title + '" />');
    //     });
    
    //     let table = $('#data').DataTable({
    //         searchPanes: {
    //             viewTotal: true
    //         },
    //         dom: 'Plfrtip',
    //         "language": {
    //                 "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
    //             }
    //     });
    
    //     table.columns().every( function() {
    //         let that = this;
    
    //         $('input', this.footer()).on('keyup change', function() {
    //             if (that.search() !== this.value) {
    //                 that
    //                     .search(this.value)
    //                     .draw();
    //             }
    //         });
    //     });
    // })
</script>
<!-- InputMask -->


<script>
 
    // $(function () {
    //     $('#data').inputmask('99/99/9999');
    //     $('#cep').inputmask('99999-999');
    //     $('#cpf').inputmask('999.999.999-99');
    //     $('#rg').inputmask('99.999.999-9');
    //     $('#celular').inputmask('(99) 99999-9999');
    //     $('#telefone').inputmask('(99) 9999-9999');
    //     $('#cnpj').inputmask('99.999.999/9999-99');
    
        

    // })



    

</script>





    <?php //$this->callIncludes($urlAtual); ?>
    </body>


</html>
