<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Log activity dengan standar project
     */
    public static function log(
        string $logName,
        string $description,
        ?Model $subject = null,
        array $properties = []
    ): void {
        $activity = activity($logName);

        if ($subject) {
            $activity->performedOn($subject);
        }

        if (Auth::check()) {
            $activity->causedBy(Auth::user());
        }

        $activity->withProperties(array_merge([
            'ip' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ], $properties));

        $activity->log($description);
    }
}

// example usage:
// use App\Support\ActivityLogger;

// ActivityLogger::log(
//     'hr',
//     'Employee created',
//     $employee,
//     ['employee_id' => $employee->id]
// );
