<?php
namespace Application\Service;

use Application\Entity\Author;
use Application\Entity\Book;
use Laminas\Filter\StaticFilter;


class AuthorManager
{
  /**
   * @var Doctrine\ORM\EntityManager
   */
  private $entityManager;


  public function __construct($entityManager)
  {
    $this->entityManager = $entityManager;
  }


  public function addNewAuthor($data)
  {

    $author = new Author();
    $author->setName($data['name']);

    $this->entityManager->persist($author);

    $this->entityManager->flush();
  }

  public function updateAuthor($author, $data)
  {
      $author->setName($data['name']);
      $this->entityManager->flush();
  }


}
