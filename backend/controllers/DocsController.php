<?php

/**
 * Этот контроллер является частью проекта Inely.
 *
 * @link    https://github.com/marinakliman/Diplom
 * @licence https://github.com/marinakliman/Diplom/LICENSE.md GPL
 * @author  hirootkit <marinakliman9@gmail.com>
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;

/**
 * Class DocsController
 * @package backend\controllers
 */
class DocsController extends Controller
{
    public $layout = 'support';

    public function actionIndex()
    {
        return $this->render('index');
    }
}