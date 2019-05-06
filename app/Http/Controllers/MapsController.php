<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;

class MapsController extends Controller
{
    //
    public function storeMarker(Request $request) {

        if ($request->isJson()){
            $data = $request->json()->all();
        }else{
            $data = $request->all();
        }
        $rules = [
            'lat' => 'required',
            'lng' => 'required',
            'title' => 'required'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $error['message'] = $errors[0];
            $error['code'] = 'SAVE_MARKER_ERROR';
            return response()->json(['$error' => $error], 403);
        }
        
        $marker = Marker::create($data);
        $success['marker'] = $marker;
        $success['message'] = 'Successfully saved marker';
        $success['code'] = 'MARKER_SAVED';
        return response()->json(['success'=> $success], 200);
        
    }
}
