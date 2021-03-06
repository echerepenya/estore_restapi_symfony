<?php

declare(strict_types=1);

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Dto\SearchResult;
use App\ApiResource\Search;
use App\Repository\VatRateRepository;

final class SearchService implements DataPersisterInterface 
{
    private $vr;

    public function __construct(VatRateRepository $vr)
    {
        $this->vr = $vr;
    }
        
    public function supports($data): bool
    {
        return $data instanceof Search;
    }

    public function persist($data)
    {
        // here you have access to your request via $data
        $product_id = $data->product_id;
        $locale_iso = $data->locale_iso;
        
        $output = new SearchResult();
        $output->result = $this->vr->getFullList($product_id, $locale_iso);
        
        return $output;
    }

    public function remove($data)
    {
        // this method just need to be presented
    }

}