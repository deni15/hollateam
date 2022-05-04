<div class="modal fade text-left" id="modalreset" tabindex="-1" role="dialog" aria-labelledby="modalreset" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="page/user/reset.php" method="get">
        <div class="modal-content">
            <div class="modal-header bg-success white">
                <h4 class="modal-title white" id="modalreset">are you sure you want to reset password this user ?</h4>
            </div>
            <div class="modal-body">
                <p>By reseting this user password will change old password to <code>Holla*123!</code></p>
                <input type="hidden" name="reset" value="" id="uid">
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-outline-success" value="Reset">
            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">
$(document).on("click", ".resetuser", function () {
    var id = $(this).data('id');
    $(".modal-body #uid").val(id);
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    $('#modalreset').modal('show');
});
</script>
