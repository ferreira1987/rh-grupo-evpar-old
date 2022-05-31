<?php

namespace common\widgets\repeater;

use Yii;
use yii\base\Model;
use yii\base\Widget;

class Repeater extends Widget
{
    public $model;

    /**
     * {@inheritdoc}
     */
    public function run()
    {

        return $this->render('layout', ['model' => $this->model]);

    }
}

