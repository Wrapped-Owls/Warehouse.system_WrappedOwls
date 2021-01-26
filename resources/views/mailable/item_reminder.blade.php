<h1>Lembre-se de Devolver o Produto ao Almoxarifado</h1>

<p>
	<?php
	if (isset($inout)) {
		$itemRequest = \App\Models\ItemRequest::find($inout->code_request);
        $quantity = $itemRequest->quantity;
        $item = \App\Models\Item::find($itemRequest->code_item);
        $product = \App\Models\Product::find($item->code_product);
	}
	?>
    Você realizou remoção de {{ $quantity }} {{ $product->name }} do almoxarifado, por favor lembre-se de devolvê-los até o dia {{ $itemRequest->return_date }}
</p>
