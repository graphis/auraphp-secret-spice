<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8 />
	<title>aura-secret-spice</title>

	<!-- css reset -->
	<link rel="stylesheet" type="text/css" href="resources/ui/css/reset.css" />

	<!-- site specific css -->
	<link rel="stylesheet" type="text/css" href="resources/ui/css/main.css" />



	<!-- global js
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="path/to/your/jquery"><\/script>')</script> -->
	</script>

	<!-- IE 8 or below -->   
	<!--[if lt IE 9]>
		<script src="resources/ui/js/jquery-1.11.3.min.js"></script>  
	<![endif]-->
	<!-- IE 9 or above -->
	<!-- [if gte IE 9] >
		<script src="resources/ui/js/jquery-2.1.4.min.js"></script>  
	<! [endif] -->


	<script src="resources/ui/js/jquery/jquery-2.1.4.min.js"></script>
	<script src="resources/ui/js/pjax/jquery.cookie.js"></script>
	<script src="resources/ui/js/pjax/jquery.pjax.js"></script>

	<!--<script src="pjaxtest/js/jquery.pjax.js"></script>-->

	<style>

		#main {
			margin: 0 auto;
			background: #FFF;
			font-family:Helvetica,Arial,sans-serif;	
			width:50%;  
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



<div id='page'>



<header id='header'>

	<h1>auraphp pjax</h1>

	<nav class='header'>

		<ul id='main_navigation'>
			<li><a href='/'>index</a></li>
			<li><a href='/work'>work</a></li>
			<li><a href='974'>974</a></li>
			<li><a href='zsele'>zsele</a></li>
		</ul>
	</nav>

</header>










<!-- main -->
<section id="main">
<?php echo $this->getContent(); ?>
</section>
<!-- / main -->











<footer>
<!-- profile -->
<?php
// profile
$time_end = microtime(true);
$time = $time_end - APP_START_TIME;
echo "<br/><br/><br/>Page rendered in $time seconds<br/>";
?>

<p>Contact information: <a href="mailto:someone@example.com">someone@example.com</a>.</p>

<p>
	Ámor Intercity indul az egyes vágyányról. <br/>
	A szemétkocsik ajtaját kérjük csukják be!<br/>
</p>



</footer>



<script type="text/javascript">

var direction = "right";

function autorun()
{
$(document).pjax('a', '#main');
$(document).on('pjax:start', function() {
	$(this).addClass('loading')
});
$(document).on('pjax:end', function() {
	$(this).removeClass('loading')
});
}
if (document.addEventListener) document.addEventListener("DOMContentLoaded", autorun, false);
else if (document.attachEvent) document.attachEvent("onreadystatechange", autorun);
else window.onload = autorun;
</script>



</div>



</body>
</html>