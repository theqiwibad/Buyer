<?php

namespace Buyer\sound;

use pocketmine\entity\Entity;
use pocketmine\player\Player;
use pocketmine\network\mcpe\protocol\PlaySoundPacket;

class VillagerSound
{
    public static function send(Entity $entity, string $soundName) : void
    {
        foreach ($entity->getWorld()->getNearbyEntities($entity->getBoundingBox()->expandedCopy(16, 16, 16)) as $player)
        {
            if ($player instanceof Player and $player->isOnline())
            {
                $position = $player->getPosition();
                $pk = new PlaySoundPacket();
                $pk->soundName = $soundName;
                $pk->x = $position->x;
                $pk->y = $position->y;
                $pk->z = $position->z;
                $pk->volume = 1.0;
                $pk->pitch = 1.0;
                $player->getNetworkSession()->sendDataPacket($pk);
            }
        }
    }
}
