<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Wilayah Indonesia</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/fontawesome-free/css/all.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets') ?>/dist/css/adminlte.min.css">

    <style>
        .main-header .container,
        .content-header .container,
        .content .container {
            width: 100% !important;
            max-width: 100% !important;
            padding-left: 15px !important;
            padding-right: 15px !important;
            margin-left: auto !important;
            margin-right: auto !important;
        }
        .select2-container .select2-selection--single {
            height: 38px;
        }
    </style>
</head>
<body class="hold-transition layout-top-nav">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <div class="navbar-brand">
                    <span class="brand-text font-weight-light">Data Wilayah Indonesia</span>
                </div>
            </div>
        </nav>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Data Wilayah Administrasi Indonesia</h1>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-header">
                                    <h3 class="card-title">Filter Data</h3>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Provinsi</label>
                                                <select class="form-control select2" id="province" style="width: 100%;">
                                                    <option value="">Semua Provinsi</option>
                                                    <?php foreach ($this->Wilayah_model->get_provinces() as $province): ?>
                                                        <option value="<?= $province->id ?>"><?= $province->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kabupaten/Kota</label>
                                                <select class="form-control select2" id="regency" style="width: 100%;" disabled>
                                                    <option value="">Semua Kabupaten/Kota</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Kecamatan</label>
                                                <select class="form-control select2" id="district" style="width: 100%;" disabled>
                                                    <option value="">Semua Kecamatan</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>Desa/Kelurahan</label>
                                                <select class="form-control select2" id="village" style="width: 100%;" disabled>
                                                    <option value="">Semua Desa/Kelurahan</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary card-outline">
                                <div class="card-body">
                                    <table id="wilayahTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Provinsi</th>
                                                <th>Kabupaten/Kota</th>
                                                <th>Kecamatan</th>
                                                <th>Desa/Kelurahan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Data akan diisi oleh DataTables via AJAX -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer -->
        <footer class="main-footer">
            <strong>Copyright &copy; <?= date('Y') ?> Data Wilayah Indonesia.</strong>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url('assets') ?>/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="<?php echo base_url('assets') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url('assets') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url('assets') ?>/plugins/select2/js/select2.full.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets') ?>/dist/js/adminlte.min.js"></script>

    <script>
        $(function () {
            // Inisialisasi Select2
            $('.select2').select2({
                theme: 'bootstrap4'
            });

            // Inisialisasi DataTable dengan server-side processing
            var table = $('#wilayahTable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "<?= site_url('wilayah/datatable') ?>",
                    "type": "POST",
                    "data": function (d) {
                        // Tambahkan parameter filter
                        d.province = $('#province').val();
                        d.regency = $('#regency').val();
                        d.district = $('#district').val();
                        d.village = $('#village').val();
                    }
                },
                "columns": [
                    {"data": null, "orderable": false, "className": "text-center"},
                    {"data": "province_name"},
                    {"data": "regency_name"},
                    {"data": "district_name"},
                    {"data": "village_name"}
                ],
                "order": [[1, 'asc']],
                "responsive": true,
                "autoWidth": false,
                "lengthMenu": [10, 25, 50, 100],
                "pageLength": 10,
                "createdRow": function (row, data, dataIndex) {
                    // Menambahkan nomor urut
                    $('td', row).eq(0).html(dataIndex + 1);
                }
            });

            // Event ketika filter berubah
            $('#province, #regency, #district, #village').change(function() {
                // Reset ke halaman pertama saat filter berubah
                table.ajax.reload();
                
                // Update dropdown dependensi
                if ($(this).attr('id') === 'province') {
                    var province_id = $(this).val();
                    $('#regency').val('').trigger('change').prop('disabled', !province_id);
                    $('#district').val('').trigger('change').prop('disabled', true);
                    $('#village').val('').trigger('change').prop('disabled', true);
                    
                    if (province_id) {
                        $.ajax({
                            url: '<?= site_url("wilayah/get_regencies") ?>',
                            type: 'POST',
                            data: {province_id: province_id},
                            dataType: 'json',
                            success: function(data) {
                                $('#regency').empty().append('<option value="">Semua Kabupaten/Kota</option>');
                                $.each(data, function(key, value) {
                                    $('#regency').append('<option value="'+value.id+'">'+value.name+'</option>');
                                });
                                $('#regency').prop('disabled', false);
                            }
                        });
                    }
                } else if ($(this).attr('id') === 'regency') {
                    var regency_id = $(this).val();
                    $('#district').val('').trigger('change').prop('disabled', !regency_id);
                    $('#village').val('').trigger('change').prop('disabled', true);
                    
                    if (regency_id) {
                        $.ajax({
                            url: '<?= site_url("wilayah/get_districts") ?>',
                            type: 'POST',
                            data: {regency_id: regency_id},
                            dataType: 'json',
                            success: function(data) {
                                $('#district').empty().append('<option value="">Semua Kecamatan</option>');
                                $.each(data, function(key, value) {
                                    $('#district').append('<option value="'+value.id+'">'+value.name+'</option>');
                                });
                                $('#district').prop('disabled', false);
                            }
                        });
                    }
                } else if ($(this).attr('id') === 'district') {
                    var district_id = $(this).val();
                    $('#village').val('').trigger('change').prop('disabled', !district_id);
                    
                    if (district_id) {
                        $.ajax({
                            url: '<?= site_url("wilayah/get_villages") ?>',
                            type: 'POST',
                            data: {district_id: district_id},
                            dataType: 'json',
                            success: function(data) {
                                $('#village').empty().append('<option value="">Semua Desa/Kelurahan</option>');
                                $.each(data, function(key, value) {
                                    $('#village').append('<option value="'+value.id+'">'+value.name+'</option>');
                                });
                                $('#village').prop('disabled', false);
                            }
                        });
                    }
                }
            });
        });
    </script>
</body>
</html>