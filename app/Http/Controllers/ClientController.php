<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;


class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return ClientResource::collection(Client::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResource
     */
    public function store(StoreClientRequest $request)
    {
        $newClient = Client::create($request->all());

        return new ClientResource($newClient);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return JsonResource
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return JsonResource
     */
    public function update(UpdateClientRequest $request, Client $client)
    {

        $client->fill($request->all())->save();

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *en
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        $client->delete();

        return response()->json(['messenge'=>'OK'], 200);
    }

    public function getAll()
    {
        return ClientResource::collection(Client::orderBy('name')->get());
    }
}
