<div class="table-responsive" style="height: 60vh;">
    <table class="table">
        <thead>
            <tr>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">สถานะ</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">#</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_year</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_category</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_type</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_date</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_number</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_budget</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_amount</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_name</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_detail</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_store1</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_store2</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_store3</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_department</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_payee</th>
                <th style="font-weight: bold; font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">doc_index_pathfinder</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            $check0 = 0;
            $check1 = 0;
            if (count($data) > 0) {
                foreach ($data as $row) {
            ?>
                    <tr>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;">
                            <?php if ($row['check'] == 0) {  ?>
                                <i class="fa fa-warning text-warning"></i>
                            <?php $check0++;
                            } else { ?>
                                 <i class="fa fa-check text-success"></i>
                            <?php $check1++;
                            } ?>
                        </td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $i; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_year']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_category']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_type']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_date']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_number']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_budget']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_amount']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_name']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_detail']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_store1']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_store2']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_store3']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_department']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_payee']; ?></td>
                        <td style="font-size: 10px; border: 1px solid whitesmoke; padding: 1px;"><?php echo $row['doc_index_pathfinder']; ?></td>
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
<br>
<p><i class="fa fa-check text-success"></i> ข้อมูลมีโอกาสถูกต้อง <?php echo $check1; ?> แถว</p>
<p><i class="fa fa-warning text-warning"></i> ข้อมูลมีโอกาสผิดพลาด  <?php echo $check0; ?> แถว</p>