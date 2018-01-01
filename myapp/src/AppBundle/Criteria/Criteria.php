<?php
namespace AppBundle\Criteria;

use Doctrine\Common\Collections\Criteria as BaseCriteria;
use PHPMentors\DomainKata\Entity\CriteriaInterface;

class Criteria extends BaseCriteria implements CriteriaInterface
{

    public function excludeDeleted($excludeDeleted)
    {
        if (! $excludeDeleted)
            return;

        $this->andWhere($this->expr()
            ->isNull('deletedAt'));
    }
}