<div class="text-center mt-4 mb-4">
    <h3 class="text-center mt-2">
        ผลการตรวจสอบ
    </h3>
    <i class="fa fa-check-circle-o fa-4x text-success mb-2"></i>
    <h4 class="mb-3">ข้อมูลลายเซ็นต์</h4>
    <p>เลขที่เอกสาร : <?php echo $row->signature_work_no; ?></p>
    <p>เรื่อง : <?php echo ($row->work_info_subject != '' ? $row->work_info_subject : '-'); ?></p>
    <p>ผู้ลงนาม : <?php echo $row->signature_name; ?></p>
    <p>ตำแหน่ง : <?php echo ($row->work_user_id != NULL ? 'ผู้ปฎิบัติงาน' : $user->officer_name); ?></p>
    <p>Signature Code : <?php echo $row->signature_key; ?></p>
    <p>วันเวลา : <?php echo $this->misc->date2thai($row->signature_date, '%d %m %y %h:%i:%s'); ?></p>
</div>  
