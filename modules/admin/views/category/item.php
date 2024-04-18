<?php

use app\models\Category;
use app\models\Status;
use yii\bootstrap5\Html;

?>

<div class="card m-3" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title">Название:<?= Html::encode($model->title) ?></h5>
    <p class="card-text">Номер:<?= Html::encode($model->id) ?></p>
  </div>
  <div class="card-body">
    <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
  </div>
</div>