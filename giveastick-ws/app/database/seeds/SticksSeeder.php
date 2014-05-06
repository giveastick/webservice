<?php
use App\Models\StickLine;

class SticksSeeder extends Seeder {
    
    public function run()
    {
        DB::table('sticklines')->delete();
        
        $dt = \Carbon\Carbon::now()->subWeek();
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Max',
           'credit'         =>  0,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Max',
           'credit'         =>  1,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Max',
           'credit'         =>  1,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Max',
           'credit'         =>  1,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Max',
           'credit'         =>  1,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Alextiti',
           'credit'         =>  0,
           'reseted_at'        =>  $dt->toDateTimeString(),
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Alextiti',
           'credit'         =>  1,
           'reseted_at'        =>  $dt->toDateTimeString(),
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Alextiti',
           'credit'         =>  1,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Alextiti',
           'credit'         =>  1,
        ));
        
        StickLine::create(array(
           'channelTag'     =>  'test1',
           'nickname'       =>  'Alextiti',
           'credit'         =>  1,
        ));
    }
}
