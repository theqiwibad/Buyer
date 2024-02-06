<?php

namespace Buyer\event;

use pocketmine\event\Listener;
use pocketmine\event\entity\EntityDamageEvent;
use Buyer\entity\VillagerV2;
use pocketmine\event\entity\EntityDamageByEntityEvent;
use pocketmine\player\Player;
use Buyer\menu\Menu;
use Buyer\sound\VillagerSound;
use Buyer\sound\VillagerSoundIds;

class EventHandler implements Listener
{
    public function EntityDamageEvent(EntityDamageEvent $event) : void
    {
        if ($event->getEntity()->saveNBT()->getByte(VillagerV2::TAG_BUYER, false))
        {
            $event->cancel();
            if ($event instanceof EntityDamageByEntityEvent)
            {
                $damager = $event->getDamager();
                if ($damager instanceof Player)
                {
                    new Menu($damager);
                    VillagerSound::send($damager, VillagerSoundIds::MOB_VILLAGER_HAGGLE);
                }
            }
        }
    }
}
