<?php
use yii\bootstrap4\Html;
//use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

echo GridView::widget ( [ 
		'id' => 'install-grid',
		'dataProvider' => $dataProvider,
		'columns' => array (
				'name',
				'size:shortSize',
				'create_time:datetime',
				array (
						'header' => 'Delete DB',
						'class' => 'yii\grid\ActionColumn',
						'template' => '{restore} {delete} {download}',
						'buttons' => [ 
								'delete' => function ($url, $model) {
									return Html::a ( '<span class="fas fa-trash glyphicon glyphicon-remove"></span>', $url, [ 
											'title' => Yii::t ( 'app', 'Delete this backup' ) ,'data-method'=>'post',
                                            'data-confirm' => Yii::t ( 'app', 'Really delete this backup?' ),
				                            'data-pjax' => '0',
									] );
								},
								
								'restore' => function ($url, $model) {
									return Html::a ( '<span class="fas fa-upload glyphicon glyphicon-save"></span>', $url, [ 
											'title' => Yii::t ( 'app', 'Restore this backup' ) ,'data-method'=>'post'
									] );
								},
				        'download' => function ($url, $model) {
				            return Html::a(
				                '<span class="fas fa-download glyphicon glyphicon-arrow-down"></span>',
				                $url, 
				                [
				                    'title' => Yii::t ( 'app', 'Download this backup' ),'data-method'=>'post',
				                    'data-pjax' => '0',
				                ]
				            );
				        }, 								 
						],
						'urlCreator' => function ($action, $model, $key, $index) {
							
								$url = Url::toRoute ( [ 
										'default/' .$action,
										'file' => $model ['name'] 
								] );
								return $url;
							
						} 
				)
				 
		) 
] );
?>
<p>
importieren (in windows - cmd) mittels codepage ändern zu utf8, importieren, codepage wieder zu 850:
<br>
chcp 65001<br>
D:\wamp64\yii2-backup>..\bin\mysql\mysql5.6.17\bin\mysql -u root -p wt-data &lt;D:\WT\Backups\db_backup_2021.10.12_20.14.58.sql
chcp 850<br>
</p>
<p>

Wenn die Fehlermeldung kommt:<br>
ERROR 2006 (HY000) at line 122732: MySQL server has gone away
--- dann:<br>
To solve this problem increase max_allowed_packet size in your mysql configuration. Edit configuration file my.ini and add following value under [mysql] section.
<br>
  max_allowed_packet=100M
<br>
Set the value as per your requirement and restart MySQL service.
</p><p>
For phpmyadmin:<br>
Execution Time Limit needs to be set as 0 in config.default.php file. Which looks like $cfg['ExecTimeLimit'] = 300;
<br>
Make it to
<br>
$cfg['ExecTimeLimit'] = 0;
<br>
Location of that file supposed to be at /usr/share/phpmyadmin/libraries
</p>
