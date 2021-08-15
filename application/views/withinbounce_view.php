<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="<?php echo $icon; ?>"></i> <?php echo " " . $title; ?>
                </h4>
                <div class="row m-t-20">
                    <div class="col-sm-2 m-b-10">
                        <label class="control-label" style="font-weight: bold;">ปีสารบรรณ</label>
                        <select id="year_id" class="form-control form-control-sm" onchange="ajax_pagination();">
                            <option value="">ปีทั้งหมด</option>
                            <?php
                            $years = $this->accesscontrol->get_year();
                            if ($years->num_rows() > 0) {
                                foreach ($years->result() as $year) {
                                    ?>
                                    <option value="<?php echo $year->year_id; ?>" <?php echo ($year->year_id == $this->session->userdata('year_id') ? 'selected="selected"' : ''); ?>><?php echo $year->year; ?></option>
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
                <div id="result-pagination" class="m-t-20"></div>
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

    $(function () {
        ajax_pagination();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_pagination();
        }
    });

    function ajax_pagination() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'withinbounce/ajax_pagination',
            type: 'POST',
            data: {
                year_id: $('#year_id').val(),
                searchtext: $('#searchtext').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }
</script>

