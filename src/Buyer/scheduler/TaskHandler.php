<?php

namespace Buyer\scheduler;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use Buyer;
use Buyer\entity\VillagerV2;
use Buyer\season\SeasonManager;
use Buyer\utils\Utils;
use Buyer\menu\MenuManager;
use pocketmine\world\format\Chunk;
use Buyer\menu\Menu;

class TaskHandler extends Task
{
    public function onRun() : void
    {
        $defaultWorld = Server::getInstance()->getWorldManager()->getDefaultWorld();
        $entities = [];
        $time = Buyer::getTime();
        foreach ($defaultWorld->getEntities() as $entity)
        {
            if ($entity instanceof VillagerV2 and $entity->saveNBT()->getByte(VillagerV2::TAG_BUYER, false)):
                $entities[] = $entity;
            endif;
        }
        if (count($entities) > 1)
        {
            array_pop($entities);
            foreach ($entities as $entity):
                $entity->close();
            endforeach;
        }
        if ($time > 0)
        {
            Buyer::$time--;
            Buyer::getVillagerV2()?->setNameTag("§l§9СКУПЩИК\nСейчас сезон§9 " . SeasonManager::getSeasonName(Buyer::getSeason()) . "\nОбновление через§9 " . Utils::toHours($time) . "§fч.§9 " . Utils::toMinutes($time) . "§fм.§9 " . Utils::toSeconds($time) . "§fс.");
        } else
        {
            $position = Buyer::getLocation();
            Buyer::getVillagerV2()?->close();
            Buyer::setSeason(mt_rand(0, 4));
            Buyer::setTime(120);
            if (MenuManager::getCurrentItems()):
                MenuManager::setCurrentItems(null);
            endif;
            $defaultWorld->orderChunkPopulation($position->x >> Chunk::COORD_BIT_SIZE, $position->z >> Chunk::COORD_BIT_SIZE, null)->onCompletion(
                function () use ($position) : void
                {
                    $villagerV2 = VillagerV2::create($position);
                    Buyer::setVillagerV2($villagerV2);
                },
                fn () => null
            );
            foreach (Server::getInstance()->getOnlinePlayers() as $player)
            {
                (new Menu($player))->onClose($player);
                $player->sendMessage("§9Скупщик обновил сезон§f, успей продать ему ресурсы! Сейчас сезон§9 " . SeasonManager::getSeasonName(Buyer::getSeason()));
            }
        }
    }
}
