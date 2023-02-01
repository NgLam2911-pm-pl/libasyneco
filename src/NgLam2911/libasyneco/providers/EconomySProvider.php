<?php
declare(strict_types=1);

namespace NgLam2911\libasyneco\providers;

use Generator;
use NgLam2911\libasyneco\exceptions\EcoException;
use onebone\economyapi\EconomyAPI;
use pocketmine\player\Player;

class EconomySProvider implements EcoProvider{

	/**
	 * @throws EcoException
	 */
	public function myMoney(Player|string $player) : Generator{
		if ($player instanceof Player) $player = $player->getName();
		$result = EconomyAPI::getInstance()->myMoney($player);
		if ($result === false) throw new EcoException();
		0 && yield; //this is just a hacks for a function that doesn't yield anything at all...
		return $result;
	}

	/**
	 * @throws EcoException
	 */
	public function addMoney(Player|string $player, float $amount) : Generator{
		if($player instanceof Player) $player = $player->getName();
		$result = EconomyAPI::getInstance()->addMoney($player, $amount);
		if ($result !== EconomyAPI::RET_SUCCESS) throw new EcoException();
		0 && yield;
	}

	/**
	 * @throws EcoException
	 */
	public function takeMoney(Player|string $player, float $amount) : Generator{
		if($player instanceof Player) $player = $player->getName();
		$result = EconomyAPI::getInstance()->reduceMoney($player, $amount);
		if ($result !== EconomyAPI::RET_SUCCESS) throw new EcoException();
		0 && yield;
	}

	/**
	 * @throws EcoException
	 */
	public function setMoney(Player|string $player, float $amount) : Generator{
		if($player instanceof Player) $player = $player->getName();
		$result = EconomyAPI::getInstance()->setMoney($player, $amount);
		if ($result !== EconomyAPI::RET_SUCCESS) throw new EcoException();
		0 && yield;
	}

	public function isCompatible() : bool{
		return class_exists(EconomyAPI::class);
	}
}