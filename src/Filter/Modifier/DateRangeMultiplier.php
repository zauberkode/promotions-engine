<?php


namespace App\Filter\Modifier;

use App\DTO\PromotionEnquiryInterface;
use App\Entity\Promotion;

class DateRangeMultiplier implements PriceModifierInterface
{
    public function modify(int $price, int $quantity, Promotion $promotion, PromotionEnquiryInterface $enquiry): int
    {
        $requestDate = date_create($enquiry->getRequestDate());
        $to = date_create($promotion->getCriteria()['to']);
        $from = date_create($promotion->getCriteria()['from']);

        if (!($requestDate >= $from && $requestDate < $to)) {
            return $price * $quantity;
        }
        return ($price * $quantity) * $promotion->getAdjustment();
    }

}