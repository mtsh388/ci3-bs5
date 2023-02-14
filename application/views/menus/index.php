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
        <ul id="myTab" class="nav nav-tabs">
            <li class="nav-item">
                <a href="#stations" class="nav-link active" id="stations-tab" data-bs-toggle="tab">Stations</a>
            </li>
            <li class="nav-item">
                <a href="#moduls" class="nav-link" id="moduls-tab" data-bs-toggle="tab">Moduls</a>
            </li>
            <li class="nav-item">
                <a href="#menus" class="nav-link" id="menus-tab" data-bs-toggle="tab">Menus</a>
            </li>
            <li class="nav-item">
                <a href="#akses-menus" class="nav-link" id="akses-tab" data-bs-toggle="tab">Akses</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="stations">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Stations <button class="btn btn-sm btn-primary float-end" onclick="modal_station()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-stations" class="table table-striped nowrap">
                                <thead>
                                    <tr>

                                        <th>Station</th>
                                        <th>Icon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($data_station as $data_station) { ?>
                                        <tr>

                                            <td><?= $data_station['station'] ?></td>
                                            <td><i class="<?= $data_station['icon'] ?>"></i></td>
                                            <td>
                                                <a class="btn btn-warning btn-sm" onclick="modal_station(<?= $data_station['idstation'] ?>)"><i class="bi bi-pencil-square"></i> | Edit</a>
                                                <a class="btn btn-danger btn-sm" onclick="del_station(<?= $data_station['idstation'] ?>)"><i class="bi bi-trash"></i> | Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="moduls">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Moduls
                        <button class="btn btn-sm btn-primary float-end" onclick="modal_modul()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-moduls" class="table table-striped nowrap">
                                <thead>
                                    <tr>

                                        <th>Modul</th>
                                        <th>Icon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($data_modul as $data_modul) { ?>
                                        <tr>

                                            <td><?= $data_modul['modul'] ?></td>
                                            <td><i class="<?= $data_modul['icon'] ?>"></i></td>
                                            <td><a class="btn btn-warning btn-sm" onclick="modal_modul(<?= $data_modul['idmodul'] ?>)"><i class="bi bi-pencil-square"></i> | Edit</a>
                                                <a class="btn btn-danger btn-sm" onclick="del_modul(<?= $data_modul['idmodul'] ?>)"><i class="bi bi-trash"></i> | Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="menus">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Menus
                        <button class="btn btn-sm btn-primary float-end" onclick="modal_menu()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-menus" class="table table-striped nowrap">
                                <thead>
                                    <tr>

                                        <th>Menu</th>
                                        <th>Link</th>
                                        <th>Icon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php

                                    foreach ($data_menu as $data_menu) { ?>
                                        <tr>

                                            <td><?= $data_menu['menu'] ?></td>
                                            <td><?= $data_menu['link'] ?></td>
                                            <td><i class="<?= $data_menu['icon'] ?>"></i></td>
                                            <td><a class="btn btn-warning btn-sm" onclick="modal_menu(<?= $data_menu['idmenu'] ?>)"><i class="bi bi-pencil-square"></i> | Edit</a>
                                                <a class="btn btn-danger btn-sm" onclick="del_menu(<?= $data_menu['idmenu'] ?>)"><i class="bi bi-trash"></i> | Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="akses-menus">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Akses Menu
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-akses-menus" class="table table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Station</th>
                                        <th>Modul</th>
                                        <th>Menu</th>
                                        <th>Create</th>
                                        <th>Read</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data_akses_menu as $data_akses_menu) { ?>
                                        <tr>
                                            <td><?= $data_akses_menu['level'] ?></td>
                                            <td><?= $data_akses_menu['station'] ?></td>
                                            <td><?= $data_akses_menu['modul'] ?></td>
                                            <td><?= $data_akses_menu['menu'] ?></td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="<?= $data_akses_menu['idakses'] ?>" onclick="update_akses(<?= $data_akses_menu['idakses'] ?>)" id="create<?= $data_akses_menu['idakses'] ?>" name="create" <?= ($data_akses_menu['c'] == 'Y') ? 'checked' : '' ?>>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="<?= $data_akses_menu['idakses'] ?>" onclick="update_akses(<?= $data_akses_menu['idakses'] ?>)" id="read<?= $data_akses_menu['idakses'] ?>" name="read" <?= ($data_akses_menu['r'] == 'Y') ? 'checked' : '' ?>>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="<?= $data_akses_menu['idakses'] ?>" onclick="update_akses(<?= $data_akses_menu['idakses'] ?>)" id="update<?= $data_akses_menu['idakses'] ?>" name="update" <?= ($data_akses_menu['u'] == 'Y') ? 'checked' : '' ?>>
                                            </td>
                                            <td>
                                                <input class="form-check-input" type="checkbox" value="<?= $data_akses_menu['idakses'] ?>" onclick="update_akses(<?= $data_akses_menu['idakses'] ?>)" id="delete<?= $data_akses_menu['idakses'] ?>" name="delete" <?= ($data_akses_menu['d'] == 'Y') ? 'checked' : '' ?>>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php }
?>
<div class="modal fade" id="modalstation" aria-labelledby="modal-title-station" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-station"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-station">
                <div class="modal-body">
                    <div class="form-group row mb-3">
                        <label for="inputstation" class="col-3 fw-bold align-middle">Station <b class="text-danger">*</b></label>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm" name="inputstation" id="inputstation" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="iconstation" class="col-3 fw-bold align-middle">Icon</label>
                        <div class="col-9">
                            <input type="text" class="form-control iconpicker" id="iconstation" name="iconstation" placeholder="Pilih Icon" aria-label="Icone Picker" aria-describedby="basic-addon1" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idstation" id="idstation">
                    <input type="hidden" id="action" name="action">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-station">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalmodul" aria-labelledby="modal-title-modul" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-modul"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-modul">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputiconstation" class="col-3 fw-bold align-middle">Station <b class="text-danger">*</b></label>
                        <div class="col-9 mb-3">
                            <select type="text" id="idstationmodul" name="idstationmodul" class="form-select" aria-describedby="validationServer04Feedback">
                                <option value=""></option>
                                <?php foreach ($data_station_modul as $data_station_modul) { ?>
                                    <option value="<?= $data_station_modul['idstation'] ?>"><?= $data_station_modul['station'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputmodul" class="col-3 fw-bold align-middle">Modul <b class="text-danger">*</b></label>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm" name="inputmodul" id="inputmodul" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="iconmodul" class="col-3 fw-bold align-middle">Icon</label>
                        <div class="col-9">
                            <input type="text" class="form-control iconpicker" id="iconmodul" name="iconmodul" placeholder="Pilih Icon" aria-label="Icone Picker" aria-describedby="basic-addon1" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idmodul" id="idmodul">
                    <input type="hidden" id="action" name="action">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-modul">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="modalmenu" aria-labelledby="modal-title-menu" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal-title-menu"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-menu">
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="inputiconstation" class="col-3 fw-bold align-middle">Station <b class="text-danger">*</b></label>
                        <div class="col-9 mb-3">
                            <select type="text" id="idstationmenu" name="idstationmenu" class="form-select" aria-describedby="validationServer04Feedback">
                                <option value=""></option>
                                <?php foreach ($data_station_menu as $data_station_menu) { ?>
                                    <option value="<?= $data_station_menu['idstation'] ?>"><?= $data_station_menu['station'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputiconstation" class="col-3 fw-bold align-middle">Modul <b class="text-danger">*</b></label>
                        <div class="col-9 mb-3">
                            <select type="text" id="idmodulmenu" name="idmodulmenu" class="form-select" aria-describedby="validationServer04Feedback">
                                <option value=""></option>
                                <?php foreach ($data_modul_menu as $data_modul_menu) { ?>
                                    <option value="<?= $data_modul_menu['idmodul'] ?>"><?= $data_modul_menu['modul'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="inputmenu" class="col-3 fw-bold align-middle">Menu <b class="text-danger">*</b></label>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm" name="inputmenu" id="inputmenu" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="link" class="col-3 fw-bold align-middle" id="labellink">Link <b class="text-danger">*</b></label>
                        <div class="col-9">
                            <input type="text" class="form-control form-control-sm" name="link" id="link" required>
                        </div>
                    </div>
                    <div class="form-group row mb-3">
                        <label for="iconmenu" class="col-3 fw-bold align-middle">Icon</label>
                        <div class="col-9">
                            <input type="text" class="form-control iconpicker" id="iconmenu" name="iconmenu" placeholder="Pilih Icon" aria-label="Icone Picker" aria-describedby="basic-addon1" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="idmenu" id="idmenu">
                    <input type="hidden" id="action" name="action">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="submit-modul">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
</main>
<script>
    $(document).ready(function() {
        $(".iconpicker").iconpicker({
            // customize the icon picker with the following options
            // THANKS FOR WATCHING!
            title: "Icons",
            selected: false,
            defaultValue: false,
            placement: "center",
            collision: "none",
            animation: true,
            hideOnSelect: true,
            showFooter: true,
            searchInFooter: false,
            mustAccept: false,
            selectedCustomClass: "bg-primary",
            fullClassFormatter: function(e) {
                return e;
            },
            input: "input,.iconpicker-input",
            inputSearch: false,
            container: false,
            component: ".input-group-addon,.iconpicker-component",
            templates: {
                popover: '<div class="iconpicker-popover popover" role="tooltip"><div class="arrow"></div>' +
                    '<div class="popover-title"></div><div class="popover-content"></div></div>',
                footer: '<div class="popover-footer"></div>',
                buttons: '<button class="iconpicker-btn iconpicker-btn-cancel btn btn-default btn-sm"  style="display:none;">Cancel</button>' +
                    ' <button class="iconpicker-btn iconpicker-btn-accept btn btn-primary btn-sm" style="display:none;">Accept</button>',
                search: '<input type="search" class="form-control iconpicker-search" placeholder="Type to filter" />',
                iconpicker: '<div class="iconpicker"><div class="iconpicker-items"></div></div>',
                iconpickerItem: '<a role="button" href="javascript:;" class="iconpicker-item"><i></i></a>',
            },
        });
        $('#form-station').validate({
            rules: {
                inputstation: {
                    required: true
                },
                inputiconstation: {
                    required: true
                }
            },
            messages: {
                inputstation: {
                    required: "The field is mandatory"
                },
                inputiconstation: {
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

                var idstation = $("#idstation").val();
                var inputstation = $("#inputstation").val();
                var inputiconstation = $("#iconstation").val();
                if (idstation == '') {
                    var action = "add";
                } else {
                    var action = "update";
                }
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/" + action,
                    data: {
                        "idstation": idstation,
                        "inputstation": inputstation,
                        "inputiconstation": inputiconstation,
                        "action": action,
                        "tab": "stations"
                    },
                    dataType: "json",
                    success: function(result) {

                        waitingDialog.hide();
                        if (result.msg == 'OK') {
                            $("#modalstation").modal('hide');
                            if (result.action == 'add') {
                                $('#alert-success').fadeIn().html('Created station successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            } else {
                                $("#modalstation").modal('hide');
                                $('#alert-success').fadeIn().html('Updated station successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            }
                        } else {
                            $("#modalstation").modal('hide');
                            $('#alert-danger').fadeIn().html(result.msg);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                            return false;
                        }
                    },
                    error: function(event, textStatus, errorThrown) {
                        $("#modalstation").modal('hide');
                        $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 3000);
                    }
                });
                return false;
            }
        });
        $('#form-modul').validate({
            rules: {
                idstationmodul: {
                    required: true
                },
                inputmodul: {
                    required: true
                },
                inputiconmodul: {
                    required: true
                }
            },
            messages: {
                idstationmodul: {
                    required: "The field is mandatory"
                },
                inputmodul: {
                    required: "The field is mandatory"
                },
                inputiconmodul: {
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

                var idmodul = $("#idmodul").val();
                var idstation = $("#idstationmodul").val();
                var inputmodul = $("#inputmodul").val();
                var inputiconmodul = $("#iconmodul").val();
                if (idmodul == '') {
                    var action = "add";
                } else {
                    var action = "update";
                }
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/" + action,
                    data: {
                        "idmodul": idmodul,
                        "idstation": idstation,
                        "inputmodul": inputmodul,
                        "inputiconmodul": inputiconmodul,
                        "action": action,
                        "tab": "moduls"
                    },
                    dataType: "json",
                    success: function(result) {

                        waitingDialog.hide();
                        if (result.msg == 'OK') {
                            $("#modalmodul").modal('hide');
                            if (result.action == 'add') {
                                $('#alert-success').fadeIn().html('Created modul successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            } else {
                                $("#modalmodul").modal('hide');
                                $('#alert-success').fadeIn().html('Updated modul successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            }
                        } else {
                            $("#modalmodul").modal('hide');
                            $('#alert-danger').fadeIn().html(result.msg);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                            return false;
                        }
                    },
                    error: function(event, textStatus, errorThrown) {
                        $("#modalmodul").modal('hide');
                        $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 3000);
                    }
                });
                return false;
            }
        });
        $('#form-menu').validate({
            rules: {
                idstationmenu: {
                    required: true
                },
                idmodulmenu: {
                    required: true
                },
                inputmenu: {
                    required: true
                },
                link: {
                    required: true
                },
                inputiconmenu: {
                    required: true
                }
            },
            messages: {
                idstationmenu: {
                    required: "The field is mandatory"
                },
                idmodulmenu: {
                    required: "The field is mandatory"
                },
                inputmenu: {
                    required: "The field is mandatory"
                },
                link: {
                    required: "The field is mandatory"
                },
                inputiconmenu: {
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

                var idmenu = $("#idmenu").val();
                var idstation = $("#idstationmenu").val();
                var idmodul = $("#idmodulmenu").val();
                var inputmenu = $("#inputmenu").val();
                var link = $("#link").val();
                var inputiconmenu = $("#iconmenu").val();
                if (idmenu == '') {
                    var action = "add";
                } else {
                    var action = "update";
                }
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/" + action,
                    data: {
                        "idstation": idstation,
                        "idmodul": idmodul,
                        "idmenu": idmenu,
                        "inputmenu": inputmenu,
                        "link": link,
                        "inputiconmenu": inputiconmenu,
                        "action": action,
                        "tab": "menus"
                    },
                    dataType: "json",
                    success: function(result) {
                        waitingDialog.hide();
                        if (result.msg == 'OK') {
                            $("#modalmenu").modal('hide');
                            if (result.action == 'add') {
                                $('#alert-success').fadeIn().html('Created menu successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            } else {
                                $("#modalmenu").modal('hide');
                                $('#alert-success').fadeIn().html('Updated menu successfully');
                                setTimeout(function() {
                                    $('#alert-success').fadeOut("slow");
                                    location.reload();
                                }, 3000);
                            }
                        } else {
                            $("#modalmenu").modal('hide');
                            $('#alert-danger').fadeIn().html(result.msg);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                            return false;
                        }
                    },
                    error: function(event, textStatus, errorThrown) {
                        $("#modalmenu").modal('hide');
                        $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                        setTimeout(function() {
                            $('#alert-danger').fadeOut("slow");
                        }, 3000);
                    }
                });
                return false;
            }
        });

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
        $('#table-stations').DataTable({
            "processing": false,
            columnDefs: [{
                    targets: [1, 2],
                    className: 'dt-center',
                },
                {
                    bSortable: false,
                    target: [0, 2]
                }
            ]
        });
        $('#table-moduls').DataTable({
            "processing": false,
            columnDefs: [{
                    targets: [1, 2],
                    className: 'dt-center',
                },
                {
                    bSortable: false,
                    target: [0, 2]
                }
            ]
        });
        $('#table-menus').DataTable({
            "processing": false,
            columnDefs: [{
                    targets: [1, 2],
                    className: 'dt-center',
                },
                {
                    bSortable: false,
                    target: [0, 2]
                }
            ]
        });
        $('#table-akses-menus').DataTable({
            "processing": false,
            columnDefs: [{
                    targets: [4, 5, 6, 7],
                    className: 'dt-center',
                },
                {
                    bSortable: false,
                    target: [4, 5, 6, 7]
                }
            ]
        });

        window.setTimeout(function() {
            $("#pesan").fadeTo(1000, 0).slideUp(1000, function() {
                $(this).remove();
            });
        }, 2000);
    });

    function formatText(icon) {
        return $('<span><i class="' + $(icon.element).data("icon") + '"></i> ' + "</span>");
    }

    function update_akses(id) {
        var create = $("#create" + id).prop('checked');
        var read = $('#read' + id).prop('checked');
        var update = $('#update' + id).prop('checked');
        var del = $('#delete' + id).prop('checked');
        var tab = activeTab;
        $.ajax({
            type: "POST",
            url: "<?= base_url() . $menu ?>/update",
            data: {
                'id': id,
                'create': create,
                'read': read,
                'update': update,
                'delete': del,
                'tab': activeTab
            },
            dataType: 'json',
            success: function(result) {
                if (result.msg == 'OK') {
                    $('#alert-success').fadeIn().html('Updated Successfully');
                    setTimeout(function() {
                        $('#alert-success').fadeOut("slow");
                        location.reload();
                    }, 3000);
                } else {
                    $('#alert-danger').fadeIn().html(result.msg);
                    setTimeout(function() {
                        $('#alert-danger').fadeOut("slow");
                        location.reload();
                    }, 3000);
                }
            },
            error: function(event, textStatus, errorThrown) {
                $('#alert-danger').fadeIn().html(textStatus);
                setTimeout(function() {
                    $('#alert-danger').fadeOut("slow");
                }, 3000);
            }
        });
    }

    function modal_station(id) {
        modal_station_clear();
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/data_station",
                data: {
                    'id': isi
                },
                dataType: 'json',
                success: function(result) {
                    $("#modal-title-station").html(result.modal_title_station);
                    $('#modalstation').modal('show');
                    $('#inputstation').val(result.station);
                    $('#iconstation').val(result.icon_station);
                    $('#idstation').val(result.idstation);
                }
            });

        } else {
            $("#modal-title-station").html("New Stations");
            $('#modalstation').modal('show');
        }
    }

    function modal_modul(id) {
        modal_modul_clear();
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/data_modul",
                data: {
                    'id': isi
                },
                dataType: 'json',
                success: function(result) {
                    $("#modal-title-modul").html(result.modal_title_modul);
                    $('#modalmodul').modal('show');
                    $('#inputmodul').val(result.modul);
                    $('#iconmodul').val(result.icon_modul);
                    $('#idstationmodul').val(result.idstation);
                    $('#idmodul').val(result.idmodul);
                }
            });

        } else {
            $("#modal-title-modul").html("New Moduls");
            $('#modalmodul').modal('show');
        }
    }

    function modal_menu(id) {
        modal_menu_clear();
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/data_menu",
                data: {
                    'id': isi
                },
                dataType: 'json',
                success: function(result) {
                    $("#modal-title-menu").html(result.modal_title_menu);
                    $('#modalmenu').modal('show');
                    $('#inputmenu').val(result.menu);
                    $('#link').val(result.link);
                    $('#link').hide();
                    $('#labellink').hide();
                    $('#iconmenu').val(result.icon_menu);
                    $('#idstationmenu').val(result.idstation);
                    $('#idmodulmenu').val(result.idmodul);
                    $('#idmenu').val(result.idmenu);
                }
            });

        } else {
            $("#modal-title-menu").html("New Menus");
            $('#modalmenu').modal('show');
        }
    }

    function del_station(id) {
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/delete",
                data: {
                    'idstation': isi,
                    'tab': "stations"
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

    function del_modul(id) {
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/delete",
                data: {
                    'idmodul': isi,
                    'tab': "moduls"
                },
                dataType: 'json',
                success: function(result) {
                    if (result.msg == "OK") {
                        $('#alert-success').fadeIn().html("Deleted modul successfully");
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

            }, 3000);
        }
    }

    function del_menu(id) {
        if (id) {
            var isi = id;
            $.ajax({
                type: "POST",
                url: "<?= base_url() . $menu ?>/delete",
                data: {
                    'idmenu': isi,
                    'tab': "menus"
                },
                dataType: 'json',
                success: function(result) {
                    if (result.msg == "OK") {
                        $('#alert-success').fadeIn().html("Deleted menu successfully");
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

            }, 3000);
        }
    }

    function modal_station_clear() {
        $("#idstation").val("");
        $("#inputstation").val("");
        $("#iconstation").val("");
        $("#modal-title-station").html("");
    }

    function modal_modul_clear() {
        $("#idstationmodul").val("").trigger('change');
        $("#idmodul").val("");
        $("#inputmodul").val("");
        $("#iconmodul").val("");
        $("#modal-title-modul").html("");
    }

    function modal_menu_clear() {
        $("#idstationmenu").val("").trigger('change');
        $("#idmodulmenu").val("").trigger('change');
        $("#idmodul").val("");
        $("#inputmodul").val("");
        $("#iconmenu").val("");
        $("#modal-title-menu").html("");
    }
</script>