<?php
if ($akses['r'] == 'N') { ?>
    <div class="container-fluid p-3">
        <div class="alert alert-danger" role="alert">
            You don't have access.
            Please call Administrator!
        </div>
    </div>
<?php } else { ?>
    <div class="container-fluid p-3">
        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <?php
                if ($breadcrumb['modul'] != '') { ?>
                    <li class="breadcrumb-item <?= (strtolower($breadcrumb['station']) == $menu) ? 'active' : '' ?>" aria-current="page"><?= $breadcrumb['station'] ?></li>
                <?php } ?>
                <?php
                if ($breadcrumb['modul'] != '') { ?>
                    <li class="breadcrumb-item <?= (strtolower($breadcrumb['modul']) == $menu) ? 'active' : '' ?>" aria-current="page"><?= $breadcrumb['modul'] ?></li>
                <?php } ?>
                <?php
                if ($breadcrumb['menu'] != '') { ?>
                    <li class="breadcrumb-item <?= (strtolower($breadcrumb['link']) == $menu) ? 'active' : '' ?>" aria-current="page"><?= $breadcrumb['menu'] ?></li>
                <?php } ?>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Data
                <a class="btn btn-sm btn-primary float-end" href="<?= base_url() . $menu ?>/export_pdf">
                    <i class="fas fa-plus"></i></a>
                <button class="btn btn-sm btn-success float-end me-3" onclick="dowload_barcode_pdf()">
                    <i class="fas fa-download"></i> Barcode</button>
                <button class="btn btn-sm btn-warning float-end me-3" onclick="dowload_qr_pdf()">
                    <i class="fas fa-download"></i> QR</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table-users" class="table table-striped nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="text-center">Nama Lengkap</th>
                                <th class="text-center">Username</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Aktif</th>
                                <th class="text-center">Level</th>
                                <th class="text-center">Jalan</th>
                                <th class="text-center">Kelurahan</th>
                                <th class="text-center">Kecamatan</th>
                                <th class="text-center">Kota</th>
                                <th class="text-center">Provinsi</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
</main>
<script>
    $(document).ready(function() {
        table_users = $('#table-users').DataTable({
            "searching": true,
            "processing": true,
            "autoWidth": false,
            "serverSide": true,
            "ajax": {
                url: "<?= base_url($menu) . "/table" ?>",
                type: "post",
                data: function(aData) {
                    aData.id = "users";
                },
                error: function() {
                    $("#table-users").append('<tbody><tr><td>No data found in the server</td></tr></tbody>');
                    $("#dynamic-table_processing").css("display", "none");

                }
            },
            "pagingType": "simple_numbers",
            "iDisplayLength": 10,
            "aoColumnDefs": [{
                    "bSortable": false,
                    "aTargets": [0, 11]
                },
                {
                    "bSearchable": false,
                    "aTargets": [0, 11]
                },
                {
                    "className": "dt-center",
                    "aTargets": [0, 11]
                }
            ],
            "order": [
                [1, "asc"]
            ],
            "scrollY": true,
            "scrollY": "500px",
            "scrollX": true,
            "scrollCollapse": true
        });
    })

    function dowload_barcode_pdf() {
        window.location = '<?= base_url($menu) ?>/dn_pdf';
    }

    function dowload_qr_pdf() {
        window.location = '<?= base_url($menu) ?>/dn_qr_pdf';
    }
</script>