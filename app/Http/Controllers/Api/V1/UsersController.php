<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use Validator;

class UsersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return $this->sendResponse(UserResource::collection($users), 'Proveedores retrieved Successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nombre' => 'required',
            'email' => 'required|email',
            'dui' => 'required|string',
            'fecha_contratacion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $User = User::create([
            ...$request->all(),
            'password' => bcrypt($request->password),
            'name' => $request->nombre,
        ]);

        return $this->sendResponse(new UserResource($User), 'Proveedor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($proveedore)
    {
        $proveedor = User::find($proveedore);
        if (is_null($proveedor)) {
            return $this->sendError('Proveedor not found.');
        }

        return $this->sendResponse(new UserResource($proveedor), 'Proveedor retrieved successfully.');
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

        $User = User::find($proveedore);

        if (is_null($User)) {
            return $this->sendError('Proveedor not found.');
        }

        $User->update($request->all());

        return $this->sendResponse(new UserResource($User), 'Proveedor created successfully.');
    }
}
