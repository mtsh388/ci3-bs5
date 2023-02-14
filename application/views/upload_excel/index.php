<?php
if ($akses['r'] == 'N') { ?>
    <div class="container-fluid p-3">
        <div class="alert alert-danger" role="alert">
            You don't have access.
            Please call Administrator!
        </div>
    </div>
<?php } else {
    $trans = isset($_GET['trans']) ? $_GET['trans'] : '';
?>
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
                Data Excel <button class="btn btn-sm btn-primary float-end" onclick="modal_excel()"><i class="fas fa-plus"></i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped nowrap" id="table-excel">
                        <thead>
                            <tr>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($data_detail as $detail) { ?>
                                <tr>
                                    <td><?= $detail['a'] ?></td>
                                    <td><?= $detail['b'] ?></td>
                                    <td><?= $detail['c'] ?></td>
                                    <td><?= $detail['d'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </main>
    <div class="modal fade" id="modalexcel" aria-labelledby="modal-title-excel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-excel"></h5>
                    <button type="button" class="btn-close closemodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success hide m-3" role="alert" id="modal-success">
                    </div>
                    <div class="alert alert-danger hide m-3" role="alert" id="modal-danger">
                    </div>
                    <div class="row">
                        <form method="POST" enctype="multipart/form-data" id="fileUploadForm">
                            <div class="form-group row mb-3">
                                <label for="file-excel" class="col-3 align-middle fw-bold fw-6">File Upload <b class="text-danger">*</b></label>
                                <div class="col-9">
                                    <input class="form-control form-control-sm" id="fileupload" name="fileupload" type="file" required>
                                </div>
                            </div>
                            <input type="hidden" id="trans" name="trans">
                            <div class="row">
                                <div class="col-9">
                                    <p style="font-size: 10pt;">Download file template <a href="<?= base_url() ?>assets/file/upload-excel/temp.xlsx" class="text-decoration-none"><b>(<i class="bi bi-download"></i> template.xlsx)</b></a>.</p>
                                </div>
                                <div class="col-3">
                                    <button type="button" class="btn btn-primary btn-sm float-end my-2 " id="submitexcel">Check File</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="table-responsive">
                        <table class="table nowrap table-responsive table-bordered table-striped display" id="tbl-notes" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Validation Result</th>
                                    <th>Qty</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-sm" id="kirim">Kirim</button>
                    <button type="button" class="btn btn-secondary closemodal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $(document).ready(function() {
        $('#table-excel').DataTable({
            "processing": false,
            columnDefs: [{
                    targets: [0, 1, 2, 3],
                    className: 'dt-center',
                },
                {
                    bSortable: false,
                    target: [0, 1, 2, 3]
                }
            ]
        })
    });

    tablenotes = $('#tbl-notes').DataTable({
        "searching": false,
        "processing": false,
        "autoWidth": true,
        "serverSide": true,
        "ajax": {
            url: "<?= base_url('Upload_excel/data_notes') ?>",
            type: "post",
            data: function(aData) {
                aData.trans = $('#trans').val();
            },
            error: function() {
                $("#tbl-notes").append('<tbody><tr><td>No data found in the server</td></tr></tbody>');
            }
        },
        "pagingType": "simple_numbers",
        "lengthChange": false,
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, 1, 2]
            },
            {
                "bSearchable": false,
                "aTargets": [0, 1, 2]
            },
            {
                "className": "dt-left",
                "aTargets": [1]
            },
            {
                "className": "dt-center",
                "aTargets": [0, 2]
            }
        ],
        "order": [
            [0, "asc"]
        ],
        "scrollCollapse": true
    });
    $("#submitexcel").click(function() {
        var trans = $('#trans').val();
        var form = $('#fileUploadForm')[0];
        var data = new FormData(form);
        $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            processData: false, // Important!
            contentType: false,
            cache: false,
            url: "<?= base_url() . $menu ?>/add",
            data: data,
            dataType: "json",
            success: function(result) {
                if (result.msg == 'OK') {
                    $("#trans").val(result.trans);
                    $("#fileupload").val('');
                    $("#modalexcel").modal('show');
                    $(".closemodal").hide();
                    refreshTable();
                    if (result.kirim == 0) {
                        $("#kirim").show();
                    } else {
                        $("#kirim").hide();
                    }
                    $('#modal-success').fadeIn().html("Check file success");
                    setTimeout(function() {
                        $('#modal-success').fadeOut("slow");
                    }, 3000);
                    setInterval(function() {}, 3000);
                } else {
                    $("#fileupload").val('');
                    $('#modal-danger').fadeIn().html(result.msg);
                    setTimeout(function() {
                        $('#modal-danger').fadeOut("slow");
                    }, 3000);
                    $("#modalexcel").modal('show');
                    return false;
                }
            },
            error: function(event, textStatus, errorThrown) {
                $("#fileupload").val('');
                $("#modalexcel").modal('show');
                $('#modal-danger').fadeIn().html("HTTP: " + errorThrown);
                setTimeout(function() {
                    $('#modal-danger').fadeOut("slow");
                }, 3000);
            }
        });
    })
    $("#kirim").click(function() {
        var trans = $("#trans").val();
        $.ajax({
            type: "POST",
            url: "<?= base_url() . $menu ?>/submitdetail",
            data: {
                'trans': trans
            },
            dataType: "json",
            success: function(result) {
                if (result.msg == 'OK') {
                    $("#trans").val('');
                    $("#fileupload").val('');
                    $("#modalexcel").modal('hide');
                    $('#alert-success').fadeIn().html("Check file success");
                    setTimeout(function() {
                        $('#alert-success').fadeOut("slow");
                    }, 3000);
                    location.reload();
                } else {
                    $("#fileupload").val('');
                    $('#modal-danger').fadeIn().html(result.msg);
                    setTimeout(function() {
                        $('#modal-danger').fadeOut("slow");
                    }, 3000);
                    $("#modalexcel").modal('show');
                    return false;
                }
            },
            error: function(event, textStatus, errorThrown) {
                $("#fileupload").val('');
                $("#modalexcel").modal('show');
                $('#modal-danger').fadeIn().html("HTTP: " + errorThrown);
                setTimeout(function() {
                    $('#modal-danger').fadeOut("slow");
                }, 3000);
            }
        });
    })

    function refreshTable() {
        tablenotes.ajax.reload();
    }

    function modal_excel() {
        $("#modal-title-excel").html('Form Upload');
        $('#modalexcel').modal('show');
        $('#kirim').hide();
        $('.closemodal').show();
    }
</script>