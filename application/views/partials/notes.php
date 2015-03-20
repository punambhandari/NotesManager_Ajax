<html>
<head>
	<title>Update Post</title>
	<link rel="stylesheet" type="text/css" href="/assets/css/bootstrap.css">
	<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
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
	}
	ul li{
		list-style: none;
		display: inline;
		padding: 2px;	
	}
	</style>
</head>
<body>
	<div class="container">
		<h5>Notes</h5>
		<div class="row" id="display_notes">
		</div>
			
		<div class="col-sm-3">
		<form method="post" action="/notes/update">
			<div class="form-group">
				<textarea class="form-control" name="description"  ><?=$notes['description']?></textarea>
			</div>
			<div class="form-group">
				<input class="form-control" typep="text" name="title" value = "<?=$notes['title']?>">
			</div>
			<input type="submit" value="Update Note" class="pull-right">
			<input type="hidden" name="note_id" value="<?=$notes['id']?>">
		</form>
	</div>
</body>
</html>