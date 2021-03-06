<?php
	# -- IDIORM
	$app->register(new \Idiorm\Silex\Provider\IdiormServiceProvider(), array(
        'idiorm.db.options' => array(
            'connection_string' => 'mysql:host=localhost;dbname=projet',
            'username' => 'root',
            'password' => '',
			'id_column_overrides' => array(
				'category' =>  'ID_category',
				'event' => 'ID_event',
				'post' => 'ID_post',
				'products' => 'ID_product',
				'topic' => 'ID_topic',
				'users' => 'ID_user'
			),
        ),
	));
	#----------------------------------------------------------------------
?>