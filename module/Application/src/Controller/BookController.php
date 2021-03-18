<?php

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Form\BookForm;
use Application\Entity\Book;
use Application\Entity\Author;



class BookController extends AbstractActionController
{
  /**
   * @var Doctrine\ORM\EntityManager
   */
  private $entityManager;

  /**
   * @var Application\Service\BookManager
   */
  private $bookManager;


  public function __construct($entityManager, $bookManager)
  {
      $this->entityManager = $entityManager;
      $this->bookManager = $bookManager;
  }

  public function addAction()
  {
      $form = new BookForm();

      if ($this->getRequest()->isPost()) {


          $data = $this->params()->fromPost();


          $form->setData($data);
          if ($form->isValid()) {


              $data = $form->getData();


              $this->bookManager->addNewBook($data);


              return $this->redirect()->toRoute('application', ['action'=>'index']);
          }
      }


      return new ViewModel([
          'form' => $form
      ]);
    }

  public function editAction()
  {

    $form = new BookForm();


    $bookId = $this->params()->fromRoute('id', -1);

    $book = $this->entityManager->getRepository(book::class)
                ->findOneById($bookId);
    if ($book == null) {
      $this->getResponse()->setStatusCode(404);
      return;
    }
    if ($this->getRequest()->isPost()) {

      $data = $this->params()->fromPost();


      $form->setData($data);
      if ($form->isValid()) {


        $data = $form->getData();

        $this->bookManager->updateBook($book, $data);


        return $this->redirect()->toRoute('application', ['action'=>'index']);
      }
    } else {
      $data = [
               'title' => $book->getTitle(),
               'description' => $book->getDescription(),
               'author' => $this->bookManager->getAuthorName($book)
            ];


      $form->setData($data);
    }

    return new ViewModel([
            'form' => $form,
            'book' => $book
        ]);
      }

    public function deleteAction()
    {
      $bookId = $this->params()->fromRoute('id', -1);

      $book = $this->entityManager->getRepository(Book::class)
                  ->findOneById($bookId);
      if ($book == null) {
        $this->getResponse()->setStatusCode(404);
        return;
      }

      $this->bookManager->removeBook($book);


      return $this->redirect()->toRoute('application', ['action'=>'index']);
    }




}
 ?>
