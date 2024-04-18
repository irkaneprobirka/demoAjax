<?php

use app\models\Category;
use app\models\Status;
use app\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Application $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Applications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="application-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <? Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id',
                'value' => Html::encode($model->id)
            ],
            [
                'attribute' => 'user_id',
                'value' => User::findOne($model->user_id)->login
            ],
            [
                'attribute' => 'status_id',
                'value' => Html::encode(Status::getStatus()[$model->status_id])
            ],
            [
                'attribute' => 'category_id',
                'value' => Html::encode(Category::getCategory()[$model->category_id])
            ],
            [
                'attribute' => 'title',
                'value' => Html::encode($model->title)
            ],
            [
                'attribute' => 'description',
                'value' => Html::encode($model->description)
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => Html::img('@web/img/' . Html::encode($model->image), ['class' => 'card-img-top h-25 w-25']) 
            ],
            [
                'attribute' => 'image_admin',
                'format' => 'raw',
                'value' => Html::img('@web/img/' . Html::encode($model->image_admin), ['class' => 'card-img-top h-25 w-25',]),
                'visible' => (bool)$model->image_admin
            ],
            [
                'attribute' => 'reason',
                'value' => Html::encode($model->reason),
                'visible' => (bool)$model->reason
            ],
            [
                'attribute' => 'created_at',
                'value' => Html::encode(Yii::$app->formatter->asDate($model->created_at, 'php:Y-m-d H:i:s')),
            ],
            [
                'attribute' => 'time_delivery',
                'value' => Html::encode(Yii::$app->formatter->asDate($model->time_delivery, 'php:Y-m-d H:i:s')),
            ],
        ],
    ]) ?>

</div>
