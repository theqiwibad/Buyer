<?php

namespace Buyer\item;

use pocketmine\nbt\tag\CompoundTag;
use pocketmine\item\Item;

class ItemManager
{
    public const TAG_PRICE = "Price"; //TAG_Int
    public const TAG_COUNT = "Count"; //TAG_Int
    public const TAG_MAX_COUNT = "MaxCount"; //TAG_Int

    public static function getPrice(CompoundTag $nbt) : int
    {
        return $nbt->getInt(self::TAG_PRICE, 0);
    }

    public static function setPrice(Item $item, int $value) : Item
    {
        return $item->setNamedTag($item->getNamedTag()->setInt(self::TAG_PRICE, $value));
    }

    public static function getCount(CompoundTag $nbt) : int
    {
        return $nbt->getInt(self::TAG_COUNT, 0);
    }

    public static function setCount(Item $item, int $value) : Item
    {
        return $item->setNamedTag($item->getNamedTag()->setInt(self::TAG_COUNT, $value));
    }

    public static function getMaxCount(CompoundTag $nbt) : int
    {
        return $nbt->getInt(self::TAG_MAX_COUNT, 0);
    }

    public static function setMaxCount(Item $item, int $value) : Item
    {
        return $item->setNamedTag($item->getNamedTag()->setInt(self::TAG_MAX_COUNT, $value));
    }

    public static function getItem(Item $item, int $count, int $price, int $maxCount) : Item
    {
        return $item->setCount($count)->setNamedTag($item->getNamedTag()->setInt(self::TAG_PRICE, $price)->setInt(self::TAG_MAX_COUNT, $maxCount));
    }
}
