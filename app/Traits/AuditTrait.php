<?php

namespace App\Traits;

use App\Models\AuditLog;
use Carbon\Carbon;
use Illuminate\Http\Request;

trait AuditTrait
{
   
    public  function createAudit(Request $request, $description, $event_type)
    {
        return AuditLog::create([
            'user_id' => auth()->id(),
            'description' => $description,
            'event_type' => $event_type,
            'entity_id' => auth()->user()->entity->id,
            // 'branch_id' => auth()->user()->branch->id,
            'date' => Carbon::now(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'method' => $request->method(),
        ]);
    }
}
