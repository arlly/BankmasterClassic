<?php
/**
 * Created by PhpStorm.
 * User: arlly
 * Date: 2018/01/23
 * Time: 17:12
 */

namespace AppBundle\Criteria;


use PHPMentors\DomainKata\Entity\CriteriaInterface;
use PHPMentors\DomainKata\Repository\Operation\CriteriaBuilderInterface;

class RankListOnTourCriteriaBuilder implements CriteriaBuilderInterface
{
    const approval = 1;

    /**
     * @return CriteriaInterface
     */
    public function build()
    {
        $criteria = new Criteria();

        $criteria->andWhere($criteria->expr()->eq('approval', self::approval));

        return $criteria;
    }
}