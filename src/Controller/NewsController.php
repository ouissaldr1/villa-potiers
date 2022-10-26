<?php

namespace App\Controller;

use App\Entity\News;
use App\Form\NewsType;
use App\Repository\NewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// #[Route('/admin/dashboard/news')]
class NewsController extends AbstractController
{
    #[Route('/news', name: 'app_blog', methods: ['GET'])]
    public function Blog(NewsRepository $newsRepository): Response
    {
        return $this->render('news/news.html.twig', [
            'news' => $newsRepository->findAll(),
        ]);
    }

    // #[Route('/', name: 'app_news_index', methods: ['GET'])]
    // public function index(NewsRepository $newsRepository): Response
    // {
    //     return $this->render('news/index.html.twig', [
    //         'news' => $newsRepository->findAll(),
    //     ]);
    // }

    // #[Route('/new', name: 'app_news_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, NewsRepository $newsRepository): Response
    // {
    //     $news = new News();
    //     $form = $this->createForm(NewsType::class, $news);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $news->setDate(new \DateTime);
    //         $newsRepository->add($news, true);

    //         return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('news/new.html.twig', [
    //         'news' => $news,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_news_show', methods: ['GET'])]
    // public function show(News $news): Response
    // {
    //     return $this->render('news/show.html.twig', [
    //         'news' => $news,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_news_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, News $news, NewsRepository $newsRepository): Response
    // {
    //     $form = $this->createForm(NewsType::class, $news);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $newsRepository->add($news, true);

    //         return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('news/edit.html.twig', [
    //         'news' => $news,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_news_delete', methods: ['POST'])]
    // public function delete(Request $request, News $news, NewsRepository $newsRepository): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$news->getId(), $request->request->get('_token'))) {
    //         $newsRepository->remove($news, true);
    //     }

    //     return $this->redirectToRoute('app_news_index', [], Response::HTTP_SEE_OTHER);
    // }
}
