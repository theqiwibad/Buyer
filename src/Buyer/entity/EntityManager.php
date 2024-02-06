<?php

namespace Buyer\entity;

use pocketmine\entity\EntityFactory;
use pocketmine\world\World;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\entity\EntityDataHelper;

class EntityManager
{
    public static function init() : void
    {
        EntityFactory::getInstance()->register(
            VillagerV2::class,
            function (World $world, CompoundTag $nbt) : VillagerV2
            {
                return new VillagerV2(EntityDataHelper::parseLocation($nbt, $world), $nbt);
            },
            ["VillagerV2", "minecraft:villager_v2"]
        );
    }
}
