<?php

namespace Buyer\season;

use Buyer\entity\ProfessionIds;
use Buyer\item\ItemManager;
use pocketmine\item\VanillaItems;
use pocketmine\block\VanillaBlocks;

class SeasonManager
{
    public static function getProfessionOnSeason(int $season) : int
    {
        return match ($season)
        {
            SeasonIds::ALCHEMY => ProfessionIds::CLERIC,
            SeasonIds::MINE => ProfessionIds::STONE_MASON,
            SeasonIds::FISHING => ProfessionIds::FISHERMAN,
            SeasonIds::MEAT => ProfessionIds::BUTCHER,
            default => ProfessionIds::FARMER
        };
    }

    public static function getSeasonItems(int $season) : array
    {
        $farm = [
            ItemManager::getItem(VanillaItems::WHEAT_SEEDS(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::WHEAT_SEEDS(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::PUMPKIN_SEEDS(), 8, 16, 4096),
            ItemManager::getItem(VanillaItems::MELON_SEEDS(), 8, 16, 4096),
            ItemManager::getItem(VanillaItems::BEETROOT_SEEDS(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::WHEAT(), 32, 64, 4096),
            ItemManager::getItem(VanillaBlocks::PUMPKIN()->asItem(), 4, 8, 4096),
            ItemManager::getItem(VanillaBlocks::MELON()->asItem(), 4, 8, 4096),
            ItemManager::getItem(VanillaItems::BEETROOT(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::POTATO(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::CARROT(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::COCOA_BEANS(), 8, 32, 4096),
            ItemManager::getItem(VanillaBlocks::NETHER_WART()->asItem(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::BONE_MEAL(), 8, 32, 4096)
        ];
        $alchemy = [
            ItemManager::getItem(VanillaItems::SPIDER_EYE(), 8, 16, 4096),
            ItemManager::getItem(VanillaItems::FERMENTED_SPIDER_EYE(), 4, 8, 4096),
            ItemManager::getItem(VanillaItems::GLOWSTONE_DUST(), 16, 32, 4096),
            ItemManager::getItem(VanillaBlocks::NETHER_WART()->asItem(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::REDSTONE_DUST(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::GUNPOWDER(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::DRAGON_BREATH(), 4, 16, 4096),
            ItemManager::getItem(VanillaItems::GHAST_TEAR(), 8, 16, 4096),
            ItemManager::getItem(VanillaItems::GLISTERING_MELON(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::SUGAR(), 8, 16, 4096),
            ItemManager::getItem(VanillaItems::MAGMA_CREAM(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::BLAZE_POWDER(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::GOLDEN_CARROT(), 8, 32, 4096)
        ];
        $mine = [
            ItemManager::getItem(VanillaBlocks::GRAVEL()->asItem(), 32, 64, 4096),
            ItemManager::getItem(VanillaBlocks::TUFF()->asItem(), 32, 64, 4096),
            ItemManager::getItem(VanillaBlocks::DEEPSLATE()->asItem(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::COAL(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::COPPER_INGOT(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::IRON_INGOT(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::GOLD_INGOT(), 8, 16, 4096),
            ItemManager::getItem(VanillaItems::LAPIS_LAZULI(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::REDSTONE_DUST(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::NETHER_QUARTZ(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::EMERALD(), 4, 16, 4096),
            ItemManager::getItem(VanillaBlocks::ANCIENT_DEBRIS()->asItem(), 4, 16, 4096),
            ItemManager::getItem(VanillaItems::DIAMOND(), 8, 32, 4096)
        ];
        $fishing = [
            ItemManager::getItem(VanillaBlocks::LILY_PAD()->asItem(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::FISHING_ROD(), 1, 16, 4096),
            ItemManager::getItem(VanillaItems::ROTTEN_FLESH(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::BOWL(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::STICK(), 32, 64, 4096),
            ItemManager::getItem(VanillaItems::BONE(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::RAW_FISH(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::RAW_SALMON(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::CLOWNFISH(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::PUFFERFISH(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::BOW(), 1, 32, 4096),
            ItemManager::getItem(VanillaItems::NAUTILUS_SHELL(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::COOKED_FISH(), 8, 32, 4096)
        ];
        $meat = [
            ItemManager::getItem(VanillaItems::RAW_BEEF(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::RAW_PORKCHOP(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::RAW_MUTTON(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::RAW_CHICKEN(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::RAW_RABBIT(), 16, 32, 4096),
            ItemManager::getItem(VanillaItems::STEAK(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::COOKED_PORKCHOP(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::COOKED_MUTTON(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::COOKED_CHICKEN(), 8, 32, 4096),
            ItemManager::getItem(VanillaItems::COOKED_RABBIT(), 8, 32, 4096)
        ];
        return match ($season)
        {
            SeasonIds::FARM => $farm,
            SeasonIds::ALCHEMY => $alchemy,
            SeasonIds::MINE => $mine,
            SeasonIds::FISHING => $fishing,
            SeasonIds::MEAT => $meat,
            default => array_merge($farm, $alchemy, $mine, $fishing, $meat)
        };
    }

    public static function getSeasonName(int $season) : string
    {
        return match ($season)
        {
            SeasonIds::FARM => "фермы",
            SeasonIds::ALCHEMY => "алхимии",
            SeasonIds::MINE => "шахты",
            SeasonIds::FISHING => "рыбалки",
            SeasonIds::MEAT => "мяса",
            default => ""
        };
    }
}
