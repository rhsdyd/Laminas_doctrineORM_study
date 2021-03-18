## Introduction
this Book module that moves accoring to the CRUD operations has been created with Laminas-mvc-skeleton

## Apply the migrations to database
```
./vendor/bin/doctrine-module migrations:migrate
```


## Setting Data (MySQL)
```MySQL
INSERT INTO author(`name`) VALUES(
  'Fyodor Dostoyevsky');

INSERT INTO author(`name`) VALUES(
  'J. K. Rowling');

INSERT INTO author(`name`) VALUES(
    'Ernest Hemingway');
```

```MySQL

INSERT INTO book(`title`, `description`, `date_created`, `author_id`) VALUES(
  'The Old Man and the Sea',
  'The Old Man and the Sea is a short novel written by the American author Ernest Hemingway in 1951 in Cuba, and published in 1952. It was the last major work of fiction by Hemingway that was published during his lifetime.',
  '2018-02-20 11:35:32',3);

INSERT INTO book(`title`, `description`, `date_created`, `author_id`) VALUES(
  'Harry Potter and the Prisoner of Azkaban',
  'Harry Potter and the Prisoner of Azkaban is a fantasy novel written by British author J.K. Rowling and is the third in the Harry Potter series. The book follows Harry Potter, a young wizard, in his third year at Hogwarts School of Witchcraft and Wizardry.',
  '2019-12-20 10:30:27',2);

INSERT INTO book(`title`, `description`, `date_created`, `author_id`) VALUES(
  'Crime and Punishment',
  'Crime and Punishment is a novel by the Russian author Fyodor Dostoevsky. It was first published in the literary journal The Russian Messenger in twelve monthly installments during 1866. It was later published in a single volume.',
  '2020-2-29 09:30:27',1);

INSERT INTO book(`title`, `description`, `date_created`, `author_id`) VALUES(
  'Harry Potter and the Philosopher\'s Stone',
  'Harry Potter and the Philosopher\'s Stone is a fantasy novel written by British author J. K. Rowling. ',
  '2020-3-2 08:00:18',2);
```
