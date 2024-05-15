<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <!-- <b>Version</b> 3.2.0 -->
    </div>
    <strong>Copyright &copy; {{ date('Y') }}</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ URL::asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ URL::asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ URL::asset('dist/js/demo.js') }}"></script> -->

<script src="{{ URL::asset('plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>

<script src="{{ URL::asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('plugins/select2/js/select2.full.min.js') }}"></script>


<script>
    $(function () {
      
        //Initialize Select2 Elements
        $('.select2').select2()


        //Colorpicker
        $('.my-colorpicker1').colorpicker()
        //color picker with addon      
    })




</script>
</body>
</html>