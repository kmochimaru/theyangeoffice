<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i>&nbsp;<?php echo $title; ?>
                    <a href="<?php echo base_url('serviecinfo'); ?>" style="float: right" class="btn btn-sm btn-rounded btn-outline-inverse"><i class="fa fa-arrow-left"></i>&nbsp;กลับ</a>
                </h4>
                <hr>
                <h5 class="text-info" style="font-weight: bold;">เลือกงานแก้ไขและบริการ</h5>
                <ul class="feeds">
                    <?php foreach ($this->serviecinfo_model->get_service()->result() as $service) { ?>
                        <a href="<?php echo base_url() . 'serviecinfo/serviec/' . $service->service_id ?>">
                            <li style="font-weight: bold; color: gray;">
                                <div class="bg-light-info"><i class="fa fa-wrench"></i></div> <?php echo $service->service_name; ?><span class="text-muted"> <?php echo $service->service_group_name; ?></span>
                            </li>
                        </a>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>
