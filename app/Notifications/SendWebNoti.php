<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use NotificationChannels\WebPush\WebPushMessage;
use NotificationChannels\WebPush\WebPushChannel;
class SendWebNoti extends Notification
{
    use Queueable;

    public $title,$icon, $body;

     
    public function __construct($title, $body,$icon,$action)
    {
        //
        $this->title = $title;
        $this->body = $body;
        $this->icon = $icon;
        $this->action = $action;
    }

    public function via($notifiable)
    {
        return [WebPushChannel::class];
    }
    public function toWebPush($notifiable, $notification)
    {

        return (new WebPushMessage)
        ->title($this->title)
        ->icon(url($this->icon))
        ->body($this->body)
        ->action('مشاهدة الوظيفة',$this->action);
    
    }
    
}

