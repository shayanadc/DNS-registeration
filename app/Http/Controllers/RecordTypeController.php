<?php

namespace App\Http\Controllers;

use App\Domain;
use App\RecordType;
use Illuminate\Http\Request;

class RecordTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            Domain::findOrFail($request->input('domain_id'));
            $recordType = new RecordType();
            $config = $recordType->createNewRecord($request->toArray());
            return response()->json(['content' => $config->content, 'domain_id' => $config->domain_id], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try{
            RecordType::find($id)->domain()->where('user_id', $request->user()->id)->firstOrFail();
            RecordType::destroy($id);
            $record = RecordType::find($id);
            if($record) throw new \Exception('not delete');
            return response()->json(['message' => 'deleted'], 200);
        }catch (\Exception $exception){
            return response()->json(['message' => 'not deleted'], 400);
        }
    }
}
