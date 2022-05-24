$(function(){
        
                                   // form check
        
		function value_check(input_id , note_id, min_length) {
			$(input_id).keyup(function(){
				var max = $(this).attr('maxlength');
				var sizeNow = $(this).val().length;
				var left = max - sizeNow;
				$(note_id).html("Remaining " + left);
                
                if(sizeNow < min_length) {
                    $(this).addClass("border-3 border-danger");
                } else {
                    $(this).removeClass("border-danger");
                   $(this).addClass("border-success");
                    
                }
                
			});
		};
        
    
                                
        function addAlert(msg,type) {
            return '<div class=" alert alert-' + type +'">' + msg + '</div>';
        }
		
		
    
    
        function validate(input_id, input_name, min_length) {
            
            if($(input_id).val().length <= min_length) {
                var msg = input_name + ' length has to be more than ' + min_length;
                return  addAlert(msg,'danger') ;
                
            } else {
                
                return "";
                
            }
        };
    
    
        
        
       /*
       //create row for append with add
       function create_row(id, title, brief,body) {
		  return ' <td> ' + title + '</td> <td>' + brief + '</td> <td> <a href="#" value="' + id + '" "class = "news_edit" > Edit </a> | <a href="#" value="' + id + '" class="news_delete">  Delete </a> |<a href="view.php?id=' + id + '"> View </a></td>'; 
        };*/
        
        
    
                                                              //News 
           value_check('#title', '#title_note', 5);
           value_check('#brief', '#brief_note', 10);
           value_check('#body', '#body_note', 30);
    
    
        //add and edit news
    
        $('#submit').click(function(){
            
            var validate_title = validate('#title','The Title',5);
            var validate_brief = validate('#brief','The brief description',10);
            var validate_body = validate('#body','The main topic',30);
            
           if( (validate_title + validate_brief + validate_body) != '') {
               
               $('#message').html(validate_title + validate_brief + validate_body);
               return false; 
               
           } else {
               
              var formData = $('#news_form').serialize();
               
              $.ajax({
                  
                  url : 'ajax/addnews.php',
                  type : 'POST',
                  data : formData,
                  
                  beforeSend : function(){
                      $('#spinners').html('<div class="spinner-grow text-primary" role="status"></div>');
                  },
                  
                  
                  statusCode : {
                      404 : function() {
                           $('#message').html(addAlert('404 error'));
                      },

                      403 : function() {
                          $('#message').html(addAlert('403 error') );
                      }
                  },
                  
                  
                  success : function(data) {
                      data = $.parseJSON(data);
					   
                      if(data['result'] == 1) {
                          
						  document.getElementById('message').scrollIntoView(true);
                          $('#message').html(addAlert('The item has been added successfully','success')).delay(500);
						 
						  if(data['type'] == 'edit') {
							  var edited_item = data['edited_item'];
							  $('#meWhoGotEdited > td:eq(0)').text(edited_item['title']);
							  $('#meWhoGotEdited > td:eq(1)').text(edited_item['brief']); 
						  }
						  
						  if(data['type'] == 'add') {
                              setTimeout(location.reload.bind(location), 1000);
							  // location.reload();
						  }
					  
                      } else if(data['result'] == 2) {
                           document.getElementById('message').scrollIntoView(true);
                           $('#message').html(addAlert('There is error in add the news','danger') );
                      } else {
                          document.getElementById('message').scrollIntoView(true);
                          $('#message').html(addAlert(data, 'danger') );
                      }
                      
                     
                        
                  },
                  
                  
                  complete : function() {
                       $('#spinners').html('');
					   $(':input').val('');
					   $('#form_header').text('Add a new news');
					   $('#meWhoGotEdited').removeAttr( "id" );
                  }
                   
              }); // end of ajax
               
           }
           return false; 
            
        }); // end of click
        
    
												 
							//pre edit news
        
       $('.news_edit').click(function(){
			var id = $(this).attr('value');
			var data = {edit : id};
            var this_item =  $(this).parent().parent();
			$.ajax({
				url : 'ajax/addnews.php',
				type : 'POST',
				data : data,
				success : function(data){
					if(data == 2) {
                        
                        $('#message').html(addAlert('There is a problem to get the edited item','danger') );
                        
                    } else {
                        
                       data = $.parseJSON(data);
					
                        document.getElementById('news_form').scrollIntoView(true);
                        $('#form_header').text('Edit the news');

                        $('#title').val(data['title']);
                        $('#brief').val(data['brief']);
                        $('#body').val(data['body']);
                        $('#news_id').val(data['id']); 
                    }	
					
				},
                complete : function(){
                   this_item.attr('id','meWhoGotEdited' );
                }
			});
			return false;
		});
		
		
		      //delete news
		
		$('.news_delete').click(function(){
			
			if(confirm('Are you sure you want to delete this item')) {
				
			var id = $(this).attr('value');
			var data = {delete : id};
			var this_item = $(this).parent().parent();
			
			$.ajax({
				url : 'ajax/addnews.php',
				type : 'POST',
				data : data,
				beforeSend : function(){
					this_item.addClass('border border-danger');
				},
				success : function(data){
					if(data == 1) {
					 $('#message').html(addAlert('The news have been deleted successfully','success')); 
                     $(this_item).fadeOut();
					} else if(data == 2) {
					  $('#message').html(addAlert('There is an error in delete the news','danger') );
					}else {
						$('#message').html(addAlert('There is an error not included in delete the news','danger') );
					}
				},
				complete : function(){
					
				}
				
			});
			}
			
			return false;
		});
    
    
    
    
		
		
		                                                                  //comments
		
		value_check('#name', '#name_note', 3);
		value_check('#comment', '#comment_note', 5);
    
		
	     	//add and edit comment
		
		 $('#comment_submit').click(function(){
            
            var validate_name = validate('#name','Name',3);
            var validate_comment = validate('#comment','The comment',5);
            
           if( (validate_name + validate_comment) != '') {
               
               $('#message').html(validate_name + validate_comment);
               return false; 
               
           } else {
               
              var formData = $('#comments_form').serialize();
               
              $.ajax({
                  
                  url : 'ajax/comment.php',
                  type : 'POST',
                  data : formData,
                  
                  beforeSend : function(){
                      $('#spinners').html('<div class="spinner-grow text-primary" role="status"></div>');
                  },
                  
                  
                  statusCode : {
                      404 : function() {
                           $('#message').html(addAlert('404 error'));
                      },

                      403 : function() {
                          $('#message').html(addAlert('403 error') );
                      }
                  },
                  
                  
                  success : function(data) {
					  
                      data = $.parseJSON(data);
					  
                      if(data['result'] == 1) {
						  
						     $('#message').html(addAlert('The comment has been added successfully','success')); 
							  if(data['type'] == 'edit') {
								  var edited_item = data['edited_item'];
								  $('#meWhoGotEdited > span:eq(1)').text(edited_item['comment']); 
							  };
							  
							  if(data['type'] == 'add') {
								 location.reload();
							  };
                         
                      } else if(data['result'] == 2) {
                           $('#message').html(addAlert('There is error in add the comment','danger') );
                      } else {
                          $('#message').html(addAlert(data, 'danger') );
                      };
                 
                  },
                  
                  
                  complete : function() {
                       $('#spinners').html('');
					   $(':input').val('');
					   $('#form_header').text('Add a new news');
					   $('#meWhoGotEdited').removeAttr( "id" );
					   $('#name').attr('readonly', false);
                  }
                   
              }); // end of ajax
               
           }
           return false; 
            
        }); 
    
    
    
		
		
		// pre edit comment
		 $('.comment_edit').click(function(){
		   
			var id = $(this).attr('value');
			var data = {comment_edit : id};
            var this_item =  $(this).parent();
			$.ajax({
				url : 'ajax/comment.php',
				type : 'POST',
				data : data,
				success : function(data){
					if(data == 2) {
                        
                        $('#message').html(addAlert('There is a problem to get the edited item','danger') );
                        
                    } else {
                        
                       data = $.parseJSON(data);
					
                        document.getElementById('comments_form').scrollIntoView(true);
                        $('#form_header').text('Edit Your comment');
                        
                        $('#name').val(data['name']).attr('readonly', true);
                        $('#comment').val(data['comment']);
                        $('#comment_id').val(data['id']); 
                    }	
					
				},
                complete : function(){
                   this_item.attr('id','meWhoGotEdited' );
                }
			});
			return false;
		});
        
        
    
    
        //delete comment
        $('.comment_delete').click(function(){
			
			if(confirm('Are you sure you want to delete this item')) {
				
			var id = $(this).attr('value');
			var data = {comment_delete : id};
			var this_item = $(this).parent();
			
			$.ajax({
				url : 'ajax/comment.php',
				type : 'POST',
				data : data,
				beforeSend : function(){
					this_item.addClass('border border-danger');
				},
				success : function(data){
					if(data == 1) {
					 $('#message').html(addAlert('The comment have been deleted successfully','success')); 
                     $(this_item).fadeOut();
					} else if(data == 2) {
					  $('#message').html(addAlert('There is an error in delete the comment','danger') );
					}else {
						$('#message').html(addAlert('There is an error not included in delete the comment','danger') );
					}
				},
				complete : function(){
					
				}
				
			});
			}
			
			return false;
		});
        
        
      
        
});
        
     
        
        

      