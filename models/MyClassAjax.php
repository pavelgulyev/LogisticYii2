<?php
use yii\db\ActiveRecord;
class MyClassAjax extends ActiveRecord
{
  public static function tableName()
  {
    return '{{%comment}}';
  }
 
  public static function getComments()
  {
    return self::find()->all();
  }
}