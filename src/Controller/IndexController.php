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
    
    #[Route('/', name: 'product_list')]
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

}
