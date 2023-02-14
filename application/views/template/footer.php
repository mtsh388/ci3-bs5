<footer class="py-4 bg-light mt-auto">
    <div class="container-fluid px-4">
        <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; Your Website 2022</div>
            <div>
                <a href="#">Privacy Policy</a>
                &middot;
                <a href="#">Terms &amp; Conditions</a>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<script>
    $(document).ready(function() {})

    function logout() {
        waitingDialog.show();

        $.ajax({
            type: "POST",
            url: "<?= base_url() ?>welcome/logout",
            dataType: "json",
            success: function(result) {
                waitingDialog.hide();
                if (result.msg == 'OK') {
                    document.location('<?= base_url() ?>');
                } else {
                    $('#alert-danger').fadeIn().html(result.msg);
                    setTimeout(function() {
                        $('#alert-danger').fadeOut("slow").html(result.msg);
                        location.reload();
                    }, 3000);
                    return false;
                }
            },
            error: function(event, textStatus, errorThrown) {
                $('#alert-danger').fadeIn().html("HTTP: " + errorThrown);
                setTimeout(function() {
                    $('#alert-danger').fadeOut("slow");
                }, 5000);
            }
        })
    }
</script>
</body>

</html>