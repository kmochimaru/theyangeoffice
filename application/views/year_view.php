<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                    <span style="float: right">
                        <button type="button" class="btn btn-sm btn-rounded btn-outline-success" onclick="modal_add();"><i class="fa fa-plus"></i> เพิ่มปี</button>
                    </span>
                </h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">ปีงานสารบรรณ</th>
                                <th class="text-center">ปี พศ.</th>
                                <th class="text-center">ปี คศ.</th>
                                <th class="text-center">วันที่ เริ่ม - สิ้นสุด</th>
                                <th class="text-center">หน่วยงาน ทั้งหมด / สร้างเเล้ว</th>
                                <th class="text-center">ตัวเลือก</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            if ($datas->num_rows() > 0) {
                                foreach ($datas->result() as $data) {
                                    $count_dep = $this->year_model->getDep()->num_rows();
                                    $check_map_dep = $this->year_model->check_map_dep($data->year_id);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td class="text-center"><?php echo $data->year; ?></td>
                                        <td class="text-center"><?php echo $data->year_th; ?></td>
                                        <td class="text-center"><?php echo $data->year_en; ?></td>
                                        <td class="text-center"><?php echo $data->year_start . ' - ' . $data->year_end; ?></td>
                                        <td class="text-center"><b><?php echo $count_dep; ?></b> / <?php echo ($count_dep == $check_map_dep ? '<span class="badge badge-success"><i class="fa fa-check"></i> ' . $check_map_dep . '</span>' : $check_map_dep); ?></td>
                                        <td class="text-center">
                                            <?php
                                            if ($count_dep > $check_map_dep) {
                                                ?>
                                                <a href="<?php echo base_url() . 'year/process/' . $data->year_id; ?>" class="btn btn-sm btn-outline-warning"><i class="fa fa-refresh"></i> สร้างปีหน่วยงาน</a>
                                                <?php
                                            } else {
                                                ?>
                                                <button type="button" onclick="javascript:void(0);" class="btn btn-sm btn-outline-inverse"><i class="fa fa-refresh"></i> สร้างปีหน่วยงาน</button>
                                                <?php
                                            }
                                            ?>                                            
                                            <button type="button" onclick="modal_edit(<?php echo $data->year_id; ?>);" class="btn btn-sm btn-outline-info"><i class="fa fa-edit"></i> แก้ไข</button>
                                            <?php
                                            if ($check_map_dep == 0) {
                                                ?>
                                                <button type="button" onclick="modal_delete(<?php echo $data->year_id; ?>);" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i> ลบ</button>
                                                <?php
                                            } else {
                                                ?>
                                                <button type="button" onclick="javascript:void(0);" class="btn btn-sm btn-outline-inverse"><i class="fa fa-trash"></i> ลบ</button>
                                                <?php
                                            }
                                            ?>                                            
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            } else {
                                ?>
                                <tr>
                                    <td class="text-center" colspan="5"><?php echo 'ไม่มีข้อมูล'; ?></td>
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

<div id="result-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>

<div id="result-modal-lg" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div>
    </div>
</div>

<script>
    var service_base_url = $('#service_base_url').val();

    function modal_add() {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'year/add_year_modal',
            type: 'POST',
            data: {},
            success: function (response) {
                $('#result-modal-lg .modal-content').html(response);
                $('#form-modal').parsley();
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_edit(year_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'year/edit_year_modal',
            type: 'POST',
            data: {
                year_id: year_id
            },
            success: function (response) {
                $('#result-modal-lg .modal-content').html(response);
                $('#form-modal').parsley();
                $('#result-modal-lg').modal('show', {backdrop: 'true'});
            }
        });
    }

    function modal_delete(year_id) {
        $('.modal-content').html('');
        $.ajax({
            url: service_base_url + 'year/delete_year_modal',
            type: 'POST',
            data: {
                year_id: year_id
            },
            success: function (response) {
                $('#result-modal .modal-content').html(response);
                $('#result-modal').modal('show', {backdrop: 'true'});
            }
        });
    }

</script>