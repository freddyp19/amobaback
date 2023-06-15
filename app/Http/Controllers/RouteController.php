<?php

namespace App\Http\Controllers;

use App\Models\Route;
use Illuminate\Http\Request;
use Exception;

class RouteController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        $return = array('status' => 'success','messagge' => '', 'data' => array());
        try {
            $return['data'] = Route::where("id","=",$id)->first();
        } catch (Exception $e) {
            $return['status'] = 'error';
            $return['messagge'] = 'error al cargar la ruta';
        }

        return $return;
    }

    public function showAll(){
        # solicitud llamada desde el API
        # se pueden crear filtros, en caso de ser necesario
        try {
            $return['messagge'] = "";
            $return['routes'] = Route::all();
        } catch (Exception $e) {
            $return['routes'] = [];
            $return['messagge'] = 'error al cargar la ruta '.$e->getMessage();
        }
        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
