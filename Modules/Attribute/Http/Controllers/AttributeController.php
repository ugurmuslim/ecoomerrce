<?php

namespace Modules\Attribute\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Entities\Attributename;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $attributes = Attribute::orderBy('attribute_id','desc')->paginate(20);

        return view('attribute::index')->withAttributes($attributes);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $attributes = Attributename::all();
          return view('attribute::create')->withAttributes($attributes);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {

      $request->validate(array(
      'attribute_id' => 'required',
      'attribute_short' => 'required|max:3',
      'attribute_long' => 'required|max:10',
      ));
      $attribute_human_id =  new Attribute;
      $next_human_id = $attribute_human_id->setNextHumanId();
      $attribute = new Attribute;
      $attribute->timestamps = false;
      $attribute->attribute_id = $request->attribute_id;
      $attribute->attribute_short = $request->attribute_short;
      $attribute->attribute_long = $request->attribute_long;
      $attribute->attribute_human_id = $next_human_id;
      $attribute->save();
      return back();
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('attribute::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('attribute::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }
}
