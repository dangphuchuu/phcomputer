<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Products::all();
        return view('admin/pages/products/index',['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function status(Request $request){
        $products = Products::find($request->status_id);
        $products->status = $request->active;
        $products->save();
        return response('success',200);
    }
    public function featured(Request $request){
        $products = Products::find($request->featured_id);
        $products->featured_product = $request->active;
        $products->save();
        return response('success',200);
    }
}
