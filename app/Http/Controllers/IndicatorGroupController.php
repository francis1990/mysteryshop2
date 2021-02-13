<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndicatorGroupRequest;
use App\Http\Requests\UpdateIndicatorGroupRequest;
use App\Http\Resources\IndicatorGroupResource;
use App\Models\IndicatorGroup;
use Exception;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Response;

class IndicatorGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResource
     */
    public function index()
    {
        return IndicatorGroupResource::collection(IndicatorGroup::orderBy('name')->paginate());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreIndicatorGroupRequest  $request
     * @return JsonResource
     */
    public function store(StoreIndicatorGroupRequest $request)
    {
        $indicator = IndicatorGroup::create($request->all());

        return new IndicatorGroupResource($indicator);
    }

    /**
     * Display the specified resource.
     *
     * @param  IndicatorGroup  $indicatorGroup
     * @return JsonResource
     */
    public function show(IndicatorGroup $indicatorGroup)
    {
        return new IndicatorGroupResource($indicatorGroup);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpdateIndicatorGroupRequest  $request
     * @param  IndicatorGroup  $indicatorGroup
     * @return JsonResource
     */
    public function update(UpdateIndicatorGroupRequest $request, IndicatorGroup $indicatorGroup)
    {
        $indicatorGroup->fill($request->all())->save();

        return new IndicatorGroupResource($indicatorGroup);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param IndicatorGroup $indicatorGroup
     * @return Response
     * @throws Exception
     */
    public function destroy(IndicatorGroup $indicatorGroup)
    {
        return new Response($indicatorGroup->delete());
    }
}
