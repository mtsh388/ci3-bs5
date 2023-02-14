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
                <a href="#provinsi" class="nav-link active" id="provinsi-tab" data-bs-toggle="tab">Provinsi</a>
            </li>
            <li class="nav-item">
                <a href="#kota" class="nav-link" id="kota-tab" data-bs-toggle="tab">Kota</a>
            </li>
            <li class="nav-item">
                <a href="#kecamatan" class="nav-link" id="kecamatan-tab" data-bs-toggle="tab">Kecamatan</a>
            </li>
            <li class="nav-item">
                <a href="#kelurahan" class="nav-link" id="kelurahan-tab" data-bs-toggle="tab">Kelurahan</a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="provinsi">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Provinsi <button class="btn btn-sm btn-primary float-end" onclick="ModalProvinsi()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-provinsi" class="table table-striped table-bordered nowrap">
                                <thead class="table-info">
                                    <tr>
                                        <th>No</th>
                                        <th>Provinsi</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="kota">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Kota <button class="btn btn-sm btn-primary float-end" onclick="ModalKota()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-kota" class="table table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kota</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade " id="kecamatan">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Kecamatan <button class="btn btn-sm btn-primary float-end" onclick="ModalKecamatan()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-kecamatan" class="table table-striped nowrap">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kecamatan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade " id="kelurahan">
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Data Kelurahan <button class="btn btn-sm btn-primary float-end" onclick="ModalKelurahan()"><i class="fas fa-plus"></i></button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="table-kelurahan" class="table table-striped nowrap ">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kelurahan</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
    <div class="modal fade" id="modalprovinsi" aria-labelledby="modal-title-provinsi" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-provinsi"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-provinsi">
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="inputprovinsi" class="col-3 fw-bold align-middle">Provinsi <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-sm" name="inputprovinsi" id="inputprovinsi" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3" id="form-status-provinsi">
                            <label for="statusprovinsi" class="col-3 fw-bold align-middle">Status <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="statusprovinsi" name="statusprovinsi" class="form-select" aria-describedby="validationServer04Feedback">
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idprovinsi" id="idprovinsi">
                        <input type="hidden" id="actionprovinsi" name="actionprovinsi">
                        <button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-provinsi">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalkota" aria-labelledby="modal-title-kota" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-kota"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-kota">
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="selectidprovinsi" class="col-3 fw-bold align-middle">Provinsi <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="selectidprovinsi" name="selectidprovinsi" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputkota" class="col-3 fw-bold align-middle">Kota <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-sm" name="inputkota" id="inputkota" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3" id="form-status-kota">
                            <label for="statuskota" class="col-3 fw-bold align-middle">Status <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="statuskota" name="statuskota" class="form-control form-control-sm form-select" aria-describedby="validationServer04Feedback">
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idkota" id="idkota">
                        <input type="hidden" id="actionkota" name="actionkota">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-provinsi">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalkecamatan" aria-labelledby="modal-title-kecamatan" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-kecamatan"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-kecamatan">
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="selectidprovinsi2" class="col-3 fw-bold align-middle">Provinsi <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="selectidprovinsi2" name="selectidprovinsi2" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectidkota" class="col-3 fw-bold align-middle">Kota <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="selectidkota" name="selectidkota" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputkecamatan" class="col-3 fw-bold align-middle">Kota <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-sm" name="inputkecamatan" id="inputkecamatan" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3" id="form-status-kecamatan">
                            <label for="statuskecamatan" class="col-3 fw-bold align-middle">Status <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="statuskecamatan" name="statuskecamatan" class="form-select" aria-describedby="validationServer04Feedback">
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idkecamatan" id="idkecamatan">
                        <input type="hidden" id="actionkecamatan" name="actionkecamatan">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-provinsi">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalkelurahan" aria-labelledby="modal-title-kelurahan" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title-kelurahan"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="form-kelurahan">
                    <div class="modal-body">
                        <div class="form-group row mb-3">
                            <label for="selectidprovinsi3" class="col-3 fw-bold align-middle">Provinsi <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="selectidprovinsi3" name="selectidprovinsi3" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectidkota2" class="col-3 fw-bold align-middle">Kota <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="selectidkota2" name="selectidkota2" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="selectidkecamatan" class="col-3 fw-bold align-middle">Kecamatan <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="selectidkecamatan" name="selectidkecamatan" class="form-select" aria-describedby="validationServer04Feedback">
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-3">
                            <label for="inputkelurahan" class="col-3 fw-bold align-middle">Kelurahan <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <input type="text" class="form-control form-control-sm" name="inputkelurahan" id="inputkelurahan" required>
                            </div>
                        </div>
                        <div class="form-group row mb-3" id="form-status-kelurahan">
                            <label for="statuskelurahan" class="col-3 fw-bold align-middle">Status <b class="text-danger">*</b></label>
                            <div class="col-9">
                                <select type="text" id="statuskelurahan" name="statuskelurahan" class="form-select" aria-describedby="validationServer04Feedback">
                                    <option value="1">Active</option>
                                    <option value="0">Non Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="idkelurahan" id="idkelurahan">
                        <input type="hidden" id="actionkelurahan" name="actionkelurahan">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="submit-provinsi">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#modalprovinsi').on('hidden.bs.modal', function() {
                $form = $("#form-provinsi");
                $form.validate().resetForm();
                $form.find('.error').removeClass('error');
                $form.find('.is-invalid').removeClass('is-invalid');
                $("#idprovinsi").val('');
                $("#inputprovinsi").val('');
                $("#actionprovinsi").val('');
            })
            $('#modalkota').on('hidden.bs.modal', function() {
                $form = $("#form-kota");
                $form.validate().resetForm();
                $form.find('.error').removeClass('error');
                $form.find('.is-invalid').removeClass('is-invalid');
                $("#selectidprovinsi").val('');
                $("#idkota").val('');
                $("#inputkota").val('');
                $("#actionkota").val('');
            })
            $('#modalkecamatan').on('hidden.bs.modal', function() {
                $form = $("#form-kecamatan");
                $form.validate().resetForm();
                $form.find('.error').removeClass('error');
                $form.find('.is-invalid').removeClass('is-invalid');
                $("#selectidprovinsi2").val('').trigger('change');
                $("#selectidkota").val('').trigger('change');
                $("#idkecamatan").val('');
                $("#inputkecamatan").val('');
                $("#actionkecamatan").val('');
            })
            $('#modalkelurahan').on('hidden.bs.modal', function() {
                $form = $("#form-kelurahan");
                $form.validate().resetForm();
                $form.find('.error').removeClass('error');
                $form.find('.is-invalid').removeClass('is-invalid');
                $("#selectidprovinsi3").val('').trigger('change');
                $("#selectidkot2").val('').trigger('change');
                $("#selectidkecamatan").val('').trigger('change');
                $("#idkelurahan").val('');
                $("#inputkelurahan").val('');
                $("#actionkelurahan").val('');
            })
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
            $('#selectidprovinsi').select2({
                allowClear: true,
                placeholder: 'Pilih Provinsi',
                dropdownParent: $('#modalkota'),
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

            $("#provinsi-tab").click(function() {
                table_provinsi.ajax.reload();
            })
            $("#kota-tab").click(function() {
                table_kota.ajax.reload();
            })
            $("#kecamatan-tab").click(function() {
                table_kecamatan.ajax.reload();
            })
            $("#kelurahan-tab").click(function() {
                table_kelurahan.ajax.reload();
            })
            $('#selectidprovinsi2').select2({
                allowClear: true,
                placeholder: 'Pilih Provinsi',
                dropdownParent: $('#modalkecamatan'),
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
            $("#selectidprovinsi2").on('change', function() {
                $('#selectidkota').select2({
                    allowClear: true,
                    placeholder: 'Pilih Kota',
                    dropdownParent: $('#modalkecamatan'),
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
                                search: params.term,
                                "idprovinsi": $("#selectidprovinsi2").val()
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
            })
            $('#selectidprovinsi3').select2({
                allowClear: true,
                placeholder: 'Pilih Provinsi',
                dropdownParent: $('#modalkelurahan'),
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
            $("#selectidprovinsi3").on('change', function() {
                $('#selectidkota2').select2({
                    allowClear: true,
                    placeholder: 'Pilih Kota',
                    dropdownParent: $('#modalkelurahan'),
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
                                search: params.term,
                                "idprovinsi": $("#selectidprovinsi3").val()
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
            })
            $("#selectidkota2").on('change', function() {
                $('#selectidkecamatan').select2({
                    allowClear: true,
                    placeholder: 'Pilih Kecamatan',
                    dropdownParent: $('#modalkelurahan'),
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
                                search: params.term,
                                "idkota": $("#selectidkota2").val()
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
            })
            table_provinsi = $('#table-provinsi').DataTable({
                "searching": true,
                "processing": true,
                "autoWidth": false,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url($menu) . "/table" ?>",
                    type: "post",
                    data: function(aData) {
                        aData.id = "provinsi";
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
                        "aTargets": [0, 3]
                    },
                    {
                        "bSearchable": false,
                        "aTargets": [0, 2, 3]
                    },
                    {
                        "className": "dt-center",
                        "aTargets": [0, 3]
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
            table_kota = $('#table-kota').DataTable({
                "searching": true,
                "processing": true,
                "autoWidth": false,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url($menu) . "/table" ?>",
                    type: "post",
                    data: function(aData) {
                        aData.id = "kota";
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
                        "aTargets": [0, 3]
                    },
                    {
                        "bSearchable": false,
                        "aTargets": [0, 2, 3]
                    },
                    {
                        "className": "dt-center",
                        "aTargets": [0, 3]
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
            table_kecamatan = $('#table-kecamatan').DataTable({
                "searching": true,
                "processing": true,
                "autoWidth": false,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url($menu) . "/table" ?>",
                    type: "post",
                    data: function(aData) {
                        aData.id = "kecamatan";
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
                        "aTargets": [0, 3]
                    },
                    {
                        "bSearchable": false,
                        "aTargets": [0, 2, 3]
                    },
                    {
                        "className": "dt-center",
                        "aTargets": [0, 3]
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
            table_kelurahan = $('#table-kelurahan').DataTable({
                "searching": true,
                "processing": true,
                "autoWidth": false,
                "serverSide": true,
                "ajax": {
                    url: "<?= base_url($menu) . "/table" ?>",
                    type: "post",
                    data: function(aData) {
                        aData.id = "kelurahan";
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
                        "aTargets": [0, 3]
                    },
                    {
                        "bSearchable": false,
                        "aTargets": [0, 2, 3]
                    },
                    {
                        "className": "dt-center",
                        "aTargets": [0, 3]
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
            $('#form-provinsi').validate({
                rules: {
                    inputprovinsi: {
                        required: true,
                        remote: {
                            url: "<?= base_url() . $menu ?>/cek_provinsi",
                            type: "post",
                            data: {
                                inputprovinsi: function() {
                                    return $("#inputprovinsi").val();
                                },
                                action: function() {
                                    return $("#actionprovinsi").val();
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

            $('#form-kota').validate({
                rules: {
                    inputkota: {
                        required: true,
                        remote: {
                            url: "<?= base_url() . $menu ?>/cek_kota",
                            type: "post",
                            data: {
                                inputkota: function() {
                                    return $("#inputkota").val();
                                },
                                action: function() {
                                    return $("#actionkota").val();
                                }
                            }
                        }
                    },
                    selectidprovinsi: {
                        required: true
                    },
                    statuskota: {
                        required: true
                    }
                },
                messages: {
                    inputkota: {
                        required: "The field is mandatory",
                        remote: "Kota allready exist"
                    },
                    selectidprovinsi: {
                        required: "The field is mandatory"
                    },
                    statuskota: {
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

                    var idkota = $("#idkota").val();
                    var selectidprovinsi = $("#selectidprovinsi").val();
                    var inputkota = $("#inputkota").val();
                    var statuskota = $("#statuskota").val();
                    if (idkota == '') {
                        var action = "add";
                    } else {
                        var action = "update";
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() . $menu ?>/" + action,
                        data: {
                            "idkota": idkota,
                            "selectidprovinsi": selectidprovinsi,
                            "inputkota": inputkota,
                            "statuskota": statuskota,
                            "action": action,
                            "tab": "kota"
                        },
                        dataType: "json",
                        success: function(result) {

                            waitingDialog.hide();
                            if (result.msg == 'OK') {
                                $("#modalkota").modal('hide');
                                if (action == 'add') {
                                    $('#alert-success').fadeIn().html('Created kota successfully');
                                    setTimeout(function() {
                                        $('#alert-success').fadeOut("slow");
                                        modal_clear();
                                        location.reload();
                                    }, 3000);
                                } else {
                                    $("#modalkota").modal('hide');
                                    $('#alert-success').fadeIn().html('Updated kota successfully');
                                    setTimeout(function() {
                                        modal_clear();
                                        table_kota.ajax.reload();
                                        $('#alert-success').fadeOut("slow");
                                        // location.reload();
                                    }, 3000);
                                }
                            } else {
                                $("#modalkota").modal('hide');
                                $('#alert-danger').fadeIn().html(result.msg);
                                setTimeout(function() {
                                    $('#alert-danger').fadeOut("slow");
                                }, 3000);
                                return false;
                            }
                        },
                        error: function(event, textStatus, errorThrown) {
                            $("#modalkota").modal('hide');
                            $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                        }
                    });
                    return false;
                }
            });
            $('#form-kecamatan').validate({
                rules: {
                    inputkecamatan: {
                        required: true,
                        remote: {
                            url: "<?= base_url() . $menu ?>/cek_kecamatan",
                            type: "post",
                            data: {
                                inputkecamatan: function() {
                                    return $("#inputkecamatan").val();
                                },
                                action: function() {
                                    return $("#actionkecamatan").val();
                                }
                            }
                        }
                    },
                    selectidprovinsi2: {
                        required: true
                    },
                    selectidkota: {
                        required: true
                    },
                    statuskecamatan: {
                        required: true
                    }
                },
                messages: {
                    inputkecamatan: {
                        required: "The field is mandatory",
                        remote: "Kecamatan allready exist"
                    },
                    selectidprovinsi2: {
                        required: "The field is mandatory"
                    },
                    selectidkota: {
                        required: "The field is mandatory"
                    },
                    statuskecamatan: {
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

                    var idkecamatan = $("#idkecamatan").val();
                    var selectidprovinsi = $("#selectidprovinsi2").val();
                    var selectidkota = $("#selectidkota").val();
                    var inputkecamatan = $("#inputkecamatan").val();
                    var statuskecamatan = $("#statuskecamatan").val();
                    if (idkecamatan == '') {
                        var action = "add";
                    } else {
                        var action = "update";
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() . $menu ?>/" + action,
                        data: {
                            "idkecamatan": idkecamatan,
                            "selectidprovinsi": selectidprovinsi,
                            "inputkecamatan": inputkecamatan,
                            "statuskecamatan": statuskecamatan,
                            "action": action,
                            "tab": "kecamatan"
                        },
                        dataType: "json",
                        success: function(result) {

                            waitingDialog.hide();
                            if (result.msg == 'OK') {
                                $("#modalkecamatan").modal('hide');
                                if (action == 'add') {
                                    $('#alert-success').fadeIn().html('Created kecamatan successfully');
                                    setTimeout(function() {
                                        $('#alert-success').fadeOut("slow");
                                        modal_clear();
                                        location.reload();
                                    }, 3000);
                                } else {
                                    $("#modalkecamatan").modal('hide');
                                    $('#alert-success').fadeIn().html('Updated kecamatan successfully');
                                    setTimeout(function() {
                                        modal_clear();
                                        table_kecamatan.ajax.reload();
                                        $('#alert-success').fadeOut("slow");
                                        // location.reload();
                                    }, 3000);
                                }
                            } else {
                                $("#modalkecamatan").modal('hide');
                                $('#alert-danger').fadeIn().html(result.msg);
                                setTimeout(function() {
                                    $('#alert-danger').fadeOut("slow");
                                }, 3000);
                                return false;
                            }
                        },
                        error: function(event, textStatus, errorThrown) {
                            $("#modalkecamatan").modal('hide');
                            $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                        }
                    });
                    return false;
                }
            });
            $('#form-kelurahan').validate({
                rules: {
                    inputkelurahan: {
                        required: true,
                        remote: {
                            url: "<?= base_url() . $menu ?>/cek_kelurahan",
                            type: "post",
                            data: {
                                inputkelurahan: function() {
                                    return $("#inputkelurahan").val();
                                },
                                action: function() {
                                    return $("#actionkelurahan").val();
                                }
                            }
                        }
                    },
                    selectidprovinsi3: {
                        required: true
                    },
                    selectidkota2: {
                        required: true
                    },
                    selectidkecamatan: {
                        required: true
                    },
                    statuskelurahan: {
                        required: true
                    }
                },
                messages: {
                    inputkelurahan: {
                        required: "The field is mandatory",
                        remote: "Kelurahan allready exist"
                    },
                    selectidprovinsi3: {
                        required: "The field is mandatory"
                    },
                    selectidkota2: {
                        required: "The field is mandatory"
                    },
                    selectidkecamatan: {
                        required: "The field is mandatory"
                    },
                    statuskelurahan: {
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

                    var idkelurahan = $("#idkelurahan").val();
                    var selectidprovinsi = $("#selectidprovinsi3").val();
                    var selectidkota = $("#selectidkota2").val();
                    var selectidkecamatan = $("#selectidkecamatan").val();
                    var inputkelurahan = $("#inputkelurahan").val();
                    var statuskelurahan = $("#statuskelurahan").val();
                    if (idkelurahan == '') {
                        var action = "add";
                    } else {
                        var action = "update";
                    }
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() . $menu ?>/" + action,
                        data: {
                            "idkelurahan": idkelurahan,
                            "selectidprovinsi": selectidprovinsi,
                            "selectidkota": selectidkota,
                            "selectidkecamatan": selectidkecamatan,
                            "inputkelurahan": inputkelurahan,
                            "statuskelurahan": statuskelurahan,
                            "action": action,
                            "tab": "kelurahan"
                        },
                        dataType: "json",
                        success: function(result) {

                            waitingDialog.hide();
                            if (result.msg == 'OK') {
                                $("#modalkelurahan").modal('hide');
                                if (action == 'add') {
                                    $('#alert-success').fadeIn().html('Created kelurahan successfully');
                                    setTimeout(function() {
                                        $('#alert-success').fadeOut("slow");
                                        modal_clear();
                                        location.reload();
                                    }, 3000);
                                } else {
                                    $("#modalkelurahan").modal('hide');
                                    $('#alert-success').fadeIn().html('Updated kelurahan successfully');
                                    setTimeout(function() {
                                        modal_clear();
                                        table_kelurahan.ajax.reload();
                                        $('#alert-success').fadeOut("slow");
                                        // location.reload();
                                    }, 3000);
                                }
                            } else {
                                $("#modalkelurahan").modal('hide');
                                $('#alert-danger').fadeIn().html(result.msg);
                                setTimeout(function() {
                                    $('#alert-danger').fadeOut("slow");
                                }, 3000);
                                return false;
                            }
                        },
                        error: function(event, textStatus, errorThrown) {
                            $("#modalkelurahan").modal('hide');
                            $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                            setTimeout(function() {
                                $('#alert-danger').fadeOut("slow");
                            }, 3000);
                        }
                    });
                    return false;
                }
            });
        })

        function ModalProvinsi(id) {
            modal_clear();
            if (id) {
                var isi = id;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/data_provinsi",
                    data: {
                        'id': isi
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#modal-title-provinsi").html(result.modal_title_provinsi);
                        $('#modalprovinsi').modal('show');
                        $('#form-status-provinsi').show();
                        $('#inputprovinsi').val(result.provinsi);
                        $('#statusprovinsi').val(result.status).trigger('change');
                        $('#idprovinsi').val(result.idprovinsi);
                        $("#actionprovinsi").val('update')
                    }
                });

            } else {
                $("#actionprovinsi").val('add')
                $("#modal-title-provinsi").html("New Provinsi");
                $('#modalprovinsi').modal('show');
                $('#form-status-provinsi').hide();
            }
        }

        function ModalKota(id) {
            modal_clear();
            if (id) {
                var isi = id;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/data_kota",
                    data: {
                        'id': isi
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#modal-title-kota").html(result.modal_title_kota);
                        $('#inputkota').val(result.kota);
                        $('#idkota').val(result.idkota);
                        $('#statuskota').val(result.status).trigger('change');
                        $('#selectidprovinsi').html('<option value="' + result.idprovinsi + '" selected>' + result.provinsi + '</option>');
                        $("#actionkota").val('update');
                        $('#modalkota').modal('show');
                        $('#form-status-kota').show();
                    }
                });

            } else {
                $("#actionkota").val('add');
                $("#modal-title-kota").html("New Kota");
                $('#modalkota').modal('show');
                $('#form-status-kota').hide();
            }
        }

        function ModalKecamatan(id) {
            modal_clear();
            if (id) {
                var isi = id;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/data_kecamatan",
                    data: {
                        'id': isi
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#modal-title-kecamatan").html(result.modal_title_kecamatan);
                        $('#modalkecamatan').modal('show');
                        $('#form-status-kecamatan').show();
                        $('#inputkecamatan').val(result.kecamatan);
                        $('#idkecamatan').val(result.idkecamatan);
                        $('#statuskecamatan').val(result.status).trigger('change');
                        $("#actionkecamatan").val('update');
                        $('#selectidprovinsi2').html('<option value="' + result.idprovinsi + '" selected>' + result.provinsi + '</option>');
                        $('#selectidkota').html('<option value="' + result.idkota + '" selected>' + result.kota + '</option>');
                    }
                });

            } else {
                $("#actionkecamatan").val('add');
                $("#modal-title-kecamatan").html("New Kecamatan");
                $('#modalkecamatan').modal('show');
                $('#form-status-kecamatan').hide();
            }
        }

        function ModalKelurahan(id) {
            modal_clear();
            if (id) {
                var isi = id;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/data_kelurahan",
                    data: {
                        'id': isi
                    },
                    dataType: 'json',
                    success: function(result) {
                        $("#modal-title-kelurahan").html(result.modal_title_kelurahan);
                        $('#modalkelurahan').modal('show');
                        $('#form-status-kelurahan').show();
                        $("#actionkelurahan").val('update');
                        $('#selectidprovinsi3').html('<option value="' + result.idprovinsi + '" selected>' + result.provinsi + '</option>');
                        $('#selectidkota2').html('<option value="' + result.idkota + '" selected>' + result.kota + '</option>');
                        $('#selectidkecamatan').html('<option value="' + result.idkecamatan + '" selected>' + result.kecamatan + '</option>');
                        $("#idkelurahan").val(result.idkelurahan);
                        $("#inputkelurahan").val(result.kelurahan);
                        $("#statuskelurahan").val(result.status).trigger('change');
                    }
                });

            } else {
                $("#actionkelurahan").val('add');
                $("#modal-title-kelurahan").html("New Kelurahan");
                $('#modalkelurahan').modal('show');
                $('#form-status-kelurahan').hide();
            }
        }

        function DeleteProvinsi(id) {
            if (id) {
                var isi = id;
                $.ajax({
                    type: "POST",
                    url: "<?= base_url() . $menu ?>/delete",
                    data: {
                        'id': isi,
                        'tab': "provinsi"
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
                }, 3000);
            }
        }

        function modal_clear() {
            $("#idprovinsi").val('');
            $("#idkota").val('');
            $("#idkecamatan").val('');
            $("#idkelurahan").val('');
            $("#selectidprovinsi").val('').trigger('change');
            $("#selectidprovinsi2").val('').trigger('change');
            $("#selectidprovinsi3").val('').trigger('change');
            $("#selectidkota").val('').trigger('change');
            $("#selectidkota2").val('').trigger('change');
            $("#selectidkecamatan").val('').trigger('change');
            $("#input_provinsi").val('');
            $("#input_kota").val('');
            $("#input_kecamatan").val('');
            $("#input_kelurahan").val('');
            $("#statusprovinsi").val('').trigger('change');
            $("#statuskota").val('').trigger('change');
            $("#statuskecamatan").val('').trigger('change');
            $("#statuskelurahan").val('').trigger('change');
            $("#modal-title-provinsi").html("");
            $("#modal-title-kota").html("");
            $("#modal-title-kecamatan").html("");
            $("#modal-title-kelurahan").html("");
        }
    </script>
<?php } ?>