<?php


namespace App\EventSubscriber;


use App\Event\AfterDtoCreatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class DtoSubscriber implements EventSubscriberInterface
{

    /**
     * DtoSubscriber constructor.
     */
    public function __construct(private ValidatorInterface $validator)
    {
    }

    public static function getSubscribedEvents(): array
    {
        return [
             AfterDtoCreatedEvent::NAME =>
                ['validateDto', 100]
        ];
    }

    public function validateDto(AfterDtoCreatedEvent $event):void {
        $dto = $event->getDto();
        $errors = $this->validator->validate($dto);
        if (count($errors) > 0) {
            throw new ValidationFailedException('Validation Falied', $errors);
        }
    }
}