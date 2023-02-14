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
                Data Excel <button class="btn btn-sm btn-primary float-end" onclick="modal()"><i class="fas fa-plus"></i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped nowrap" id="table-index">
                        <thead>
                            <tr>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </main>
    <div class="modal fade" id="modalform" aria-labelledby="modal-title-form" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-form"></h5>
                    <button type="button" class="btn-close closemodal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-success hide m-3" role="alert" id="modal-success">
                    </div>
                    <div class="alert alert-danger hide m-3" role="alert" id="modal-danger">
                    </div>
                    <div class="row mb-3">
                        <form method="POST">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="text" class="col-form-label fw-bold">Text <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="text" id="text" name="text" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="number" class="col-form-label fw-bold">Number <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-sm-8">
                                    <input type="number" id="number" name="number" class="form-control form-control-sm">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <label for="select" class="col-form-label fw-bold">Select <b class="text-danger">*</b></label>
                                </div>
                                <div class="col-sm-8">
                                    <select id="select" name="select" class="form-select form-control-sm">
                                    </select>
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

        $("#select").select2({
            allowClear: true,
            placeholder: 'Pilih Matdoc / TRN',
            ajax: {
                dataType: 'json',
                type: "POST",
                url: 'single_input/pilih_select',
                delay: 600,
                data: function(params) {
                    return {
                        search: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        })

    });

    function modal(id) {
        ModalClear();
        if (id) {
            $.ajax({
                type: "POST",
                url: "aksi.php?pages=&act=read&sub=data-edit",
                data: {
                    'id': id
                },
                dataType: "json",
                success: function(result) {
                    $("#loading").hide();
                    $("#id").val(id);
                    $("#act").val("edit");
                    $("#modal-title-form").html("Form Edit");
                    $("#material_id").val(result.mat_id);
                    $("#material_name").val(result.mat_name);
                    $("#iduom").val(result.iduom).trigger('change');
                    $('input[name=sn_flag][value=' + result.sn_flag + ']').attr('checked', 'checked');
                    if (result.domain_name == 'POWER') {
                        // $('#sub_domain').val(result.sub_domain).prop('checked', 'checked');
                        $("#sub_domain").val(result.sub_domain).trigger('change');
                    }
                    $("#iddomain").val(result.iddomain).trigger('change');
                    $("#idvendor").val(result.idvendor).trigger('change');
                    $("#modal-material").modal("show");
                },
                error: function(event, textStatus, errorThrown) {
                    swal({
                        title: "Error !",
                        text: 'Error Message: ' + textStatus + ' , HTTP Error: ' + errorThrown,
                        type: "error"
                    }, function() {
                        location.reload();
                    })
                }
            });
        } else {
            $("#act").val("add");
            $("#modal-title-form").html("New Form");
            $("#modalform").modal("show");
        }
    }

    function ModalClear() {

    }
</script>