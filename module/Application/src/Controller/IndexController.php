<?php

/**
 * @see       https://github.com/laminas/laminas-mvc-skeleton for the canonical source repository
 * @copyright https://github.com/laminas/laminas-mvc-skeleton/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-mvc-skeleton/blob/master/LICENSE.md New BSD License
 */

declare(strict_types=1);

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Entity\Book;
use Application\Form\BookForm;
use Application\Entity\Author;



class IndexController extends AbstractActionController
{
  /**
   * Entity manager.
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


  public function indexAction()
  {

    $books = $this->entityManager->getRepository(Book::class)
               ->findBy([], ['dateCreated'=>'ASC']);


    return new ViewModel([
        'books' => $books,
        'bookManager' => $this->bookManager
    ]);
  }
}
