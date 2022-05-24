<?php
require_once('../conn.php');
require_once('../function.php');

$comments_tableSchema = [
'news_id'     => PDO::PARAM_INT,
'name'     => PDO::PARAM_STR,
'comment'     => PDO::PARAM_STR
];


if(isset($_POST)) {
	
	if(isset($_POST['comment_id'])) {
    save($_POST, 'comments', $comments_tableSchema, $_POST['comment_id']);
    }

	if(isset($_POST['comment_edit']) ) {
        $data = getById('comments',$_POST['comment_edit']);
		if($data) {
           echo json_encode($data); 
        } else {
            echo 2;
        }
		
	}
	
    if(isset($_POST['comment_delete']) ) {
       echo deleteItem('comments', $_POST['comment_delete']);
     }
	
}

  
?>