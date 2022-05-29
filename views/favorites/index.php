<?php

use faro\core\components\FaroGridView;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SitecontentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('favorites', 'Favoritos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorites-index">


    <?= FaroGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'columns' => [
            [
                'filter' => false,
                'format' => 'html',
                'attribute' => 'icon',
                'header' => '&nbsp;',
                'value' => function ($data) {
                    if ($data->icon) {
                        return $data->icon;
                    }
                }
            ],
            [
                'filter' => false,
                'format' => 'raw',
                'attribute' => 'target_id',
                'value' => function ($data) {
                    if ($data->target) {
                        return Html::a($data->target->nombre, $data->url, ['data-pjax' => 0]);
                    }
                }
            ],
            [
                'filter' => $model_types,
                'format' => 'raw',
                'attribute' => 'model',
                "header" => "Tipo",
                'value' => function ($data) {
                    if ($data->model) {
                        $aliases = Yii::$app->getModule('favorites')->modelAliases;

                        return isset($aliases[$data->model]) ? Yii::t('app',
                            $aliases[$data->model]) : $data->model;
                    }
                }
            ],
            [
                'attribute' => 'fecha_ingreso_sistema',
                'filter' => false,
                'format' => 'relativeTime',
            ],
        ],
    ]); ?>
</div>
