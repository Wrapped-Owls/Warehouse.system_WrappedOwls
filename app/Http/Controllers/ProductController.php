<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class ProductController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('admin');
	}

	public function show($id) {
		return view('product.show', ['product' => Product::findOrFail($id)]);
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Application|Factory|\Illuminate\Contracts\View\View|Response
	 */
	public function index() {
		$products = Product::orderBy('created_at', 'asc');
		return view('product.index', ['products' => $products->paginate(10)]);
	}

	/**
	 * Load Create Product Form Page
	 *
	 * @return Application|Factory|\Illuminate\Contracts\View\View|Response
	 */
	public function create() {
		return view('administrator/register_product');
	}


	/**
	 * @param int $id
	 * @return Factory|View
	 */
	public function edit($id) {
		$product = Product::where('code_product', '=', $id)
		                  ->first();
		$data = [];
		$data['id'] = $product->code_product;
		$data['name'] = $product->name;
		$data['description'] = $product->material_description;
		$data['price'] = $product->price;
		$data['image'] = $product->image_path ? "/storage/" . $product->image_path : null;
		return view('product.edit')->with('data', $data);
	}

	public function detail($id) {
		$product = Product::where('code_product', '=', $id)
		                  ->first();
		$data = [];
		$data['id'] = $product->code_product;
		$data['name'] = $product->name;
		$data['description'] = $product->material_description;
		$data['price'] = $product->price;
		$data['image'] = $product->image_path ? "/storage/" . $product->image_path : null;
		return view('product.detail')->with('data', $data);
	}

	/**
	 * Start register process
	 *
	 * @param Request $request
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function store(Request $request) {
		$product = new Product();
		$product->name = $request->input('name');
		$product->material_description = $request->input('material_description');
		if($request->file('product_image')) {
			$path = $request->file('product_image')
			                ->store('images', 'public');
			$product->image_path = $path;
		}
		$product->price = $request->input('price');
		$product->disposable = $request->input('disposable') == "true" ? 1 : 0;
		$product->save();
		$this->saveLog("Criaçao de produto");
		return redirect('product');
	}

	/**
	 * @param Request $request
	 * @param $id
	 * @return RedirectResponse
	 */
	public function update(Request $request, $id): RedirectResponse {
		$product = Product::where('code_product', '=', $id)
		                  ->first();
		$product->name = $request->input('name') ? $request->input('name') : $product->name;
		$product->material_description = $request->input('material_description') ? $request->input(
			'material_description'
		) : $product->material_description;
		$product->disposable = $request->input('disposable') == "true" ? 1 : 0;
		if($request->input('price')) {
			$product->previous_price = $product->price;
			$product->price = $request->input('price');
		}
		if($request->file('product_image') != null) {
			if($product->image_path) {
				$path = $product->image_path;
				File::delete($path);
				Image::make(
					$request->file('product_image')
					        ->getRealPath()
				)
				     ->save($path);
			} else {
				$path = $request->file('product_image')
				                ->store('images', 'public');
				$product->image_path = $path;
			}
		}
		$this->saveLog("Alteraçao de dados do produto " . $product->name);
		$product->save();
		return redirect()->route('product.edit', [$id]);
	}

	public function remove($id): RedirectResponse {
		$data = Product::find($id);
		if($data != null) {
			$data->forceDelete();
			return redirect()
				->route('product.index')
				->with(['message' => 'Successfully deleted!!']);
		}

		return redirect()
			->route('product.index')
			->with(['message' => 'Wrong ID!!']);
	}

}
