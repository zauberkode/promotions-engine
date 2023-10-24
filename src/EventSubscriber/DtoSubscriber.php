<?php


namespace App\EventSubscriber;


use App\Event\AfterDtoCreatedEvent;
use App\Service\ServiceException;
use App\Service\ServiceExceptionData;
use App\Service\ValidationExceptionData;
use Doctrine\DBAL\Exception\ConstraintViolationException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
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

            $validationExceptionData = new ValidationExceptionData(422, 'ConstraintViolationList', $errors);
            throw new ServiceException($validationExceptionData);
        }
    }
}