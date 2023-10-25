<?php


namespace App\Tests\unit;


use App\DTO\LowestPriceEnquiry;
use App\Event\AfterDtoCreatedEvent;
use App\EventSubscriber\DtoSubscriber;
use App\Service\ServiceException;
use App\Tests\ServiceTestCase;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class DtoSubscriberTest extends ServiceTestCase
{

    public function testEventSubscriptions(): void {
        $this->assertArrayHasKey(AfterDtoCreatedEvent::NAME,DtoSubscriber::getSubscribedEvents());

    }

    public function testValidateDto():void {
        $dto = new LowestPriceEnquiry();
        $dto->setQuantity(-5);
        $event = new AfterDtoCreatedEvent($dto);

        /** @var EventDispatcherInterface $eventDispatcher */
        $eventDispatcher = $this->container->get('debug.event_dispatcher');

        $this->expectException(ServiceException::class);
        $this->expectExceptionMessage('ConstraintViolationList');

        $eventDispatcher = $eventDispatcher->dispatch($event,$event::NAME);
    }
}