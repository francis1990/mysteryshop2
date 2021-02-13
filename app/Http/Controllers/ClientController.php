<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;
use Exception;



class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return ClientResource::collection(Client::orderBy('name', 'DESC')->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreClientRequest  $request
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
     * @param Client $client
     * @return JsonResource
     */
    public function show(Client $client)
    {
        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateClientRequest  $request
     * @param Client $client
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
     * @param Client $client
     * @return Response
     * @throws Exception
     */
    public function destroy(Client $client)
    {
        return new Response($client->delete());

    }

    public function getAll()
    {
        return ClientResource::collection(Client::orderBy('name')->get());
    }
}
