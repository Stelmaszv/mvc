mam kotak
<?php echo $arguments['text'] ?>


<?php if ($arguments['text'] =='kot'): ?>
    to jest kot
<?php endif; ?>



<?php foreach($arguments['loopTest'] as $el): ?>
    <?php echo $el['name'] ?>;
<?php endforeach; ?>