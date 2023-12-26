<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        // http://127.0.0.1:8000/api/product?page=2&q=tec
        $search = isset($request->q)?$request->q : '';
        $limit = isset($request->limit)?$request->limit: 10;

        if($search){
            $products = Product::orderBy('id', 'desc')
                                    ->where('name', 'like', '%'.$search.'%')
                                    ->with("categories")
                                    ->paginate($limit);
        }else{
            $products = Product::orderBy('id', 'desc')->with("categories")->paginate($limit);
        }
        return response()->json($products, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar
        $request->validate([
            "name"=> "required|max:255",
            "description"=> "max:255",
            "image"=> "max:255",
            "brand"=> "max:255",
            "price"=> "numeric|regex:/^\d{1,6}(\.\d{1,2})?$/",
            "price_sale"=> "numeric|regex:/^\d{1,6}(\.\d{1,2})?$/",
            "stock"=> "numeric|regex:/^\d{1,5}(\.\d{1,2})?$/",
            "categories_id"=> "exists:categories,id",
        ]);

        // guardar
        $prod = new Product();
        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->image = $request->image;
        $prod->brand = $request->brand;
        $prod->price = $request->price;
        $prod->price_sale = $request->price_sale;
        $prod->stock = $request->stock;
        $prod->categories_id = $request->categories_id;
        $prod->save();

        return response()->json(["message" => "Product Registered"], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json($product, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $id)
    {
        // validar
        $request->validate([
            "name"=> "required|max:255",
            "description"=> "max:255",
            "image"=> "max:255",
            "brand"=> "max:255",
            "price"=> "numeric|regex:/^\d{1,6}(\.\d{1,2})?$/",
            "price_sale"=> "numeric|regex:/^\d{1,6}(\.\d{1,2})?$/",
            "stock"=> "numeric|regex:/^\d{1,5}(\.\d{1,2})?$/",
            "categories_id"=> "exists:categories,id",
        ]);

        $prod = Product::findOrFail($id);
        $prod->name = $request->name;
        $prod->description = $request->description;
        $prod->image = $request->image;
        $prod->brand = $request->brand;
        $prod->price = $request->price;
        $prod->price_sale = $request->price_sale;
        $prod->stock = $request->stock;
        $prod->categories_id = $request->categories_id;
        $prod->save();
        
        return response()->json(["message" => "Product Modified"], 201);
   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $prod = Product::findOrFail($id);
        $prod->delete();
        return response()->json(["message" => "Product deleted"], 200);
    }

}
