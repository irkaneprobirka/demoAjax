<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
use yii\web\JqueryAsset;

$this->title = 'Регистрация';
/** @var yii\web\View $this */
/** @var app\models\User $model */
/** @var ActiveForm $form */
?>
<div class="site-register">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin(
        [
            'id' => 'register-form',
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
        ]
    ); ?>

    <?= $form->field($model, 'full_name') ?>
    <?= $form->field($model, 'login') ?>
    <?= $form->field($model, 'email') ?>
    <?= $form->field($model, 'phone') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'password_repeat')->passwordInput() ?>
    <?= $form->field($model, 'rules')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- site-register -->

<?= $this->registerJsFile('@web/js/qwe.js', ['depends' => [JqueryAsset::class]]) ?>