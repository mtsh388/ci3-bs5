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
            <div class="card-header fw-bold">
                <?= ucwords($menu) ?>
                <button class="btn btn-sm btn-primary float-end" onclick="ModalUsers()"><i class="bi bi-plus-lg"></i></button>
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
    </main>
    <div class="modal fade" id="modalusers" aria-labelledby="modal-title-users" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-users"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-users">
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="namalengkap" class="col-4 fw-bold align-middle">Nama Lengkap <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <input type="text" class="form-control form-control-sm" name="namalengkap" id="namalengkap" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="username" class="col-4 fw-bold align-middle">Username <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <input type="text" class="form-control form-control-sm" name="username" id="username" readonly required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="email" class="col-4 fw-bold align-middle">Email <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <input type="email" class="form-control form-control-sm" name="email" id="email" readonly required>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="jalan" class="col-4 fw-bold align-middle">Jalan <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <textarea class="form-control form-control-sm" name="jalan" id="jalan" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectlevel" class="col-4 fw-bold align-middle">Level <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <select type="text" id="selectlevel" name="selectlevel" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selecetkelurahan" class="col-4 fw-bold align-middle">Kelurahan <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <select type="text" id="selectkelurahan" name="selectkelurahan" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectkecamatan" class="col-4 fw-bold align-middle">Kecamatan <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <select type="text" id="selectkecamatan" name="selectkecamatan" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectkota" class="col-4 fw-bold align-middle">Kota <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <select type="text" id="selectkota" name="selectkota" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectprovinsi" class="col-4 fw-bold align-middle">Provinsi <b class="text-danger">*</b></label>
                            <div class="col-8">
                                <select type="text" id="selectprovinsi" name="selectprovinsi" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idusers" id="idusers">
                        <input type="hidden" id="actionusers" name="actionusers">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-users">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
            $('#selectlevel').select2({
                allowClear: true,
                placeholder: 'Pilih Level',
                dropdownParent: $('#modalusers'),
                theme: "bootstrap-5",
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                    dataType: 'json',
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/pilih_level",
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
            });
            $('#selectkelurahan').select2({
                allowClear: true,
                placeholder: 'Pilih Kelurahan',
                dropdownParent: $('#modalusers'),
                theme: "bootstrap-5",
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                    dataType: 'json',
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/pilih_kelurahan",
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
            });
            $('#selectkecamatan').select2({
                allowClear: true,
                placeholder: 'Pilih Kecamatan',
                dropdownParent: $('#modalusers'),
                theme: "bootstrap-5",
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                    dataType: 'json',
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/pilih_kecamatan",
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
            });
            $('#selectkota').select2({
                allowClear: true,
                placeholder: 'Pilih Kota',
                dropdownParent: $('#modalusers'),
                theme: "bootstrap-5",
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                    dataType: 'json',
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/pilih_kota",
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
            });
            $('#selectprovinsi').select2({
                allowClear: true,
                placeholder: 'Pilih Provinsi',
                dropdownParent: $('#modalusers'),
                theme: "bootstrap-5",
                containerCssClass: "select2--small", // For Select2 v4.0
                selectionCssClass: "select2--small", // For Select2 v4.1
                dropdownCssClass: "select2--small",
                ajax: {
                    dataType: 'json',
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/pilih_provinsi",
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
            });
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
                        $("#table-detail").append('<tbody><tr><td>No data found in the server</td></tr></tbody>');
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
            $('#form-users').validate({
                rules: {
                    username: {
                        required: true,
                        remote: {
                            url: "<?= base_url() . $menu ?>/cek_username",
                            type: "post",
                            data: {
                                username: function() {
                                    return $("#username").val();
                                },
                                action: function() {
                                    return $("#actionusers").val();
                                }
                            }
                        }
                    },
                    email: {
                        required: true,
                        remote: {
                            url: "<?= base_url() . $menu ?>/cek_email",
                            type: "post",
                            data: {
                                email: function() {
                                    return $("#email").val();
                                },
                                action: function() {
                                    return $("#actionusers").val();
                                }
                            }
                        }
                    }
                },
                messages: {
                    inputprovinsi: {
                        required: "The field is mandatory",
                        remote: "Provinsi allready exist"
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

                    var idprovinsi = $("#idprovinsi").val();
                    var inputprovinsi = $("#inputprovinsi").val();
                    var statusprovinsi = $("#statusprovinsi").val();
                    if (idprovinsi == '') {
                        var action = "add";
                    } else {
                        var action = "update";
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() . $menu ?>/" + action,
                        data: {
                            "idprovinsi": idprovinsi,
                            "inputprovinsi": inputprovinsi,
                            "statusprovinsi": statusprovinsi,
                            "action": action,
                            "tab": "provinsi"
                        },
                        dataType: "json",
                        success: function(result) {

                            waitingDialog.hide();
                            if (result.msg == 'OK') {
                                $("#modalprovinsi").modal('hide');
                                if (action == 'add') {
                                    $('#alert-success').fadeIn().html('Created provinsi successfully');
                                    setTimeout(function() {
                                        $('#alert-success').fadeOut("slow");
                                        modal_clear();
                                        location.reload();
                                    }, 3000);
                                } else {
                                    $("#modalprovinsi").modal('hide');
                                    $('#alert-success').fadeIn().html('Updated provinsi successfully');
                                    setTimeout(function() {
                                        $('#alert-success').fadeOut("slow");
                                        // location.reload();
                                    }, 3000);
                                }
                            } else {
                                $("#modalprovinsi").modal('hide');
                                $('#alert-danger').fadeIn().html(result.msg);
                                setTimeout(function() {
                                    $('#alert-danger').fadeOut("slow");
                                }, 3000);
                                return false;
                            }
                        },
                        error: function(event, textStatus, errorThrown) {
                            $("#modalprovinsi").modal('hide');
                            $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                        }
                    });
                    return false;
                }
            });
        });

        function ModalUsers(id) {
            modal_clear();
            if (id) {
                var isi = id;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/data_users",
                    data: {
                        'id': isi
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#modal-title-users").html(result.modal_title_users);
                        $('#modalusers').modal('show');
                        $('#form-status-users').show();
                        $('#idusers').val(result.idusers);
                        $('#namalengkap').val(result.namalengkap);
                        $('#username').val(result.username);
                        $('#email').val(result.email);
                        $('#jalan').val(result.jalan);
                        $('#selectlevel').html('<option value="' + result.idlevel + '" selected>' + result.level + '</option>');
                        $('#selectkelurahan').html('<option value="' + result.idkelurahan + '" selected>' + result.kelurahan + '</option>');
                        $('#selectkecamatan').html('<option value="' + result.idkecamatan + '" selected>' + result.kecamatan + '</option>');
                        $('#selectkota').html('<option value="' + result.idkota + '" selected>' + result.kota + '</option>');
                        $('#selectprovinsi').html('<option value="' + result.idprovinsi + '" selected>' + result.provinsi + '</option>');
                        $("#actionusers").val('update')
                    }
                });

            } else {
                $("#actionusers").val('add')
                $("#modal-title-users").html("New users");
                $('#modalusers').modal('show');
                $('#form-status-users').hide();
            }
        }

        function modal_clear() {
            $("#namalengkap").val('');
            $("#idusers").val('');
            $("#actionusers").val('');
        }
    </script>
<?php } ?>