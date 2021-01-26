<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    private function createRequest($inputs) {
        $request = new \Illuminate\Http\Request();
        $request->setMethod('POST');
        $request->request->add($inputs);
        return $request;
}

    public function testRegisterProduct() {
        $request = $this->createRequest(['name' => 'Jumento', 'material_description' => 'Opa', 'price' => 10]);
        try{
            (new ItemController)->store($request);
        } catch (ErrorException $e){
            $e->getMessage();
        }
        $this->assertEquals(Product::where('name', 'Jumento')->first()->price, 10);
    }



    public function testItemCreation()
    {
        $this->assertTrue(true);
    }
}
