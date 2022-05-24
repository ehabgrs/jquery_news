<?php
require_once('../conn.php');
require_once('../function.php');

$news_tableSchema = [
'title'     => PDO::PARAM_STR,
'brief'     => PDO::PARAM_STR,
'body'      => PDO::PARAM_STR
];


if(isset($_POST)) {
	
	if(isset($_POST['id'])) {
    save($_POST, 'news', $news_tableSchema, $_POST['id']);
    }

	if(isset($_POST['edit']) ) {
        $data = getById('news',$_POST['edit']);
		if($data) {
           echo json_encode($data); 
        } else {
            echo 2;
        }
		
	}
	
    if(isset($_POST['delete']) ) {
       echo deleteItem('news', $_POST['delete'] , 'comments');
     }
	
}

  
?>