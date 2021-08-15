<div class="row">
    <div class="col-lg-12 text-center">
        <?php
        if ($data->work_info_signature != null || $data->work_info_signature != '') {
            ?>
            <a  href="<?php echo base_url() . $data->work_info_signature; ?>" class="<?php echo ($data->work_info_signature != 2) ? 'fancybox' : ''; ?>">
                <img id="icon_show" src="<?php echo base_url() . 'store/signature/' . $data->work_info_id_pri; ?>" class="img-thumbnail" style="height: 200px; cursor:pointer; border: 0px solid whitesmoke">
            </a>
        <?php } else { ?>
            <div class="col-md-12 text-center" style="color: #999;">
                <br/>
                <i class="fa fa-info-circle"></i> ยังไม่มีการลงนาม
            </div>
            <?php
        }
        ?>        
    </div>
</div>
<hr>
<div class="row">
    <div class=" col-md-12 text-right">
        <?php
        if ($data->work_info_signature != null || $data->work_info_signature != '') {
            if ($data->state_info_id == 1) {
                ?>
                <button type="button" class="btn btn-warning" onclick="modal_signature();"><i class="fa fa-pencil"></i>&nbsp;บันทึกการลงนาม</button>
                <?php
            }
        }
        ?>
    </div>
</div>
<script>
    $(document).ready(function () {
        $('.fancybox').fancybox({
            padding: 0,
            helpers: {
                title: {
                    type: 'outside'
                }
            }
        });
    });
</script>

