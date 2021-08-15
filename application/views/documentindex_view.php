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
    echo "\t" . $this->assets->css_full('plugin/select2/dist/css/select2.min.css');
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
    echo "\t" . $this->assets->js_full('plugin/select2/dist/js/select2.full.min.js');
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
    <style>
        label {
            font-size: 12px !important;
            padding: 0px 0px 0px 0px;
            margin: 0px 0px 0px 0px;
        }
    </style>
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
            <div class="container-fluid" style="padding: 0px 2px 2px 2px;">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">
                                    <div class="row">
                                        <div class="col-md-3 m-t-5">
                                            <i class="fa fa-tags"></i> <?php echo " " . $title; ?>
                                        </div>
                                        <div class="col-md-9 text-right m-t-5">
                                            <div class="input-group">
                                                <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="รหัส, เลขที่ฎีกา, ชื่อโครงการ (คำอธิบาย), ชื่อผู้รับเงิน, ชื่อผู้เบิก">
                                                <div class="input-group-append">
                                                    <button type="button" class="btn btn-sm btn-primary" onclick="ajax_pagination()"><i class="fa fa-search"></i> ค้นหา</button>
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-success m-l-10" onclick="import_modal();"><i class="fa fa-file-excel-o"></i> นำเข้า</button>
                                                <button type="button" class="btn btn-sm btn-success m-l-10" onclick="modal_add();"><i class="fa fa-plus"></i> เพิ่ม<?php echo $title; ?></button>
                                                <a href="<?php echo base_url() . 'documentindexref' ?>" class="btn btn-sm btn-warning m-l-10"><i class="fa fa-list"></i> ข้อมูลอ้างอิง</a>
                                                <button type="button" class="btn btn-sm btn-inverse m-l-10" onclick="modal_process();"><i class="fa fa-refresh"></i> ประมวลผลรหัส</button>
                                            </div>
                                        </div>
                                    </div>
                                </h4>
                                <div class="row m-t-20">
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">ปีงบประมาณ</label>
                                        <select id="ref_doc_index_year_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_year()->result() as $year) {
                                            ?>
                                                <option value="<?php echo $year->ref_doc_index_year_name; ?>"><?php echo $year->ref_doc_index_year_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" id="ymd" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                                    <input type="hidden" id="start" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                                    <input type="hidden" id="end" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                                    <input type="hidden" id="min" value="<?php echo $this->documentindex_model->mindate()->row()->mindate; ?>" onchange="ajax_pagination()">
                                    <input type="hidden" id="max" value="<?php echo date('Y-m-d'); ?>" onchange="ajax_pagination()">
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">ช่วงเวลาวันที่เอกสาร</label>
                                        <select id="select_time" class="form-control form-control-sm" onchange="set_select_time()">
                                            <option value="1">รายวัน</option>
                                            <option value="2">รายเดือน</option>
                                            <option value="3">รายปี</option>
                                            <option value="4">กำหนดเอง</option>
                                            <option value="5" selected="">ทั้งหมด</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">ช่วงเวลาวันที่เอกสาร</label>
                                        <div class="select_control" id="select_1">
                                            <input type="text" id="input_select_1" class="form-control form-control-sm" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="set_select_time_input()">
                                        </div>
                                        <div class="select_control" id="select_2">
                                            <select id="input_select_2" class="form-control form-control-sm" onchange="set_select_time_input()">
                                                <option value="01" <?php echo date('m') == 1 ? 'selected' : '' ?>>มกราคม</option>
                                                <option value="02" <?php echo date('m') == 2 ? 'selected' : '' ?>>กุมภาพันธ์</option>
                                                <option value="03" <?php echo date('m') == 3 ? 'selected' : '' ?>>มีนาคม</option>
                                                <option value="04" <?php echo date('m') == 4 ? 'selected' : '' ?>>เมษายน</option>
                                                <option value="05" <?php echo date('m') == 5 ? 'selected' : '' ?>>พฤษภาคม</option>
                                                <option value="06" <?php echo date('m') == 6 ? 'selected' : '' ?>>มิถุนายน</option>
                                                <option value="07" <?php echo date('m') == 7 ? 'selected' : '' ?>>กรกฎาคม</option>
                                                <option value="08" <?php echo date('m') == 8 ? 'selected' : '' ?>>สิงหาคม</option>
                                                <option value="09" <?php echo date('m') == 9 ? 'selected' : '' ?>>กันยายน</option>
                                                <option value="10" <?php echo date('m') == 10 ? 'selected' : '' ?>>ตุลาคม</option>
                                                <option value="11" <?php echo date('m') == 11 ? 'selected' : '' ?>>พฤศจิกายน</option>
                                                <option value="12" <?php echo date('m') == 12 ? 'selected' : '' ?>>ธันวาคม</option>
                                            </select>
                                        </div>
                                        <div class="select_control" id="select_3">
                                            <select id="input_select_3" class="form-control form-control-sm" onchange="set_select_time_input()">
                                                <?php
                                                $minyears = $this->documentindex_model->minyear();
                                                if ($minyears->row()->minyear != 0) {
                                                    $minyear = $minyears->row();
                                                    $maxyear = date('Y');
                                                    for ($i = $minyear->minyear; $i <= $maxyear; $i++) {
                                                ?>
                                                        <option value="<?php echo ($i + 543); ?>" <?php echo date('Y') == $i ? 'selected' : '' ?>><?php echo ($i + 543); ?></option>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <option value="<?php echo (date('Y') + 543); ?>"><?php echo (date('Y') + 543); ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="select_control" id="select_4">
                                            <input type="text" class="form-control form-control-sm" value="" disabled>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">เริ่มต้น</label>
                                        <input type="text" id="input_start" class="form-control form-control-sm" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('input_start', 'start')" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">สิ้นสุด</label>
                                        <input type="text" id="input_end" class="form-control form-control-sm" value="<?php echo $this->misc->offsetyear(date('Y-m-d'), 543); ?>" onchange="date_convert('input_end', 'end')" disabled>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">แหล่งเงิน</label>
                                        <select id="ref_doc_index_budget_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_budget()->result() as $type) {
                                            ?>
                                                <option value="<?php echo $type->ref_doc_index_budget_name; ?>"><?php echo $type->ref_doc_index_budget_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-t-10">
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">ประเภทเอกสาร</label>
                                        <select id="ref_doc_index_category_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_category()->result() as $category) {
                                            ?>
                                                <option value="<?php echo $category->ref_doc_index_category_name; ?>"><?php echo $category->ref_doc_index_category_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">ประเภทเอกสาร (ย่อย)</label>
                                        <select id="ref_doc_index_type_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_type()->result() as $type) {
                                            ?>
                                                <option value="<?php echo $type->ref_doc_index_type_name; ?>"><?php echo $type->ref_doc_index_type_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">จัดเก็บเอกสาร 1</label>
                                        <select id="ref_doc_index_store1_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_store1_name()->result() as $location) {
                                            ?>
                                                <option value="<?php echo $location->ref_doc_index_store1_name; ?>"><?php echo $location->ref_doc_index_store1_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">จัดเก็บเอกสาร 2</label>
                                        <select id="ref_doc_index_store2_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_store2_name()->result() as $location) {
                                            ?>
                                                <option value="<?php echo $location->ref_doc_index_store2_name; ?>"><?php echo $location->ref_doc_index_store2_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">จัดเก็บเอกสาร 3</label>
                                        <select id="ref_doc_index_store3_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_store3_name()->result() as $location) {
                                            ?>
                                                <option value="<?php echo $location->ref_doc_index_store3_name; ?>"><?php echo $location->ref_doc_index_store3_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label" style="font-weight: bold;">หน่วยงาน</label>
                                        <select id="ref_doc_index_department_id" class="form-control form-control-sm" onchange="ajax_pagination()">
                                            <option value="">ทั้งหมด</option>
                                            <?php
                                            foreach ($this->documentindex_model->get_ref_doc_index_department()->result() as $department) {
                                            ?>
                                                <option value="<?php echo $department->ref_doc_index_department_code; ?>"><?php echo $department->ref_doc_index_department_code . ' ( ' . $department->ref_doc_index_department_name . ' )'; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div id="result-pagination" class="m-t-20"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content" id="modal-content"></div>
                    </div>
                </div>

                <div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="modal-content-lg">
                        </div>
                    </div>
                </div>
                <div id="modal_process" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-refresh"></i> ยืนยันการทำรายการ</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="bootbox-body text-center text-info">
                                    <b>ยืนยันการประมวลผลรหัส</b>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="process_id();" id="btn-process-submit" class="btn btn-info"><i class="fa fa-save"></i> ตกลง</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="import_modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" style="max-width:1300px;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title"><i class="fa fa-file-excel-o"></i>
                                    <?php echo 'นำเข้า'; ?>
                                </h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <div class="bootbox-body">
                                    <form id="form-modal-import" method="post" action="<?php echo base_url() . 'documentindex/import'; ?>" enctype="multipart/form-data" autocomplete="off">
                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-8">
                                                <input type="file" name="file" accept=".csv, .txt" class="form-control form-control-sm" required="" />
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" id="btn-form-check-modal" class="btn btn-outline-success"><i class="fa fa-check"></i><?php echo 'ตรวจสอบ'; ?></button>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div id="result-page" class="m-t-20">

                                                </div>
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="row">
                                            <div class="col-sm-12 text-right">
                                                <button type="submit" disabled id="check-btn" class="btn btn-info"><i class="fa fa-save"></i>&nbsp;<?php echo 'บันทึก'; ?></button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true"><i class="fa fa-close"></i>&nbsp;<?php echo 'ยกเลิก'; ?></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
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
        var service_base_url = $('#service_base_url').val();

        $('#searchtext').keypress(function(e) {
            if (e.which == 13) {
                ajax_pagination();
            }
        });

        $(document).ready(function() {
            set_select_time();
            $('#input_start').datepicker({
                language: 'th-th',
                format: 'dd/mm/yyyy',
                autoclose: true
            });
            $('#input_end').datepicker({
                language: 'th-th',
                format: 'dd/mm/yyyy',
                autoclose: true
            });
        });

        function date_convert(input_id, output_id, id) {
            get_date = $('#' + input_id).val();
            if (get_date != '') {
                split_date = get_date.split('/');
                date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0];
                $('#' + output_id).val(date);
            } else {
                $('#' + output_id).val('');
            }
            $('#' + output_id).change();
        }

        function set_select_time() {
            select_time = $('#select_time').val();
            $('.select_control').hide();
            $('#input_start').prop('disabled', true);
            $('#input_end').prop('disabled', true);
            if (select_time == 1) {
                $('#select_1').show();
                $('#input_select_1').datepicker({
                    language: 'th-th',
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
                set_select_time_input();
            } else if (select_time == 2) {
                $('#select_2').show();
                set_select_time_input();
            } else if (select_time == 3) {
                $('#select_3').show();
                set_select_time_input();
            } else if (select_time == 4) {
                $('#select_4').show();
                $('#input_start').prop('disabled', false);
                $('#input_end').prop('disabled', false);
            } else {
                $('#select_4').show();
                $('#input_start').val('');
                $('#input_end').val('');
                $('#start').val('');
                $('#end').val('');
                ajax_pagination();
            }
        }

        function set_select_time_input() {
            select_time = $('#select_time').val();
            if (select_time == 1) {
                th_date = $('#input_select_1').val();
                if (th_date != '') {
                    split_date = th_date.split('/');
                    en_date = (parseInt(split_date[2]) - 543) + '-' + split_date[1] + '-' + split_date[0];
                    $('#input_start').val(th_date);
                    $('#input_end').val(th_date);
                    $('#start').val(en_date);
                    $('#end').val(en_date);
                } else {
                    $('#input_start').val('');
                    $('#input_end').val('');
                    $('#start').val('');
                    $('#end').val('');
                }
                $('#end').change();
            } else if (select_time == 2) {
                en_ymd = $('#ymd').val().split('-');
                en_y = en_ymd[0];
                th_y = parseInt(en_ymd[0]) + 543;
                m = $('#input_select_2').val();
                d = new Date(en_y, m, 0).getDate();
                input_start = '01/' + m + '/' + th_y;
                input_end = d + '/' + m + '/' + th_y;
                start = en_y + '-' + m + '-01';
                end = en_y + '-' + m + '-' + d;
                $('#input_start').val(input_start);
                $('#input_end').val(input_end);
                $('#start').val(start);
                $('#end').val(end);
                $('#end').change();
            } else if (select_time == 3) {
                th_y = $('#input_select_3').val();
                en_y = parseInt(th_y) - 543;
                input_start = '01/01/' + th_y;
                input_end = '31/12/' + th_y;
                start = en_y + '-01-01';
                end = en_y + '-12-31';
                $('#input_start').val(input_start);
                $('#input_end').val(input_end);
                $('#start').val(start);
                $('#end').val(end);
                $('#end').change();
            } else {

            }
        }

        function ajax_pagination() {
            $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
            var start = $('#start').val();
            var end = $('#end').val();
            if (start === '') {
                start = $('#min').val();
            }
            if (end === '') {
                end = $('#max').val();
            }
            $.ajax({
                url: service_base_url + 'documentindex/ajax_pagination',
                type: 'POST',
                data: {
                    searchtext: $('#searchtext').val(),
                    start: start,
                    end: end,
                    ref_doc_index_year_id: $('#ref_doc_index_year_id').val(),
                    ref_doc_index_category_id: $('#ref_doc_index_category_id').val(),
                    ref_doc_index_type_id: $('#ref_doc_index_type_id').val(),
                    ref_doc_index_location_id: $('#ref_doc_index_location_id').val(),
                    ref_doc_index_budget_id: $('#ref_doc_index_budget_id').val(),
                    ref_doc_index_store1_id: $('#ref_doc_index_store1_id').val(),
                    ref_doc_index_store2_id: $('#ref_doc_index_store2_id').val(),
                    ref_doc_index_store3_id: $('#ref_doc_index_store3_id').val(),
                    ref_doc_index_department_id: $('#ref_doc_index_department_id').val(),
                },
                success: function(response) {
                    $('#result-pagination').html(response);
                }
            });
        }

        function modal_add() {
            $('#modal-content-lg').html('');
            $.ajax({
                url: service_base_url + 'documentindex/add_modal',
                type: 'POST',
                data: {

                },
                success: function(response) {
                    $('#result-modal-lg #modal-content-lg').html(response);
                    $('#form-modal-add').parsley().reset();
                    $('#result-modal-lg').modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        }

        function documentindex_add() {
            $('#submit_add').prop('disabled', true);
            $('#submit_add').html('<i class="fa fa-spinner fa-spin"></i> กำลังประมวลผล');
            $.ajax({
                url: service_base_url + 'documentindex/add',
                type: 'POST',
                data: $("#form-modal-add").serialize(),
                success: function(res) {
                    //console.log(res);
                    $('#result-modal-lg').modal('hide');
                    if (res == 1) {
                        setTimeout(function() {
                            ajax_pagination();
                            notification('success', 'ทำรายการเรียบร้อย', 'บันทึกข้อมูลสำเร็จ');
                        }, 500);
                    } else {
                        notification('error', 'เกิดข้อผิดผลาด', 'ไม่สามารถบันทึกข้อมูลได้');
                        ajax_pagination();
                    }
                }
            });
            return false;
        }

        function modal_edit(doc_index_id) {
            //console.log(doc_index_id);
            $('#modal-content-lg').html('');
            $.ajax({
                url: service_base_url + 'documentindex/edit_modal',
                type: 'POST',
                data: {
                    doc_index_id: doc_index_id
                },
                success: function(response) {
                    $('#result-modal-lg #modal-content-lg').html(response);
                    $('#form-modal-edit').parsley().reset();
                    $('#result-modal-lg').modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        }

        function modal_delete(doc_index_id) {
            //console.log(doc_index_id);
            $('#modal-content').html('');
            $.ajax({
                url: service_base_url + 'documentindex/delete_modal',
                type: 'POST',
                data: {
                    doc_index_id: doc_index_id
                },
                success: function(response) {
                    $('#result-modal #modal-content').html(response);
                    $('#result-modal').modal('show', {
                        backdrop: 'true'
                    });
                }
            });
        }

        function modal_process() {
            $('#modal_process').modal('show', {
                backdrop: 'true'
            });
        }

        function process_id() {
            $('#btn-process-submit').prop('disabled', true);
            $('#btn-process-submit').html('<i class="fa fa-spinner fa-spin"></i> กำลังประมวลผล');
            $.ajax({
                url: service_base_url + 'documentindex/processid',
                type: 'POST',
                data: {

                },
                success: function(response) {
                    $('#modal_process').modal('hide');
                    if (response == 1) {
                        setTimeout(function() {
                            ajax_pagination();
                            notification('success', 'ทำรายการเรียบร้อย', 'บันทึกข้อมูลสำเร็จ');
                        }, 500);
                    } else {
                        notification('error', 'เกิดข้อผิดผลาด', 'ไม่สามารถบันทึกข้อมูลได้');
                        ajax_pagination();
                    }
                }
            });
        }

        $(function() {
            var alert_message = $('#alert_message').val();
            if (alert_message != '') {
                var foo = alert_message.split(',');
                notification(foo[0], foo[1], foo[2]);
            }
        });

        function notification(type, head, message) {
            $.toast({
                heading: head,
                text: message,
                position: 'top-right',
                loaderBg: '#D8DBDD',
                icon: type,
                hideAfter: 3000,
                stack: 3
            });
        }

        function import_modal() {
            $('#form-modal-import').parsley().reset();
            $('#import_modal').modal('show', {
                backdrop: 'true'
            });
            $('#result-page').html('');
            $('#check-btn').prop('disabled', true);
        }

        $('#btn-form-check-modal').click(function() {
            if ($('#form-modal-import').parsley().validate() === true) {
                $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
                var form_data = new FormData($('#form-modal-import')[0])
                $.ajax({
                    url: service_base_url + 'documentindex/checkimport',
                    type: 'POST',
                    data: form_data,
                    // file
                    enctype: 'multipart/form-data',
                    processData: false,
                    contentType: false,
                    cache: false,
                    success: function(response) {
                        $('#check-btn').prop('disabled', false);
                        $('#result-page').html(response);
                    }
                });
            }
        });
    </script>
</body>

</html>