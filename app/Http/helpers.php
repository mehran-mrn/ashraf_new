<?php
/**
 * Created by PhpStorm.
 * User: asus
 * Date: 04/06/2019
 * Time: 08:43 PM
 */

function back_error($request,$errors){
    if ($request->ajax()) {
        $errors_array = ['message'=>"has error",
            "errors"=>$errors];
        return response()->json($errors_array, 404);
    }
    return back()->withErrors($errors);
}

function back_normal($request,$message=null){
    if (!isset($message)){
        $message="Done!";
    }
    if ($request->ajax()) {
        return response()->json(['message' => $message]);
    }
    return back()->with('message', $message);
}