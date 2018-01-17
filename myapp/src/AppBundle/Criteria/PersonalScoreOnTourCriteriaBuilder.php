<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/17
 * Time: 14:06
 */

namespace AppBundle\Criteria;

use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;


class PersonalScoreOnTourCriteriaBuilder implements CriteriaBuilderInterface
{
    private $tourId;
    private $userId;
    private $limit;

    const approval = 1;

    public function __construct(int $tourId, int $userId, int $limit)
    {
        $this->tourId = $tourId;
        $this->userId = $userId;
        $this->limit = $limit;
    }

    /**
     * @return CriteriaInterface
     */
    public function build()
    {
        $criteria = new Criteria();

        $criteria->andWhere($criteria->expr()->eq('tour', $this->tourId))
            ->andWhere($criteria->expr()->eq('user', $this->userId))
            ->andWhere($criteria->expr()->eq('approval', self::approval))
            ->setMaxResults($this->limit)
            ->orderBy(['size' => Criteria::DESC]);

        return $criteria;
    }
}