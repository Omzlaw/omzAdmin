<?php

use Carbon\Carbon;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

if (!function_exists('create_activity')) {
    function create_activity($type, $model)
    {
        $user = Auth::user();
        $activity_log = ActivityLog::create([
            'time' => Carbon::now(),
            'type' => $type,
            'activity_by' => $user->id,
            'description' => 'Activity on ' . $model . ' table',
        ]);
    }
}