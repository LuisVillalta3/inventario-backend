<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Resources\Provider as ProviderResource;
use Validator;

class ProvidersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::all();

        return $this->sendResponse(ProviderResource::collection($providers), 'Proveedores retrieved Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idProveedor' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fax' => 'nullable|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $provider = Provider::create($request->all());

        return $this->sendResponse(new ProviderResource($provider), 'Proveedor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($proveedore)
    {
        $proveedor = Provider::find($proveedore);
        if (is_null($proveedor)) {
            return $this->sendError('Proveedor not found.');
        }

        return $this->sendResponse(new ProviderResource($proveedor), 'Proveedor retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $proveedore)
    {
        $validator = Validator::make($request->all(), [
            'idProveedor' => 'required',
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'fax' => 'nullable|string',
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $provider = Provider::find($proveedore);

        if (is_null($provider)) {
            return $this->sendError('Proveedor not found.');
        }

        $provider->update($request->all());

        return $this->sendResponse(new ProviderResource($provider), 'Proveedor created successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($proveedore)
    {
        $proveedor = Provider::find($proveedore);

        if (is_null($proveedor)) {
            return $this->sendError('Proveedor not found.');
        }

        $proveedor->delete();

        return $this->sendResponse([], 'Proveedor deleted successfully.');
    }
}
