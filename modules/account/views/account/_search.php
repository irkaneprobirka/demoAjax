<?php

use app\models\Category;
use app\models\Status;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\account\models\AccountSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="application-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>


    <?= $form->field($model, 'status_id')->dropDownList(Status::getStatus()) ?>

    <?= $form->field($model, 'category_id')->dropDownList(Category::getCategory()) ?>

    <div class="form-group">
        <?= Html::submitButton('Фильтрация', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Очистить',['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
