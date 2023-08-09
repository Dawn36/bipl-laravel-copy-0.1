<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Goutte\Client;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\RequestOptions;

class CustomGoutteClient extends Client {
    protected function createClient(array $options = [])
    {
        // Create a custom Guzzle client with 'verify' option set to false
        $options['verify'] = false;

        return new GuzzleClient($options);
    }
}
class SbpOvernightRepoFloorRate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sbp:overnight-repo-floor-rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Over night repo floor rate monthly';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $client = new CustomGoutteClient();
// $goutteClient->setClient($guzzleClient);
    
        $website = $client->request('GET', 'https://www.sbp.org.pk/script/rates_main.html');
        $website=$website->filter('td')->each(function ($node) {
            // if ($node->matches('.style53')) {
                // return 'Address is ' . $child->text();
                return $node->text();
                // $arr = explode(" ",$node->text());
                // dump();
            // }
        });
        DB::connection('mysql')->table('sbp_rate')->insert(['rate'=>str_replace("% p.a.","",$website[10]), 'created_at'=>DATE('Y-m-d h:i:s')]);
        //  print_r($website[10]);
    }
}
