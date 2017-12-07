<?php
namespace frontend\models;

use yii;
use yii\db\ActiveRecord;

class Student extends ActiveRecord{
  public function rules()
  {
      return [
          [['username','sex','age','hobby','email','tel','file','card','name'],'required','message'=>'{attribute}不能为空！'],

      ];
  }

    public function attributeLabels()
    {
        return [
          'username'=>'用户名',
          'sex'=>'性别',
          'age'=>'年龄',
          'hobby'=>'爱好',
          'email'=>'邮箱',
          'tel'=>'电话',
          'file'=>'文件',
          'card'=>'身份证',
          'name'=>'真名',
        ];
    }
}

?>