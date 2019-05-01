<?php
namespace app\commands;

use Yii;
use yii\console\Controller;

class DropboxController extends Controller
{
    public function actionCreateDailyBackup()
    {
        Yii::$app->console->createDbDump();
        Yii::$app->console->archiveImages(null, Base::IMAGE_UPLOAD_FOLDER);
        Yii::$app->console->archiveImages(null, Base::AUTHOR_IMAGE_UPLOAD_FOLDER);
    }

    public function actionCreateFullBackup()
    {
        Yii::$app->console->createDbDump(true);
        Yii::$app->console->archiveImages(true, Base::IMAGE_UPLOAD_FOLDER);
        Yii::$app->console->archiveImages(true, Base::AUTHOR_IMAGE_UPLOAD_FOLDER);
    }
}
