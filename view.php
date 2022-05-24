<?php
require_once('conn.php');
require_once('function.php');

if(isset($_GET['id']) && getById('news', $_GET['id'])) {
    
    $new = getById('news', $_GET['id']);
	$comments = showTable('comments' , $new['id']);
	
    
} else {
    
    header("Location: http://mvcphp.rf.gd/test/news/");
    exit;
}  

require_once('template/header.php');
?>

<title><?= @$new['title']?></title>
</head>

<body>

<?php require_once('template/navbar.php');?>
 <br>   
 
	<div class="container">
		
		<div class="card">
		
			 <div class="card-header">
				<?= @$new['title']?>
			 </div>
			 
			<div class="card-body">
				<h5 class="card-title"><?= @$new['brief']?></h5>
				<p class="card-text"><?= @$new['body']?></p>
				
			</div>
		    <br>
		    <div class="card-footer text-muted">
		  
				  <form id="comments_form" method="post" accept-charset="">
			  
					  <h6 id="form_header">Add a new comment</h6>
					  <div id="message"></div>
					  
				  <div class="form-group">
					<label for="title">Your name</label>
					<input type="text" class="form-control" id="name" maxlength="15" name="name"  placeholder="Enter your name">
					<small id="name_note" class="form-text text-muted"></small>

				  </div>
					  

				 <div class="form-group">
					<label for="body">Your comment</label>
					  <textarea class="form-control" id="comment" name ="comment" rows="3"  maxlength="100"> </textarea>
					  <small id="comment_note" class="form-text text-muted"></small>
				 </div>
				  <input type="text" class="form-control"  id="news_id" name='news_id' value="<?= @$new['id']?>"  style="display:none">
				  <input type="text" class="form-control"  id="comment_id" name='comment_id'  style="display:none">

				 
				  <div class="form-group">
					  <button type="submit" id="comment_submit"  name="comment_submit"  class="btn btn-primary">Submit</button>
				  </div>  
				   <div id="spinners"></div>
					  
				 </form>
				 <br>
				 <div>
					<?php
					if(isset($comments) && !empty($comments)) {
					?>
						<p>Comments</p>
					<?php
						foreach($comments as $comment) {
					?>
					<div class="card">
					  <div class="card-header">
						<span><?= @$comment['name']?></span> |<span> <?= @$comment['comment']?></span> |<a href="#" value="<?= @$comment['id']?>"  class="comment_edit"> Edit </a> |  <a href="#"  value="<?= @$comment['id']?> "  class="comment_delete">  Delete </a> 
					  </div>
					</div>
					<?php
						}
					}
					?>
					
				</div> 
			 
		  </div>
		  
		</div>
		
	</div>
	





<?php require_once('template/footer.php'); ?>