<?php
use App\Models\StickLine;

class MainController extends BaseController {
    
    public function getSticks($_nickname, $_group)
    {
        
        $dt = \Carbon\Carbon::now();
        
        $this->_checkUserExistance($_nickname, $_group);

        $sticklist = Stickline::select(array(
            DB::raw('nickname'),
            DB::raw('SUM(credit) AS balance')
        ))
        ->where('channelTag', $_group)
        ->where(function($query)
                {
                    $query  ->where('reseted_at','=',null)
                            ->orWhere('credit','=',0);
                }
        )
        ->groupBy('nickname')
        ->orderBy('balance', 'DESC')
        ->orderBy('nickname')
        ->get();
        
        return Response::json($sticklist);
    }
    
    public function postStick()
    {
        $_giver = Input::get('giver');
        $_receiver = Input::get('receiver');
        $_group = Input::get('channelTag');
        $_coeff = Input::get('coeff', 1);
        
        $this->_checkUserExistance($_giver, $_group);
        $this->_checkUserExistance($_receiver, $_group);
        
        StickLine::create(array(
           'channelTag'     =>  $_group,
           'nickname'       =>  $_receiver,
           'credit'         =>  POST_STICK_CREDIT*$_coeff,
           'giver'          =>  $_giver
        ));
        
        return Response::json(array('giver'=>$_giver, 'receiver'=>$_receiver));
    }
    
    protected function _checkUserExistance($_nickname, $_group)
    { 
        $nbUserSL = DB::table('sticklines')->where('nickname', $_nickname)->where('channelTag', $_group)->count();
        if($nbUserSL < 1)
        {
            Stickline::create(array(
               'nickname'   =>  $_nickname,
               'channelTag' =>  $_group,
               'credit'     =>  0,
            ));
        }
    }
}