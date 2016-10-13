<?php
/* @var $data user */
?>
<tr>
    <td style="display: none">
        <?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->firstname); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->lastname); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->zip); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->city); ?>
    </td>
    <td>
        <?php echo CHtml::encode($data->getNumberOfBooks()); ?>
    </td>
    <td>
        <table>
            <?php
            foreach ($data->userHasBooks as $userHasBooks)
            {
                $this->render('_viewBook', array('data'=>$userHasBooks));
            }
            ?>
        </table>
    </td>
    <td><button class="addBook" id="<?php echo $data->id; ?>">+</button></td>
</tr>