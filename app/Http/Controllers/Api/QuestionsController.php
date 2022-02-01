<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\CaseResponseController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\LookUpController;
use App\Http\Controllers\QuestionsController as ControllersQuestionsController;
use App\Models\CaseResponse;
use App\Models\File;
use App\Models\Questions;
use App\Models\UserClient;
use App\Models\UserFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class QuestionsController extends Controller
{


    //fileid
    public function questionsgroups(Request $request)
    {

        $fields = $request->validate([
            'id' => 'required|integer',
        ]);

        return (new ControllersQuestionsController)->questionsgroups($fields['id']);
    }


    //question groupname
    public function questions(Request $request)
    {
        $fields = $request->validate([
            'groupname' => 'required|string',
        ]);

        return (new ControllersQuestionsController)->questions($fields['groupname']);
    }

    //fileid
    public function lookups(Request $request)
    {
        $fields = $request->validate([
            'id' => 'required|integer',
        ]);
        return (new LookUpController)->lookups($fields['id']);
    }

    //
    public function caseresponse(Request $request)
    {
        $fields = $request->validate([
            'fileid' => 'required|integer',
            'responses' => 'required|array',
        ]);

        $fileid = $fields["fileid"];
        $responses = $fields["responses"];


          $isSave = false;

        foreach ($responses as  $key) {
            foreach ($key as $value) {

                if (isset($value["response"])) {

                    $caseresponses = new CaseResponse();

                    $questions = Questions::where('questionid', $value["questionid"])
                        ->orderBy('questionid')->first();

                    $caseresponses->caseid = $fileid;
                    $caseresponses->questionid = $questions->id;
                    $caseresponses->response = $value["response"];
                    $caseresponses->status = 1;
                    $caseresponses->crby = 1;
                    $caseresponses->dtcr = now();
                    $caseresponses->lmby = 1;
                    $caseresponses->dtlm = now();
                    $caseresponses = caseresponse::create($caseresponses->toArray());

                    if (!empty($caseresponses)) {
                        $isSave = true;
                    }
                }
            }
        }

        if ($isSave) {

            $file = File::findOrFail($fileid);

            $processor = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
                ->where('usersrole.roleid', 3)
                ->where('userclient.clientid', $file->clientid)
                ->distinct(['userclient.userid'])
                ->first();

            if (!empty($processor->userid)) {
                $file->filestatusid = 62;
            } else {
                $file->filestatusid = 61;
            }
$file->save();
            return response()->json("Success", 201);
            
        }
        return response()->json("Fails", 201);
    }






    public function fileupload(Request $request)
    {
        $fields = $request->validate([
            'file' => 'required',             //|mimes:doc,docx,pdf,txt,csv|max:2048',
            'id' => 'required|integer',
        ]);
        
         Log::info('fileupload>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>' . $fields["file"]);

        return (new CaseResponseController)->fileupload($fields["id"], $request);
    }
}
