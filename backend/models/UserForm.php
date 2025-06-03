<?php

/**
 * Эта модель является частью проекта Inely.
 *
 * @link    https://github.com/marinakliman/Diplom
 * @licence https://github.com/marinakliman/Diplom/LICENSE.md GPL
 * @author  hirootkit <marinakliman9@gmail.com>
 */

namespace backend\models;

use common\models\User;
use Yii;
use yii\base\Model;

class UserForm extends Model
{
    public $email;

    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => '\common\models\User',
             'filter' => function (User $query) {
                 $query->andWhere(['not', ['id' => Yii::$app->user->getId()]]);
             }
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'email' => 'Email'
        ];
    }
}