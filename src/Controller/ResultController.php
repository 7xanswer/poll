<?php

namespace App\Controller;

use App\Entity\Result;
use App\Form\ResultType;
use App\Repository\ResultRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/result')]
class ResultController extends AbstractController
{
    #[Route('/', name: 'result_index', methods: ['GET'])]
    public function index(ResultRepository $resultRepository): Response
    {
        return $this->render('result/index.html.twig', [
            'results' => $resultRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'result_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $result = new Result();
        $form = $this->createForm(ResultType::class, $result);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($result);
            $entityManager->flush();

            return $this->redirectToRoute('result_index');
        }

        return $this->render('result/new.html.twig', [
            'result' => $result,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'result_show', methods: ['GET'])]
    public function show(Result $result): Response
    {
        return $this->render('result/show.html.twig', [
            'result' => $result,
        ]);
    }

    #[Route('/{id}/edit', name: 'result_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Result $result): Response
    {
        $form = $this->createForm(ResultType::class, $result);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('result_index');
        }

        return $this->render('result/edit.html.twig', [
            'result' => $result,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'result_delete', methods: ['POST'])]
    public function delete(Request $request, Result $result): Response
    {
        if ($this->isCsrfTokenValid('delete'.$result->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($result);
            $entityManager->flush();
        }

        return $this->redirectToRoute('result_index');
    }
}
