<?php

namespace Kenyalang\DiskMonitor\Tests\Feature;

use Illuminate\Support\Facades\Storage;
use Kenyalang\DiskMonitor\Console\RecordDiskMetricsCommand;
use Kenyalang\DiskMonitor\DiskMonitorEntry;
use Kenyalang\DiskMonitor\Tests\TestCase;

class RecordDiskMetricsCommandTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('local');
    }

    public function test_can_record_file_count_for_a_disk()
    {
        Storage::disk('local')->put('test.txt', 'test');

        $this
            ->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(1, DiskMonitorEntry::get());

        $entry = DiskMonitorEntry::last();

        $this->assertEquals(1, $entry->file_count);
    }
}