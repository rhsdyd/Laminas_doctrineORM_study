<?php

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Form\BookForm;
use Application\Entity\Book;
use Application\Entity\Author;
use Application\Form\AuthorForm;



class AuthorController extends AbstractActionController
{
  /**
   * @var Doctrine\ORM\EntityManager
   */
  private $entityManager;

  /**
   * @var Application\Service\AuthorManager
   */
  private $authorManager;


  public function __construct($entityManager, $authorManager)
  {
      $this->entityManager = $entityManager;
      $this->authorManager = $authorManager;
  }

  public function adminAction()
  {

    $authors = $this->entityManager->getRepository(Author::class)
               ->findAll();


    return new ViewModel([
        'authors' => $authors,
        'authorManager' => $this->authorManager
    ]);
  }
  public function addAction()
  {
      $form = new AuthorForm();

      if ($this->getRequest()->isPost()) {
          $data = $this->params()->fromPost();
          $form->setData($data);
          if ($form->isValid()) {
              $data = $form->getData();
              $this->authorManager->addNewAuthor($data);
              return $this->redirect()->toRoute('authors', ['action' => 'admin']);
          }
      }


      return new ViewModel([
          'form' => $form
      ]);
  }
  public function editAction()
  {
      $form = new AuthorForm();
      $authorId = $this->params()->fromRoute('id', -1);

      $author = $this->entityManager->getRepository(Author::class)
          ->findOneById($authorId);
      if ($author == null) {
          $this->getResponse()->setStatusCode(404);
          return;
      }

      if ($this->getRequest()->isPost()) {
          $data = $this->params()->fromPost();

          $form->setData($data);
          if ($form->isValid()) {
              $data = $form->getData();

              $this->authorManager->updateAuthor($author, $data);

              return $this->redirect()->toRoute('authors', ['action'=>'admin']);
          }
      } else {
          $data = [
              'name' => $author->getName(),
          ];

           $form->setData($data);
      }

      return new ViewModel([
          'form' => $form,
          'author' => $author
      ]);
  }

}
 ?>
