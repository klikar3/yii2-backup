<?php
use yii\helpers\Html;
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
									return Html::a ( '<span class="glyphicon glyphicon-remove"></span>', $url, [ 
											'title' => Yii::t ( 'app', 'Delete this backup' ) ,'data-method'=>'post',
                      'data-confirm' => Yii::t ( 'app', 'Really delete this backup?' )
									] );
								},
								
								'restore' => function ($url, $model) {
									return Html::a ( '<span class="glyphicon glyphicon-save"></span>', $url, [ 
											'title' => Yii::t ( 'app', 'Restore this backup' ) ,'data-method'=>'post'
									] );
								},
				        'download' => function ($url, $model) {
				            return Html::a(
				                '<span class="glyphicon glyphicon-arrow-down"></span>',
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