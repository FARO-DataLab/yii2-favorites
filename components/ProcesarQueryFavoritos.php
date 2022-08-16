<?php 

namespace faro\core\favorites\components;

use faro\media\models\Campana;
use Yii;
use yii\base\Component;
use yii\db\ActiveQuery;
use yii\db\Expression;

/**
 * Clase encargada de recibir un objeto query y agregarle lo necesario para que se relacione con
 * la estructura de favoritos 
 */
class ProcesarQueryFavoritos extends Component
{

    /**
     * @param ActiveQuery $query
     * @param string $clase
     * @param string $campoRelacion
     * @return ActiveQuery
     */
    public static function agregarFavoritosAQuery(ActiveQuery $query, string $clase, string $campoRelacion)
    {
        $orden = $query->orderBy ?? [];
        $nuevoOrden = ["favorito" => SORT_DESC];
        $orden = array_merge($nuevoOrden, $orden);
        
        $query = $query
            ->addSelect(new Expression("IF(f.id IS NOT NULL, 1, 0) as favorito"))
            ->leftJoin("{{%core_favorito}} f",
                "f.target_id = {$campoRelacion} AND f.model = :modeloFavorito AND f.created_by = :usuario",
                [":modeloFavorito" => $clase, ":usuario" => Yii::$app->getUser()->id])
            ->addGroupBy("favorito")
            ->orderBy($orden);
        
        return $query;
    }
}