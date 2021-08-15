<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h3 class="text-center mt-2">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h3>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-4 col-md-4 col-12">
                        <form class="form-horizontal" id="formcheck" method="post" autocomplete="off">
                            <div class="form-group mb-2">
                                <label class="control-label">Public Key :</label>
                                <input type="text" name="public_key" id="public_key" class="form-control" value="<?php echo $data->public_key != "" ? $data->public_key : "-"; ?>" readonly="" required="">
                                <small class="form-control-feedback">ข้อมูล Public Key ของท่าน </small>
                            </div>
                            <div class="form-group mb-3">
                                <label class="control-label">Signature Code:</label>
                                <input type="text" name="signature" id="signature" class="form-control" value="" required="">
                                <small class="form-control-feedback">กรอกข้อมูลลายเซ็นต์ที่ท่านต้องการตรวจสอบ </small>
                            </div>
                            <button type="button" id="btn-formcheck" class="btn btn-block btn-info"><i class="fa fa-search"></i>&nbsp;ตรวจสอบ</button>
                        </form>
                    </div>                    
                </div>
                <hr>
                <div class="row" style="min-height: 40vh;">
                    <div class="col-lg-2 col-md-2 col-12">
                        &nbsp;
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <div id="result">
                            <div class="text-center mt-4 mb-2">
                                <h3 class="text-center mt-2">
                                    ผลการตรวจสอบ
                                </h3>
                                <i class="fa fa-minus"></i>
                            </div> 
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var service_base_url = $('#service_base_url').val();

    $(function () {
        $('#formcheck').parsley();
    });

    $('#btn-formcheck').click(function () {
        if ($('#formcheck').parsley().validate() === true) {
            check_signature();
        }
        return false;
    })

    function check_signature() {
        if ($("#signature").val() !== '') {
            $('#result').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-2x fa-fw"></i></div>');
            url = service_base_url + 'checksignature/check';
            $.ajax({
                url: url,
                method: "POST",
                data: {
                    signature: $('#signature').val()
                },
                success: function (response) {
                    $('#result').html(response);
                    $('#formcheck').parsley().reset();
                }
            });
        }
        return false;
    }

</script>