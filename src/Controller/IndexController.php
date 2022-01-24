<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ProductRepository;
use App\Repository\LocaleRepository;
use App\Repository\VatRateRepository;

class IndexController extends AbstractController
{
    
    #[Route('/', name: 'homepage')]
    /**
     * @return Response
     */
    public function productList(ProductRepository $itemsRepository): Response
    {
        $items = $itemsRepository->findAll();

        //dd($items);
        return $this->render('index.html.twig', [
            'title' => 'Product List',
            'items' => $items
        ]);
    }

    
    #[Route('/locale', name: 'locale_list')]
    /**
     * @return Response
     */
    public function localeList(LocaleRepository $itemsRepository): Response
    {
        $items = $itemsRepository->findAll();

        //dd($items);
        return $this->render('locale.html.twig', [
            'title' => 'Locale List',
            'items' => $items
        ]);
    }

    #[Route('/vat', name: 'vat_list')]
    /**
     * @return Response
     */
    public function vatList(VatRateRepository $itemsRepository): Response
    {
        
        $items = $itemsRepository->findAll();

        //dd($items);
        return $this->render('vat.html.twig', [
            'title' => 'VAT Rates',
            'items' => $items
        ]);
    }

    #[Route('/full-list', name: 'fl')]
    /**
     * @return Response
     */
    public function vat_filter(VatRateRepository $itemsRepository): Response
    {
        
        $query_result = $itemsRepository->getFullList();
        //dd($query_result);

        return $this->render('full_list.html.twig', [
            'title' => 'Full list of records',
            'results' => $query_result
        ]);
    }

}
