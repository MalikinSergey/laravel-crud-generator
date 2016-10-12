<?php

namespace DummyNamespace;

use Illuminate\Http\Request;

use DummyRootNamespaceHttp\Requests;
use DummyRootNamespaceHttp\Controllers\Controller;

class DummyClass extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = DummyModel::query();

        $dummy_model_lower_plural = $query->get();

        return view('dummy_prefixdummy_model_lower.list', ['dummy_model_lower_plural' => $dummy_model_lower_plural]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dummy_prefixdummy_model_lower.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation here

        $dummy_model_lower = new DummyModel();

        $dummy_model_lower->fill($request->all());

        return redirect()->route('dummy_prefixdummy_model_lower.list')->with('dummy_message_key', 'dummy_message_success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dummy_model_lower = DummyModel::findOrFail($id);

        return view('dummy_prefixdummy_model_lower.show', ['dummy_model_lower' => $dummy_model_lower]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dummy_model_lower = DummyModel::findOrFail($id);

        return view('dummy_prefixdummy_model_lower.edit', ['dummy_model_lower' => $dummy_model_lower]);
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
        // validation here

        $dummy_model_lower = DummyModel::findOrFail($id);

        $dummy_model_lower->fill($request->all());

        return redirect()->route('dummy_prefixdummy_model_lower.edit')->with('dummy_message_key', 'dummy_message_success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DummyModel::destroy($id);

        return redirect()->route('dummy_prefixdummy_model_lower.list')->with('dummy_message_key', 'dummy_message_success');
    }
}