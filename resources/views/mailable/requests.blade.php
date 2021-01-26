<h1>Item Requested</h1>

<p>
	<?php
	use App\Models\Product;
	if(isset($item)) {
		$itemName = Product::find(App\Models\Item::find($item->code_item)->code_product)->name;
	}
	?>
	<?php echo auth()->user()->name; ?> made the request for {{ $item->quantity }} {{ $itemName }}
</p>
