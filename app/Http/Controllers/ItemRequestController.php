<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Item;
use App\Models\Area;
use App\Models\User;
use App\Models\ItemRequest;
use App\Models\Collaborator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use App\Mail\ItemRequestedToAdministrator;
use Illuminate\Contracts\Foundation\Application;

class ItemRequestController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Application|Factory|View|Response
	 */
	public function index() {
		$itens = Item::orderBy('items.created_at', 'asc')
		             ->join('products as product', 'items.code_product', '=', 'product.code_product')
		             ->join('areas as area', 'items.code_area', '=', 'area.code_area')
		             ->select('items.*', 'product.name as product_name', 'area.name as area_name')
		             ->paginate(10);
		return view('inout.index', ['items' => $itens]);
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
	 * @return Application|RedirectResponse|Response|Redirector
	 */
	public function store(Request $request) {
		$itemRequest = new ItemRequest();
		$itemRequest->request_datetime = (new DateTime())->format('Y-m-d H:i:s');
		$item = Item::find($request->input('code_item'));
		$collaborator = Collaborator::find(auth()->user()->id);
		$admin = User::find(auth()->user()->id);
		$area = Area::find($item->code_area);
		if($item->code_area == $collaborator->code_area || $admin->access_level == 3) {
			$itemRequest->another_area = false;
			$itemRequest->responsible = $area->responsible;
		} else {
			$itemRequest->another_area = true;
			$itemRequest->responsible = $area->responsible;
		}
		$itemRequest->return_date = $request->input('return_date');
		$itemRequest->quantity = $request->input('total_request');
		$itemRequest->code_item = $request->input('code_item');
		$itemRequest->code_user = auth()->user()->id;
		$itemRequest->save();
		$this->saveLog("Requisiçao de um item");
		foreach(User::orderBy('users.id')
		            ->join('item_requests as item_request', 'users.id', '=', 'item_request.responsible')
		            ->select('email')
		            ->get() as $user) {
			Mail::to($user->email)
			    ->send(new ItemRequestedToAdministrator($itemRequest));
		}
		return redirect('item');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param int $id
	 * @return Application|Factory|View|Response
	 */
	public function show(int $id) {
		$item = Item::where('code_item', '=', $id)
		            ->first();
		$data = [
			'code_item'    => $item->code_item, 'code_product' => $item->code_product, 'code_area' => $item->code_area,
			'total_inside' => $item->total_inside
		];
		return view('item.request')->with('data', $data);
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
