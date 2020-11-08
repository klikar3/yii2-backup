<?php

namespace klikar3\modules\backup;

class Module extends \yii\base\Module {
	public $controllerNamespace = 'klikar3\modules\backup\controllers';
	public $path;
	public $fileList;
	public function init() {
		parent::init ();
		if (\Yii::$app instanceof \yii\console\Application) {
			$this->controllerNamespace = 'klikar3\modules\backup\commands';
		}
		// custom initialization code goes here
	}
	public function getFileList() {
		return $this->fileList;
	}
}
