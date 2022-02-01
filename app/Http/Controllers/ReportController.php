<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function reportpolicyno(Request $request)
    {
        $file = new File();

        return view('reports.reportpolicyno')->with([
            'file' => $file,
        ]);
    }


    public function reportpolicy(Request $request, File $file)
    {
        $file = File::where('policyno', $request->policyno)->first();

        $report = (new CaseResponseController)->responsegeneratorlgv($file->id);


        switch (trim($file->clientid)) {
            case (1):
                return view('reports.policyno.reportpolicyicici')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (2):
                return view('reports.policyno.reportpolicymaxlife')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (3):
                return view('reports.policyno.reportpolicysbi')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (4):
                return view('reports.policyno.reportpolicypnb')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (5):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (6):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (6):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (7):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (8):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (9):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (10):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (11):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (12):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            case (13):
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
                break;
            default:
                return view('reports.reportpolicy')->with([
                    'file' => $file,
                    'report' => $report,
                ]);
        }





        return view('reports.reportpolicy')->with([
            'file' => $file,
            'report' => $report,
        ]);
    }
}
