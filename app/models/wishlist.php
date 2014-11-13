 <?php 
 class Wishlist extends AppModel { 

	var $name = 'Wishlist';
	
 	var $belongsTo = array(
			'User' => array(
				'className'=> 'User',
				'foreignKey'=> 'author_id' ,
			),
			'Article' => array(
				'className'=> 'Article',
				'foreignKey'=> 'article_id' ,
			)
	); 
	
}
    ?>

