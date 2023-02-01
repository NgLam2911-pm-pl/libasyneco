<?php
declare(strict_types=1);

namespace NgLam2911\libasyneco\providers;

use cooldogedev\BedrockEconomy\api\BedrockEconomyAPI;
use cooldogedev\BedrockEconomy\libs\cooldogedev\libSQL\context\ClosureContext;
use Generator;
use NgLam2911\libasyneco\exceptions\EcoException;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

class BedrockEconomyProvider implements EcoProvider{

	public function myMoney(Player|string $player) : Generator{
		if($player instanceof Player) $player = $player->getName();
		return yield from Await::promise(function($resolve, $reject) use ($player){
			BedrockEconomyAPI::legacy()->getPlayerBalance($player, ClosureContext::create(function(?int $balance) use ($resolve, $reject){
				if($balance === null) $reject(new EcoException());
				else $resolve($balance);
			}));
		});
	}

	public function addMoney(Player|string $player, float $amount) : Generator{
		if($player instanceof Player) $player = $player->getName();
		yield from Await::promise(function($resolve, $reject) use ($player, $amount){
			BedrockEconomyAPI::legacy()->addToPlayerBalance($player, (int) $amount, ClosureContext::create(function(bool $wasUpdated) use ($resolve, $reject){
				if(!$wasUpdated) $reject(new EcoException());
				else $resolve();
			}));
		});
	}

	public function takeMoney(Player|string $player, float $amount) : Generator{
		if($player instanceof Player) $player = $player->getName();
		yield from Await::promise(function($resolve, $reject) use ($player, $amount){
			BedrockEconomyAPI::legacy()->subtractFromPlayerBalance($player, (int) $amount, ClosureContext::create(function(bool $wasUpdated) use ($resolve, $reject){
				if(!$wasUpdated) $reject(new EcoException());
				else $resolve();
			}));
		});
	}

	public function setMoney(Player|string $player, float $amount) : Generator{
		if($player instanceof Player) $player = $player->getName();
		yield from Await::promise(function($resolve, $reject) use ($player, $amount){
			BedrockEconomyAPI::legacy()->setPlayerBalance($player, (int) $amount, ClosureContext::create(function(bool $wasUpdated) use ($resolve, $reject){
				if(!$wasUpdated) $reject(new EcoException());
				else $resolve();
			}));
		});
	}

	public function isCompatible() : bool{
		return class_exists(BedrockEconomyAPI::class);
	}
}