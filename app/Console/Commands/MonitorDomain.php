<?php

namespace App\Console\Commands;

use App\Models\Operator;
use App\Models\MonitoringLog;
use Illuminate\Console\Command;

class MonitorDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor Operator Domains';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $operators = Operator::all();

        foreach ($operators as $operator) {
            $ip = $operator->website;
            $port = '80';
            $url = $ip . ':' . $port;
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 5);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $data = curl_exec($ch);
            $health = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            if ($health) {
                // $json = json_encode(['health' => $health, 'status' => '1']);
                // return '<p class="text-success">Okay</p>';
                $monitoring_log = MonitoringLog::create([
                    'operator_id' => $operator->id,
                    'operator' => $operator->name,
                    'website' => $operator->website,
                    'status' => 'Up'
                ]);
                $monitoring_log->save();
            } else {
                // $json = json_encode(['health' => $health, 'status' => '0']);
                $monitoring_log = MonitoringLog::create([
                    'operator_id' => $operator->id,
                    'operator' => $operator->name,
                    'website' => $operator->website,
                    'status' => 'Down'
                ]);
                $monitoring_log->save();
            }
        }
    }
}
