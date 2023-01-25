<?php

namespace App\Controller;

use App\Entity\Commodity;
use App\Form\CommodityType;
use App\Repository\CommodityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commodity')]
class CommodityController extends AbstractController
{
    #[Route('/', name: 'app_commodity_index', methods: ['GET'])]
    public function index(CommodityRepository $commodityRepository): Response
    {
        return $this->render('commodity/index.html.twig', [
            'commodities' => $commodityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commodity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommodityRepository $commodityRepository): Response
    {
        $commodity = new Commodity();
        $form = $this->createForm(CommodityType::class, $commodity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commodityRepository->save($commodity, true);

            return $this->redirectToRoute('app_commodity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commodity/new.html.twig', [
            'commodity' => $commodity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commodity_show', methods: ['GET'])]
    public function show(Commodity $commodity): Response
    {
        return $this->render('commodity/show.html.twig', [
            'commodity' => $commodity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commodity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Commodity $commodity, CommodityRepository $commodityRepository): Response
    {
        $form = $this->createForm(CommodityType::class, $commodity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commodityRepository->save($commodity, true);

            return $this->redirectToRoute('app_commodity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commodity/edit.html.twig', [
            'commodity' => $commodity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commodity_delete', methods: ['POST'])]
    public function delete(Request $request, Commodity $commodity, CommodityRepository $commodityRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commodity->getId(), $request->request->get('_token'))) {
            $commodityRepository->remove($commodity, true);
        }

        return $this->redirectToRoute('app_commodity_index', [], Response::HTTP_SEE_OTHER);
    }
}
