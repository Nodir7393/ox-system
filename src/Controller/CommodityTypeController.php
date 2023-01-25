<?php

namespace App\Controller;

use App\Entity\CommodityType;
use App\Form\CommodityTypeType;
use App\Repository\CommodityTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/commodity-type')]
class CommodityTypeController extends AbstractController
{
    #[Route('/', name: 'app_commodity_type_index', methods: ['GET'])]
    public function index(CommodityTypeRepository $commodityTypeRepository): Response
    {
        return $this->render('commodity_type/index.html.twig', [
            'commodity_types' => $commodityTypeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_commodity_type_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommodityTypeRepository $commodityTypeRepository): Response
    {
        $commodityType = new CommodityType();
        $form = $this->createForm(CommodityTypeType::class, $commodityType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commodityTypeRepository->save($commodityType, true);

            return $this->redirectToRoute('app_commodity_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commodity_type/new.html.twig', [
            'commodity_type' => $commodityType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commodity_type_show', methods: ['GET'])]
    public function show(CommodityType $commodityType): Response
    {
        return $this->render('commodity_type/show.html.twig', [
            'commodity_type' => $commodityType,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_commodity_type_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CommodityType $commodityType, CommodityTypeRepository $commodityTypeRepository): Response
    {
        $form = $this->createForm(CommodityTypeType::class, $commodityType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $commodityTypeRepository->save($commodityType, true);

            return $this->redirectToRoute('app_commodity_type_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('commodity_type/edit.html.twig', [
            'commodity_type' => $commodityType,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_commodity_type_delete', methods: ['POST'])]
    public function delete(Request $request, CommodityType $commodityType, CommodityTypeRepository $commodityTypeRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$commodityType->getId(), $request->request->get('_token'))) {
            $commodityTypeRepository->remove($commodityType, true);
        }

        return $this->redirectToRoute('app_commodity_type_index', [], Response::HTTP_SEE_OTHER);
    }
}
