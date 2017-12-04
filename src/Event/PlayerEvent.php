<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 04/12/17
 * Time: 15:36
 */

namespace App\Event;


use Symfony\Component\EventDispatcher\Event;

class PlayerEvent extends Event
{
    private $player;

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }
}