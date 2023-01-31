# libasyneco
Economy library made for await-generator user
# Documentation

## Setup
```php
//use NgLam2911\libasyneco\providers\EcoProvider;
//use NgLam2911\libasyneco\libasyneco;
//protected EcoProvider $provider
//onEnable() or onLoad()

try{
  $this->provider = libasyneco::init("*your provider*"); //"economyapi" or "bedrockeconomy"
}catch(InvalidProviderException){
  //Invalid Provider
}catch(DependencyMissingException){
  //Mising libasyneco's dependency
}
```

## Get money from a player
```php
/** @var Player $player */
try{
  $money = yield from $this->provider->myMoney($player);
}catch(EcoException){
  //Error
}
```

## Add, set, reduce money from player (same)
```php
/** @var Player $player */
/** @var float|int $amount */
try{
  yield from $this->provider->addMoney($player, $amount);
}catch(EcoException){
  //Error
}
```
