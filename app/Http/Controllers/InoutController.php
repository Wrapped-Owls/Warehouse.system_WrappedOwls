<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\ItemRequest;
use App\Models\InoutProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Mail\ClientItemReminder;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Database\Query\Builder;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\Foundation\Application;

class InoutController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('admin');
	}

	/**
	 * @return Builder
	 */
	private function requestJoin(): Builder {
		return DB::table('item_requests')
		         ->join('inout_products', 'item_requests.code_request', '=', 'inout_products.code_request')
		         ->join('users', 'users.id', '=', 'item_requests.code_user')
		         ->join('items', 'items.code_item', '=', 'item_requests.code_item')
		         ->join('products', 'products.code_product', '=', 'items.code_product');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$inStore = $this->requestJoin()
		                ->whereNull('out_datetime')
		                ->get();
		$notReceived = $this->requestJoin()
		                    ->whereNotNull('out_datetime')
		                    ->whereNull('in_datetime')
		                    ->get();
		return view('administrator.approved_requests', ['requests' => $inStore, 'notReceived' => $notReceived]);
	}

	/**
	 * @param $id
	 * @return RedirectResponse|
	 */
	public function release($id) {
		$inout = InoutProduct::find($id);
		$inout->out_datetime = now();
		$inout->save();
		$itemRequest = ItemRequest::find($inout->code_request);
		$item = Item::find($itemRequest->code_item);
		$item->total_inside -= $itemRequest->quantity;
		$item->total_outside += $itemRequest->quantity;
		$item->save();
		$collaborator = User::find($itemRequest->code_user);
		Mail::to($collaborator->email)
		    ->send(new ClientItemReminder($inout));
		return redirect('/requests/approved');
	}

	/**
	 * @param $id
	 * @param Request $request
	 * @return RedirectResponse|
	 */
	public function receive($id, Request $request) {
		$inout = InoutProduct::find($id);
		$inout->in_datetime = now();
		$inout->quantity_received = $request->input('quantity_received') ? $request->input('quantity_received') : 0;
		$inout->save();
		$itemRequest = ItemRequest::find($inout->code_request);
		$item = Item::find($itemRequest->code_item);
		$item->total_inside += $inout->quantity_received;
		$item->total_outside -= $itemRequest->quantity;
		$item->save();
		/*if($inout->quantity_received < Product){

		}*/
		return redirect('/requests/approved');
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
