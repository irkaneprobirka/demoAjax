<?php

namespace app\controllers;

use Yii;

class QweController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $model = new \app\models\Review();
    
        if ($model->load(Yii::$app->request->post())) {
            //тут в жопу валид, надо загрузку имг с сейвом (фолс)
            if ($model->validate()) {
                // form inputs are valid, do something here
                return;
            }
        }
    
        return $this->render('index', [
            'model' => $model,
        ]);
    }

}
