
<div class="modal fade text-left" id="delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel10" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="page/task/delete.php" method="get">
        <div class="modal-content">
            <div class="modal-header bg-danger white">
                <h4 class="modal-title white" id="myModalLabel10">are you sure you want to delete this Task ?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>by deleting this task, tasks and remarks will be deleted.</p>
                <input type="hidden" name="delete" value="" id="id">
            <div class="modal-footer">
                <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-outline-danger" value="Delete">
            </div>
        </div>
        </form>
    </div>
</div>



<script type="text/javascript">
$(document).on("click", ".delete", function () {
    var id = $(this).data('id');
    $(".modal-body #id").val(id);
    // As pointed out in comments, 
    // it is unnecessary to have to manually call the modal.
    $('#delete').modal('show');
});
</script>