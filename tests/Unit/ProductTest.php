<?php

namespace Tests\Unit;

use App\Http\Controllers\ProductController;
use App\Models\Product;
use ErrorException;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase {

	private function createRequest($inputs) {
		$request = new \Illuminate\Http\Request();
		$request->setMethod('POST');
		$request->request->add($inputs);
		return $request;
	}

	public function testRegisterProduct() {
		$request = $this->createRequest(['name' => 'Jumento', 'material_description' => 'Opa', 'price' => 10]);
		try{
			(new ProductController)->store($request);
		} catch (ErrorException $e){
			$e->getMessage();
		}
		$this->assertEquals(Product::where('name', 'Jumento')->first()->price, 10);
	}


	public function testProductUpdate(){
        $request2 = $this->createRequest(['name' => 'Livro do Harry Potterr', 'material_description' => 'Livro mais top do mundo', 'price' => 934]);
        Product::where('name','Jumento')->update(array('name'=> $request2['name'],'material_description'=>$request2['material_description'],'price'=>$request2['price']));
        $this->assertEquals(Product::where('name', 'Livro do Harry Potterr')->first()->price, 934);
    }

}
