<?php
namespace Application\Service;

use Application\Entity\Book;
use Application\Entity\Author;
use Laminas\Filter\StaticFilter;

class BookManager
{
    /**
     * Doctrine entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    private $entityManager;

    public function __construct($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function addNewBook($data)
    {
        $book = new Book();
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $currentDate = date('Y-m-d H:i:s');
        $book->setDateCreated($currentDate);
        $author = $this->entityManager->getRepository(Author::class)
            ->findOneByName($data['author']);
        $book -> setAuthor($author);

        $this->entityManager->persist($book);




        $this->entityManager->flush();
    }

    public function getAuthorName($book)
    {
        $author= $book->getAuthor();
        $authorName = $author-> getName();

        return $authorName;
    }


    public function updateBook($book, $data)
    {
        $book->setTitle($data['title']);
        $book->setDescription($data['description']);
        $author = $this->entityManager->getRepository(Author::class)
            ->findOneByName($data['author']);
        $book -> setAuthor($author);

        $this->entityManager->flush();
    }

        public function removeBook($book)
    {

      $this->entityManager->remove($book);

      $this->entityManager->flush();
    }

}
