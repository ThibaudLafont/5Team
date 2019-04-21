<div class="card-columns">

    <?php foreach ($tickets as $ticket) {?>

        <!-- Ticket -->
        <div class="card">
            <!-- Ticket Date -->
            <div class="card-header" id="ticket-date"><?=$ticket->getFormattedDate()?></div>
            <ul class="list-group list-group-flush">
                <!-- Ticket Title -->
                <li class="list-group-item" id="ticket-title"><?=$ticket->getTitle()?></li>
                <!-- Ticket Spent -->
                <li class="list-group-item" id="ticket-spent"><?=$ticket->getSpent()?>$</li>
                <!-- Action buttons -->
                <li class="list-group-item">
                    <buttton class="btn btn-warning" onclick="edit(<?=$ticket->getId()?>)">Edit</buttton>
                    <buttton class="btn btn-danger" onclick="remove(<?=$ticket->getId()?>)">Delete</buttton>
                </li>
            </ul>
        </div>

    <?php } ?>

</div>
