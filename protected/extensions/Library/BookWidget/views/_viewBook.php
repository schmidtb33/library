<?php
/* @var $data userHasBook */
?>
<tr>
    <td><button class="removeBook" id="<?php echo $data->id; ?>">-</button></td>
    <td>
        <?php echo CHtml::encode($data->book->title); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->book->author); ?>
    </td>
</tr>