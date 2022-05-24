<?php

  function showTable($tableName, $news_id = ''){
	  
	  global $conn;
	  
	  if($news_id == '') {
	      $sql = 'Select * from ' . $tableName ;
	  } else {
		  $sql = 'Select * from ' . $tableName . ' where news_id = ' . $news_id ;
	  }
      $stmt = $conn->prepare($sql);
      $stmt->execute();
      return $stmt->fetchAll(); 
  };

 function getLastItem($tableName) {
  global $conn;
  $sql = 'Select * from ' . $tableName . ' order by id desc limit 1' ;
  $stmt = $conn->prepare($sql);
  if($stmt->execute()) {
      $data = $stmt->fetchAll(); 
      return !empty($data) ? array_shift($data) : false;
  }
  return false;
 } 
  
function save($post ,$tableName, $tableSchema ,$id = '') {
	  
	global $conn;
	$params = '';
    $result = [];
	
	foreach($tableSchema as $column => $type) {
		$params .= $column. ' = :' . $column. ', ';
	}
	
	$params = trim($params , ', ');
    
	$id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    
    if($id == '') {
        $sql = 'INSERT INTO '.$tableName . ' SET ' . $params . ' ,created_at = now()';
        $result['type'] = 'add'; 
    } else {
        $sql = 'UPDATE '.$tableName. ' SET ' . $params . ' WHERE id= ' . $id ;
        $result['type']= 'edit';
    }
	$stmt = $conn->prepare($sql);
	foreach($tableSchema as $column => $type) {
		$stmt->bindValue(":{$column}" , $post[$column] , $type);
	}
	if($stmt->execute()) {
        
		$result['result'] = 1; 
        
        if($result['type'] == 'add') {
          $result['new_item'] =  getLastItem($tableName); 
        } else if($result['type'] == 'edit') {
           $result['edited_item']= getById($tableName,$id);
        }
        
       
	} else {
		$result['result'] = 2; 
	}
	echo json_encode($result);
}



function getById($tableName,$id) {
  global $conn;
  $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
  $sql = 'Select * from ' . $tableName . ' WHERE id= ' . $id ;
  $stmt = $conn->prepare($sql);
  if($stmt->execute()) {
      $data = $stmt->fetchAll(); 
      return !empty($data) ? array_shift($data) : false;
  }
  return false;
}


function deleteItem($tableName, $id, $reference_table = '') {
	
	global $conn;
	
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
	
	if($reference_table != '') {
		$sql = 'DELETE FROM ' . $reference_table . ' WHERE news_id= ' . $id;
	    $stmt = $conn->prepare($sql);
		$stmt->execute();
	}
	
	$sql = 'DELETE FROM ' . $tableName . ' WHERE id= ' . $id;
	$stmt = $conn->prepare($sql);
	
	if($stmt->execute()) {
		echo 1;
	} else {
		echo 2;
	}
}
	
    






