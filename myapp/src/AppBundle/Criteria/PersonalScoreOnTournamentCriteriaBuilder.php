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


class PersonalScoreOnTournamentCriteriaBuilder implements CriteriaBuilderInterface
{
    private $tournamentId;
    private $userId;
    private $limit;

    const approval = 1;

    public function __construct(int $tournamentId, int $userId, int $limit)
    {
        $this->tournamentId = $tournamentId;
        $this->userId = $userId;
        $this->limit = $limit;
    }

    /**
     * @return CriteriaInterface
     */
    public function build()
    {
        $criteria = new Criteria();

        $criteria->andWhere($criteria->expr()->eq('tournament', $this->tournamentId))
            ->andWhere($criteria->expr()->eq('user', $this->userId))
            ->andWhere($criteria->expr()->eq('approval', self::approval))
            ->setMaxResults($this->limit)
            ->orderBy(['size' => Criteria::DESC]);

        return $criteria;
    }
}