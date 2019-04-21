<div class="modal-dialog" role="document">
    <div class="modal-content">

        <!-- Modal header -->
        <div class="modal-header">
            <!-- Modal title -->
            <h5 class="modal-title" id="exampleModalLabel">
                <?php if(is_null($form->getEntity()->getId())){echo 'New Ticket';}
                else{echo 'Edit Ticket';}
                ?>
            </h5>
            <!-- Close Button -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="hideModal()">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <!-- Form -->
            <form>
                <?= $form->buildView() ?>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <!-- Close button -->
            <button type="button" class="btn btn-secondary custom-close" data-dismiss="modal" onclick="hideModal()">
                Close
            </button>
            <!-- Submit button -->
            <button type="button" class="btn btn-primary" onclick="addSubmit()">
                <?php
                    if(is_null($form->getEntity()->getId())){echo 'Add';}
                    else{echo 'Edit';}
                ?>
            </button>
        </div>
    </div>
</div>