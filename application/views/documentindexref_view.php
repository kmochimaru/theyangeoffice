<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $title . ' | มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา'; ?></title>
        <meta name="description" content="<?php echo $this->config->item('app_description'); ?>" />
        <meta name="keywords" content="<?php echo $this->config->item('app_keyward'); ?>" />
        <meta name="author" content="<?php echo $this->config->item('app_author'); ?>" />
        <meta name="robots" content="noindex, nofollow">

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>">

        <?php
        echo $this->assets->css_full('plugin/bootstrap/css/bootstrap.min.css');
        echo "\t" . $this->assets->css_full('plugin/toast-master/css/jquery.toast.css');
        echo "\t" . $this->assets->css('style_1.css');
        echo "\t" . $this->assets->css_full('css/colors/default-dark.css');
        echo "\t" . $this->assets->css('parsley.min.css');
        echo "\t" . $this->assets->css_full('plugin/bootstrap-datepicker/bootstrap-datepicker.min.css');
        echo "\n\t";

        if (isset($css_full)) {
            foreach ($css_full as $row) {
                echo $this->assets->css_full($row);
            }
        }
        if (isset($css)) {
            foreach ($css as $row) {
                echo $this->assets->css($row);
            }
        }

        echo "\n";
        echo "\t\t" . $this->assets->js_full('plugin/jquery/jquery.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/popper.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/bootstrap.min.js');
        echo "\t" . $this->assets->js('perfect-scrollbar.jquery.min.js');
        echo "\t" . $this->assets->js('waves.js');
        echo "\t" . $this->assets->js('sidebarmenu.js');
        echo "\t" . $this->assets->js_full('plugin/sticky-kit-master/dist/sticky-kit.min.js');
        echo "\t" . $this->assets->js_full('plugin/sparkline/jquery.sparkline.min.js');
        echo "\t" . $this->assets->js('custom.js');
        echo "\t" . $this->assets->js_full('plugin/toast-master/js/jquery.toast.js');
        echo "\t" . $this->assets->js('parsley.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap-datepicker/bootstrap-datepicker.min.js');
        echo "\t" . $this->assets->js('totop.js');
        echo "\n\t";

        if (isset($js_full)) {
            foreach ($js_full as $row) {
                echo $this->assets->js_full($row);
            }
        }
        if (isset($js)) {
            foreach ($js as $row) {
                echo $this->assets->js($row);
            }
        }
        ?>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="fix-header fix-sidebar card-no-border">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" />
        <script>
            var service_base_url = $('#service_base_url').val();
            var service_front_url = $('#service_front_url').val();
        </script>
        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url() . 'documentindex' ?>">
                            <b>ระบบดัชนีเอกสาร
                                <!--<img src="<?php echo base_url(); ?>assets/img/logo-icon.png" alt="logo" class="dark-logo" />-->
                            </b>
                            <span>มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา
                                <!--<img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="logo" class="dark-logo" />-->  
                            </span> 
                        </a>
                    </div>
                </nav>
            </header>

            <div class="page-wrapper">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-3">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <i class="fa fa-tag"></i> <?php echo " ปีงบประมาณ"; ?>
                                                <span style="float: right" class="m-r-10">
                                                    <button type="button" class="btn btn-sm btn-success" onclick="modal_add_year();"><i class="fa fa-plus"></i> ปีงบประมาณ</button>
                                                </span>
                                            </h4>              
                                            <div class="row m-t-20">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>ปี</th>
                                                                    <th class="text-right"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($data_years->num_rows() > 0) {
                                                                    $i = 1;
                                                                    foreach ($data_years->result() as $row_year) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $row_year->ref_doc_index_year_code; ?></td>
                                                                            <td><?php echo $row_year->ref_doc_index_year_name; ?></td>                      
                                                                            <td class="text-right">
                                                                                <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_year('<?php echo $row_year->ref_doc_index_year_id; ?>')"><i class="fa fa-edit"></i> </button>                           
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">
                                                <i class="fa fa-tag"></i> <?php echo " แหล่งเงิน"; ?>
                                                <span style="float: right" class="m-r-10">
                                                    <button type="button" class="btn btn-sm btn-success" onclick="modal_add_budget();"><i class="fa fa-plus"></i> ปีแหล่งเงิน</button>
                                                </span>
                                            </h4>              
                                            <div class="row m-t-20">
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table">
                                                            <thead>
                                                                <tr>
                                                                    <th>ID</th>
                                                                    <th>ชื่อแหล่งเงิน</th>
                                                                    <th class="text-right"></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if ($data_budgets->num_rows() > 0) {
                                                                    $i = 1;
                                                                    foreach ($data_budgets->result() as $row_budget) {
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo $row_budget->ref_doc_index_budget_code; ?></td>     
                                                                            <td><?php echo $row_budget->ref_doc_index_budget_name; ?></td>                      
                                                                            <td class="text-right">
                                                                                <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_budget('<?php echo $row_budget->ref_doc_index_budget_id; ?>')"><i class="fa fa-edit"></i> </button>                           
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $i++;
                                                                    }
                                                                } else {
                                                                    ?>
                                                                    <tr>
                                                                        <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                                                    </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="fa fa-tag"></i> <?php echo " ประเภทเอกสาร"; ?>
                                        <span style="float: right" class="m-r-10">
                                            <button type="button" class="btn btn-sm btn-success" onclick="modal_add_category();"><i class="fa fa-plus"></i> ประเภทเอกสาร</button>
                                        </span>
                                    </h4>              
                                    <div class="row m-t-20">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th></th>
                                                            <th>ชื่อประเภทเอกสาร</th>
                                                            <th class="text-right" width="30%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($data_categorys->num_rows() > 0) {
                                                            $i = 1;
                                                            foreach ($data_categorys->result() as $data_category) {
                                                                ?>
                                                                <tr>                   
                                                                    <td colspan="2"><?php echo $data_category->ref_doc_index_category_code; ?></td>                    
                                                                    <td><?php echo $data_category->ref_doc_index_category_name; ?></td>                      
                                                                    <td class="text-right">
                                                                        <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_category('<?php echo $data_category->ref_doc_index_category_id; ?>')"><i class="fa fa-edit"></i> </button>   
                                                                        <button type="button" class="btn btn-sm btn-primary" onclick="modal_add_type('<?php echo $data_category->ref_doc_index_category_id; ?>')"><i class="fa fa-plus"></i> </button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $data_types = $this->documentindexref_model->get_ref_doc_index_type($data_category->ref_doc_index_category_id);
                                                                if ($data_types->num_rows() > 0) {
                                                                    foreach ($data_types->result() as $data_type) {
                                                                        ?>
                                                                        <tr>                  
                                                                            <td><i class="mdi mdi-subdirectory-arrow-right"></i></td>  
                                                                            <td><?php echo $data_type->ref_doc_index_type_code; ?></td>                    
                                                                            <td><?php echo $data_type->ref_doc_index_type_name; ?></td>                      
                                                                            <td class="text-right">
                                                                                <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_type('<?php echo $data_type->ref_doc_index_type_id; ?>')"><i class="fa fa-edit"></i> </button>   
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                }
                                                                $i++;
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="fa fa-tag"></i> <?php echo " ลักษณะจัดเก็บ"; ?>
                                        <span style="float: right" class="m-r-10">
                                            <button type="button" class="btn btn-sm btn-success" onclick="modal_add_store1();"><i class="fa fa-plus"></i> ลักษณะจัดเก็บ</button>
                                        </span>
                                    </h4>              
                                    <div class="row m-t-20">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>ชื่อลักษณะจัดเก็บ</th>
                                                            <th class="text-right" width="30%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($data_stores1->num_rows() > 0) {
                                                            $i = 1;
                                                            foreach ($data_stores1->result() as $data_store1) {
                                                                ?>
                                                                <tr>                  
                                                                    <td><?php echo $data_store1->ref_doc_index_store1_code; ?></td>
                                                                    <td><?php echo $data_store1->ref_doc_index_store1_name; ?></td>                      
                                                                    <td class="text-right">
                                                                        <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_store1('<?php echo $data_store1->ref_doc_index_store1_id; ?>')"><i class="fa fa-edit"></i> </button>                           
                                                                        <button type="button" class="btn btn-sm btn-primary" onclick="modal_add_store2('<?php echo $data_store1->ref_doc_index_store1_id; ?>')"><i class="fa fa-plus"></i> </button>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $data_stores2 = $this->documentindexref_model->get_ref_doc_index_store2($data_store1->ref_doc_index_store1_id);
                                                                if ($data_stores2->num_rows() > 0) {
                                                                    foreach ($data_stores2->result() as $data_store2) {
                                                                        ?>
                                                                        <tr> 
                                                                            <td><i class="mdi mdi-subdirectory-arrow-right"></i> <?php echo $data_store2->ref_doc_index_store2_code; ?></td>
                                                                            <td><?php echo $data_store2->ref_doc_index_store2_name; ?></td>                      
                                                                            <td class="text-right">
                                                                                <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_store2('<?php echo $data_store2->ref_doc_index_store2_id; ?>')"><i class="fa fa-edit"></i> </button>                           
                                                                                <button type="button" class="btn btn-sm btn-primary" onclick="modal_add_store3('<?php echo $data_store2->ref_doc_index_store2_id; ?>')"><i class="fa fa-plus"></i> </button>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                        $data_stores3 = $this->documentindexref_model->get_ref_doc_index_store3($data_store2->ref_doc_index_store2_id);
                                                                        if ($data_stores3->num_rows() > 0) {
                                                                            foreach ($data_stores3->result() as $data_store3) {
                                                                                ?>
                                                                                <tr> 
                                                                                    <td>&nbsp;&nbsp;&nbsp;&nbsp;<i class="mdi mdi-subdirectory-arrow-right"></i> <?php echo $data_store3->ref_doc_index_store3_code; ?></td>                   
                                                                                    <td><?php echo $data_store3->ref_doc_index_store3_name; ?></td>                      
                                                                                    <td class="text-right">
                                                                                        <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_store3('<?php echo $data_store3->ref_doc_index_store3_id; ?>')"><i class="fa fa-edit"></i> </button>                           
                                                                                    </td>
                                                                                </tr>
                                                                                <?php
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                                $i++;
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <i class="fa fa-tag"></i> <?php echo " หน่วยงาน"; ?>
                                        <span style="float: right" class="m-r-10">
                                            <button type="button" class="btn btn-sm btn-outline-success" onclick="modal_import_department();"><i class="fa fa-file-excel-o"></i> นำเข้า</button>
                                            <button type="button" class="btn btn-sm btn-success" onclick="modal_add_department();"><i class="fa fa-plus"></i> หน่วยงาน</button>
                                        </span>
                                    </h4>              
                                    <div class="row m-t-20">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>ชื่อหน่วยงาน</th>
                                                            <th class="text-right"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if ($data_departments->num_rows() > 0) {
                                                            $i = 1;
                                                            foreach ($data_departments->result() as $data_department) {
                                                                ?>
                                                                <tr>                  
                                                                    <td><?php echo $data_department->ref_doc_index_department_code; ?></td> 
                                                                    <td><?php echo $data_department->ref_doc_index_department_name; ?></td>                      
                                                                    <td class="text-right">
                                                                        <button type="button" class="btn btn-sm btn-info" onclick="modal_edit_department('<?php echo $data_department->ref_doc_index_department_id; ?>')"><i class="fa fa-edit"></i> </button>                           
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $i++;
                                                            }
                                                        } else {
                                                            ?>
                                                            <tr>
                                                                <td class="text-center" colspan="6"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>

                </div>
                <footer class="footer">
                    <?php echo $this->config->item('app_footer'); ?>
                </footer>
            </div>
        </div>
        <input type="hidden" id="alert_message" value="<?php echo $this->session->flashdata('flash_message') != '' ? $this->session->flashdata('flash_message') : ''; ?>">

        <script>
            function modal_add_year() {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_year',
                    type: 'POST',
                    data: {

                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_year(ref_doc_index_year_id) {
                console.log(ref_doc_index_year_id)
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_year',
                    type: 'POST',
                    data: {
                        ref_doc_index_year_id: ref_doc_index_year_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_category() {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_category',
                    type: 'POST',
                    data: {

                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_category(ref_doc_index_category_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_category',
                    type: 'POST',
                    data: {
                        ref_doc_index_category_id: ref_doc_index_category_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_type(ref_doc_index_category_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_type',
                    type: 'POST',
                    data: {
                        ref_doc_index_category_id: ref_doc_index_category_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_type(ref_doc_index_type_id) {
                console.log(ref_doc_index_type_id)
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_type',
                    type: 'POST',
                    data: {
                        ref_doc_index_type_id: ref_doc_index_type_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_budget() {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_budget',
                    type: 'POST',
                    data: {

                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_budget(ref_doc_index_budget_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_budget',
                    type: 'POST',
                    data: {
                        ref_doc_index_budget_id: ref_doc_index_budget_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_store1() {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_store1',
                    type: 'POST',
                    data: {

                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_store1(ref_doc_index_store1_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_store1',
                    type: 'POST',
                    data: {
                        ref_doc_index_store1_id: ref_doc_index_store1_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_store2(ref_doc_index_store1_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_store2',
                    type: 'POST',
                    data: {
                        ref_doc_index_store1_id: ref_doc_index_store1_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_store2(ref_doc_index_store2_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_store2',
                    type: 'POST',
                    data: {
                        ref_doc_index_store2_id: ref_doc_index_store2_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_store3(ref_doc_index_store2_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_store3',
                    type: 'POST',
                    data: {
                        ref_doc_index_store2_id: ref_doc_index_store2_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_store3(ref_doc_index_store3_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_store3',
                    type: 'POST',
                    data: {
                        ref_doc_index_store3_id: ref_doc_index_store3_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_add_department() {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/add_modal_department',
                    type: 'POST',
                    data: {

                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_import_department() {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/import_modal_department',
                    type: 'POST',
                    data: {

                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            function modal_edit_department(ref_doc_index_department_id) {
                $('.modal-content').html('');
                $.ajax({
                    url: service_base_url + 'documentindexref/edit_modal_department',
                    type: 'POST',
                    data: {
                        ref_doc_index_department_id: ref_doc_index_department_id
                    },
                    success: function (response) {
                        $('#result-modal .modal-content').html(response);
                        $('#form-modal').parsley().reset();
                        $('#result-modal').modal('show', {backdrop: 'true'});
                    }
                });
            }

            $(function () {
                var alert_message = $('#alert_message').val();
                if (alert_message != '') {
                    var foo = alert_message.split(',');
                    notification(foo[0], foo[1], foo[2]);
                }
            });

            function notification(category, head, message) {
                $.toast({
                    heading: head,
                    text: message,
                    position: 'top-right',
                    loaderBg: '#D8DBDD',
                    icon: category,
                    hideAfter: 3000,
                    stack: 3
                });
            }
        </script>
    </body>
</html>
