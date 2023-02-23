<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Exceptions\ProudctNotInThisUser;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductCollection;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  ProductCollection::collection(Product::paginate(20));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $product=Product::create([
            'name' =>$request->name,
            'details' =>$request->description,
            'stock' =>$request->stock,
            'price'=>$request->price,
            'discount'=>$request->discount,
        ]);

        return response([
            'data'=>new ProductResource($product)
        ],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productUserCheck($product);
        $product->update([
            'name' =>$request->name ? $request->name : $product->name,
            'details' =>$request->description ? $request->description : $product->details,
            'stock' =>$request->stock ? $request->stock : $product->stock,
            'price'=>$request->price ? $request->price :$product->price,
            'discount'=>$request->discount ?$request->discount : $product->discount ,
        ]);
        return response([
            'data'=>new ProductResource($product)
        ],201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $this->productUserCheck($product);
        $product->delete();
         return response(null,204);
        // return  response([
        //    'data'=> ProductCollection::collection(Product::paginate(20))
        // ],204);
    }

    public function productUserCheck($product)
    {
        if(Auth::id() !== $product->user_id){
            throw new ProudctNotInThisUser;
        }
    }
}
