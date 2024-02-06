<?php

namespace Buyer\menu;

use Buyer\season\SeasonManager;
use Buyer;
use pocketmine\item\Item;
use Buyer\item\ItemManager;
use cooldogedev\BedrockEconomy\BedrockEconomy;
use pocketmine\item\VanillaItems;

class MenuManager
{
    private static ?array $currentItems = null;

    public static function getCurrentItems() : ?array
    {
        return self::$currentItems;
    }

    public static function setCurrentItems(?array $contents) : void
    {
        self::$currentItems = $contents;
    }

    public static function setLore(Item $item) : void
    {
        $nbt = $item->getNamedTag();
        $item->setLore(
            [
                "\n§rКоличество§9 " . ItemManager::getCount($nbt) . "§f/§9" . ItemManager::getMaxCount($nbt)
                . "шт.\n§rСтоимость§9 " . $nbt->getInt(ItemManager::TAG_PRICE, 8) . BedrockEconomy::getInstance()->getCurrencyManager()->getSymbol() . "§f за " . $item->getCount() . "шт."
            ]
        );
    }

    public static function getContents() : array
    {
        $items = self::getCurrentItems() ?? SeasonManager::getSeasonItems(Buyer::getSeason());
        $index = array_merge(range(11, 15), range(20, 24), range(39, 41));
        /** @var Item $allItems */
        foreach ($items as $item)
        {
            $nbt = $item->getNamedTag();
            $item->setNamedTag($nbt->setInt(ItemManager::TAG_MAX_COUNT, ItemManager::getMaxCount($nbt))->setInt(ItemManager::TAG_COUNT, ItemManager::getCount($nbt)));
            self::setLore($item);
        }
        if (count($items) < count($index)):
            $items = array_pad($items, count($index), VanillaItems::AIR());
        endif;
        return array_combine($index, $items);
    }
}
