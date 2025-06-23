<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\UserApplication;
use App\Models\Notification;
use Illuminate\Http\Request;

class InstitutionApplicationController extends Controller
{
    // GET /api/institution/applications
    public function index()
    {
        $inst = Auth::user();
        if (!$inst) return response()->json(['error'=>'Unauth'],401);
        $apps = UserApplication::whereHas('event', function($q) use ($inst){
            $q->where('institution_id', $inst->id);
        })->with(['user','event'])->orderBy('created_at','desc')->get();
        return response()->json($apps);
    }

    // PUT /api/institution/applications/{id}
    public function update(Request $request, $id)
    {
        $inst = Auth::user();
        if(!$inst) return response()->json(['error'=>'Unauth'],401);
        $app = UserApplication::where('id',$id)->whereHas('event',function($q)use($inst){$q->where('institution_id',$inst->id);})->firstOrFail();
        $validated = $request->validate(['status'=>'required|in:Pending,Accepted,Rejected']);

        $prevStatus = $app->status;
        $app->update($validated);

        // создаём уведомление при изменении статуса (кроме если статус не поменялся)
        if($validated['status'] !== $prevStatus){
            $msg = match($validated['status']){
                'Accepted' => "Ваша заявка на мероприятие '{$app->event->event_name}' принята. Номер билета: {$app->ticket_code}",
                'Rejected' => "Ваша заявка на мероприятие '{$app->event->event_name}' отклонена.",
                default => null
            };
            if($msg){
                Notification::create([
                    'user_id'=>$app->user_id,
                    'event_id'=>$app->event_id,
                    'message'=>$msg,
                ]);
            }
        }
        return response()->json($app);
    }
} 