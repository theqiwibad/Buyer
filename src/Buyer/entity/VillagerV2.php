<?php

namespace Buyer\entity;

use pocketmine\entity\Living;
use pocketmine\entity\Ageable;
use pocketmine\entity\Location;
use Buyer\season\SeasonManager;
use Buyer;
use pocketmine\network\mcpe\protocol\types\entity\EntityIds;
use pocketmine\entity\EntitySizeInfo;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataCollection;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataFlags;
use pocketmine\network\mcpe\protocol\types\entity\EntityMetadataProperties;

class VillagerV2 extends Living implements Ageable
{
    public const TAG_PROFESSION = "Profession"; //TAG_Int
    public const TAG_BUYER = "Buyer"; //TAG_Int

    private int $profession;

    public static function create(Location $location) : self
    {
        $villagerV2 = new self($location);
        $villagerV2->setProfession(SeasonManager::getProfessionOnSeason(Buyer::getSeason()));
        $villagerV2->spawnToAll();
        return $villagerV2;
    }

    public static function getNetworkTypeId() : string
    {
        return EntityIds::VILLAGER_V2;
    }

    public function getInitialSizeInfo() : EntitySizeInfo
    {
        return new EntitySizeInfo(1.9, 0.6);
    }

    public function getName() : string
    {
        return "VillagerV2";
    }

    public function isBaby() : bool
    {
        return false;
    }

    public function getProfession() : int
    {
        return $this->profession;
    }

    public function setProfession(int $profession) : void
    {
        $this->profession = $profession;
    }

    public function initEntity(CompoundTag $nbt) : void
    {
        parent::initEntity($nbt);
        $profession = $nbt->getInt(self::TAG_PROFESSION, ProfessionIds::FARMER);
        if($profession > 14 or $profession < 0):
            $profession = ProfessionIds::FARMER;
        endif;
        $this->setProfession($profession);
    }

    public function saveNBT() : CompoundTag
    {
        $nbt = parent::saveNBT();
        $nbt->setInt(self::TAG_PROFESSION, $this->getProfession());
        $nbt->setByte(self::TAG_BUYER, true);
        return $nbt;
    }

    public function syncNetworkData(EntityMetadataCollection $properties) : void
    {
        parent::syncNetworkData($properties);
        $properties->setGenericFlag(EntityMetadataFlags::BABY, $this->isBaby());
        $properties->setInt(EntityMetadataProperties::VARIANT, $this->profession);
    }
}
