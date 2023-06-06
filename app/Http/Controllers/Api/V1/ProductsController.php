<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product as ProductResource;
use Validator;

class ProductsController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Products = Product::all();

        return $this->sendResponse(ProductResource::collection($Products), 'productos retrieved Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_proveedor' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Product = Product::create($request->all());

        return $this->sendResponse(new ProductResource($Product), 'productocreated successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($producto)
    {
        $producto = Product::find($producto);
        if (is_null($producto)) {
            return $this->sendError('productonot found.');
        }

        return $this->sendResponse(new ProductResource($producto, 'productoretrieved successfully.'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $producto)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'nombre' => 'required',
            'descripcion' => 'required',
            'id_proveedor' => 'required',

        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Product = Product::find($producto);

        if (is_null($Product)) {
            return $this->sendError('productonot found.');
        }

        $Product->update($request->all());

        return $this->sendResponse(new ProductResource($Product), 'productocreated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($producto)
    {
        $producto = Product::find($producto);

        if (is_null($producto)) {
            return $this->sendError('productonot found.');
        }

        $producto->delete();

        return $this->sendResponse([], 'productodeleted successfully.');
    }
}
