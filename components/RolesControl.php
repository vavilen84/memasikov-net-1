<?php
namespace app\components;

use app\components\BaseComponentaData;
use Yii;
use yii\base\Component;
use app\models\db as Models;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

class RolesControl extends BaseComponentData
{

    public function isAdminUser()
    {
        $userId = Yii::$app->user->getId();
        $user = Models\User::findIdentity($userId);
        if (!empty($user) && !empty($user->role) && ($user->role == Base::USER_ADMIN_ROLE)) {
            return true;
        }

        return false;
    }

    public function beforeAction($action)
    {
        $user = $this->user;
        $request = Yii::$app->getRequest();
        /* @var $rule AccessRule */
        foreach ($this->rules as $rule) {
            if ($allow = $rule->allows($action, $user, $request)) {
                return true;
            } elseif ($allow === false) {
                if (isset($rule->denyCallback)) {
                    call_user_func($rule->denyCallback, $rule, $action);
                } elseif ($this->denyCallback !== null) {
                    call_user_func($this->denyCallback, $rule, $action);
                } else {
                    $this->denyAccess($user);
                }
                return false;
            }
        }
        if ($this->denyCallback !== null) {
            call_user_func($this->denyCallback, null, $action);
        } else {
            $this->denyAccess($user);
        }
        return false;
    }
}
