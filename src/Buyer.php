<?php

use pocketmine\plugin\PluginBase;
use pocketmine\entity\Location;
use Buyer\entity\VillagerV2;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use Buyer\entity\EntityManager;
use Buyer\event\EventHandler;
use Buyer\scheduler\TaskHandler;
use pocketmine\Server;

class Buyer extends PluginBase
{
    private static ?VillagerV2 $villagerV2 = null;
    public static ?int $season, $time = null;

    private function loadVirion() : void
    {
        if (class_exists(InvMenu::class))
        {
            if (!InvMenuHandler::isRegistered()):
                InvMenuHandler::register($this);
            endif;
        }
    }

    public function onEnable() : void
    {
        $this->loadVirion();
        EntityManager::init();
        $this->getServer()->getPluginManager()->registerEvents(new EventHandler(), $this);
        $this->getScheduler()->scheduleRepeatingTask(new TaskHandler(), 20);
    }

    public static function getLocation() : Location
    {
        return new Location(5000, 100, 5000, Server::getInstance()->getWorldManager()->getDefaultWorld(), 0, 0);
    }

    public static function getVillagerV2() : VillagerV2
    {
        return self::$villagerV2 ?? new VillagerV2(self::getLocation());
    }

    public static function setVillagerV2(?VillagerV2 $villagerV2) : void
    {
        self::$villagerV2 = $villagerV2;
    }

    public static function getSeason() : int
    {
        return self::$season ?? 0;
    }

    public static function setSeason(?int $season) : void
    {
        self::$season = $season;
    }

    public static function getTime() : int
    {
        return self::$time ?? 0;
    }

    public static function setTime(?int $time) : void
    {
        self::$time = $time;
    }
}
