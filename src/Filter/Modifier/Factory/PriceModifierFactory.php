<?php


namespace App\Filter\Modifier\Factory;


use App\Filter\Modifier\PriceModifierInterface;
use Symfony\Component\VarExporter\Exception\ClassNotFoundException;

class PriceModifierFactory implements PriceModifierFactoryInterface
{

    public function create(string $modifierType): PriceModifierInterface
    {
        $modifierClassBaseName = str_replace('_', '', ucwords($modifierType, '_'));
        $modifierName = self::PRICE_MODIFIER_NAMESPACE . $modifierClassBaseName;
        if (!class_exists($modifierName)) {
            throw new ClassNotFoundException($modifierName);
        }
        return new $modifierName();
    }
}