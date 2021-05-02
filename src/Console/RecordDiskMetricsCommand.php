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

        collect(config('disk-monitor.disk_names'))
            ->each(fn(string $diskName) => $this->recordDiskEntry($diskName));

        $this->comment('All done!');
    }

    protected function recordDiskEntry(string $diskName): void
    {
        $this->info("Recording metrics for disk `{$diskName}`..");

        $disk = Storage::disk($diskName);

        $fileCount = count($disk->allFiles());

        DiskMonitorEntry::create([
            'disk_name' => $diskName,
            'file_count' => $fileCount
        ]);
    }
}