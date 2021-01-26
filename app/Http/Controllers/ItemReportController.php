<?php

namespace App\Http\Controllers;

use DateTime;
use Exception;
use App\Models\Item;
use App\Models\Report;
use App\Models\Product;
use App\Models\ItemRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Foundation\Application;


class ItemReportController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$products = Product::all();
		$stationaryProducts = $this->getStationaryProducts(true);

		return view('product.report', compact('products', 'stationaryProducts'));
	}

	/**
	 * @param bool $timeInterval
	 * @return array
	 */
	public function getStationaryProducts($timeInterval = false): array {
		$now = new DateTime("now");
		$products = Product::all();
		$stationaryProducts = [];
		foreach($products as $product) {
			$items = $product->item;
			$addStationary = false;
			$dateInterval = ($now)->diff((new DateTime('0000/01/01')));
			if($items) {
				foreach($items as $item) {
					$itemRequests = ItemRequest::where('code_item', $item->code_item)
					                           ->orderByDesc('request_datetime')
					                           ->get();
					if(count($itemRequests) > 0) {
						$dateInterval = ($now)->diff((new DateTime($itemRequests->first()->request_datetime)));
						if($dateInterval->m >= 3) {
							$addStationary = true;
						}
					} else {
						$addStationary = true;
					}
				}
			} else {
				$addStationary = true;
			}
			if($addStationary) {
				if($timeInterval) {
					$newProduct = [];
					array_push($newProduct, $product, $dateInterval);
					array_push($stationaryProducts, $newProduct);
				} else {
					array_push($stationaryProducts, $product);
				}
			}

		}
		return $stationaryProducts;
	}

	/**
	 * @return string
	 * @throws Exception
	 */
	public function fun_pdf(): string {
		$products = Product::all();
		$now = new DateTime("now");
		$prod = [];
		$stationaryProducts = $this->getStationaryProducts(true);
		foreach($products as $product) {
			$dif = ($now)->diff((new DateTime($product->created_at)));
			$newp = [];
			array_push($newp, $product, $dif);
			array_push($prod, $newp);
		}

		PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
		$pdf = PDF::loadView('product.report', compact('products', 'stationaryProducts'));
		$report = new Report();
		$report->save();
		$report->path = 'reports/' . md5('RelatorioMensal' . $report->created_at) . '.pdf';
		Storage::disk('local')
		       ->put($report->path, $pdf->output());
		$report->save();
		return Storage::download($report->path);
	}

	public function qr_print($id) {
		$product = Product::find($id);
		$items = Item::all();
		$relation = [];
		$soma = 0;
		foreach($items as $item) {
			if($item->code_product == $product->code_product) {
				$soma += $item->total_inside;
			}
		}
		if(!$soma == 0) {
			$relation[$product->code_product] = [$soma, $product];
		}

		PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
		$pdf = PDF::loadView('product.qrDownload', compact('relation'));
		return $pdf->download($product->name . 'qrCode.pdf');


		// return view('product.qrDownload',compact('relation'));
	}

	public function downloadsPage() {
		$reports = Report::paginate(10);
		return view('product.reportDownload', compact('reports'));
	}

	public function makeDownload($createdAt) {
		$report = Report::where('created_at', $createdAt)
		                ->first();
		return Storage::download($report->path);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(): Response {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request
	 * @return Response
	 */
	public function store(Request $request): Response {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function show(int $id): Response {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function edit(int $id): Response {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request
	 * @param int $id
	 * @return Response
	 */
	public function update(Request $request, int $id): Response {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param int $id
	 * @return Response
	 */
	public function destroy(int $id): Response {
		//
	}
}
