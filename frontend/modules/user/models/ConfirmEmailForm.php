<?php

/**
 * Эта модель является частью проекта Inely.
 *
 * @link    https://github.com/marinakliman/Diplom
 * @licence https://github.com/marinakliman/Diplom/LICENSE.md GPL
 * @author  hirootkit <marinakliman9@gmail.com>
 */

namespace frontend\modules\user\models;

use common\models\User;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

/**
 * Модель сброса пароля
 */
class ConfirmEmailForm extends Model
{
    /**
     * @var User объект класса
     */
    private $_user;

    /**
     * Конструктор создания модели по данному токену.
     *
     * @param  string $token  уникальный токен.
     * @param  array  $config пары имен-значений, которые будут использоваться для инициализации свойств объектов.
     *
     * @throws \yii\base\InvalidParamException если токен пустой, либо неверный.
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidParamException(Yii::t('frontend', 'No confirmation code'));
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user) {
            throw new InvalidParamException(Yii::t('frontend', 'Invalid token. Maybe you have already confirmed your account?'));
        }
        parent::__construct($config);
    }

    /**
     * Сброс токена, который предназначен для подтверждения email.
     *
     * @return boolean если токен был сброшен.
     */
    public function confirmEmail()
    {
        $user = $this->_user;
        $user->removeEmailConfirmToken();

        return $user->save();
    }
}