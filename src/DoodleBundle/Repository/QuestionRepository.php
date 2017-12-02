<?php

namespace DoodleBundle\Repository;

use Doctrine\ORM\EntityRepository;
use DoodleBundle\Entity\Question;

class QuestionRepository extends EntityRepository
{
    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function getAllQuestions()
    {
        return $this->createQueryBuilder('q')
            ->where('q.status > :status')
            ->setParameter('status', Question::STATUS_DELETED)
            ->getQuery()
            ->getResult()
        ;
    }
}
