  <footer class="main-footer">
    <strong>Copyright &copy; <script>
        document.write(new Date().getFullYear());
      </script> <a target="_blank">Duljaun</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.1
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- Bootstrap 4 -->
  <script src="<?= base_url() ?>src/backend/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url() ?>src/backend/dist/js/adminlte.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="<?= base_url() ?>src/backend/dist/js/demo.js"></script>
  <!-- SweetAlert2 -->
  <script src="<?= base_url() ?>src/backend/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?= base_url() ?>src/js/notif.js"></script>
  <script>
    document.getElementById("filterOption").addEventListener("change", function() {

      let pilihan = this.value;

      document.getElementById("formLokasi").style.display = "none";
      document.getElementById("formRange").style.display = "none";

      if (pilihan === "lokasi") {
        document.getElementById("formLokasi").style.display = "block";
      }

      if (pilihan === "range") {
        document.getElementById("formRange").style.display = "block";
      }

    });
  </script>
  </body>

  </html>