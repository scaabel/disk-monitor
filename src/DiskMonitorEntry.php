<?php

namespace Kenyalang\DiskMonitor;

use Illuminate\Database\Eloquent\Model;

class DiskMonitorEntry extends Model
{
    protected $guarded = [];

    protected $casts = [
        'file_count' => 'integer'
    ];

    public static function last(): ?self
    {
        return self::orderByDesc('id')->first();
    }
}