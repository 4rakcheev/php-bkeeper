<?php
$this->sidebar=array(
    array('label'=>'Назад', 'icon'=>'backward', 'url'=>array('index')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
