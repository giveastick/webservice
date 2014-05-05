<?php
class MainController extends BaseController {
    
    public function getSticks($_nickname, $_group)
    {
        return Response::json(array('nickname'=>$_nickname, 'group'=>$_group));
    }
    
    public function postStick()
    {
        $_giver = Input::get('giver');
        $_receiver = Input::get('receiver');
        
        return Response::json(array('giver'=>$_giver, 'receiver'=>$_receiver));
    }
}