<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Resources\Warehouse as WarehouseResource;
use App\Models\Warehouse;
use Validator;

class WarehousesController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Warehouses = Warehouse::all();

        return $this->sendResponse(WarehouseResource::collection($Warehouses), 'bodegas retrieved Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fax' => 'nullable|string',
            'disponible' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Warehouse = Warehouse::create($request->all());

        return $this->sendResponse(new WarehouseResource($Warehouse), 'Proveedor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($proveedore)
    {
        $proveedor = Warehouse::find($proveedore);
        if (is_null($proveedor)) {
            return $this->sendError('Proveedor not found.');
        }

        return $this->sendResponse(new WarehouseResource($proveedor), 'Proveedor retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $proveedore)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fax' => 'nullable|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $Warehouse = Warehouse::find($proveedore);

        if (is_null($Warehouse)) {
            return $this->sendError('Proveedor not found.');
        }

        $Warehouse->update($request->all());

        return $this->sendResponse(new WarehouseResource($Warehouse), 'Proveedor created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($proveedore)
    {
        $proveedor = Warehouse::find($proveedore);

        if (is_null($proveedor)) {
            return $this->sendError('Proveedor not found.');
        }

        $proveedor->delete();

        return $this->sendResponse([], 'Proveedor deleted successfully.');
    }
}
