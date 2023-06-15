<?php

namespace App\Http\Controllers;

use App\Models\Calendar;
use Exception;
use Illuminate\Http\Request;


class CalendarController extends Controller
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
        //
    }

    public function showAll(){
        # solicitud llamada desde el API
        # se pueden crear filtros, en caso de ser necesario
        try {
            $return['messagge'] = "";
            $return['calendars'] = Calendar::all();
        } catch (Exception $e) {
            $return['calendars'] = [];
            $return['messagge'] = 'error al cargar el calendario '.$e->getMessage();
        }
        return $return;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calendar $Calendar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calendar $Calendar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calendar $Calendar)
    {
        //
    }
}
