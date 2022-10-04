<?php

namespace Database\Seeders;
use App\Models\Campaign;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class campaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('campaigns')->delete();
        
        $dec_img[] = 'image.png';
        for ($i=1; $i < 6; $i++) {
            Campaign::create([
                'name'=>'camp_'.$i ,
                'from'=> Carbon::now(),
                'to'=> Carbon::tomorrow(),
                'total' => $i*26 ,
                'daily_budget'=> $i*0.05,
                'images' => \json_encode($dec_img) ,
            ]);
        }
    }
}
