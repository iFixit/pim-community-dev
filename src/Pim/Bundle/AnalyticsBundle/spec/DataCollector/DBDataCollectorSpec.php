<?php

namespace spec\Pim\Bundle\AnalyticsBundle\DataCollector;

use PhpSpec\ObjectBehavior;
use Pim\Component\CatalogVolumeMonitoring\Volume\Query\AverageMaxQuery;
use Pim\Component\CatalogVolumeMonitoring\Volume\Query\CountQuery;
use Pim\Component\CatalogVolumeMonitoring\Volume\ReadModel\AverageMaxVolumes;
use Pim\Component\CatalogVolumeMonitoring\Volume\ReadModel\CountVolume;

class DBDataCollectorSpec extends ObjectBehavior
{
    function let(
        CountQuery        $channelCountQuery,
        CountQuery        $productCountQuery,
        CountQuery        $localeCountQuery,
        CountQuery        $familyCountQuery,
        CountQuery        $userCountQuery,
        CountQuery        $productModelCountQuery,
        CountQuery        $variantProductCountQuery,
        CountQuery        $categoryCountQuery,
        CountQuery        $categoryTreeCountQuery,
        AverageMaxQuery   $categoriesInOneCategoryAverageMax,
        AverageMaxQuery   $categoryLevelsAverageMax,
        CountQuery        $productValueCountQuery,
        AverageMaxQuery   $productValueAverageMaxQuery
    ) {
        $this->beConstructedWith(
            $channelCountQuery,
            $productCountQuery,
            $localeCountQuery,
            $familyCountQuery,
            $userCountQuery,
            $productModelCountQuery,
            $variantProductCountQuery,
            $categoryCountQuery,
            $categoryTreeCountQuery,
            $categoriesInOneCategoryAverageMax,
            $categoryLevelsAverageMax,
            $productValueCountQuery,
            $productValueAverageMaxQuery
        );
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Pim\Bundle\AnalyticsBundle\DataCollector\DBDataCollector');
        $this->shouldHaveType('Akeneo\Component\Analytics\DataCollectorInterface');
    }

    function it_collects_database_statistics(
        $channelCountQuery,
        $productCountQuery,
        $localeCountQuery,
        $familyCountQuery,
        $userCountQuery,
        $productModelCountQuery,
        $variantProductCountQuery,
        $categoryCountQuery,
        $categoryTreeCountQuery,
        $categoriesInOneCategoryAverageMax,
        $categoryLevelsAverageMax,
        $productValueCountQuery,
        $productValueAverageMaxQuery
    ) {
        $channelCountQuery->fetch()->willReturn(new CountVolume(3, -1, 'count_channels'));
        $productCountQuery->fetch()->willReturn(new CountVolume(1121, -1, 'count_products'));
        $localeCountQuery->fetch()->willReturn(new CountVolume(3, -1, 'count_locales'));
        $familyCountQuery->fetch()->willReturn(new CountVolume(14, -1, 'count_families'));
        $userCountQuery->fetch()->willReturn(new CountVolume(5, -1, 'count_users'));
        $productModelCountQuery->fetch()->willReturn(new CountVolume(123, -1, 'count_product_models'));
        $variantProductCountQuery->fetch()->willReturn(new CountVolume(89, -1, 'count_variant_products'));
        $categoryCountQuery->fetch()->willReturn(new CountVolume(250, -1, 'count_categories'));
        $categoryTreeCountQuery->fetch()->willReturn(new CountVolume(3, -1, 'count_category_trees'));
        $categoriesInOneCategoryAverageMax->fetch()->willReturn(new AverageMaxVolumes(25,2, -1, 'average_max_categories_in_one_category'));
        $categoryLevelsAverageMax->fetch()->willReturn(new AverageMaxVolumes(6, 4, -1, 'average_max_category_levels'));
        $productValueCountQuery->fetch()->willReturn(new CountVolume(254897, -1, 'count_product_values'));
        $productValueAverageMaxQuery->fetch()->willReturn(new AverageMaxVolumes(8,7, -1, 'average_max_product_values'));

        $this->collect()->shouldReturn(
            [
                "nb_channels"           => 3,
                "nb_locales"            => 3,
                "nb_products"           => 1121,
                'nb_product_models'     => 123,
                'nb_variant_products'   => 89,
                "nb_families"           => 14,
                "nb_users"              => 5,
                'nb_categories'         => 250,
                'nb_category_trees'     => 3,
                'max_category_in_one_category'   => 25,
                'max_category_levels'   => 6,
                'nb_product_values'     => 254897,
                'avg_product_values_by_product' => 7
            ]
        );
    }
}
