<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityLogController extends Controller
{
    public function index(Request $request)
    {
        $q = Activity::query()
            ->with(['causer'])
            ->latest();

        // filter log_name (hr/budget/security/dll)
        if ($request->filled('log_name')) {
            $q->where('log_name', $request->string('log_name'));
        }

        // filter event (created/updated/deleted/custom)
        if ($request->filled('event')) {
            $q->where('event', $request->string('event'));
        }

        // search description / subject type / causer
        if ($request->filled('search')) {
            $search = $request->string('search')->toString();

            $q->where(function ($sub) use ($search) {
                $sub->where('description', 'like', "%{$search}%")
                    ->orWhere('subject_type', 'like', "%{$search}%")
                    ->orWhere('causer_type', 'like', "%{$search}%");
            });
        }

        $logs = $q->paginate(25)->withQueryString();

        // dropdown options
        $logNames = Activity::query()
            ->select('log_name')
            ->whereNotNull('log_name')
            ->distinct()
            ->orderBy('log_name')
            ->pluck('log_name');

        $events = Activity::query()
            ->select('event')
            ->whereNotNull('event')
            ->distinct()
            ->orderBy('event')
            ->pluck('event');

        return view('admin.activity-logs.index', compact('logs', 'logNames', 'events'));
    }
}
