<script src="../static/jquery.js"></script>
<script src="../static/bootstrap.js"></script>
<script src="../static/jquery.slimscroll.min.js"></script>
<script src="../static/style.js"></script>
<script src="../static/Chart.min.js"></script>
<!-- ckeditor  -->
   <script src="./includes/ckeditor/ckeditor.js"></script>
<script src="./includes/ckeditor/adapters/jquery.js"></script>
<!-- datatables js -->
<script src="./includes/datatables.net/js/jquery.dataTables.js"></script>
<!-- <script src="./includes//datatables.net-bs/js/dataTables.bootstrap.js"></script> -->
<!-- Data Table Initialize -->
<script>
  $(function () {
    $('#example1').DataTable({
      responsive: true
    })
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : true
    })
  })
</script>
