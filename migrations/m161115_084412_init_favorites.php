<?php

use faro\core\components\FaroBaseMigration;
use yii\db\Migration;
use yii\db\Schema;

/**
 * @author Herbert Maschke <thyseus@gmail.com>
 */
class m161115_084412_init_favorites extends FaroBaseMigration
{
    public function up()
    {
        $tableOptions = '';

        if (Yii::$app->db->driverName == 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        $this->crearTabla('{{%core_favorito}}', [
            'id'                   => Schema::TYPE_PK,
            'model'                => Schema::TYPE_TEXT,
            'target_id'            => Schema::TYPE_TEXT, // can be a slug, not only an numeric id
            'target_attribute'     => Schema::TYPE_TEXT,
            'route'                => Schema::TYPE_TEXT,
            'url'                  => Schema::TYPE_TEXT,
            'icon'                 => Schema::TYPE_STRING,
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('{{%core_favorito}}');
    }
}
