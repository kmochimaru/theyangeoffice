<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-2 m-b-10">
                        <label class="control-label" style="font-weight: bold;">สถานะ</label>
                        <select id="service_status_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">สถานะทั้งหมด</option>
                            <?php
                            $status = $this->servieclist_model->ref_service_status();
                            if ($status->num_rows() > 0) {
                                foreach ($status->result() as $state) {
                                    ?>
                                    <option value="<?php echo $state->service_status_id; ?>"><?php echo $state->service_status_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">กลุ่มงานแก้ไขและบริการ</label>
                        <select id="service_group_id" class="form-control form-control-sm" onchange="selected();">
                            <option value="">ทั้งหมด</option>
                            <?php
                            $service_groups = $this->servieclist_model->get_service_group();
                            if ($service_groups->num_rows() > 0) {
                                foreach ($service_groups->result() as $service_group) {
                                    ?>
                                    <option value="<?php echo $service_group->service_group_id; ?>"><?php echo $service_group->service_group_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-3 m-b-10">
                        <label class="control-label" style="font-weight: bold;">งานแก้ไขและบริการ</label>
                        <select id="service_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ทั้งหมด</option>
                            <?php
                            $services = $this->servieclist_model->get_service();
                            if ($services->num_rows() > 0) {
                                foreach ($services->result() as $service) {
                                    ?>
                                    <option value="<?php echo $service->service_id; ?>"><?php echo $service->service_name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-sm-4 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ค้นหา</label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_pagination()">ค้นหา</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="result-pagination"></div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        ajax_pagination();
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        url = service_base_url + 'servieclist/ajax_pagination';
        $.ajax({
            url: url,
            method: "POST",
            data: {
                service_status_id: $('#service_status_id').val(),
                service_group_id: $('#service_group_id').val(),
                service_id: $('#service_id').val(),
                searchtext: $('#searchtext').val(),
            },
            success: function (res)
            {
                $('#result-pagination').html(res);
            }
        });
    }


    function selected() {
        service_group_id = $('#service_group_id').val();
        service_tag = $('#service_id');
        service_tag.find('option').remove();
        $.ajax({
            url: service_base_url + 'servieclist/selected',
            type: 'POST',
            dataType: 'json',
            data: {
                service_group_id: service_group_id
            },
            success: function (response) {
                count_row = response.service_id.length;
                service_tag.append($("<option></option>").attr("value", "").text('ทั้งหมด'));
                for (i = 0; i < count_row; i++) {
                    service_id = response.service_id[i];
                    service_name = response.service_name[i];
                    service_tag.append($("<option></option>").attr("value", service_id).text(service_name));
                }
            }
        });
    }
</script>