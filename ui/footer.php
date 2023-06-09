<!-- ---------------------------------------------------------------------------
#  lan.scanner
#  Open Source LAN Scanner
#
#-------------------------------------------------------------------------------
#  eugef 2023        eugef66@gmail.com        GNU GPLv3
#--------------------------------------------------------------------------- -->


  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- Default to the left -->

    <!-- &copy; 2023 eugef -->
    <?php
      $conf_file = '../version.conf';
      $conf_data = parse_ini_file($conf_file);
      echo '<span style="display:inline-block; transform: rotate(180deg)">&copy;</span> '. $conf_data['VERSION_YEAR'] .' eugef';
    ?>

    <!-- To the right -->
    <div class="pull-right no-hidden-xs">

    
    <?php
      $conf_file = '../version.conf';
      $conf_data = parse_ini_file($conf_file);
      echo 'lan.scanner&nbsp&nbsp'. $conf_data['VERSION'] .'&nbsp&nbsp<small>('. $conf_data['VERSION_DATE'] .')</small>';
    ?>
    </div>
  </footer>

<!-- ----------------------------------------------------------------------- -->
  <!-- Control Sidebar -->
    <!-- DELETED -->
	</div>
<!-- /.Site-wrapper -->

<!-- ----------------------------------------------------------------------- -->
<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
  <script src="lib/AdminLTE/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap 3.3.7 -->
  <script src="lib/AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- AdminLTE App -->
  <script src="lib/AdminLTE/dist/js/adminlte.min.js"></script>
  
</body>
</html>
