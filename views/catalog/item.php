<?php

use app\models\Category;
use app\models\Status;
use yii\bootstrap5\Html;

?>

<div class="card m-3" style="width: 18rem;">
  <?= Html::img('@web/img/' . Html::encode($model->image), ['class' => 'card-img-top']) ?>
  <div class="card-body">
    <h5 class="card-title">Название:<?= Html::encode($model->title) ?></h5>
    <p class="card-text">Описание:<?= Html::encode($model->description) ?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Категория:<?= Html::encode(Category::getCategory()[$model->category_id]) ?></li>
    <li class="list-group-item">Статус:<?= Html::encode(Status::getStatus()[$model->status_id]) ?></li>
    <li class="list-group-item">Дата создания:<?= Html::encode(Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d H:i:s')) ?></li>
    <li class="list-group-item">Дата доставки:<?= Html::encode(Yii::$app->formatter->asDate($model->time_delivery, 'php:Y-m-d H:i:s')) ?></li>
  </ul>
  <div class="card-body">
  <?= Html::a('Просмотр', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
  </div>
</div>