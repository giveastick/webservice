<?php
use App\Models\StickLine;

class MainController extends BaseController {
    
    public function getSticks($_nickname, $_group)
    {
        
        $dt = \Carbon\Carbon::now();
        
        $this->_formatString($_nickname, 'nickname');
        $this->_formatString($_group, 'group');
        
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
    
    public function postStick($_group)
    {
        $required = array('giver', 'receiver');
        
        foreach($required as $field)
        {
            if(!Input::has($field))
                App::abort(500, 'Please provide the post input "' . $field . '"'); 
        }

        
        
        $_giver = Input::get('giver');
        $_receiver = Input::get('receiver');
        $_coeff = (int) Input::get('coeff', 1);
        
        $lastQuarter = \Carbon\Carbon::now()->subMinutes(15);
        
        $this->_formatString($_giver, 'nickname');
        $this->_formatString($_receiver, 'nickname');
        $this->_formatString($_group, 'group');
        
        $this->_checkUserExistance($_giver, $_group);
        $this->_checkUserExistance($_receiver, $_group);
        
        $countLastQuarter = Stickline:: where('channelTag', $_group)
                                        ->where('giver', '=', $_giver)
                                        ->where('created_at','>',$lastQuarter->toDateTimeString())
                                        ->whereNotNull('reseted_at')
                                        ->count();
                                        
        if($countLastQuarter > 0)
        {
            $responseArray = array('result'=>false, 'code'=>'alreadyInTimeLimit');
        }
        else
        {
            StickLine::create(array(
                'channelTag'     =>  $_group,
                'nickname'       =>  $_receiver,
                'credit'         =>  1*$_coeff,
                'giver'          =>  $_giver
            ));
            
            $responseArray = array('result'=>true, 'code'=>'ok', 'countLastQuarter'=>$countLastQuarter, 'giver'=>$_giver, 'channelTag'=>$_group, 'created_at'=>$dt->toDateTimeString(), 'countLastQuarter'=>$countLastQuarter);
        }
        
        return Response::json($responseArray);
    }
    
    public function deleteSticks($_group)
    {
        $dt = \Carbon\Carbon::now();
        
        $this->_formatString($_group, 'group');
        
        $sticklines = Stickline::where('channelTag', $_group);
        $sticklines->update(array('reseted_at'=>$dt->toDateTimeString()));
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
    
    protected function _formatString(&$string, $format = null)
    {
        
    }
}