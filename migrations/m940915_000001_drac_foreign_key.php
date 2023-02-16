<?php

use yii\db\Migration;

class m940915_000001_drac_foreign_key extends Migration
{
    public function up()
    {
        $initialAuth = Yii::$app->params['initial_auth'];

        $this->addForeignKey($initialAuth['assignment'].'_'.$initialAuth['item'].'_drac_1', $initialAuth['assignment'], 'item_name', $initialAuth['item'], 'name', 'CASCADE', 'CASCADE');
        
        $this->addForeignKey($initialAuth['item'].'_'.$initialAuth['rule'].'_drac_1', $initialAuth['item'], 'rule_name', $initialAuth['rule'], 'name', 'SET NULL', 'CASCADE');

        $this->addForeignKey($initialAuth['item_child'].'_child_drac_1', $initialAuth['item_child'], 'child', $initialAuth['item'], 'name', 'CASCADE', 'CASCADE');

        $this->addForeignKey($initialAuth['item_child'].'_parent_drac_1', $initialAuth['item_child'], 'parent', $initialAuth['item'], 'name', 'CASCADE', 'CASCADE');
    }
}