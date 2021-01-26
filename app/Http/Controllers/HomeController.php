<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ItemRequest;
use App\Models\InoutProduct;
use Illuminate\Http\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;


class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$access_level = auth()->user()->access_level;
		if($access_level > 1) {
			$requests = $this->getRequests("FALSE");
			$stationaryProducts = (new ItemReportController)->getStationaryProducts();
			return view('administrator/index', compact('requests', 'stationaryProducts'));
		} else {
			if($access_level == 1) {
				$requests = $this->getRequests("1");
				return view('collaborator/index', compact('requests'));
			}
		}
		return redirect('item');
	}

	public function approve($id): RedirectResponse {
		$inout = new InoutProduct();
		$itemRequest = ItemRequest::find($id);
		$inout->code_administrator = auth()->user()->id;
		$inout->code_request = $itemRequest->code_request;
		$inout->save();
		return redirect()->route('home');
	}

	public function refuse($id): RedirectResponse {
		$itemRequest = ItemRequest::find($id);
		$itemRequest->delete();
		return redirect()->route('home');
	}

	public function getRequests($another_area) {
		$inout = InoutProduct::pluck('code_request')
		                     ->all();
		$user = User::find(auth()->user()->id);
		if($user->access_level == 3) {
			$requests = ItemRequest::orderBy('item_requests.created_at', 'asc')
			                       ->join('users as user', 'item_requests.code_user', '=', 'user.id')
			                       ->join('items as item', 'item_requests.code_item', '=', 'item.code_item')
			                       ->join('products as product', 'item.code_product', '=', 'product.code_product')
			                       ->select('item_requests.*', 'product.name as product_name', 'user.name as user_name')
			                       ->paginate(10)
			                       ->whereNotIn('code_request', $inout)
			                       ->where('another_area', '=', $another_area);
			return $requests;
		} else {
			$requests = ItemRequest::orderBy('item_requests.created_at', 'asc')
			                       ->where('item_requests.responsible', '=', auth()->user()->id)
			                       ->join('users as user', 'item_requests.code_user', '=', 'user.id')
			                       ->join('items as item', 'item_requests.code_item', '=', 'item.code_item')
			                       ->join('products as product', 'item.code_product', '=', 'product.code_product')
			                       ->select('item_requests.*', 'product.name as product_name', 'user.name as user_name')
			                       ->paginate(10)
			                       ->whereNotIn('code_request', $inout)
			                       ->where('another_area', '=', $another_area);
			return $requests;
		}
	}

}
