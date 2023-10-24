<?php


namespace App\EventSubscriber;


use App\Event\AfterDtoCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class DtoSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            AfterDtoCreatedEvent::NAME => 'validateDto',
        ];
    }

    public function validateDto(AfterDtoCreatedEvent $event):void {

    }
}