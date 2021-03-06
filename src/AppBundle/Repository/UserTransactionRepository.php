<?php

namespace AppBundle\Repository;

/**
 * UserTransactionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserTransactionRepository extends \Doctrine\ORM\EntityRepository
{
    public function searchByUserName(string $userName) {
        $qb = $this->createQueryBuilder('user_transaction');

        $qb->select(['partial user_transaction.{id, amount}', 'partial user.{id, name}'])
            ->join('user_transaction.user', 'user')
            ->where('user.name LIKE :userName')
            ->orderBy('user.name')
            ->setParameter('userName', '%'.$userName.'%');

        return $qb->getQuery()->getArrayResult();
    }
}
