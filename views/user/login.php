<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\gii\UserGii */

$this->title = 'Update Profile';
?>
<div class="user-gii-update">
    <h1><?php echo Html::encode($this->title); ?></h1>
    <div class="user-gii-form">
        <?php $form = ActiveForm::begin(); ?>
        <?php echo $form->field($model, 'username')->textInput(['maxlength' => true]); ?>
        <?php echo $form->field($model, 'password')->passwordInput(['maxlength' => true]); ?>
        <div class="form-group">
            <?php echo Html::submitButton('Login', ['class' => 'btn btn-success']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>
