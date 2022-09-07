<?php

use faro\core\components\FaroGridView;
use faro\core\components\HtmlComponentsHelper;
use faro\core\widgets\Panel;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SitecontentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('favorites', 'Favoritos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="favorites-index">

    <?php Panel::begin(["header" => false]) ?>

    <?= FaroGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => null,
        'layout' => "{items}{pager}",
        'columns' => [
            [
                'filter' => false,
                'format' => 'raw',
                'label' => "Categoria",
                'value' => function ($data) {
                    if ($data->target) {
                        $categoria = $data->target->getCategoria()->one();
                        if (!$categoria) {
                            return "-";
                        }

                        return HtmlComponentsHelper::imprimirBadgeCategoria(
                            $categoria->nombre,
                            $categoria->slug,
                            $categoria->color
                        );
                    }
                }
            ],
            [
                'filter' => $model_types,
                'format' => 'raw',
                'attribute' => 'model',
                "header" => "Tipo",
                "contentOptions" => ["style" => "max-width: 150px;"],
                'value' => function ($data) {
                    if ($data->model) {
                        $aliases = Yii::$app->getModule('favorites')->modelAliases;

                        return isset($aliases[$data->model])
                            ? Yii::t('app', $aliases[$data->model])
                            : Yii::t('app', $data->model);
                    }
                }
            ],

            [
                'filter' => false,
                'format' => 'raw',
                'attribute' => 'target_id',
                'label' => "Objeto",
                'value' => function ($data) {
                    if ($data->target) {
                        return Html::a($data->target->nombre, $data->url, ['data-pjax' => 0]);
                    }
                }
            ],

            [
                'attribute' => 'fecha_ingreso_sistema',
                'filter' => false,
                'label' => 'Creado',
                'format' => 'relativeTime',
            ],
        ],
    ]); ?>

    <?php Panel::end() ?>
</div>
