<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?> <?php echo " - " . $groupdep->groupdep_name; ?> (<?php echo $groupdep->groupdep_id; ?>)
                </h4>
                <input type="hidden" id="groupdep_id" value="<?php echo $groupdep_id; ?>"/>
                <div class="row m-t-20 m-b-5">
                    <div class="col-sm-3">
                        <select id="dep_id_pri" class="select2 form-control form-control-sm custom-select" style="width: 100%; height:36px;" data-placeholder="ทั้งหมด" onchange="ajax_page();" >
                            <option value="0">หน่วยงานทั้งหมด</option>
                            <?php foreach ($this->groupdep_model->getOrgDepartment()->result() as $dep) { ?>
                                <option value="<?php echo $dep->dep_id_pri; ?>"><?php echo $dep->dep_name; ?></option>
                            <?php } ?>
                        </select>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-7" style="border-right: 1px solid lavender">                        
                        <div id="result-page" class="m-t-10"></div>
                    </div>
                    <div class="col-5">
                        <div class="m-t-15" style="font-weight: bold;">จัดเรียงกลุ่มหน่วยงาน</div>
                        <div id="result-page-sort" class="m-t-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var service_base_url = $('#service_base_url').val();

    $(function () {
        $(".select2").select2();
        ajax_page();
        ajax_sort();
    });

    function ajax_page() {
        $('#result-page').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'groupdep/ajax_page',
            type: 'POST',
            data: {
                groupdep_id: $('#groupdep_id').val(),
                dep_id_pri: $('#dep_id_pri').val(),
            },
            success: function (response) {
                $('#result-page').html(response);
            }
        });
    }

    function ajax_sort() {
        $('#result-page-sort').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'groupdep/ajax_sort',
            type: 'POST',
            data: {
                groupdep_id: $('#groupdep_id').val(),
            },
            success: function (response) {
                $('#result-page-sort').html(response);
            }
        });
    }

    function switchgroupdep(groupdep_id, dep_off_id, checkbox) {
        if (checkbox.checked) {
            var url = service_base_url + 'groupdep/add';
            $.post(url, {groupdep_id: groupdep_id, dep_off_id: dep_off_id}, function (response) {
                $('#groupdep_show_checkbock' + dep_off_id).html('<span class="badge badge-success"><i class="fa fa-check-circle"></i>&nbsp;เลือก</span>');
                ajax_sort();
                notification('success', 'สำเร็จ', 'กำหนดกลุ่มหน่วยงานสำเร็จ');
            });
        } else {
            var url = service_base_url + 'groupdep/delete';
            $.post(url, {groupdep_id: groupdep_id, dep_off_id: dep_off_id}, function (response) {
                $('#groupdep_show_checkbock' + dep_off_id).html('<span class="badge badge-warning"><i class="fa fa-times-circle"></i>&nbsp;ไม่เลือก</span>');
                ajax_sort();
                notification('success', 'สำเร็จ', 'กำหนดกลุ่มหน่วยงานสำเร็จ');
            });
        }
    }
</script>