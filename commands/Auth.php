<?php

namespace app\commands;

use Yii;
use yii\base\Action;
use yii\base\ActionFilter;
use yii\di\Instance;
use yii\web\User;
use yii\web\ForbiddenHttpException;


class Auth extends ActionFilter
{
    public $user = 'user';
    public $not_rule_actions = [];
    public function init()
    {
        parent::init();
        $this->user = Instance::ensure($this->user, User::className());
    }


    public function beforeAction($action)
    {
        if (in_array($action->id, $this->not_rule_actions)) {
            return true;
        }else
            if ($this->user->identity->role == 'admin') {
                 return true;
            } else {
                throw new ForbiddenHttpException(Yii::t('yii', 'You are not allowed to perform this action.'));
            }
    }
}
