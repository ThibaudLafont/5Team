<form>
    <?= $form->buildView() ?>
    <button type="Submit">
        <?php if(is_null($form->getEntity()->getId())){echo 'Add';}
              else{echo 'Edit';}
        ?>
    </button>
</form>