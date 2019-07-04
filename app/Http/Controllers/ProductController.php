<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function index(): Responsable
    {
        $products = Product::with(['attributes'])->get();

        return ProductResource::collection($products);
    }

    /**
     * @param  int|string  $id
     * @return \Illuminate\Contracts\Support\Responsable
     */
    public function show($id): Responsable
    {
        $product = Product::with([
            'attributes',
            'related.attributes',
            'relatedTo.attributes',
            'relatedTo.related.attributes',
        ])->find($id);

        if (! $product instanceof Product) {
            abort(Response::HTTP_NOT_FOUND);
        }

        return new ProductResource($product);
    }
}
