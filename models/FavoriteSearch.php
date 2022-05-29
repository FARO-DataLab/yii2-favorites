<?php

namespace faro\core\favorites\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use faro\core\favorites\models\Favorite;

/**
 * FavoriteSearch represents the model behind the search form about `app\models\Favorite`.
 */
class FavoriteSearch extends Favorite
{
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Favorite::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['fecha_ingreso_sistema' => SORT_DESC]]
        ]);

        $this->load($params);

        $query->andFilterWhere([
            'created_by' => Yii::$app->user->id,
            'fecha_ingreso_sistema' => $this->fecha_ingreso_sistema,
            'fecha_actualizacion_sistema' => $this->fecha_actualizacion_sistema,
            'model' => $this->model,
        ]);

        $query->andFilterWhere(['like', 'url', $this->url]);

        return $dataProvider;
    }
}
