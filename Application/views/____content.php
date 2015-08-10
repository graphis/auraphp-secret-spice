<pre>
	
	
	<div>Hello <?php // echo $this->name; ?></div>

<div>
xzxzx`zx`zxz`xz`x`zx`zx`zx`
<?php

/*
foreach ($this->items as $item) {
    $id = htmlspecialchars($item['id'], ENT_QUOTES, 'UTF-8');
    $name = htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8');
    echo "Item ID #{$id} is '{$name}'." . PHP_EOL;
}
*/

if (array_key_exists('slug', $this->items)) {
//    echo "The 'first' element is in the array";
	print_r( $this->items['slug'] );
} else {
	echo 'no slug given';
}




//if (defined( (string)$this->items['slug'] )) {
   
   //}


//print_r( $this );

// print_r( $this->stack );
// echo '<br/>';
// print_r( $this->id );
// echo '<br/>';
// print_r( $this->title );
// echo '<br/>';
// print_r( $this->body );
// echo '<br/>';
// print_r( $this->slug );
// echo '<br/>';



?>
</div>


</pre>