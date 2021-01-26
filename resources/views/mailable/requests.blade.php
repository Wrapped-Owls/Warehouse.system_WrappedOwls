<h1>Item Solicitado</h1>

<p>
	<?php
	if (isset($item)) {
		$itemName = \App\Models\Product::find(App\Models\Item::find($item->code_item)->code_product)->name;
	}
	?>
    <?php echo auth()->user()->name; ?> realizou a solicitação de {{ $item->quantity }} {{ $itemName }}
</p>
