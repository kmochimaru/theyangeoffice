<div class="row m-t-30">
    <div class="col-md-11" style="margin-left: auto; margin-right: auto;">
        <div class="myadmin-dd-empty dd" id="sort_routes">
            <ol class="dd-list">
                <?php foreach ($this->routes_model->get_routes_process($routes_id)->result() as $row) { ?>
                    <li class="dd-item dd3-item" data-id="<?php echo $row->routes_process_id; ?>">
                        <div class="dd-handle dd3-handle"></div>
                        <?php $dep_off = $this->routes_model->get_dep_off($row->dep_off_id)->row(); ?>
                        <div class="dd3-content"><?php echo $dep_off->dep_name . ' : ' . $dep_off->officer_name; ?></div>
                    </li>
                <?php } ?>
            </ol>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ready(function () {
        var updateOutput = function (e) {
            var list = e.length ? e : $(e.target), output = list.data('output');
            $.ajax({
                url: service_base_url + 'routes/editsort',
                method: 'POST',
                data: {
                    list: list.nestable('serialize')
                },
                success: function (response) {
                    notification('success', 'สำเร็จ', 'จัดเรียงเส้นทางสำเร็จ');
                }
            });

        };
        $('#sort_routes').nestable({
            group: 1,
            maxDepth: 1
        }).on('change', updateOutput);
    });

</script>