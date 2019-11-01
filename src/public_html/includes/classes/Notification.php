<?php
class Notification {
    public static $list = [];
    
    public $title = "";
    public $content = "";
    public $negative = true;

    public function __construct($title, $content, $negative){
        $this->title = $title;
        $this->content = $content;
        $this->negative = $negative;
    }

    public static function addActionNotification($title, $trueContent, $response) {
        if($response===true) {
            $notification = new Notification($title, $trueContent, false);
        } else {
            $notification = new Notification("Atenção", $response, true);
        }
        array_push(self::$list, $notification);
    }
}