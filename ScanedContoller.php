<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ExternalContract;
use App\Education;
use App\Title;
use App\TitleList;
use App\WorkContract;
use App\ExternalContractAprovement;
use App\NoneducatorExternal;
use DataTable;
use Storage;

class ScanedContoller extends Controller
{
    public function index(User $user, WorkContract $work){
        
    	$users = User::whereNotNull('type')->get();
    	$educations = \App\Education::all();   
        $extes = \App\ExternalContract::all();
        $title = \App\Title::all();
        $work = \App\WorkContract::all();

    	return view('skenirana.show')->with('users',$users)
    	->with('educations',$educations)
    	->with('extes',$extes)
    	->with('title',$title)
        ->with('work',$work);
    }

    public function download($url) {
        $url = str_replace('*', '/', $url);
        $file= public_path().'/'. $url;
        $url = explode('/', $file);
        return response()->download($file, $url[count($url)-1]);
    }

    public function tabela(){

        $users = User::whereNotNull('type')->get();
        $titles = Title::all();
        $works = WorkContract::all();
        $aprovement = ExternalContractAprovement::all();

        return view('skenirana.index')->with('users',$users)
        ->with('titles',$titles)
        ->with('works',$works)
        ->with('aprovement',$aprovement);
    }
    public function show(User $user, WorkContract $work)
    {
        $users = User::where('id',$user->id)->get();
        $edu = \App\Education::where('user_id',$user->id)->get();   
        $exte = \App\ExternalContract::where('user_id',$user->id)->get();
        $zva = \App\Title::where('user_id',$user->id)->get();
        $none = NoneducatorExternal::with('work_contract_id')->find($work->id);
        $work = WorkContract::where('user_id',$user->id)->get();
        
        return view('skenirana.show1')->with('users',$users)
        ->with('edu',$edu)
        ->with('exte',$exte)
        ->with('work',$work)
        ->with('zva',$zva)
        ->with('none',$none);
    }
    public function trazi(Request $request)
    {
        
        $keyword = $request->input('ime');
        $prezime = $request->input('prezime');
        $tip = $request->input('tip');
        $pozicija = $request->input('status');
        $posao = $request->input('angazovanje');
        $od = $request->input('istekOd');
        $do = $request->input('istekDo');
        $zvanje=$request->input('zvanje');

        $users = User::where('name','LIKE','%'.$keyword.'%')
            ->orWhere('surname','LIKE','%'.$prezime.'%')
            ->orWhere('employee_type','LIKE','%'.$tip.'%')
            ->get();
            $zvanje=Title::where('datum_izbora_u_zvanje','LIKE','%'.$zvanje.'%')
            ->get();
            $works=WorkContract::where('work_position','LIKE','%'.$pozicija.'%')
            ->orWhere('angazovanje','LIKE','%'.$posao.'%')
            ->orWhere('contract_date_expiration','LIKE','%'.$od.'%')
            ->orWhere('contract_date_expiration','LIKE','%'.$do.'%')
            ->orderBy('contract_date_expiration','asc')
            ->get();

        return view('skenirana.index')->with('users',$users)
        ->with('works',$works)
;
    }
}
