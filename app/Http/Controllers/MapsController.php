<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Marker;

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
            'lat' => 'required|unique:markers,lat',
            'lng' => 'required|unique:markers,lng',
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
        return response()->json(['success'=> $success], 200, [], JSON_NUMERIC_CHECK);
        
    }

    public function fetchMarkers(Request $request) {

        $markers = Marker::all();
        return response()->json(['markers' => $markers], 200, [], JSON_NUMERIC_CHECK);
    }

    public function updateMarker(Request $request, Marker $marker) {

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
            $error['code'] = 'EDIT_MARKER_ERROR';
            return response()->json(['$error' => $error], 403);
        }
        Marker::whereId($marker->id)->update($data);
        $marker = Marker::find($marker->id);
        $success['marker'] = $marker;
        $success['message'] = 'Successfully updated marker';
        $success['code'] = 'MARKER_UPDATED';
        return response()->json(['success' => $success], 200, [], JSON_NUMERIC_CHECK);
    }

    public function deleteMarker(Request $request, Marker $marker) {

        $marker->delete();
        $markers = Marker::all();
        $success['message'] = 'Successfully deleted a place';
        $success['code'] = 'MARKER_DELETED';
        $success['markers'] = $markers;
        return response()->json(['success' => $success], 200, [], JSON_NUMERIC_CHECK);
    }
}
