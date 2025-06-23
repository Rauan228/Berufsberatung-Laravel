<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Institution;
use App\Models\Specialization;
use App\Models\CollegeSpecialization;
use Illuminate\Support\Facades\DB;

class InstitutionSpecialtyController extends Controller
{
    private function tables($institution)
    {
        return $institution->type === 'college'
            ? ['table' => 'college_institution_specs', 'column' => 'college_specialization_id']
            : ['table' => 'institution_specialties', 'column' => 'university_specialization_id'];
    }

    // GET /api/institution/specialties
    public function index()
    {
        $inst = Auth::user();
        if (!$inst) return response()->json(['error'=>'Unauth'],401);
        $tbl = $this->tables($inst);
        $specialties = DB::table($tbl['table'])
            ->where('institution_id',$inst->id)
            ->get();
        return response()->json($specialties);
    }

    // GET /api/institution/specialties/available
    public function available()
    {
        $inst = Auth::user();
        if (!$inst) return response()->json(['error'=>'Unauth'],401);
        $tbl = $this->tables($inst);
        $attached = DB::table($tbl['table'])->where('institution_id',$inst->id)->pluck($tbl['column']);
        if($inst->type==='college'){
            $list = CollegeSpecialization::whereNotIn('id',$attached)->get();
        }else{
            $list = Specialization::whereNotIn('id',$attached)->get();
        }
        return response()->json($list);
    }

    // POST attach
    public function store(Request $request)
    {
        $inst = Auth::user();
        if (!$inst) return response()->json(['error'=>'Unauth'],401);
        $tbl = $this->tables($inst);
        $validated = $request->validate([
            'specialization_id'=>'required|integer',
            'cost'=>'nullable|numeric',
            'duration'=>'nullable|string'
        ]);
        DB::table($tbl['table'])->insert([
            'institution_id'=>$inst->id,
            $tbl['column']=>$validated['specialization_id'],
            'cost'=>$validated['cost']??null,
            'duration'=>$validated['duration']??null,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
        return response()->json(['message'=>'attached'],201);
    }

    // PUT update pivot row
    public function update(Request $request,$id)
    {
        $inst = Auth::user();
        if(!$inst) return response()->json(['error'=>'Unauth'],401);
        $tbl=$this->tables($inst);
        $validated=$request->validate([
            'cost'=>'nullable|numeric',
            'duration'=>'nullable|string'
        ]);
        DB::table($tbl['table'])
            ->where('institution_id',$inst->id)
            ->where('id',$id)
            ->update(array_merge($validated,['updated_at'=>now()]));
        return response()->json(['message'=>'updated']);
    }

    public function destroy($id)
    {
        $inst = Auth::user();
        if(!$inst) return response()->json(['error'=>'Unauth'],401);
        $tbl=$this->tables($inst);
        DB::table($tbl['table'])->where('institution_id',$inst->id)->where('id',$id)->delete();
        return response()->json(['message'=>'deleted']);
    }
} 