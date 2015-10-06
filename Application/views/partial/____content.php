<div>

<pre>

<div class="full case-pad">

	<div class="half change-padding">
		<div class="half right">
			<h1 class="smooth"><?php // echo $this->items['title']; ?></h1>
		</div>
	</div>

	<div class="half text-block">
		<p class="smooth"><?php // echo $this->items['body']; ?></p>
	</div>

</div>





<?php

use Application\Helper\Arr;

/*
foreach ($this->items as $item) {
    $id = htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8');
    $name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
    echo "Item ID #{$id} is '{$name}'." . PHP_EOL;
}
*/

if (array_key_exists('slug', $this->items)) {
//    echo "The 'first' element is in the array";

	echo '<div>Hello ' . $this->items['title'] . '</div>';
	echo '<br/>';
	// print_r( $this->stack );
	echo( 'slug: ' . $this->items['slug'] );
	echo '<br/>';
	echo( 'id: ' . $this->items['id'] );
	echo '<br/>';
	// echo( $this->items['title'] );
	// echo '<br/>';
	echo( 'body: ' . $this->items['body'] );
	echo '<br/>';

} else {
	echo 'no slug given';
}



$zzz   = Arr::path($this->items, 'slug');
echo '<br/>';
echo ' xxx xxx xxx = ' . $zzz;
echo '<br/>';



//if (defined( (string)$this->items['slug'] )) {
   
//}



?>


</pre>
</div>

