<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CoController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd(request()->all());  //gives JSON
        $co1 = request('co1');
        $co2 = request('co2');
        $co3 = request('co3');
        $co4 = request('co4');
        $co5 = request('co5');
        $co6 = request('co6');

        $data=array('co1'=>$co1,
                    'co2'=>$co2,
                    'co3'=>$co3, 
                    'co4'=>$co4,
                    'co5'=>$co5,
                    'co6'=>$co6);

        DB::table('cotest')->insert($data);

        return view('co-po-just');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
