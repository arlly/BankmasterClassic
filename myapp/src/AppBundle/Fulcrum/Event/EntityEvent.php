<?php
namespace AppBundle\Fulcrum\Event;

use Symfony\Component\EventDispatcher\Event;
use PHPMentors\DomainKata\Entity\EntityInterface;

class EntityEvent extends Event
{

    /**
     * @var EntityInterface
     */
    private $entity;

    public function __construct(EntityInterface $entity)
    {
        $this->entity = $entity;
    }

    /**
     * @return EntityInterface
     */
    public function getEntity(): EntityInterface
    {
        return $this->entity;
    }
}