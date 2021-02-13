<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\EstablishmentEvaluation;
use App\Http\Resources\EstablishmentEvaluationResource;
use App\Http\Requests\StoreEstablishmentEvaluationRequest;
use App\Http\Requests\UpdateEstablishmentEvaluationRequest;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;


class EstablishmentEvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return EstablishmentEvaluationResource::collection(EstablishmentEvaluation::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreEstablishmentEvaluationRequest  $request
     * @return JsonResource
     */
    public function store(StoreEstablishmentEvaluationRequest $request)
    {
        $newEstablishmentEvaluation = EstablishmentEvaluation::create($request->all());

        return new EstablishmentEvaluationResource($newEstablishmentEvaluation);
    }

    /**
     * Display the specified resource.
     *
     * @param EstablishmentEvaluation $establishmentEvaluation
     * @return JsonResource
     */
    public function show(EstablishmentEvaluation $establishmentEvaluation)
    {
        return new EstablishmentEvaluationResource($establishmentEvaluation);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateEstablishmentEvaluationRequest  $request
     * @param  EstablishmentEvaluation  $establishmentEvaluation
     * @return JsonResource
     */
    public function update(UpdateEstablishmentEvaluationRequest $request, EstablishmentEvaluation $establishmentEvaluation)
    {
        $establishmentEvaluation->fill($request->all())->save();

        return new EstablishmentEvaluationResource($establishmentEvaluation);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param EstablishmentEvaluation $establishmentEvaluation
     * @return Response
     * @throws Exception
     */
    public function destroy(EstablishmentEvaluation $establishmentEvaluation)
    {
        return new Response($establishmentEvaluation->delete());
    }
}
