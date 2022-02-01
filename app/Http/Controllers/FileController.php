<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\City;
use App\Models\Client;
use App\Models\ClientState;
use App\Models\File;
use App\Models\Hub;
use App\Models\HubLoc;
use App\Models\Lob;
use App\Models\Location;
use App\Models\LookUp;
use App\Models\State;
use App\Models\SubLob;
use App\Models\User;
use App\Models\UserClient;
use App\Models\UserFiles;
use App\Models\UserLoc;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;
        $filter = "";
        session()->forget('indexReassign');

        if ($request->has('q') != null) {
            $q = $request->query('q');
        }

        if ($request->query('filter') != null) {
            $q = $request->query('filter');
        }

        $auth_user_id = Auth::user()->id;

        $role = $this->roles($auth_user_id);

        $status = $this->actionStatus($role);

        if (empty($status)) {
            $status = [0, 0];
        }

        if ($role == "Administrator" || $role == "CRM") {

            if ($request->query('filter') != null) {
                $files = $this->indexFilter($q);
            } else {
                $files = $this->indexQueryFilter($q);
            }
        } else if ($role == "Assignor") {

            $status = $this->actionStatus($role);

            if ($q == null) {
                $q = $status[0];
            }

            $files = $this->indexFilter($q);

            $location = "";
            $users = $this->fieldusers($location);


            return view('files.index')->with([
                'files' => $files,
                'users' => $users,
                'role' => $role
            ]);
        } else {
            $files = $this->indexUserFilter($auth_user_id, $status, $q);
        }

        $filestatuses = LookUp::where('type', 'File Status')->get();

        return view('files.index')->with([
            'files' => $files,
            'filter' => $filter,
            'filestatuses' => $filestatuses,
            'role' => $role
        ]);
    }



    public function indexReassign(Request $request)
    {


        session(['indexReassign' => 1]);
        $q = null;
        $filter = "";

        $auth_user_id = Auth::user()->id;



        $role = $this->roles($auth_user_id);


        if ($request->has('q') != null) {
            $q = $request->query('q');
        }

        if ($request->query('filter') != null) {
            $q = $request->query('filter');
        }

        $files = File::whereIn('filestatusid', [64, 67])->paginate(10);


        $filestatuses = LookUp::where('type', 'File Status')->get();


        return view('files.reassignfile')->with([
            'files' => $files,
            'filter' => $filter,
            'filestatuses' => $filestatuses,
            'role' => $role
        ]);
    }


    public function indexQueryFilter($q)
    {
        $files = File::SearchFiles($q)->paginate(10);
        return $files;
    }

    public function indexFilter($q)
    {
        $files = File::where('filestatusid', $q)->paginate(10);
        return $files;
    }

    public function roles($auth_user_id)
    {
        $auth_user_role = UserRole::where('usersid', $auth_user_id)->first();

        if (empty($auth_user_role)) {
            return redirect('/home')->withErrors('You have not map with user role. Please contact the Admin');
        }

        return $auth_user_role->roles->name;
    }

    public function indexUserFilter($userid, $filestatuses, $q)
    {
        $fileid = UserFiles::select(['fileid'])
            ->where('userid', $userid)
            ->get();

        $files = File::whereIn('id', $fileid)
            ->where('filestatusid', $filestatuses[0])
            ->SearchFiles($q)
            ->paginate(10);


        return $files;
    }

    public function fieldusers($location)
    {
        $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
            ->whereIn('usersrole.roleid', [5, 6, 7])
            ->where('userloc.locationid', $location)->get();

        return $users;
    }


    public function processorusers($clientid)
    {
        // $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
        //     ->whereIn('usersrole.roleid', [3])
        //     ->where('userloc.locationid', $location)->get();
        // return $users;

        $users = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 3)
            ->where('userclient.clientid', $clientid)
            ->distinct(['userclient.userid'])
            ->get();
        return $users;
    }
    public function qcusers($clientid)
    {
        // $users = UserLoc::join('usersrole', 'userloc.usersid', '=', 'usersrole.usersid')
        //     ->whereIn('usersrole.roleid', [4])
        //     ->where('userloc.locationid', $location)->get();
        // return $users;

        $users = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $clientid)
            ->distinct(['userclient.userid'])
            ->get();

        return $users;
    }




    public function lockFile($fileid, $userid)
    {
        $userfile = UserFiles::where('fileid', [$fileid])
            ->where('status', 1)
            ->get();

        if (!empty($userfile[0]->fileid)) {
            return 1;
        }


        $userfile = UserFiles::where('fileid', [$fileid])
            ->where('userid', $userid)
            ->first();

        $userfile->status = 1;
        $userfile->save();

        return 0;
    }


    public function lockReleaseFile($fileid, $userid)
    {
        $userfile = UserFiles::where('fileid', [$fileid])
            ->where('userid', $userid)
            ->first();

        $userfile->status = 0;
        $userfile->save();
    }

    public function returnStatus($roleName)
    {
        $status = "";

        switch (trim($roleName)) {
            case ('CVO'):
                $status = "51";
                return $status;
                break;
            case ('TVO'):
                $status = "51";
                return $status;
                break;
            case ('Vendor'):
                $status = "51";
                return $status;
                break;
            case ('Processor'):
                $status = "64";
                return $status;
                break;
            case ('QC'):
                $status = "67";
                return $status;
                break;
            default:
        }
    }

    public function actionStatus($roleName)
    {
        $currentstatus = "";
        $newstatus = "";

        switch (trim($roleName)) {
            case ('CRM'):
                $currentstatus = "47";
                $newstatus = "47";
                return [$currentstatus, $newstatus];
                break;
            case ('Assignor'):
                $currentstatus = "47";
                $newstatus = "50";
                return [$currentstatus, $newstatus];
                break;
            case ('CVO'):
                $currentstatus = "50";
                $newstatus = "61";
                return [$currentstatus, $newstatus];
                break;
            case ('TVO'):
                $currentstatus = "50";
                $newstatus = "61";
                return [$currentstatus, $newstatus];
                break;
            case ('Vendor'):
                $currentstatus = "50";
                $newstatus = "61";
                return [$currentstatus, $newstatus];
                break;
            case ('Processor'):
                $currentstatus = "61";
                $newstatus = "63";
                return [$currentstatus, $newstatus];
                break;
            case ('QC'):
                $currentstatus = "63";
                $newstatus = "66";
                return [$currentstatus, $newstatus];
                break;
                // case ('SPOC'):
                //     $currentstatus = "49";
                //     $newstatus = "50";
                //     return [$currentstatus, $newstatus];
                //     break;
            case ('Administrator'):
                $currentstatus = "0";
                $newstatus = "0";
                break;
            default:
        }
    }


    public function createcaseclient()
    {
        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = State::all()->sortBy("name");
        $hubs = Hub::all()->sortBy("name");


        return view('files.createcaseclient')->with([
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'hubs' => $hubs,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
        ]);
    }

    public function createcase(Request $request, File $file)
    {
        $file->clientid = $request->clientid;
        $file->hubid = $request->hubid;
        $file->typeid = $request->typeid;
        $file->stateid = $request->stateid;
        $file->cityid = $request->cityid;
        $file->locationid = $request->locationid;

        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = State::all()->sortBy("name");
        $hubs = Hub::all()->sortBy("name");
        $relations = LookUp::where('type', 'Relation')
            ->get()->sortBy("tag");
        $newcase = 0;
        return view('files.createcase')->with([
            'file' => $file,
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'hubs' => $hubs,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'relations' => $relations,
            'newcase' => $newcase,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all()->sortBy("name");
        $lobs = Lob::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $users = User::all()->sortBy("name");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = ClientState::select('stateid')->distinct()->get()->sortBy("states.name");
        $hubs = Hub::all()->sortBy("name");
        $relations = LookUp::where('type', 'Relation')
            ->get()->sortBy("tag");
        $newcase = 0;

        return view('files.create')->with([
            'clients' => $clients,
            'lobs' => $lobs,
            'sublobs' => $sublobs,
            'hubs' => $hubs,
            'relations' => $relations,
            'users' => $users,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'newcase' => $newcase,
        ]);
    }

    public function storecase(FileRequest $filerequest, File $file, Request $request)
    {
        // $filerequest->validated();

        // $request->newcase;


        $file->fill($filerequest->all());

        // $hubloc = HubLoc::where('locationid', $file->locationid)->first();

        // if (empty($hubloc)) {
        //     return redirect('/home')->withErrors('Your location is not map with hub. Please contact the Admin');
        // }





        $file->filestatusid = 47;
        // $file->hubid = $hubloc->hubid;
        $file->status = 1;
        $file->dtcr = now();
        $file->crby = Auth::user()->id;
        $file->dtlm = now();
        $file->lmby = Auth::user()->id;
        $file->save();


        $processor = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 3)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();
        // ->get(['userclient.userid']);

        // if (empty($processor->userid)) {
        //     return redirect('/home')->withErrors('Your Processor is not map with client. Please contact the Admin');
        // }

        if (!empty($processor->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $processor->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        $qc = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();
        // ->get(['userclient.userid']);

        // if (empty($qc->userid)) {
        //     return redirect('/home')->withErrors('Your QC is not map with client. Please contact the Admin');
        // }

        if (!empty($qc->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $qc->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        return redirect()
            ->route('files.index')
            ->withSuccess("New Case with id {$file->id} was created");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FileRequest $request, File $file)
    {

        $request->validated();

        $file->fill($request->except('lobid'));

        // $hubloc = HubLoc::where('locationid', $file->locationid)->first();

        // if (empty($hubloc)) {
        //     return redirect('/home')->withErrors('Your location is not map with hub. Please contact the Admin');
        // }





        $file->filestatusid = 47;
        // $file->hubid = $hubloc->hubid;
        $file->status = 1;
        $file->dtcr = now();
        $file->crby = Auth::user()->id;
        $file->dtlm = now();
        $file->lmby = Auth::user()->id;
        $file->save();










        $processor = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 3)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();
        // ->get(['userclient.userid']);

        // if (empty($processor->userid)) {
        //     return redirect('/home')->withErrors('Your Processor is not map with client. Please contact the Admin');
        // }

        if (!empty($processor->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $processor->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        $qc = UserClient::join('usersrole', 'userclient.userid', '=', 'usersrole.usersid')
            ->where('usersrole.roleid', 4)
            ->where('userclient.clientid', $file->clientid)
            ->distinct(['userclient.userid'])
            ->first();
        // ->get(['userclient.userid']);

        // if (empty($qc->userid)) {
        //     return redirect('/home')->withErrors('Your QC is not map with client. Please contact the Admin');
        // }

        if (!empty($qc->userid)) {
            $userfile = new UserFiles();
            $userfile->fileid = $file->id;
            $userfile->userid = $qc->userid;
            $userfile->status = 0;
            $userfile->dtcr = now();
            $userfile->crby = Auth::user()->id;
            $userfile->dtlm = now();
            $userfile->lmby = Auth::user()->id;
            $userfile->save();
        }

        return redirect()
            ->route('files.index')
            ->withSuccess("New Case with id {$file->id} was created");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        $clients = Client::all()->sortBy("name");
        $sublobs = SubLob::all()->sortBy("type");
        $users = User::all()->sortBy("name");
        $locations = Location::all()->sortBy("name");
        $cities = City::all()->sortBy("name");
        $states = State::all()->sortBy("name");

        return view('files.edit')->with([
            'clients' => $clients,
            'sublobs' => $sublobs,
            'users' => $users,
            'locations' => $locations,
            'cities' => $cities,
            'states' => $states,
            'file' => $file,
        ]);
    }

    public function assignfile(File $file, Request $request)
    {
        $fileid = $request->id;

        $file = File::find($fileid);


        if ($file->filestatusid == 47 || $file->filestatusid == 51) {
            $users = $this->fieldusers($file->locationid);
        } else if ($file->filestatusid == 61 || $file->filestatusid == 62 || $file->filestatusid == 64) {
            $users = $this->processorusers($file->clientid);
        } else {
            $users = $this->qcusers($file->clientid);
        }

        return view('files.assignfile')->with([
            'users' => $users,
            'file' => $file,
        ]);
    }

    public function updateassignfile(Request $request)
    {
        $filteruser = $request->input('filteruser');
        $fileid = $request->input('getFileId');

        $userfile = new UserFiles();
        $userfile->fileid = $fileid;
        $userfile->userid = $filteruser;
        $userfile->status = 0;
        $userfile->dtcr = now();
        $userfile->crby = Auth::user()->id;
        $userfile->dtlm = now();
        $userfile->lmby = Auth::user()->id;
        $userfile->save();

        $file = File::find($fileid);


        if ($file->filestatusid == 47 || $file->filestatusid == 51) {
            $file->filestatusid = 50;
        } else if ($file->filestatusid == 61 || $file->filestatusid == 62 || $file->filestatusid == 64) {
            $file->filestatusid = 61;
        } else {
            $file->filestatusid = 63;
        }

        $file->save();

        $indexReassign =  session()->get('indexReassign');

        if ($indexReassign == 1) {
            session()->forget('indexReassign');
            return redirect()
                ->route('files.reassignfile')
                ->withSuccess("The Case with id {$fileid} was Re-Assigned  to {$userfile->users->name}");
        } else {
            return redirect()
                ->route('files.index')
                ->withSuccess("The Case with id {$fileid} was assigned  to {$userfile->users->name}");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(FileRequest $request, File $file)
    {
        $request->validated();

        $file->fill($request->all());
        $file->dtlm = now();
        $file->lmby = Auth::user()->id;
        $file->save();

        return redirect()
            ->route('files.index')
            ->withSuccess("The Case with id {$file->id} was updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\File  $file
     * @return \Illuminate\Http\Response
     */
    public function destroy(File $file)
    {
        //
    }
}
