<?php
require_once('conn.php');
require_once('function.php');
require_once('template/header.php');

$news = showTable('news');  
?>

     <title>News</title>
     </head>
  
    <body>
         <?php require_once('template/navbar.php');?>     

		 <div class="container">
			  
		    	<h1>News</h1>
			    <div id="message"></div>
			    <table class="table table-bordered">
				  <thead>
					<tr>
					  <th scope="col">Title</th>
					  <th scope="col">Brief</th>
					  <th scope="col">Control</th>
					</tr>
				  </thead>
		  
				  <tbody>
				  
				  <?php
				  if(isset($news) && !empty($news)) {
					  foreach($news as  $new) {
				   ?>
					<tr>
					  <td><?= @$new['title']?></td>
					  <td><?= @$new['brief']?></td>
					  <td><a href="#" value="<?= @$new['id']?> "  class="news_edit"> Edit </a> | <a value="<?= @$new['id']?> "  href="#" class="news_delete">  Delete </a> |<a href="view.php?id=<?= @$new['id']?>">  View </a>  </td>
					</tr>
				  <?php
					  }
				  } else {
				  ?>
					
					<tr>
					  <th colspan="4" class="text-center"> No data to show </th>
					</tr>
					
				  <?php
					  }	
				  ?>
				  <tr id="new_row"></tr>
				  </tbody>
		     </table>
			<br>
			<hr>
			  

			  
		    <form id="news_form" method="post" accept-charset="">
			  
			    <h1 id="form_header">Add a new news</h1>
			  
		        <div class="form-group">
					<label for="title">Title</label>
				   <input type="text" class="form-control" id="title" maxlength="100" name="title"  placeholder="Enter title">
				   <small id="title_note" class="form-text text-muted"></small>

		        </div>
			  
			   <div class="form-group">
				  <label for="brief">Brief description</label>
				  <textarea class="form-control" id="brief" name="brief" maxlength="200"> </textarea>
				  <small id="brief_note" class="form-text text-muted"></small>
			   </div>
			  
			  <div class="form-group">
				  <label for="body">The main topic</label>
				  <textarea class="form-control" id="body" name ="body" rows="10"  maxlength="1000">  </textarea>
				  <small id="body_note" class="form-text text-muted"></small>
			  </div>
			  
		      <input type="text" class="form-control"  id="news_id" name='id'  style="display:none">

		 
			  <div class="form-group">
				  <button type="submit" id="submit"  name="submit"  class="btn btn-primary">Submit</button>
			  </div>  
			  
		      <div id="spinners"></div>
			  
		     </form>
             <br>
		</div>

<?php require_once('template/footer.php'); ?>
