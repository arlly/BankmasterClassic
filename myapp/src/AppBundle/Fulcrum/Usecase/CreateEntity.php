<?php
namespace AppBundle\Fulcrum\Usecase;

use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\CommandUsecaseInterface;
use PHPMentors\DomainKata\Repository\RepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use AppBundle\Fulcrum\Event\EntityEvent;
use AppBundle\Fulcrum\Event\EventName;

class CreateEntity implements CommandUsecaseInterface
{

    /**
     *
     * @var RepositoryInterface $repos
     */
    private $repos;

    /**
     *
     * @var EventDispatcherInterface $eventDispatcher;
     */
    private $eventDispatcher;

    public function __construct(RepositoryInterface $repos, EventDispatcherInterface $eventDispatcher)
    {
        $this->repos = $repos;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function run(EntityInterface $entity)
    {

        //$event = new EntityEvent($entity);
        //$this->eventDispatcher->dispatch(EventName::PRE_CREATE_ENTITY, $event);

        $this->repos->add($entity);

        //$event = new EntityEvent($entity);
        //$this->eventDispatcher->dispatch(EventName::POST_CREATE_ENTITY, $event);
    }
}