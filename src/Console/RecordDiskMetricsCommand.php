<?php

namespace Kenyalang\DiskMonitor\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Kenyalang\DiskMonitor\DiskMonitorEntry;

class RecordDiskMetricsCommand extends Command
{
    protected $signature = 'disk-monitor:record-metrics';

    protected $description = 'Record metrics for the intended disk';

    public function handle()
    {
        $this->comment('Command begin ...');

        $diskName = config('disk-monitor.disk_name');

        $fileCount = count(Storage::disk($diskName)->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $fileCount
        ]);

        $this->comment('All done!');
    }
}