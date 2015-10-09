<hr/>
<div>
<pre>
<?php

use Application\Toolbox\Arr;

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
<hr/>