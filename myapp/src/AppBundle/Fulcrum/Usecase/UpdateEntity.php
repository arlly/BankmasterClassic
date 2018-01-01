<?php
namespace AppBundle\Fulcrum\Usecase;

use PHPMentors\DomainKata\Entity\EntityInterface;
use PHPMentors\DomainKata\Usecase\CommandUsecaseInterface;
use PHPMentors\DomainKata\Repository\RepositoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class UpdateEntity implements CommandUsecaseInterface
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
        $this->repos->update($entity);
    }
}