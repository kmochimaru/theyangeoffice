<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($title) ? $title . ' | ' . $this->config->item('app_name') . ' ปี ' . $this->session->userdata('year') . ' ' . $this->config->item('app_title') : $this->config->item('app_name') . ' ปี ' . $this->session->userdata('year') . ' ' . $this->config->item('app_title'); ?></title>
        <meta name="description" content="<?php echo $this->config->item('app_description'); ?>" />
        <meta name="keywords" content="<?php echo $this->config->item('app_keyward'); ?>" />
        <meta name="author" content="<?php echo $this->config->item('app_author'); ?>" />
        <meta name="robots" content="noindex, nofollow">

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>">

        <?php
        $user = $this->accesscontrol->getUserFull($this->session->userdata('user_id'));

        echo $this->assets->css_full('plugin/bootstrap/css/bootstrap.min.css');
        echo "\t" . $this->assets->css_full('plugin/toast-master/css/jquery.toast.css');
        echo "\t" . $this->assets->css('style.css');
        echo "\t" . $this->assets->css_full('css/colors/megna.css');
        echo "\t" . $this->assets->css_full('plugin/sweetalert/sweetalert.css');
        echo "\t" . $this->assets->css('parsley.min.css');
        echo "\n\t";

        if (isset($css_full)) {
            foreach ($css_full as $row) {
                echo "\t" . $this->assets->css_full($row);
            }
        }
        if (isset($css)) {
            foreach ($css as $row) {
                echo "\t" . $this->assets->css($row);
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
        echo "\t" . $this->assets->js('totop.js');
        echo "\t" . $this->assets->js('parsley.min.js');
        echo "\t" . $this->assets->js_full('plugin/toast-master/js/jquery.toast.js');
        echo "\t" . $this->assets->js_full('plugin/sweetalert/sweetalert.min.js');
        echo "\t" . $this->assets->js_full('plugin/sweetalert/jquery.sweet-alert.custom.js');
        echo "\n\t";

        if (isset($js_full)) {
            foreach ($js_full as $row) {
                echo "\t" . $this->assets->js_full($row);
            }
        }
        if (isset($js)) {
            foreach ($js as $row) {
                echo "\t" . $this->assets->js($row);
            }
        }
        $this->load->view('layout/tag');
        ?>

        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
            <![endif]-->

    </head>

    <body class="fix-header card-no-border fix-sidebar">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" />
        <script>
            var service_base_url = $('#service_base_url').val();
        </script>
        <div id="main-wrapper">
            <header class="topbar">
                <nav class="navbar top-navbar navbar-expand-md navbar-light">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo base_url(); ?>">
                            <b>
                                <img src="<?php echo base_url(); ?>assets/img/logo_icon_yn.png" alt="<?php echo $this->config->item('app_title'); ?>" class="dark-logo" />
                                <img src="<?php echo base_url(); ?>assets/img/logo_icon_yn.png" alt="<?php echo $this->config->item('app_title'); ?>" class="light-logo" />
                            </b>
                            <span>
                                <img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="<?php echo $this->config->item('app_title'); ?>" class="dark-logo" />
                                <img src="<?php echo base_url(); ?>assets/img/logo-text.png" alt="<?php echo $this->config->item('app_title'); ?>" class="light-logo" />
                            </span>
                        </a>
                    </div>

                    <div class="navbar-collapse">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item"> <a class="nav-link sidebartoggler hidden-sm-down waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                            <li class="nav-item hidden-sm-down"></li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class=" ti-pin-alt"></i>
                                </a>
                                <div class="dropdown-menu mailbox animated bounceInDown">
                                    <ul>
                                        <li>
                                            <div class="message-center" style="height: 100%;">
                                                <a href="<?php echo base_url() . 'within'; ?>">
                                                    <div class='btn btn-circle btn-info'><i class="ti-pencil-alt"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>หนังสือส่งภายใน</h5>
                                                    </div>
                                                </a>
                                                <a href="<?php echo base_url() . 'receivelist'; ?>">
                                                    <div class='btn btn-circle btn-info'><i class="ti-download"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>ลงรับหนังสือ(ภายใน)</h5>
                                                    </div>
                                                </a>
                                                <a href="<?php echo base_url() . 'getwithin'; ?>">
                                                    <div class='btn btn-circle btn-info'><i class="ti-pencil"></i></div>
                                                    <div class="mail-contnet">
                                                        <h5>หนังสือรับ(ภายนอก/ภายใน)</h5>
                                                    </div>
                                                </a>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item hidden-sm-down hidden-xs m-r-10">
                                <a class="nav-link dropdown-toggle" href="<?php echo base_url() . 'assets/docs/manual-งานสารบรรณ.pdf' ?>" target="_blank" aria-haspopup="true" aria-expanded="false"><span style="color: white; background: #56c0d8; border: 1px solid whitesmoke; padding: 5px"><i class="fa fa-file-pdf-o"></i> <?php echo 'คู่มือการใช้งาน' ?></span></a>
                            </li>
                        </ul>

                        <ul class="navbar-nav my-lg-0">
                            <?php
                            $works = $this->accesscontrol->getReceiveWork();
                            if ($works->num_rows() > 0) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-briefcase"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                        <ul>
                                            <li>
                                                <div class="drop-title">งานที่รับมอบหมาย : <?php echo $works->num_rows(); ?></div>
                                            </li>
                                            <li>
                                                <div class="message-center">
                                                    <?php
                                                    foreach ($works->result() as $w) {
                                                        ?>
                                                        <a href="<?php echo base_url() . 'receivework/detail/' . $w->work_user_id . '/1'; ?>">
                                                            <div class="btn btn-primary btn-circle"><i class="fa fa-briefcase"></i></div>
                                                            <div class="mail-contnet">
                                                                <h5><?php echo $w->work_info_no . $w->work_info_no_2 . $w->work_info_no_3; ?></h5>
                                                                <?php
                                                                $dep_off_id = $this->accesscontrol->getdep_off_id($this->accesscontrol->getworkprocess($w->work_process_id_pri)->row()->dep_off_id);
                                                                ?>
                                                                <span class="mail-desc">มอบโดย : <?php echo $dep_off_id->officer_name; ?> </span>
                                                                <span class="mail-desc">หน่วยงาน : <?php echo $dep_off_id->dep_name; ?> </span>
                                                                <span class="time"><?php echo $this->misc->date2thai($w->work_info_date, '%d %m %y', 1); ?></span>
                                                            </div>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="<?php echo base_url() . 'receivework'; ?>"> <strong>งานที่รับมอบหมายทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }

                            $infos = $this->accesscontrol->getWorkInfoReceive();
                            if ($infos->num_rows() > 0) {
                                ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fa fa-download"></i>
                                        <div class="notify"> <span class="heartbit"></span> <span class="point"></span> </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                        <ul>
                                            <li>
                                                <div class="drop-title">หนังสือรอลงรับ : <?php echo $infos->num_rows(); ?></div>
                                            </li>
                                            <li>
                                                <div class="message-center">
                                                    <?php
                                                    foreach ($infos->result() as $ins) {
                                                        $in = $this->accesscontrol->getWorkInfoData($ins->work_process_id_pri)->row();
                                                        ?>
                                                        <a href="<?php echo base_url() . 'receivelist/detail/' . $in->work_process_id_pri . '/1'; ?>">
                                                            <div class="btn btn-info btn-circle"><i class="fa fa-download"></i></div>
                                                            <div class="mail-contnet">
                                                                <h5><?php echo $in->work_process_no . $in->work_process_no_2 . $in->work_process_no_3; ?></h5>
                                                                <span class="mail-desc">จาก : <?php echo $in->work_info_from_position . ' ' . $in->work_info_from; ?> </span>
                                                                <span class="mail-desc">ถึง :</span> <?php echo (($in->work_info_to_position != '') && ($in->work_info_to != '') ? $in->work_info_to_position . ' ' . $in->work_info_to : '-'); ?> </span>
                                                                <span class="time"><?php echo $this->misc->date2thai($in->work_info_date, '%d %m %y', 1); ?></span>
                                                            </div>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </li>
                                            <li>
                                                <a class="nav-link text-center" href="<?php echo base_url() . 'receivelist'; ?>"> <strong>หนังสือรอลงรับทั้งหมด</strong> <i class="fa fa-angle-right"></i> </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <?php
                            }

                            $dep_off_result = $this->accesscontrol->getDepOff($this->session->userdata('user_dep_off_id'));
                            if ($dep_off_result->num_rows() == 1) {
                                $dep_off = $dep_off_result->row();
                                ?>
                                <li class="nav-item hidden-sm-down hidden-xs">
                                    <a class="nav-link dropdown-toggle" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <?php echo $dep_off->officer_name . ' : ' . $dep_off->dep_name; ?>
                                    </a>
                                </li>
                                <?php if ($this->accesscontrol->getUserDepOffSession($this->session->userdata('user_id'))->num_rows() > 1) { ?>
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ti-settings"></i>
                                            <div class="notify"> <span class="heartbit"></span> <span class="point"></span></div>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown">
                                            <ul>
                                                <li>
                                                    <div class="drop-title text-center" style="font-size: 15px; font-weight: bold;">ตำแหน่งงาน</div>
                                                </li>
                                                <li>
                                                    <?php foreach ($this->accesscontrol->getUserDepOffSession($this->session->userdata('user_id'))->result() as $userdepoff) { ?>
                                                        <div class="message-center" style="height: 100%;">
                                                            <a href="javascript:void(0);" onclick="changeuser_dep_off('<?php echo $userdepoff->user_dep_off_id; ?>', '<?php echo $userdepoff->dep_off_id; ?>', '<?php echo $userdepoff->dep_id_pri; ?>')">
                                                                <div class='btn btn-circle btn-<?php echo $userdepoff->user_dep_off_id == $this->session->userdata('user_dep_off_id') ? 'success' : 'info' ?>'><i class='<?php echo $userdepoff->user_dep_off_id == $this->session->userdata('user_dep_off_id') ? 'ti-check-box' : 'ti-info-alt' ?>'></i></div>
                                                                <div class="mail-contnet">
                                                                    <h5><?php echo $userdepoff->officer_name; ?></h5> <span class="mail-desc"><?php echo $userdepoff->dep_name; ?></span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    <?php } ?>
                                                </li>
                                            </ul>
                                        </div>
                                    </li>
                                    <?php
                                }
                            }
                            $user_image = base_url() . 'assets/upload/user/' . ($user->user_image != '' ? $user->user_image : 'none.png');
                            ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img id="image_h1" src="<?php echo $user_image; ?>" alt="User" class="profile-pic" />
                                </a>
                                <div class="dropdown-menu dropdown-menu-right animated flipInY">
                                    <ul class="dropdown-user">
                                        <li class="hidden-sm">
                                            <div class="dw-user-box">
                                                <div class="u-text m-t-5">
                                                    <h4><?php echo ($user->user_fullname != '' ? $user->user_fullname : '-'); ?></h4>
                                                    <p class="text-muted"><?php echo ($user->user_email != '' ? $user->user_email : '-'); ?></p>
                                                    <a href="<?php echo base_url() . 'profile/editprofile'; ?>" class="btn btn-rounded btn-info btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li><a href="<?php echo base_url() . 'profile/editprofile'; ?>"><i class="fa fa-user"></i> ประวัติส่วนตัว</a></li>
                                        <li><a href="<?php echo base_url() . 'profile'; ?>"><i class="fa fa-institution"></i> หน่วยงาน</a></li>
                                        <li role="separator" class="divider"></li>
                                        <li><a href="javascript:void()" onclick="logout()"><i class="fa fa-power-off"></i> ออกจากระบบ</a></li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>