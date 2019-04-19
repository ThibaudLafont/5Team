<div class="card-columns">

    <?php foreach ($tickets as $ticket) {?>

        <div class="card">
            <div class="card-header">
                <?=$ticket->getFormattedDate()?>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <?=$ticket->getTitle()?>
                </li>
                <li class="list-group-item">
                    <?=$ticket->getSpent()?> $
                </li>
                <li class="list-group-item">
                    <buttton class="btn btn-warning">Edit</buttton>
                    <buttton class="btn btn-danger">Delete</buttton>
                </li>
            </ul>
        </div>

    <?php } ?>

</div>
