<?php
namespace app\components;

use Yii;
use yii\base\Component;
use app\components\Base;

class Console extends Component
{
    private $tempDir = "/tmp/memasikov.net-backup-files/";

    public function __construct()
    {
        $this->removeTempDir();
        $this->createTempDir();
    }

    protected function removeTempDir()
    {
        if (is_dir($this->tempDir)) {
            system('rm -Rf /tmp/memasikov.net-backup-files/');
        }
    }

    protected function createTempDir()
    {
        mkdir($this->tempDir, 0775, true);
        system('chown -R www-data:www-data ' . $this->tempDir);
    }

    public function getFilename()
    {
        return date('d-m-Y_G:i');
    }

    public function createDbDump($fullBackup = null)
    {
        $filename = $this->getFilename() . '.sql';
        $command = sprintf(
            'mysqldump -h localhost -u %s -p%s %s > %s',
            Yii::$app->params['db_user'],
            Yii::$app->params['db_password'],
            Yii::$app->params['db_name'],
            $this->tempDir . $filename
        );
        exec($command);
        $this->uploadToDropbox($filename, $fullBackup);
    }

    public function archiveImages($fullBackup = null, $folder)
    {
        $date = new \DateTime();
        $date->add(\DateInterval::createFromDateString('yesterday'));
        $filename = $this->getFilename() . '.tar.gz';
        $uploadFolder =
            Base::BASE_FOLDER
            . Base::WEB_FOLDER
            . $folder;
        if (empty($fullBackup)) {
            $uploadFolder .= '/' . $date->format('Y') . '/' . $date->format('n') . '/' . $date->format('j');
        }
        $command = "tar -cvzf " . $this->tempDir . $filename . " " . $uploadFolder;
        exec($command);
        $this->uploadToDropbox($filename, $fullBackup);
    }

    public function uploadToDropbox($filename, $fullBackup)
    {
        $date = new \DateTime();
        $date->add(\DateInterval::createFromDateString('yesterday'));
        $path = ($fullBackup === true) ? '/full-backup' : '';
        $path .= '/' . $date->format('Y') . '/' . $date->format('n') . '/' . $date->format('j') . '/' . $filename;
        $api_url = 'https://content.dropboxapi.com/2/files/upload';
        $headers = array('Authorization: Bearer ' . Yii::$app->params['access_token'],
            'Content-Type: application/octet-stream',
            'Dropbox-API-Arg: ' .
            json_encode(
                [
                    "path" => $path,
                    "mode" => "add",
                    "autorename" => true,
                    "mute" => false
                ]
            )
        );
        $ch = curl_init($api_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POST, true);
        $fp = fopen($this->tempDir . $filename, 'rw');
        $filesize = filesize($this->tempDir . $filename);
        curl_setopt($ch, CURLOPT_POSTFIELDS, fread($fp, $filesize));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch, CURLOPT_VERBOSE, 1); // debug
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        echo($response . '<br/>');
        echo($http_code . '<br/>');
        curl_close($ch);
    }

    public function getLastmod()
    {
        $date = new \DateTime();
        $date->add(\DateInterval::createFromDateString('yesterday'));

        return $date->format('Y') . '-' . $date->format('m') . '-' . $date->format('d');
    }

    public function createSitemapXmlFile($data)
    {
        $filename = Base::BASE_FOLDER . Base::WEB_FOLDER . '/sitemap.xml';
        system('rm ' . $filename);
        $text = '<?xml version="1.0" encoding="UTF-8"?>';
        $text .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($data as $v) {
            $text .= '<url>';
            $text .= '<loc>' . $v['loc'] . '</loc>';
            if (!empty($v['lastmod'])) {
                $text .= '<lastmod>' . $v['lastmod'] . '</lastmod>';
            }
            if (!empty($v['changefreq'])) {
                $text .= '<changefreq>' . $v['changefreq'] . '</changefreq>';
            }
            $text .= '<priority>' . $v['priority'] . '</priority>';
            $text .= '</url>';
        }
        $text .= '</urlset>';
        file_put_contents($filename, $text);
    }
}