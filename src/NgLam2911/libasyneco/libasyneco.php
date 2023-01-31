<?php
declare(strict_types=1);

namespace NgLam2911\libasyneco;

use NgLam2911\libasyneco\exceptions\DependencyMissingException;
use NgLam2911\libasyneco\exceptions\InvalidProviderException;
use NgLam2911\libasyneco\providers\BedrockEconomyProvider;
use NgLam2911\libasyneco\providers\EconomySProvider;
use NgLam2911\libasyneco\providers\EcoProvider;
use SOFe\AwaitGenerator\Await;

class libasyneco {

	/** @var EcoProvider[] */
	protected static array $providers = [];
	protected static bool $isLoaded = false;

	/**
	 * @throws DependencyMissingException
	 * @throws InvalidProviderException
	 */
	public static function init(string $provider) : EcoProvider{
		if (!self::$isLoaded) self::load();
		if (!isset(self::$providers[$provider])){
			throw new InvalidProviderException();
		}
		if(!self::$providers[$provider]->isCompatible()){
			throw new DependencyMissingException();
		}
		return self::$providers[$provider];
	}

	/**
	 * @throws DependencyMissingException
	 */
	protected static function load() : void{
		if (self::$isLoaded) return;
		self::$isLoaded = true;
		if (!class_exists(Await::class)){
			throw new DependencyMissingException("AwaitGenerator virion is missing.");
		}
		self::register("economyapi", new EconomySProvider());
		self::register("bedrockeconomy", new BedrockEconomyProvider());
	}

	protected static function register(string $name, EcoProvider $provider) : void{
		self::$providers[$name] = $provider;
	}
}