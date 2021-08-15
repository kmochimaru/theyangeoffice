<form id="form-modal" method="post" onsubmit="return false;" autocomplete="off">
    <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-search-plus"></i> ค้นหาผู้รับ</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    </div>
    <div class="modal-body">
        <div class="row form-group">
            <div class="col-lg-12">
                <label class="control-label">ค้นหาผู้รับ (พัสดุส่งถึง)</label>
                <select name="parcel_to" id="parcel_to" class="select2 form-control custom-select" style="width: 100%;" data-placeholder="ค้นหาจากชื่อ นามสกุล และเบอร์โทร" required="">

                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-info" onclick="addto();"><i class="fa fa-save"></i> ตกลง</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> ยกเลิก</button>
    </div>
</form>
<script>
    $(function () {
        $("#parcel_to").select2({
            dropdownParent: $('#form-modal'),
            ajax: {
                url: service_base_url + 'postparcellist/ajax_to/' + $("#parcel_group_id").val(),
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (data, params) {
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };

                },
                cache: true,
            },
            escapeMarkup: function (markup) {
                return markup;
            },
            minimumInputLength: 3,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    });

    function formatRepo(repo) {
        if (repo.loading)
            return repo.text;
        var markup = "<div class='select2-result-repository clearfix'>" +
                "<div class='select2-result-repository__meta'>" +
                "<div class='select2-result-repository__title'>" + repo.value + "</div></div></div>";
        return markup;
    }

    function formatRepoSelection(repo) {
        return repo.value || repo.text;
    }
</script>
