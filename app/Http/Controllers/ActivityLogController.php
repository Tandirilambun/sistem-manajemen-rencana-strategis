<?php

namespace App\Http\Controllers;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        $filter = request(['tgl','action']);
        $query = ActivityLog::with('users')
            ->orderBy('created_at', 'desc');
        if($filter){
            $query -> filter($filter);
        }
        $activity_log = $query -> simplePaginate(10);
        return view('Renstra.audit-log', [
            'activity_log' => $activity_log,
            'jenis_activity' => collect(['insert', 'update', 'delete']),
            'old_value' => request('tgl'),
        ]);
    }
}
