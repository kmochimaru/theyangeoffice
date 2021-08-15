<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">
                    <i class="fa fa-search-plus"></i> ค้นหาผู้ใช้งานระบบจาก HR
                    <span style="float: right">
                        <a class="btn btn-sm btn-rounded btn-secondary" href="<?php echo base_url() . 'user'; ?>"><i class="fa fa-arrow-left"></i> กลับ</a>                     
                    </span>
                </h4>
                <div class="row m-t-20">
                    <div class="col-lg-3 col-md-3">
                        <label>เขตพื้นที่ : </label>
                        <select id="campus_id" class="form-control form-control-sm" onchange="set_faculty()">
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label>คณะ : </label>
                        <select id="faculty_id" class="form-control form-control-sm" onchange="set_department()">
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label>สาขา : </label>
                        <select id="department_id" class="form-control form-control-sm" onchange="set_major()">
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label>สาขาวิชา : </label>
                        <select id="major_id" class="form-control form-control-sm" onchange="ajax_search()">
                        </select>
                    </div>
                </div>
                <div class="row m-t-10">
                    <div class="col-lg-3 col-md-3">
                        <label>ประเภทบุคลากร : </label>
                        <select id="staff_type_id" class="form-control form-control-sm" onchange="ajax_search()">
                            <option value="0">-- เลือกประเภทบุคลากร --</option>
                            <?php foreach ($this->user_model->ref_staff_type()->result() as $row) { ?>
                                <option value="<?php echo $row->staff_type_id; ?>"><?php echo $row->staff_type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label>สายงาน : </label>
                        <select id="sub_staff_type_id" class="form-control form-control-sm" onchange="ajax_search()">
                            <option value="0">-- เลือกสายงาน --</option>
                            <?php foreach ($this->user_model->ref_sub_staff_type(array(1, 2))->result() as $row) { ?>
                                <option value="<?php echo $row->sub_staff_type_id; ?>"><?php echo $row->sub_staff_type_name; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-3">
                        <label>ค้นหา : </label>
                        <div class="input-group">
                            <input type="text" id="searchtext" class="form-control form-control-sm" placeholder="คำค้นหา">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-sm btn-info" onclick="ajax_search()">ค้นหา</button>
                                <button type="button" onclick="reset_filter()" class="btn btn-default btn-sm">รีเซ็ต</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2">
                        <label>จำนวนต่อหน้า : </label>
                        <select id="per_page" class="form-control form-control-sm" onchange="ajax_search()">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="9999">ทั้งหมด</option>
                        </select>
                    </div>
                </div>
                <div id="result-pagination" class="m-t-20" style="min-height: 400px;"></div>
            </div>
        </div>
    </div>
</div>

<script>

    var service_base_url = $('#service_base_url').val();

    $(function () {
        set_campus();
    });

    $('#searchtext').keypress(function (e) {
        if (e.which == 13) {
            ajax_search();
        }
    });

    function set_campus() {
        $.getJSON('<?php echo base_url('user/getjsoncampus/1'); ?>', function (data) {
            set_element('campus_id', data, 1);
        });
    }

    function set_faculty() {
        $.getJSON('<?php echo base_url('user/getjsonfaculty/1'); ?>', function (data) {
            set_element('faculty_id', data, 1);
        });
    }

    function set_department() {
        $.getJSON('<?php echo base_url('user/getjsondepartment'); ?>/' + $('#faculty_id').val() + '/1', function (data) {
            set_element('department_id', data, 1);
        });
    }

    function set_major() {
        $.getJSON('<?php echo base_url('user/getjsonmajor'); ?>/' + $('#department_id').val() + '/1', function (data) {
            set_element('major_id', data, 1);
        });
    }

    function set_element(get_element_id, data, onchange) {
        var get_element = document.getElementById(get_element_id);
        while (get_element.length > 0) {
            get_element.remove(0);
        }
        for (var i = 0; i < data.length; i++) {
            var item = data[i];
            var option = document.createElement('option');
            option.innerHTML = item.text;
            option.value = item.value;
            get_element.appendChild(option);
        }
        if (onchange === 1) {
            get_element.onchange();
        }
    }

    function reset_filter() {
        set_campus();
        $('#searchtext').val('');
        ajax_pagination();
    }

    function ajax_search() {
        $('#result-pagination').html('<div style="text-align:center; padding:80px;"><i class="fa fa-refresh fa-spin fa-3x fa-fw"></i></div>');
        $.ajax({
            url: service_base_url + 'user/search_data',
            type: 'POST',
            data: {
                campus_id: $('#campus_id').val(),
                faculty_id: $('#faculty_id').val(),
                department_id: $('#department_id').val(),
                major_id: $('#major_id').val(),
                staff_type_id: $('#staff_type_id').val(),
                sub_staff_type_id: $('#sub_staff_type_id').val(),
                searchtext: $('#searchtext').val(),
                per_page: $('#per_page').val()
            },
            success: function (response) {
                $('#result-pagination').html(response);
            }
        });
    }

</script>