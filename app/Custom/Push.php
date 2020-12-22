<?php
namespace App\Custom;
use Pusher\Pusher;
class Push
{
    public function __construct()
    {
        $this->middleware('auth');
        }
    public static function newPush(){
        $options = array(
            'cluster' => 'ap2',
            'usTLS' => true
        );
        return new Pusher(
            '0e8a23a77d5e825ac0fc',
            '31895c6c7d3ced73c6bc',
            '1096491', $options
        );
    }

}