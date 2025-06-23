<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\GroupApplication;
use App\Models\Notification;

class InstitutionGroupApplicationController extends Controller
{
    // GET /api/institution/group-applications
    public function index()
    {
        $inst = Auth::user();
        if(!$inst) return response()->json(['error'=>'Unauth'],401);
        $apps = GroupApplication::with('members.user')->where('institution_id',$inst->id)->orderBy('created_at','desc')->get();
        return response()->json($apps);
    }

    // PUT /api/institution/group-applications/{id}
    public function update(Request $request,$id)
    {
        $inst = Auth::user();
        if(!$inst) return response()->json(['error'=>'Unauth'],401);
        $app = GroupApplication::with('members')->where('id',$id)->where('institution_id',$inst->id)->firstOrFail();
        $validated=$request->validate(['status'=>'required|in:pending,approved,rejected']);
        $prevStatus=$app->status;
        $app->update($validated);

        if($prevStatus!==$validated['status']){
            $msg = match($validated['status']){
                'approved' => "Ваша командная заявка на мероприятие '{$app->event->event_name}' одобрена.",
                'rejected' => "Ваша командная заявка на мероприятие '{$app->event->event_name}' отклонена.",
                default => null
            };
            if($msg){
                foreach($app->members as $member){
                    Notification::create([
                        'user_id'=>$member->user_id,
                        'event_id'=>$app->event_id,
                        'message'=>$msg,
                    ]);
                }
            }
        }
        return response()->json($app);
    }
} 