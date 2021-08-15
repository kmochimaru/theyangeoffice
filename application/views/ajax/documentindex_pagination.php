<style>
    thead th, td {
        font-size: 12px !important;
        padding: 0px 0px 0px 0px;
        margin: 0px 0px 0px 0px;
    }
    .table td {
        padding: 5px 2px 2px 2px;
    }
</style>
<div class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th class="text-center" width="2%">#</th>
                <th style="min-width: 120px;">รหัส</th>
                <th style="min-width: 80px;">ปีงบประมาณ</th>
                <th style="min-width: 100px;">วันที่เอกสาร</th>
                <th style="min-width: 120px;">ประเภทเอกสาร</th>
                <th style="min-width: 80px;">เลขที่ฎีกา</th>
                <th style="min-width: 80px;">แหล่งเงิน</th>
                <th style="min-width: 100px;">จำนวนเงิน</th>
                <th style="min-width: 200px;">ชื่อโครงการ (คำอธิบาย)</th>
                <th style="min-width: 250px;">จัดเก็บ</th>
                <th style="min-width: 200px;">หน่วยงาน</th>
                <th style="min-width: 150px;">ชื่อผู้รับเงิน</th>
                <th style="min-width: 150px;">ชื่อผู้เบิก</th>
                <th style="min-width: 100px;" class="text-center">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $count_data = $data->num_rows();
            if ($count_data > 0) {
                $i = $segment + 1;
                foreach ($data->result() as $row) {
            ?>
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td><?php echo $row->doc_index_code; ?></td>
                        <td><?php echo $row->doc_index_year; ?></td>
                        <td><?php echo ($row->doc_index_date != '0000-00-00') ? $this->misc->date2thai($row->doc_index_date, '%d %m %y', 1) : ''; ?></td>
                        <td><?php echo $row->doc_index_category . ' / ' . $row->doc_index_type; ?></td>
                        <td><?php echo $row->doc_index_number; ?></td>
                        <td><?php echo $row->doc_index_budget; ?></td>
                        <td><?php echo number_format($row->doc_index_amount, 2); ?></td>
                        <td><?php echo $row->doc_index_name; ?><?php echo $row->doc_index_detail != '' ? ' (' . $row->doc_index_detail . ')' : ''; ?></td>
                        <td><?php echo $row->doc_index_store1 != '' ? $row->doc_index_store1 : ''; ?><?php echo $row->doc_index_store2 != '' ? ' -> ' . $row->doc_index_store2 : ''; ?><?php echo $row->doc_index_store3 != '' ? ' -> ' . $row->doc_index_store3 : ''; ?></td>
                        <td><?php echo $row->doc_index_department; ?></td>
                        <td><?php echo $row->doc_index_payee; ?></td>
                        <td><?php echo $row->doc_index_pathfinder; ?></td>
                        <td class="text-center">
                            <button type="button" class="btn btn-sm btn-info" onclick="modal_edit('<?php echo $row->doc_index_id; ?>');"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-sm btn-danger" onclick="modal_delete('<?php echo $row->doc_index_id; ?>');"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                <?php
                    $i++;
                }
            } else {
                ?>
                <tr>
                    <td class="text-center" colspan="15"><i class="fa fa-info-circle text-danger"></i>&nbsp;<span class="text-danger">ไม่มีข้อมูล</span></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
</div>
<div class="row m-t-20">
    <?php
    if ($count != 0) {
    ?>
        <div class="col-lg-6">
            แสดง <?php echo $segment + 1; ?> ถึง <?php echo $i - 1; ?> ทั้งหมด <?php echo ($count); ?> รายการ
        </div>
        <div class="col-lg-6">
            <?php echo $links; ?>
        </div>
    <?php
    }
    ?>
</div>

<script>
    function reloadPagination() {
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
            url: service_base_url + 'documentindex/ajax_pagination/' + '<?php echo $segment; ?>',
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
                $('#result-pagination').html(response)
            }
        })
    }
</script>