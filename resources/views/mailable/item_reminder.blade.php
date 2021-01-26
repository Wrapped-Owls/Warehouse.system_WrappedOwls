<h1>Remember to return the product to the warehouse</h1>

<p>
	<?php
	use App\Models\Item;use App\Models\Product;use App\Models\ItemRequest;
	if(isset($inout)) {
		$itemRequest = ItemRequest::find($inout->code_request);
		$quantity = $itemRequest->quantity;
		$item = Item::find($itemRequest->code_item);
		$product = Product::find($item->code_product);
	}
	?>
    You have removed {{$quantity}} {{$product->name}} from the warehouse, please remember to return them
    until {{$itemRequest->return_date}}
</p>
