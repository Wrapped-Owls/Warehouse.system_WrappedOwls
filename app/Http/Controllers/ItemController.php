<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ItemController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('admin');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$items = Item::orderBy('items.created_at', 'asc')->join('products as product', 'items.code_product', '=', 'product.code_product')->join('areas as area', 'items.code_area', '=', 'area.code_area')->select('items.*', 'product.name as product_name', 'area.name as area_name')->where('area.responsible' , '!=', 'null')->paginate(10);
		return view('inout.index', ['items' => $items]);
	}

	public function admin() {
		$items = Item::orderBy('items.created_at', 'asc')->join('products as product', 'items.code_product', '=', 'product.code_product')->join('areas as area', 'items.code_area', '=', 'area.code_area')->select('items.*', 'product.name as product_name', 'area.name as area_name')->where('area.responsible' , '!=', 'null')->paginate(10);
		return view('item.request_admin', ['items' => $items]);
	}

	/**
	 * @param Request $request
	 * @return Factory|\Illuminate\View\View
	 */
	public function search(Request $request) {
		$products = Product::where('products.name', 'like', '%' . $request->input('productName') . '%');
		$items = $products->join('items as items', 'items.code_product', '=', 'products.code_product')->join('areas as area', 'items.code_area', '=', 'area.code_area')->select('items.*', 'products.name as product_name', 'area.name as area_name')->paginate(10);
		return view('inout.index', ['items' => $items]);
	}

	/**
	 * Load Create Product Form Page
	 *
	 * @param null $error
	 * @return Application|Factory|View|Response
	 */
	public function create($error = null) {
		$areas = Area::all();
		$products = Product::all();
		return view('administrator/register_item', ['areas' => $areas, 'products' => $products, 'error' => $error]);
	}

	public function edit($id) {
		$areas = Area::all();
		$item = Item::where('code_item', '=', $id)->first();
		$data = [];
		$data['id'] = $item->code_item;
		$data['code_product'] = $item->code_product;
		$data['code_area'] = $item->code_area;
		$data['total_inside'] = $item->total_inside;
		return view('inout.update', ['areas' => $areas])->with('data', $data);
	}

	/**
	 * Start register process
	 *
	 * @param Request $request
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function store(Request $request) {
		if (Item::where("code_product", '=', $request->input('product'))->where('code_area', '=', $request->input('area'))->first() == null) {
			$item = new Item();
			$item->code_product = $request->input('product');
			$item->code_area = $request->input('area');
			$item->total_inside = $request->input('total_inside');
			$item->total_outside = 0;
			$this->saveLog("Criaçao de item");
			$item->save();
			return redirect('inout');
		}
		return $this->create('Item já existente, tente associar outro produto ou área');
	}

	public function update(Request $request, $id) {
		$item = Item::where('code_item', '=', $id)->first();
		$item->total_inside = $request->input('total_inside');
		$this->saveLog("Modificaçao de informaçoes de item");
		$item->save();
		return $this->index();
	}

	public function transfer(Request $request, $id) {
		$item = Item::find($id);
		if ($item && $item->code_area != $request->input('code_area')) {
			$newItem = Item::where('code_product', '=', $item->code_product)->where('code_area', '=', $request->input('code_area'))->first();
			$newQuantity = $item->total_inside - $request->input('total_inside');
			if (!$newItem) {
				$newItem = new Item();
				$newItem->code_product = $item->code_product;
				$newItem->code_area = $request->input('code_area');
				$newItem->total_outside = 0;
				$newItem->total_inside = 0;
				$newItem->save();
			}

			if ($newQuantity >= 0) {
				$newItem->total_inside += $request->input('total_inside');
				$item->total_inside = $newQuantity;
				$newItem->save();
				$item->save();
				$productName = Product::find($item->code_product)->name;
				$firstAreaName = Area::find($item->code_area)->name;
				$secondAreaName = Area::find($newItem->code_area)->name;
				$this->saveLog("Transferidos " . $request->input('total_inside') . " " . $productName . " de " . $firstAreaName . " para " . $secondAreaName);
			}
		}
		return $this->index();
	}

}
