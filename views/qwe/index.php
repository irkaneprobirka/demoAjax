<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Review $model */
/** @var ActiveForm $form */
?>
<div class="otz-index" style="background-image: url('/imgReview/1_1713462498.jpeg');">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'full_name') ?>
        <?= $form->field($model, 'phone') ?>
        <?= $form->field($model, 'text')->textarea() ?>
    
        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div><!-- otz-index -->
