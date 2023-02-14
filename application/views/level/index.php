<?php
if ($akses['r'] == "N") {

?>
    <div class="container-fluid p-3">
        <div class="alert alert-danger" role="alert">
            You don't have access.
            Please call Administrator!
        </div>
    </div>
    </main>
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
                    <li class="breadcrumb-item <?= (strtolower($breadcrumb['menu']) == $menu) ? 'active' : '' ?>" aria-current="page"><?= $breadcrumb['menu'] ?></li>
                <?php } ?>
            </ol>
        </nav>
        <div class="card">
            <div class="card-header fw-bold">
                Level
                <button class="btn btn-sm btn-primary float-end" onclick="modal_level()"><i class="bi bi-plus-lg"></i></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="tbl-level" class="table table-striped nowrap">
                        <thead>
                            <tr>

                                <th>Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data_level as $data_level) { ?>
                                <tr>

                                    <td><?= $data_level['level'] ?></td>
                                    <td><a class="btn btn-warning btn-sm" onclick="modal_level(<?= $data_level['id'] ?>)"><i class="bi bi-pencil-square"></i> | Edit</a>
                                        <a class="btn btn-danger btn-sm" onclick="del_level(<?= $data_level['id'] ?>)"><i class="bi bi-trash"></i> | Delete</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </main>
    <div class="modal fade" id="modallevel" aria-labelledby="modal-title-level" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-level"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-level">
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="inputlevel" class="col-3 fw-bold align-middle">Level <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-sm" name="inputlevel" id="inputlevel" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idlevel" id="idlevel">
                        <input type="hidden" id="action" name="action">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php } ?>
<script>
    $(document).ready(function() {
        $('#myTab a').click(function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        activeTab = $('a[data-bs-toggle="tab"]').on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
            activeTab = $(e.target).text().toLowerCase();
        });

        var hash = window.location.hash;
        $('#myTab a[href="' + hash + '"]').tab('show');

        $('#tbl-level').DataTable({
            "processing": false,
            columnDefs: [{
                    targets: [1],
                    className: 'dt-center',
                },
                {
                    bSortable: false,
                    target: [1]
                }
            ]
        });
        $('#form-level').validate({
            rules: {
                inputlevel: {
                    required: true
                }
            },
            messages: {
                inputlevel: {
                    required: "The field is mandatory"
                }
            },
            highlight: function(element, errorClass) {
                if (element.closest(".form-control")) {
                    $(element).closest(".form-control").addClass("is-invalid");
                } else {
                    $(element).closest(".form-select").addClass("is-invalid");
                }
            },
            unhighlight: function(element, errorClass) {
                if (element.closest(".form-control")) {
                    $(element).closest(".form-control").removeClass("is-invalid");
                } else {
                    $(element).closest(".form-select").removeClass("is-invalid");
                }
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('.form-control')) {
                    error.insertAfter(element.parent());
                } else if (element.hasClass('form-select')) {
                    error.insertAfter(element.next('span'));
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function(form) {

                var idlevel = $("#idlevel").val();
                var inputlevel = $("#inputlevel").val();
                if (idlevel == '') {
                    var action = "add";
                } else {
                    var action = "update";
                }
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/" + action,
                    data: {
                        "idlevel": idlevel,
                        "inputlevel": inputlevel
                    },
                    dataType: "json",
                    success: function(result) {
                        waitingDialog.hide();
                        if (result.msg == 'OK') {
                            $("#modallevel").modal('hide');
                            if (action == 'add') {
                                $('#alert-success').fadeIn().html('Created level successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            } else {
                                $("#modallevel").modal('hide');
                                $('#alert-success').fadeIn().html('Updated level successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            }
                        } else {
                            $("#modallevel").modal('hide');
                            $('#alert-danger').fadeIn().html(result.msg);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                            return false;
                        }
                    },
                    error: function(event, textStatus, errorThrown) {
                        $("#modallevel").modal('hide');
                        $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 3000);
                    }
                });
                return false;
            }
        });
        window.setTimeout(function() {
            $("#pesan").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);
    });

    function del_level(id) {
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/delete",
                data: {
                    'idlevel': isi
                },
                dataType: 'json',
                success: function(result) {
                    if (result.msg == "OK") {
                        $('#alert-success').fadeIn().html("Deleted successfully");
                        setTimeout(function() {
                            $('#alert-success').fadeOut("slow");
                            location.reload();
                        }, 3000);
                    } else {
                        $('#alert-danger').fadeIn().html(result.msg);
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 3000);
                    }
                }
            });
        } else {
            $('#alert-danger').fadeIn().html("Please try again");
            setTimeout(function() {
                $('#alert-danger').fadeOut("slow");

            }, 2000);
        }
    }

    function modal_level(id) {
        modal_level_clear();
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/data_level",
                data: {
                    'id': isi
                },
                dataType: 'json',
                success: function(result) {
                    $("#modal-title-level").html(result.modal_title_level);
                    $('#modallevel').modal('show');
                    $('#inputlevel').val(result.level);
                    $('#idlevel').val(result.idlevel);
                }
            });

        } else {
            $("#modal-title-level").html("New levels");
            $('#modallevel').modal('show');
        }
    }

    function modal_level_clear() {
        $("#idlevel").val("");
        $("#inputlevel").val("");
        $("#modal-title-station").html("");
    }
</script>