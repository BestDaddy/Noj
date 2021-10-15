<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SubmissionController extends Controller
{
    public function info(Request $request)
    {
        return response()->json([
            'success' => true,
            'message' => 'Succeed',
            'ret' => array_merge($request->submission->toArray(), [
                'owner' => $request->submission->user->id==auth()->user()->id,
                'lang' => $request->submission->compiler->lang
            ]),
            'err' => []
        ]);
    }

    public function test(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $body['score'] = 10;
        $body['submission_id'] = 95;
        $request = $client->post('http://192.168.1.11:8080/api/v1/compiler/get-result', ['form_params' =>$body]);
        return $request;
    }
}
