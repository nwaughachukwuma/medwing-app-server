<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Stichoza\GoogleTranslate\GoogleTranslate;

class GoogleTranslateController extends Controller
{
    //
    public function translate(Request $request) {

        if ($request->isJson()){
            $data = $request->json()->all();
        }else{
            $data = $request->all();
        }
        $rules = [
            'word' => 'required|max:5000',
            'target' => 'required',
            'source' => 'sometimes'
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            $error['message'] = $errors[0];
            $error['code'] = 'BAD_PARAMETERS';
            return response()->json(['$error' => $error], 403);
        }

        // dd($data);

        // run the translation.
        $tr = new GoogleTranslate($data['target']);
        $translation = $tr->translate($data['word']);

        $success['translation'] = $translation;
        $success['message'] = 'Translation successful';
        $success['code'] = 'OK';
        return response()->json(['data'=> $success], 200, [], JSON_NUMERIC_CHECK);
        
    }
}
