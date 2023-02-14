<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title><?= $title ?> - SB Admin</title>
    <link href="<?= base_url() ?>assets/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet" />
    <link href="<?= base_url() ?>assets/css/select2.min.css" rel="stylesheet" />

    <link href="<?= base_url() ?>assets/css/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/css/fontawesome-all.css">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"> -->

    <script src="<?= base_url('assets/') ?>js/jquery.min.js"></script>
    <link href="<?= base_url() ?>assets/css/bootstrapicons-iconpicker.css" rel="stylesheet" />
    <script src="<?= base_url() ?>assets/js/bootstrapicon-iconpicker.js"></script>

</head>

<body class="sb-nav-fixed">
    <style>
        label.error {
            color: red;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    <script src="<?= base_url() ?>assets/js/jquery-validate.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/scripts.js" crossorigin="anonymous"></script>
    <!-- <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script> -->
    <script src="<?= base_url() ?>assets/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="<?= base_url() ?>assets/js/Chart.min.js" crossorigin="anonymous"></script> -->
    <!-- <script src="<?= base_url() ?>assets/demo/chart-area-demo.js"></script> -->
    <!-- <script src="<?= base_url() ?>assets/demo/chart-bar-demo.js"></script> -->
    <script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/select2.full.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/select2.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/dataTables.bootstrap5.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/simple-datatables.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>assets/js/datatables-simple-demo.js"></script>
    <script src="<?= base_url() ?>assets/js/modalloading.js"></script>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="<?= base_url('dashboard') ?>">App</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url('welcome/logout') ?>">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="<?= base_url('dashboard') ?>">
                            <div class="sb-nav-link-icon"><i class="bi bi-house"></i></div>
                            Dashboard
                        </a>
                        <?php
                        foreach ($station as $station) {
                            $idstation = $station['id'];
                        ?>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#<?= str_replace(' ', '_', $station['station']) ?>" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="<?= $station['icon'] ?>"></i></div>
                                <?= $station['station'] ?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <?php
                            $modul = $this->db->query("SELECT a.id, a.modul, a.icon
                            FROM `tbl_station` b
                            JOIN `tbl_modul` a
                            ON b.id=a.`idstation`
                            JOIN `tbl_menu` c
                            ON b.`id`=c.`idmodul`
                            JOIN `tbl_akses` e
                            ON c.id=e.`idmenu`
                            WHERE idlevel='$idlevel' AND a.idstation='$idstation' GROUP BY a.id")->result_array();
                            foreach ($modul as $modul) {
                                $idmodul = $modul['id'];
                            ?>
                                <div class="collapse" id="<?= str_replace(' ', '_', $station['station']) ?>" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#<?= str_replace(' ', '_', $modul['modul']) ?>" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                            <div class="sb-nav-link-icon"><i class="<?= $modul['icon'] ?>"></i></div>
                                            <?= $modul['modul'] ?>
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <?php
                                        $menu = $this->db->query("SELECT c.id, c.menu, c.icon,c.link
                                        FROM tbl_station a
                                        JOIN tbl_modul b
                                        ON a.`id`=b.`idstation`
                                        JOIN tbl_menu c
                                        ON b.id=c.`idmodul`
                                        JOIN tbl_akses e
                                        ON c.id=e.`idmenu`
                                        WHERE idlevel = '$idlevel' AND b.id='$idmodul' AND a.id='$idstation'")->result_array();
                                        foreach ($menu as $menu) { ?>
                                            <div class="collapse" id="<?= str_replace(' ', '_', $modul['modul']) ?>" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                                <nav class="sb-sidenav-menu-nested nav">
                                                    <a class="nav-link" href="<?= base_url($menu['link']) ?>">
                                                        <div class="sb-nav-link-icon"><i class="<?= $menu['icon'] ?>"></i></div><?= $menu['menu'] ?>
                                                    </a>
                                                </nav>
                                            </div>
                                        <?php } ?>
                                    </nav>
                                </div>
                        <?php
                            }
                        }
                        ?>
                        <a class="nav-link" href="<?= base_url('welcome/logout') ?>">
                            <div class="sb-nav-link-icon"><i class="bi bi-box-arrow-right"></i></div>
                            Logout
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="alert alert-success hide m-3" id="alert-success" role="alert">
                </div>
                <div class="alert alert-danger hide m-3" id="alert-danger" role="alert">
                </div>