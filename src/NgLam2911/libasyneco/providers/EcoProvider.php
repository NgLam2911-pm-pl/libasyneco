<?php
declare(strict_types=1);

namespace NgLam2911\libasyneco\providers;

use Generator;
use pocketmine\player\Player;
use SOFe\AwaitGenerator\Await;

interface EcoProvider{

	/**
	 * @param Player|string $player
	 *
	 * @return Generator<float, Await::RESOLVE|Await::REJECT>
	 */
	public function myMoney(Player|string $player) : Generator;

	/**
	 * @param Player|string $player
	 * @param float  $amount
	 *
	 * @return Generator<void, Await::RESOLVE|Await::REJECT>
	 */
	public function addMoney(Player|string $player, float $amount) : Generator;

	/**
	 * @param Player|string $player
	 * @param float  $amount
	 *
	 * @return Generator<void, Await::RESOLVE|Await::REJECT>
	 */
	public function takeMoney(Player|string $player, float $amount) : Generator;

	/**
	 * @param Player|string $player
	 * @param float  $amount
	 *
	 * @return Generator<void, Await::RESOLVE|Await::REJECT>
	 */
	public function setMoney(Player|string $player, float $amount) : Generator;

	public function isCompatible() : bool;
}