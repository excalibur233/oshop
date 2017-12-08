<?php

namespace OShop\Http\Controllers;

use OShop\Core\Shop\Commodity\Spu;
use OShop\Http\Resources\Spu as SpuResource;
use OShop\Http\Resources\SpuCollection as SpuCollectionResource;
use Illuminate\Http\Request;

class SpuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->accepts('application/json')) {
            return new SpuCollectionResource(Spu::paginate(10));
        }

        return response(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \OShop\Spu  $spu
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Spu $spu)
    {
        if ($request->accepts('application/json')) {
            return new SpuResource($spu);
        }

        return response(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \OShop\Spu  $spu
     * @return \Illuminate\Http\Response
     */
    public function edit(Spu $spu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \OShop\Spu  $spu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Spu $spu)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \OShop\Spu  $spu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spu $spu)
    {
        //
    }
}
