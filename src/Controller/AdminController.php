<?php

namespace App\Controller;

use App\Entity\Author;
use App\Entity\Post;
use App\Form\AuthorType;
use App\Form\EntryType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/admin")
 * Class AdminController
 * @package App\Controller
 */
class AdminController extends Controller
{

    private $entityManager;

    private $authorRepository;

    private $postRepository;

    public function __construct(EntityManagerInterface $entityManager)
    {

        $this->entityManager = $entityManager;
        $this->postRepository = $entityManager->getRepository('App:Post');
        $this->authorRepository = $entityManager->getRepository('App:Author');
    }

    /**
     * @Route("/author/create", name="author_create")
     */
    public function createAuthor(Request $request)
    {
        if ($this->authorRepository->findOneByUsername($this->getUser()->getUsername())) {

            $this->addFlash('error', 'Unable to create author, author already exist');

            return $this->redirectToRoute('home');
        }

        $author = new Author();
        $author->setUsername($this->getUser()->getUsername());

        $form = $this->createForm(AuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($author);
            $this->entityManager->flush($author);

            $request->getSession()->set('user_is_author', true);
            $this->addFlash('success', 'Congratulations! You are now an author.');

            return $this->redirectToRoute('home');
        }

        return $this->render('admin/create_author.html.twig', [
           'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/create-entry", name="admin_create_entry")
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function createEntryAction(Request $request)
    {
        $blogPost = new Post();

        $author = $this->authorRepository->findOneByUsername($this->getUser()->getUserName());
        $blogPost->setAuthor($author);
        $blogPost->setCreatedAt(new \DateTime());

        $form = $this->createForm(EntryType::class, $blogPost);
        $form->handleRequest($request);

        // Check is valid
        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($blogPost);
            $this->entityManager->flush($blogPost);

            $this->addFlash('success', 'Congratulations! Your post is created');

            return $this->redirectToRoute('admin_entries');
        }

        return $this->render('admin/entry_form.html.twig', [
            'form' => $form->createView()
        ]);
    }


    /**
     *
     * @Route("/", name="admin_index")
     * @Route("/entries", name="admin_entries")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Doctrine\ORM\ORMException
     */
    public function entriesAction()
    {
        $author = $this->authorRepository->findOneByUsername($this->getUser()->getUserName());

        $blogPosts = [];

        if ($author) {
            $blogPosts = $this->postRepository->findByAuthor($author);
        }

        return $this->render('admin/entries.html.twig', [
            'blogPosts' => $blogPosts
        ]);
    }



    /**
     * @Route("/delete-entry/{entryId}", name="admin_delete_entry")
     * @param $entryId
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteEntryAction($entryId)
    {
        $blogPost = $this->postRepository->findOneById($entryId);
        $author = $this->authorRepository->findOneByUsername($this->getUser()->getUserName());

        if (!$blogPost || $author !== $blogPost->getAuthor()) {
            $this->addFlash('error', 'Unable to remove entry!');

            return $this->redirectToRoute('admin_entries');
        }

        $this->entityManager->remove($blogPost);
        $this->entityManager->flush();

        $this->addFlash('success', 'Entry was deleted!');

        return $this->redirectToRoute('admin_entries');
    }
}
