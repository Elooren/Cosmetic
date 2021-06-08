<?php

namespace Elooren\Events;

use pocketmine\event\Listener;
use pocketmine\item\Item;
use Elooren\Forms\{Form, ModalForm, CustomForm, SimpleForm};
use pocketmine\{Player, Server};
use Elooren\Main;
use pocketmine\entity\Entity;
use pocketmine\event\player\PlayerDeathEvent;
use pocketmine\event\entity\EntityDamageByEntityEvent;

class KillParticle implements Listener{
	
	public function __construct(Main $plugin){
		$this->p = $plugin;
	}
	
	public function death(PlayerDeathEvent $e){
	$p = $e->getEntity();
	
	if($p->getLastDamageCause() instanceof EntityDamageByEntityEvent){				
	$killer = $p->getLastDamageCause()->getDamager();
	
	if($killer instanceof Player && $p instanceof Player){
	$this->p->addKillParticle($killer, $p->getX(), $p->getY(), $p->getZ(), $killer->getLevel());
	
	
  	}
 }
}
	
}


?>