<link rel="stylesheet" href="<?= base_url() ?>src/backend/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pengadaan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('home') ?>">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Pengadaan</a></li>
                        <li class="breadcrumb-item active">Lihat Data</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <div class="flash-data" data-flashdata="<?= $this->session->flashdata('sukses'); ?>"></div>
    <div class="flash-data-gagal" data-flashdatagagal="<?= $this->session->flashdata('gagal'); ?>"></div>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Data Pengadaan Aset
                </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>

            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<script src="<?= base_url() ?>src/backend/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?= base_url() ?>src/backend/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script>
    $(function() {
        $("#example1").DataTable({
            "language": {
                "sSearch": "Cari"
            },
            "stateSave": true,
            "stateDuration": -1
        });
    });

    function resetFilterPengadaan() {

        // Hapus state DataTables
        if ($.fn.DataTable.isDataTable('#example1')) {
            $('#example1').DataTable().state.clear();
        }

        // Hapus filter session
        window.location.href = "<?= base_url('pengadaan/reset_filter'); ?>";
    }

    $(document).ready(function() {
        function cekPilihan() {

            var checked = $('.checkItem:checked');

            var jumlah = checked.length;

            // Sembunyikan semua tombol terlebih dahulu
            $('#btnProsesMultiple').hide();
            $('#btnSetujuiMultiple').hide();
            $('#btnTolakMultiple').hide();
            $('#btnPrintMultiple').hide();

            if (jumlah === 0) {
                return;
            }

            var role = "<?= $this->session->userdata('role'); ?>";

            // ==========================================
            // AMBIL STATUS DATA YANG DIPILIH
            // ==========================================

            var semuaStatus = [];

            checked.each(function() {

                semuaStatus.push(
                    $(this).data('status').toString()
                );

            });

            // ==========================================
            // ADMIN
            // ==========================================

            if (role === '1') {

                var statusPertama = semuaStatus[0];

                var statusSama = semuaStatus.every(function(status) {
                    return status === statusPertama;
                });

                // Kalau status sama
                if (statusSama) {

                    if (statusPertama === '0') {

                        $('#btnProsesMultiple').show();

                    } else if (statusPertama === '1') {

                        $('#btnSetujuiMultiple').show();
                        $('#btnTolakMultiple').show();

                    }
                }

                // ADMIN FULL AKSES PRINT
                $('#btnPrintMultiple').show();

                return;
            }

            // ==========================================
            // MANAGER
            // ==========================================

            if (role === '2') {

                // Manager hanya boleh print
                // jika SEMUA data yang dipilih status = 2

                var semuaDisetujui = semuaStatus.every(function(status) {
                    return status === '2';
                });

                if (semuaDisetujui) {

                    $('#btnPrintMultiple').show();

                }

                return;
            }
        }

        $('#btnProsesMultiple').click(function() {

            var ids = $('.checkItem:checked').map(function() {
                return $(this).val();
            }).get();

            if (ids.length === 0) {
                alert('Silakan pilih data terlebih dahulu.');
                return;
            }

            if (!confirm(
                    'Apakah Anda yakin ingin memproses ' +
                    ids.length +
                    ' data pengadaan?'
                )) {
                return;
            }

            kirimAksiMultiple(
                "<?= base_url('pengadaan/proses_multiple'); ?>",
                ids
            );
        });

        function kirimAksiMultiple(url, ids) {

            var form = $('<form>', {
                method: 'POST',
                action: url
            });

            $.each(ids, function(index, id) {

                $('<input>', {
                    type: 'hidden',
                    name: 'id_pengadaan[]',
                    value: id
                }).appendTo(form);

            });

            form.appendTo('body');
            form.submit();
        }


        $('#btnSetujuiMultiple').click(function() {

            var ids = $('.checkItem:checked').map(function() {
                return $(this).val();
            }).get();

            if (ids.length === 0) {
                alert('Silakan pilih data terlebih dahulu.');
                return;
            }

            if (!confirm(
                    'Apakah Anda yakin ingin menyetujui ' +
                    ids.length +
                    ' data pengadaan?'
                )) {
                return;
            }

            kirimAksiMultiple(
                "<?= base_url('pengadaan/setujui_multiple'); ?>",
                ids
            );
        });


        $('#btnTolakMultiple').click(function() {

            var ids = $('.checkItem:checked').map(function() {
                return $(this).val();
            }).get();

            if (ids.length === 0) {
                alert('Apakah Anda yakin ingin menolak ' +
                    ids.length +
                    ' data pengadaan?');
                return;
            }

            if (!confirm(
                    'Apakah Anda yakin ingin menolak ' +
                    ids.length +
                    ' data pengadaan?'
                )) {
                return;
            }

            kirimAksiMultiple(
                "<?= base_url('pengadaan/tolak_multiple'); ?>",
                ids
            );
        });

        $('.checkItem').change(function() {

            // Cek tombol print
            cekPilihan();

            // Cek apakah semua checkbox terpilih
            var total = $('.checkItem').length;
            var terpilih = $('.checkItem:checked').length;

            $('#checkAll').prop(
                'checked',
                total > 0 && total === terpilih
            );

        });

        $('#checkAll').click(function() {

            $('.checkItem').prop(
                'checked',
                $(this).prop('checked')
            );

            // Tampilkan / sembunyikan tombol print
            cekPilihan();

        });

        $('#pilihSemua').click(function() {

            $('.checkItem').prop('checked', true);

            $('#checkAll').prop('checked', true);

            // Tampilkan tombol print
            cekPilihan();

        });


        $('#hapusPilihan').click(function() {

            $('.checkItem').prop('checked', false);

            $('#checkAll').prop('checked', false);

            // Sembunyikan tombol print
            cekPilihan();

        });

        $('#formPrint').submit(function(e) {

            var jumlah = $('.checkItem:checked').length;

            if (jumlah == 0) {

                e.preventDefault();

                alert('Silakan pilih minimal 1 data yang ingin dicetak.');

                return false;
            }

        });

        cekPilihan();

    });
</script>