<?php

namespace App\Controller;

use App\Entity\Question;
use App\Form\QuestionType;
use App\Repository\QuestionRepository;
use App\Repository\AnswerRepository;

use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/question')]
class QuestionController extends AbstractController
{
    
    #[Route('/', name: 'question_index', methods: ['GET'])]
    public function index(QuestionRepository $questionRepository,AnswerRepository $answerRepository): Response
    {
        $id = $entityManager=$this->getUser();
        $this->denyAccessUnlessGranted('ROLE_USER');
        return $this->render('question/index.html.twig', [
            'questions' => $questionRepository->findByQuestionByUser2($id),
            'answer' => $answerRepository->findResultByQuestion($id),

        ]);
    }

    

    #[Route('/new', name: 'question_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository): Response
    {
        $id = $entityManager=$this->getUser();
        $question = new Question();
        
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $question->setUserId($userRepository->find($id));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();
           
            return $this->redirectToRoute('answer_new',array('id' => ($question->getId())),307);
        }

        return $this->render('question/new.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'question_show', methods: ['GET'])]
    public function show(Question $question): Response
    {
        return $this->render('question/show.html.twig', [
            'question' => $question,
        ]);
    }

    #[Route('/{id}/edit', name: 'question_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Question $question, UserRepository $userRepository): Response
    {
        $id = $entityManager=$this->getUser();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $question->setUserId($userRepository->find($id));
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('question_index');
        }

        return $this->render('question/edit.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'question_delete', methods: ['POST'])]
    public function delete(Request $request, Question $question): Response
    {
        if ($this->isCsrfTokenValid('delete'.$question->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($question);
            $entityManager->flush();
        }

        return $this->redirectToRoute('question_index');
    }
}
