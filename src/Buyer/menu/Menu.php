<?php

namespace Buyer\menu;

use muqsit\invmenu\InvMenu;
use pocketmine\player\Player;
use muqsit\invmenu\InvMenuHandler;
use muqsit\invmenu\type\InvMenuTypeIds;
use muqsit\invmenu\transaction\InvMenuTransaction;
use muqsit\invmenu\transaction\InvMenuTransactionResult;
use Buyer\item\ItemManager;
use cooldogedev\BedrockEconomy\BedrockEconomy;
use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use Buyer\sound\VillagerSound;
use Buyer\sound\VillagerSoundIds;

class Menu extends InvMenu
{
    public function __construct(Player $player)
    {
        parent::__construct(InvMenuHandler::getTypeRegistry()->get(InvMenuTypeIds::TYPE_DOUBLE_CHEST));
        $this->setName("§9СКУПЩИК");
        $this->getInventory()->setContents(MenuManager::getContents());
        $this->setListener(
            function (InvMenuTransaction $transaction) : InvMenuTransactionResult
            {
                $player = $transaction->getPlayer();
                $playerInventory = $player->getInventory();
                foreach ($playerInventory->getContents() as $item)
                {
                    $itemClicked = $transaction->getItemClicked();
                    $nbt = $itemClicked->getNamedTag();
                    $count = $itemClicked->getCount();
                    if ($itemClicked->getTypeId() === $item->getTypeId() and ItemManager::getCount($nbt) <= ItemManager::getMaxCount($nbt) - $count and $item->getCount() >= $count)
                    {
                        $inventory = $this->getInventory();
                        $price = ItemManager::getPrice($nbt);
                        foreach ($inventory->all($itemClicked) as $index => $items)
                        {
                            ItemManager::setCount($itemClicked, ItemManager::getCount($nbt) + $count);
                            MenuManager::setLore($itemClicked);
                            $inventory->setItem($index, $itemClicked);
                            MenuManager::setCurrentItems($inventory->getContents());
                        }
                        $playerInventory->removeItem($item->setCount($count));
                        BedrockEconomyAPI::legacy()->addToPlayerBalance($player->getName(), ItemManager::getPrice($nbt));
                        VillagerSound::send($player, VillagerSoundIds::MOB_VILLAGER_YES);
                        $player->sendMessage("Вы§9 продали§f предметы скупщику и§9 получили $price" . BedrockEconomy::getInstance()->getCurrencyManager()->getSymbol());
                        return $transaction->discard();
                    }
                }
                VillagerSound::send($player, VillagerSoundIds::MOB_VILLAGER_NO);
                return $transaction->discard();
            }
        )->send($player);
    }
}
