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


class RankListOnTournamentCriteriaBuilder implements CriteriaBuilderInterface
{
    private $tournamentId;

    const approval = 1;

    public function __construct(int $tournamentId)
    {
        $this->tournamentId = $tournamentId;
    }

    /**
     * @return CriteriaInterface
     */
    public function build()
    {
        $criteria = new Criteria();

        $criteria->andWhere($criteria->expr()->eq('tournament', $this->tournamentId))
            ->andWhere($criteria->expr()->eq('approval', self::approval));

        return $criteria;
    }
}