<?php

/**
 * Эта модель является частью проекта Inely.
 *
 * @link    https://github.com/marinakliman/Diplom
 * @licence https://github.com/marinakliman/Diplom/LICENSE.md GPL
 * @author  hirootkit <marinakliman9@gmail.com>
 */

namespace backend\models;

use Yii;
use yii\db\ActiveRecord;
use backend\models\query\TaskQuery;
use common\components\nested\NestedSetBehavior;

/**
 * Класс модели для таблицы "tasks_data"
 *
 * @property int        $dataId
 * @property int        $lft
 * @property int        $rgt
 * @property int        $lvl
 * @property int        $pid
 * @property string     $name
 *
 */
class TaskData extends ActiveRecord
{
    public function behaviors()
    {
        return [
            'tree' => [
                'class'          => NestedSetBehavior::className(),
                'treeAttribute'  => 'pid',
                'leftAttribute'  => 'lft',
                'rightAttribute' => 'rgt',
                'depthAttribute' => 'lvl',
            ]
        ];
    }

    public static function tableName()
    {
        return 'task_data';
    }

    public function transactions()
    {
        return [self::SCENARIO_DEFAULT => self::OP_ALL];
    }

    public static function find()
    {
        return new TaskQuery(get_called_class());
    }

    public function rules()
    {
        return [
            [['lft', 'rgt', 'lvl', 'pid'], 'integer'],
            [['name', 'note'], 'string']
        ];
    }

    /**
     * Отношение с таблицей "tasks"
     * @return ActiveQuery
     */
    public function getTasks()
    {
        return $this->hasOne(Task::className(), ['taskId' => 'dataId']);
    }

    /**
     * Запись данных в модель. Метод перегружен от базового класса Model.
     *
     * @param array  $data     массив данных.
     * @param string $formName имя формы, использующееся для записи данных в модель.
     *
     * @return boolean если `$data` содержит некие данные, которые связываются с атрибутами модели.
     */
    public function load($data, $formName = '')
    {
        $scope = $formName === null ? $this->formName() : $formName;
        if ($scope === '' && !empty($data)) {
            $this->setAttributes($data);

            return true;
        } elseif (isset($data[$scope])) {
            $this->setAttributes($data[$scope]);

            return true;
        } else {
            return false;
        }
    }
}