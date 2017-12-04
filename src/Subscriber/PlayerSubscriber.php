<?php

namespace App\Subscriber;

use App\Event\AppEvent;
use App\Event\PlayerEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class PlayerSubscriber implements EventSubscriberInterface
{
    private $manager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->manager = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::PLAYER_ADD => 'playerAdd',
            AppEvent::PLAYER_EDIT => 'playerEdit',
        );
        // TODO: Implement getSubscribedEvents() method.
    }

    public function playerAdd(PlayerEvent $playerEvent){
        $p = $playerEvent->getPlayer();
        $p->setCreatedAt(new \DateTime("now"));
        $p->setUpdateAt(new \DateTime("now"));
        $this->manager->persist($p);
        $this->manager->flush();
    }

    public function playerEdit(PlayerEvent $playerEvent){
        $p = $playerEvent->getPlayer();
        $p->setUpdateAt(new \DateTime("now"));

        $this->manager->persist($p);
        $this->manager->flush();
    }
}