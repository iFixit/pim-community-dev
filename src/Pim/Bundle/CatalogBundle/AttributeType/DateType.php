<?php

namespace Pim\Bundle\CatalogBundle\AttributeType;

use Pim\Component\Catalog\AttributeTypes;
use Pim\Component\Catalog\Model\AttributeInterface;

/**
 * Date attribute type
 *
 * @author    Filips Alpe <filips@akeneo.com>
 * @copyright 2013 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class DateType extends AbstractAttributeType
{
    /**
     * {@inheritdoc}
     */
    protected function defineCustomAttributeProperties(AttributeInterface $attribute)
    {
        $properties = parent::defineCustomAttributeProperties($attribute) + [
            'dateMin' => [
                'name'      => 'dateMin',
                'fieldType' => 'pim_date',
                'options'   => [
                    'widget' => 'single_text'
                ]
            ],
            'dateMax' => [
                'name'      => 'dateMax',
                'fieldType' => 'pim_date',
                'options'   => [
                    'widget' => 'single_text'
                ]
            ]
        ];

        return $properties;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return AttributeTypes::DATE;
    }
}
