<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class RunAutomation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'automation:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run the Playwright automation script';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting automation...');

        $scriptPath = base_path('automation/run-test.cjs');
        
        // Ensure node is available. Using 'node' assumes it is in the PATH of the process running PHP.
        // We execute from base_path so that relative paths in the script resolve correctly.
        $result = Process::path(base_path())
            ->timeout(3600)
            ->run(['node', $scriptPath]);

        if ($result->successful()) {
            $this->info('Automation finished successfully.');
            $this->line($result->output());
            return 0;
        } else {
            $this->error('Automation failed.');
            $this->line($result->output());
            $this->error($result->errorOutput());
            return 1;
        }
    }
}
