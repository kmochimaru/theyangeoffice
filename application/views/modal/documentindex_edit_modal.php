<form id="form-modal-edit" method="post" enctype="multipart/form-data" autocomplete="off">
    <input type="hidden" id="doc_index_id" name="doc_index_id" value="<?php echo $data->doc_index_id; ?>">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-plus"></i> แก้ไขข้อมูลปีงบประมาณ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ปีงบประมาณ <span class="text-danger">*</span></label>
                    <select id="doc_index_year" name="doc_index_year" class="form-control form-control-sm">
                        <?php
                        foreach ($this->documentindex_model->get_ref_doc_index_year()->result() as $year) {
                            ?>
                            <option value="<?php echo $year->ref_doc_index_year_id; ?>" <?php echo $year->ref_doc_index_year_name == $data->doc_index_year ? 'selected' : ''; ?>><?php echo $year->ref_doc_index_year_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">วันที่เอกสาร <span class="text-danger">*</span></label>
                    <input type="text" name="doc_index_date_input" id="doc_index_date_input" value="<?php echo $this->misc->offsetyear(date($data->doc_index_date), 543); ?>" onchange="date_convert('doc_index_date_input', 'doc_index_date')"  class="form-control form-control-sm mydatepicker" required=""/>
                    <input type="hidden" id="doc_index_date" name="doc_index_date" value="<?php echo $data->doc_index_date; ?>" class="form-control form-control-sm" required="">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ประเภทเอกสาร <span class="text-danger">*</span></label>
                    <select id="doc_index_category" name="doc_index_category" class="form-control form-control-sm" onchange="selectedtype();">
                        <?php
                        foreach ($this->documentindex_model->get_ref_doc_index_category()->result() as $cat) {
                            ?>
                            <option value="<?php echo $cat->ref_doc_index_category_id; ?>" <?php echo $cat->ref_doc_index_category_name == $data->doc_index_category ? 'selected' : ''; ?>><?php echo $cat->ref_doc_index_category_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ประเภทเอกสาร (ย่อย) <span class="text-danger">*</span></label>
                    <select id="doc_index_type" name="doc_index_type" class="form-control form-control-sm" required="">
                        <option value="">เลือกประเภทเอกสาร (ย่อย)</option>
                        <?php
                        $doc_index_categorys = $this->documentindex_model->get_ref_doc_index_category_name($data->doc_index_category);
                        $doc_index_category_id = 1;
                        if ($doc_index_categorys->num_rows() > 0) {
                            $doc_index_category_id = $doc_index_categorys->row(0)->ref_doc_index_category_id;
                        }
                        foreach ($this->documentindex_model->get_ref_doc_index_type(null, $doc_index_category_id)->result() as $type) {
                            ?>
                            <option value="<?php echo $type->ref_doc_index_type_id; ?>" <?php echo $type->ref_doc_index_type_name == $data->doc_index_type ? 'selected' : ''; ?>><?php echo $type->ref_doc_index_type_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">เลขที่ฎีกา <span class="text-danger">*</span></label>
                    <input type="text" id="doc_index_number" name="doc_index_number" value="<?php echo $data->doc_index_number; ?>" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">แหล่งเงิน <span class="text-danger">*</span></label>
                    <select id="doc_index_budget" name="doc_index_budget" class="form-control form-control-sm">
                        <?php
                        foreach ($this->documentindex_model->get_ref_doc_index_budget()->result() as $budget) {
                            ?>
                            <option value="<?php echo $budget->ref_doc_index_budget_id; ?>" <?php echo $budget->ref_doc_index_budget_name == $data->doc_index_budget ? 'selected' : ''; ?>><?php echo $budget->ref_doc_index_budget_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">จำนวนเงิน <span class="text-danger">*</span></label>
                    <input type="text" id="doc_index_amount" name="doc_index_amount"  value="<?php echo $data->doc_index_amount; ?>" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ชื่อโครงการ<span class="text-danger">*</span></label>
                    <input type="text" id="doc_index_name" name="doc_index_name" value="<?php echo $data->doc_index_name; ?>" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label class="control-label">คำอธิบายโครงการ </label>
                    <input type="text" id="doc_index_detail" name="doc_index_detail" value="<?php echo $data->doc_index_detail; ?>" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ลักษณะจัดเก็บเอกสาร <span class="text-danger">*</span></label>
                    <select id="doc_index_store1" name="doc_index_store1" class="form-control form-control-sm" onchange="selectedstore2();">
                        <option value="">ไม่ระบุ</option>
                        <?php
                        foreach ($this->documentindex_model->get_ref_doc_index_store1()->result() as $store) {
                            ?>
                            <option value="<?php echo $store->ref_doc_index_store1_id; ?>" <?php echo $store->ref_doc_index_store1_name == $data->doc_index_store1 ? 'selected' : ''; ?>><?php echo $store->ref_doc_index_store1_name; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ลักษณะจัดเก็บเอกสาร (ย่อย) <span class="text-danger">*</span></label>
                    <select id="doc_index_store2" name="doc_index_store2" class="form-control form-control-sm" onchange="selectedstore3();">
                        <option value="">ไม่ระบุ</option>
                        <?php
                        if ($data->doc_index_store1 != null) {
                            $doc_index_store1s = $this->documentindex_model->get_ref_doc_index_store1_name($data->doc_index_store1);
                            $doc_index_store1_id = 1;
                            if ($doc_index_store1s->num_rows() > 0) {
                                $doc_index_store1_id = $doc_index_store1s->row(0)->ref_doc_index_store1_id;
                                foreach ($this->documentindex_model->get_ref_doc_index_store2(null, $doc_index_store1_id)->result() as $store) {
                                    ?>
                                    <option value="<?php echo $store->ref_doc_index_store2_id; ?>" <?php echo $store->ref_doc_index_store2_name == $data->doc_index_store2 ? 'selected' : ''; ?>><?php echo $store->ref_doc_index_store2_name; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ลักษณะจัดเก็บเอกสาร (ย่อย) <span class="text-danger">*</span></label>
                    <select id="doc_index_store3" name="doc_index_store3" class="form-control form-control-sm">
                        <option value="">ไม่ระบุ</option>
                        <?php
                        if ($data->doc_index_store1 != null) {
                            $doc_index_store2s = $this->documentindex_model->get_ref_doc_index_store2_name($data->doc_index_store2);
                            $doc_index_store2_id = 1;
                            if ($doc_index_store2s->num_rows() > 0) {
                                $doc_index_store2_id = $doc_index_store2s->row(0)->ref_doc_index_store2_id;
                                foreach ($this->documentindex_model->get_ref_doc_index_store3(null, $doc_index_store2_id)->result() as $store) {
                                    ?>
                                    <option value="<?php echo $store->ref_doc_index_store3_id; ?>" <?php echo $store->ref_doc_index_store3_name == $data->doc_index_store3 ? 'selected' : ''; ?>><?php echo $store->ref_doc_index_store3_name; ?></option>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">หน่วยงาน <span class="text-danger">*</span></label>
                    <select id="doc_index_department" name="doc_index_department[]" class="select2 select2-multiple form-control" style="width: 100%" multiple="multiple" data-placeholder="เลือกหน่วยงาน" required="">
                        <?php
                        foreach ($this->documentindex_model->get_ref_doc_index_department()->result() as $department) {
                            ?>
                        <option value="<?php echo $department->ref_doc_index_department_code; ?>" <?php echo !empty(stristr($data->doc_index_department, $department->ref_doc_index_department_code)) ? 'selected' : ''; ?>><?php echo $department->ref_doc_index_department_code . ' (' . $department->ref_doc_index_department_name . ')'; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ชื่อผู้รับเงิน <span class="text-danger">*</span></label>
                    <input type="text" id="doc_index_payee" name="doc_index_payee" value="<?php echo $data->doc_index_payee; ?>" class="form-control form-control-sm">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label class="control-label">ชื่อผู้เบิก <span class="text-danger">*</span></label>
                    <input type="text" id="doc_index_pathfinder" name="doc_index_pathfinder" value="<?php echo $data->doc_index_pathfinder; ?>" class="form-control form-control-sm">
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" id="submit_edit" onclick="documentindex_edit();" class="btn btn-info"><i class="fa fa-save"></i> บันทึก</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>

<script>
    $(function () {
        $('#form-modal-edit').parsley();
        $("#doc_index_department").select2();
        $('.mydatepicker').datepicker({
            language: 'th-th',
            format: 'dd/mm/yyyy',
            autoclose: true
        });
    });

    function date_convert(input_id, output_id) {
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

    function documentindex_edit() {
        $('#submit_edit').prop('disabled', true);
        $('#submit_edit').html('<i class="fa fa-spinner fa-spin"></i> กำลังประมวลบันทึก');
        $.ajax({
            url: service_base_url + 'documentindex/edit',
            type: 'POST',
            data: $("#form-modal-edit").serialize(),
            success: function (res) {
                //console.log(res);
                $('#result-modal-lg').modal('hide');
                if (res == 1) {
                    setTimeout(function () {
                        reloadPagination();
                        notification('success', 'ทำรายการเรียบร้อย', 'บันทึกข้อมูลสำเร็จ');
                    }, 500);
                } else {
                    notification('error', 'เกิดข้อผิดผลาด', 'ไม่สามารถบันทึกข้อมูลได้');
                    reloadPagination();
                }
            }
        });
        return false;
    }

    function selectedtype() {
        doc_index_category = $('#doc_index_category').val();
        doc_index_type = $('#doc_index_type');
        doc_index_type.find('option').remove();
        $.ajax({
            url: service_base_url + 'documentindex/selectedtype',
            type: 'POST',
            dataType: 'json',
            data: {
                doc_index_category: doc_index_category,
            },
            success: function (response) {
                count_row = response.doc_index_type_id.length;
                doc_index_type.append($("<option></option>").attr("value", "").text('เลือกประเภทเอกสาร (ย่อย)'));
                for (i = 0; i < count_row; i++) {
                    doc_index_type_id = response.doc_index_type_id[i];
                    doc_index_type_name = response.doc_index_type_name[i];
                    doc_index_type.append($("<option></option>").attr("value", doc_index_type_id).text(doc_index_type_name));
                }
            }
        });
    }

    function selectedstore2() {
        doc_index_store1 = $('#doc_index_store1').val();
        doc_index_store2 = $('#doc_index_store2');
        doc_index_store2.find('option').remove();
        $.ajax({
            url: service_base_url + 'documentindex/selectedstore2',
            type: 'POST',
            dataType: 'json',
            data: {
                doc_index_store1: doc_index_store1,
            },
            success: function (response) {
                count_row = response.doc_index_store2_id.length;
                doc_index_store2.append($("<option></option>").attr("value", "").text('ไม่ระบุ'));
                for (i = 0; i < count_row; i++) {
                    doc_index_store2_id = response.doc_index_store2_id[i];
                    doc_index_store2_name = response.doc_index_store2_name[i];
                    doc_index_store2.append($("<option></option>").attr("value", doc_index_store2_id).text(doc_index_store2_name));
                }
                selectedstore3();
            }
        });
    }

    function selectedstore3() {
        doc_index_store2 = $('#doc_index_store2').val();
        doc_index_store3 = $('#doc_index_store3');
        doc_index_store3.find('option').remove();
        $.ajax({
            url: service_base_url + 'documentindex/selectedstore3',
            type: 'POST',
            dataType: 'json',
            data: {
                doc_index_store2: doc_index_store2,
            },
            success: function (response) {
                count_row = response.doc_index_store3_id.length;
                doc_index_store3.append($("<option></option>").attr("value", "").text('ไม่ระบุ'));
                for (i = 0; i < count_row; i++) {
                    doc_index_store3_id = response.doc_index_store3_id[i];
                    doc_index_store3_name = response.doc_index_store3_name[i];
                    doc_index_store3.append($("<option></option>").attr("value", doc_index_store3_id).text(doc_index_store3_name));
                }
            }
        });
    }
</script>
