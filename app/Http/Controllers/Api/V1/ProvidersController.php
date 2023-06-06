<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Provider;
use Illuminate\Http\Request;
use App\Http\Resources\Provider as ProviderResource;

class ProvidersController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $providers = Provider::all();

        return $this->sendResponse(ProviderResource::collection($providers), 'Products Retrieved Successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $provider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $provider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Provider $provider)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $provider)
    {
        //
    }
}
