<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo isset($title) ? $title . ' | ' . $this->config->item('app_name') . ' ' . $this->config->item('app_title') : $this->config->item('app_name') . ' ' . $this->config->item('app_title'); ?></title>
        <meta name="description" content="<?php echo $this->config->item('app_description'); ?>" />
        <meta name="keywords" content="<?php echo $this->config->item('app_keyward'); ?>" />
        <meta name="author" content="<?php echo $this->config->item('app_author'); ?>" />

        <link rel="shortcut icon" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>" />
        <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() . 'assets/img/' . $this->config->item('app_favicon'); ?>">

        <?php
        echo "\t\t" . $this->assets->css_full('plugin/bootstrap/css/bootstrap.min.css');
        echo "\t" . $this->assets->css('pages/login-register-lock.css');
        echo "\t" . $this->assets->css('style.css');
        echo "\t" . $this->assets->css_full('plugin/sweetalert/sweetalert.css');
        echo "\t" . $this->assets->css('parsley.min.css');
        
        $this->load->view('layout/tag');
        ?>

        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body class="card-no-border">
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">Loading...</p>
            </div>
        </div>
        <input type="hidden" id="service_base_url" value="<?php echo base_url(); ?>" />

        <section id="wrapper">
            <div class="login-register" style="background-image:url(<?php echo base_url() . 'assets/img/bg.svg'; ?>);padding: 6vw 0 0 0; position: absolute;overflow: overlay;">
                <div class="login-box card" style="border: 1px solid #e3e3E3;">
                    <div class="card-body">
                        <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo base_url() . 'login/dologin'; ?>">
                            <input type="hidden" name="login_token" value="<?php echo $login_token; ?>" />
                            <div class="text-center" style="font-size: 40px;">
                                <img src="<?php echo base_url() . 'assets/img/logo_yn.png'; ?>" width="88px">
                            </div>
                            <h3 class="box-title text-center" style="color:#666;">เข้าสู่ระบบ</h3>
                            <h5 class="box-title text-center">ระบบสารบรรณอิเล็กทรอนิกส์<br>เทศบาลตำบลยางเนิ้ง</h5>
                            <h3 class="box-title text-center" style="color:#56C0D8;"><?php echo $this->config->item('app_title'); ?></h3>

                            <div class="text-center" id="flash_message">
                                <?php
                                if ($this->session->flashdata('flash_message') != '') {
                                    ?>
                                    <?php
                                    echo $this->session->flashdata('flash_message');
                                    ?>
                                    <br>
                                    <?php
                                }
                                ?>                                 
                            </div>

                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="text" name="username_input" id="username" required="" placeholder="Username" style="min-height: 46px;"> 
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <input class="form-control" type="password" autocomplete="new-password" name="password_input" required="" placeholder="Password" style="min-height: 46px;"> 
                                </div>
                            </div>
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                    <button style="padding: 10px 15px 10px 15px;" class="btn btn-block btn-info btn-rounded" type="submit"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>
                                </div>
                            </div> 
                            <br>
                            <!--<h5 class="box-title text-center text-danger">** เข้าสู่ระบบโดย Account RMUTL Username <br>ไม่ต้องกรอก @rmutl.ac.th **</h5>-->
                        </form>                        
                    </div>     
                    <div class="card-footer">                
                        <p class="text-center"><?php echo $this->config->item('app_footer'); ?></p>                       
                    </div>
                </div>
            </div>
        </section>

        <?php
        echo "\t\t" . $this->assets->js_full('plugin/jquery/jquery.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/popper.min.js');
        echo "\t" . $this->assets->js_full('plugin/bootstrap/js/bootstrap.min.js');
        echo "\t" . $this->assets->js_full('plugin/sweetalert/sweetalert.min.js');
        echo "\t" . $this->assets->js('parsley.min.js');
        ?>

        <script type="text/javascript">
            var service_base_url = $('#service_base_url').val();

            $(function () {
                $(".preloader").fadeOut();
                $('[data-toggle="tooltip"]').tooltip();
                $('#loginform').parsley();
            });

            $('#flash_message').delay(5000).fadeOut(1000);

        </script>
    </body>
</html>
