<?php

namespace App\ApiResource;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Action\NotFoundAction;
use ApiPlatform\Core\Annotation\ApiProperty;
use App\Dto\SearchResult;

#[ApiResource(
    itemOperations: [
        "get" => [
            "controller" => NotFoundAction::class,
            "read" => false,
            "output" => false,
        ],
    ],
    output: SearchResult::class
)]
class Search
{
    /**
     * @var int
     * @ApiProperty(identifier=true)
     */
    public $product_id;
    
    /**
     * @var string
     * @ApiProperty(identifier=true)
     */
    public $locale_iso;
}