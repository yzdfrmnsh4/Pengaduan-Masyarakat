<?php

namespace App;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    public function log($action, $description = null)
    {
        ActivityLog::create([
            'user_id' => $this->id_petugas ?? $this->nik,
            'user_type' => $this->level ?? 'masyarakat',
            'action' => $action,
            'description' => $description,
            'ip_address' => Request::ip()
        ]);
    }

    public function loginLog()
    {
        $this->log('login', 'Login pada ' . now()->format('Y-m-d H:i:s'));
    }
}
