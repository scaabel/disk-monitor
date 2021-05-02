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
        Storage::fake('anotherDisk');

        config()->set('disk-monitor.disk_names', ['local', 'anotherDisk']);
    }

    public function test_can_record_file_count_for_a_single_disk()
    {
        Storage::disk('local')->put('test.txt', 'test');

        $this
            ->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $this->assertCount(1, DiskMonitorEntry::get());

        $entry = DiskMonitorEntry::last();

        $this->assertEquals(1, $entry->file_count);
    }

    public function test_can_record_file_count_for_multiple_disk()
    {
        Storage::disk('local')->put('test.txt', 'test');

        $this
            ->artisan(RecordDiskMetricsCommand::class)
            ->assertExitCode(0);

        $entries = DiskMonitorEntry::get();

        $this->assertCount(2, $entries);

        $this->assertEquals('local', $entries[0]->disk_name);
        $this->assertEquals(1, $entries[0]->file_count);

        $this->assertEquals('anotherDisk', $entries[1]->disk_name);
        $this->assertEquals(0, $entries[1]->file_count);
    }
}