<html>
<head>
	<title>Notes Manager</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
	<style type="text/css">
	a{
		margin-top: 8px;
	}
	.show_notes{height: 150px;
		overflow: scroll;
	}
	{
		margin-right: 5px;
	}
	.spacing{
		margin-right: 10px;
		height: 200px;
		overflow: scroll;
	}
	ul li{
		list-style: none;
		display: inline;
		padding: 2px;	
	}
	</style>
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
	<script type="text/javascript">
	function parse_json_to_html(res)
	{
		var html_str="";
			for(var i=0;i < res.notes.length; i++)
			{
				var div_id="div"+res.notes[i].id;
				var notes_id ="notes_id"+res.notes[i].id;
				edit_url="/notes/show/"+res.notes[i].id;
				destroy_url="/notes/destroy/"+res.notes[i].id;
				html_str=html_str + "<div id="+div_id+" class='col-sm-2 spacing panel panel-default'><input type='hidden' id=" + notes_id + " value="
				+res.notes[i].id+"><ul class='pull-right'><li><a  id='destroy_link' href="+destroy_url +">delete</a></li><li>|</li><li><a id='edit_link' href="+edit_url+">edit</a></li></ul><h4>" 
				+ res.notes[i].title + "</h4><div class='panel panel-body show_notes'>"
				+ res.notes[i].description + "</div></div>";
				
				console.log(html_str);
			}
			return html_str;
	}

	$(document).ready(function(){
		//alert("hi");
		$.get('/notes/get_all_json',function(res){
			
			var html_str=parse_json_to_html(res);
			$('#display_notes').html(html_str);
			
		},"json");

		$(document).on("click","#destroy_link",function(e){
			 e.preventDefault();
			 var url=  $(this).attr('href');
			 console.log(url);

    		$.post(url, $(this).serialize(), function(res) {
      		
      		var html_str=parse_json_to_html(res);
			$('#display_notes').html(html_str);

    		}, 'json');
			
		});

		$(document).on("blur","#id_title",function(e){
				
		$(this).parent().parent(".form_update").submit();
		$.post('/notes/update', $(this).serialize(), function(res) {
      		console.log(res);
      		var html_str=parse_json_to_html(res);
			$('#display_notes').html(html_str);


    		}, 'json');
			return false;	
		});
		$(document).on("blur","#id_desc",function(e){			
		$(this).parent().parent(".form_update").submit();
		$.post('/notes/update', $(this).serialize(), function(res) {
      		console.log(res);
      		var html_str=parse_json_to_html(res);
			$('#display_notes').html(html_str);


    		}, 'json');
			return false;	
		});

		$(document).on("submit","form.form_update",function(){
    		$.post('/notes/update', $(this).serialize(), function(res) {
      		console.log(res);
      		var html_str=parse_json_to_html(res);
			$('#display_notes').html(html_str);


    		}, 'json');
			return false;
		});
		
		$(document).on("click","#edit_link",function(e){
			 e.preventDefault(); 
			 //get the json from db and replace the html inside the div with the form elements.
			 var url= $(this).attr('href');
			 //console.log(url);
			 $.get(url,function(res){
			 	
			 	var div_id="div"+res.notes.id;
				html_str="<form class='form_update' method='post' action='/notes/update'> <input type='hidden' name='notes_id' value="
						+res.notes.id+"><div class='form-group'> <label>title:</label><input type='text' class='form-control' id='id_title' name='title' value="+res.notes.title
						+ "></div> <div class='form-group'><label>description:</label><textarea class='form-control' id='id_desc' name='description'> "+res.notes.description 
						+" </textarea></div><input type='hidden' value='update' class='update pull-right'></form>";

				//console.log(html_str);
			
				$('#'+div_id).html(html_str);
						
				
		},"json");
			
		});

		$('form').submit(function(){
			$.post('/notes/create',$(this).serialize(),function(res){
				var html_str=parse_json_to_html(res);
			$('#display_notes').html(html_str);
			},"json");
				$('#title').val('');
				$('#desc').val('');
			return false;
		});


	});

	</script>

</head>
<body>
	<div class="container">
		<h5>Notes</h5>
		<div class="row" id="display_notes">
		</div>
		<div class="col-sm-3">
		<form method="post">
			<div class="form-group">
				<textarea class="form-control" id="desc" name="description" placeholder="enter description"></textarea>
			</div>
			<div class="form-group">
				<input id="title" class="form-control" typep="text" name="title" placeholder="enter title">
			</div>
			<input type="submit" value="Add Note" class="pull-right">
		</form>
	</div>

</body>
</html>