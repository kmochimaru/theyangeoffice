<div id="popup_modal"></div>
</div>
<footer class="footer">
    <?php echo $this->config->item('app_footer'); ?>
</footer>        
</div>    
</div>
<input type="hidden" id="alert_message" value="<?php echo $this->session->flashdata('flash_message') != '' ? $this->session->flashdata('flash_message') : ''; ?>">
<script>
    $(function () {
        var alert_message = $('#alert_message').val();
        if (alert_message != '') {
            var foo = alert_message.split(',');
            notification(foo[0], foo[1], foo[2]);
        }
    });

    function notification(type, head, message) {
        $.toast({
            heading: head,
            text: message,
            position: 'top-right',
            loaderBg: '#D8DBDD',
            icon: type,
            hideAfter: 3000,
            stack: 3
        });
    }

    function changeuser_dep_off(user_dep_off_id, dep_off_id, dep_id_pri) {
        var url = service_base_url + 'login/active';
        $.post(url, {user_dep_off_id: user_dep_off_id, dep_off_id: dep_off_id, dep_id_pri: dep_id_pri}, function (response) {
            location.href = service_base_url;
        });
    }
    function logout() {
        $.ajax({
            url: service_base_url + 'login/logout_modal',
            type: 'POST',
            data: {},
            success: function (response) {
                $('#popup_modal').html(response);
                $('#logout_modal').modal('show', {backdrop: 'true'});
            }
        });
    }
</script>  
</body>
</html>