<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>My Site</title>

	<script src="pjaxtest/js/jquery-1.9.1.js"></script>
	<script src="pjaxtest/js/jquery.cookie.js"></script>
	<script src="pjaxtest/js/jquery.pjax.js"></script>
	<script type="text/javascript">
		var direction = "right";
		$(document).ready(function(){
			$(document).pjax('a', '#main');
			$(document).on('pjax:start', function() {
				$(this).addClass('loading')
			});
			$(document).on('pjax:end', function() {
				$(this).removeClass('loading')
			});
		});
	</script>
	<style> 
		#main {
			background: #FFCFCF;
			font-family:Helvetica,Arial,sans-serif;	
			width:30%;  
			opacity: 1;
			transition: opacity 0.20s linear;
		}
		#main.loading {
			opacity: 0.5;
		}	
		h2 {margin-left:200px;}
		ul{padding-left:15px; list-style:none;}
	</style> 
	
</head>



<body>

<h1>PJAX using PHP</h1>
<nav class='header'>
	<li><a href='trex' data-pjax='main'>Tyrannosaurus</a></li>
	<li><a href='kong' data-pjax='main' >King Kong</a></li>
</nav>


	<section id="main">
		<?php echo $this->getContent(); ?>
	</section>








<?php
// profile
//$time_end = microtime(true);
//$time = $time_end - $time_start;
//echo "<br/><br/><br/>Page rendered in $time seconds<br/>";


?>
</body>
</html>