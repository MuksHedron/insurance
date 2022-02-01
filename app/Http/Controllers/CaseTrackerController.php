<?php

namespace App\Http\Controllers;

use App\Models\CaseResponse;
use App\Models\CaseSummary;
use App\Models\CaseTracker;
use App\Models\File;
use App\Models\UserClient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CaseTrackerController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseTracker  $casetracker
     * @return \Illuminate\Http\Response
     */
    public function show(CaseTracker $casetracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CaseTracker  $casetracker
     * @return \Illuminate\Http\Response
     */
    public function edit(CaseTracker $casetracker)
    {
        //
    }



    public function editcasetrackers(CaseResponse $caseresponses, Request $request, CaseSummary $casesummary)
    {
        $fileid = $request->id; 
        $casesummary->summary = (new CaseSummaryController)->casesummarylgv($fileid);

        $caseresponses = CaseResponse::where('caseid', $fileid)->get();

        $auth_user_id = Auth::user()->id;
        // $lock = (new FileController)->lockFile($fileid, $auth_user_id);

        // if ($lock) {
        //     return redirect()
        //         ->route('files.index')
        //         ->withSuccess("The File with id {$fileid} was locked");
        // } else {
        // }


        return view('casetrackers.edit', [
            'caseresponses' => $caseresponses,
            'casesummary' => $casesummary,
            'fileid' => $fileid,
        ]);
    }

    public function updatecasetrackersreturn(Request $request, CaseResponse $caseresponses, File $file)
    {
        $fileid = $request->id;
        $auth_user_id = Auth::user()->id;

        $role = (new FileController)->roles($auth_user_id);

        $status = (new FileController)->returnStatus($role);

        $file = File::find($fileid);
        $file->filestatusid = $status;
        $file->save();
        return redirect()
            ->route('files.index')
            ->withSuccess("The File with id {$fileid} was returned");
    }


    public function updatecasetrackers(Request $request, CaseResponse $caseresponses, File $file)
    {
        $summary = $request->input('summary');

        $auth_user_id = Auth::user()->id;

        $role = (new FileController)->roles($auth_user_id);

        $status = (new FileController)->actionStatus($role);


        $file = File::find($request->id);

        $qc = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();


        if ($file->filestatusid == 61 && empty($qc->userid)) {
            $file->filestatusid = 65;
        } else {
            $file->filestatusid = $status[1];
        }


        $file->save();

        (new FileController)->lockReleaseFile($file->id, $auth_user_id);

        $countcasesummary = CaseSummary::where('caseid', $file->id)->count();
        if ($countcasesummary > 0) {
            $casesummary = CaseSummary::where('caseid', $file->id)->first();
            $casesummary->summary = $summary;
            $casesummary->status = 1;
            $casesummary->dtlm = now();
            $casesummary->lmby =  Auth::user()->id;
            $casesummary->save();
        } else {
            $casesummary = new CaseSummary;
            $casesummary->caseid = $file->id;
            $casesummary->summary = $summary;
            $casesummary->status = 1;
            $casesummary->dtcr = now();
            $casesummary->crby = Auth::user()->id;
            $casesummary->dtlm = now();
            $casesummary->lmby = Auth::user()->id;
            $casesummary->save();
        }

        $casetracker = new CaseTracker();
        $casetracker->fileid = $file->id;
        $casetracker->oldstatus = $status[0];
        $casetracker->newstatus = $file->filestatusid;
        $casetracker->userid = Auth::user()->id;
        $casetracker->updateat = now();
        $casetracker->save();

        return redirect()
            ->route('files.index');
    }



    public function assigncases(Request $request, File $file)
    {
        $userid = $request->input("filteruser");
        $files = $request->input("files");


        dd($userid);
        die;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseTracker  $casetracker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CaseTracker $casetracker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseTracker  $casetracker
     * @return \Illuminate\Http\Response
     */
    public function destroy(CaseTracker $casetracker)
    {
        //
    }
}
