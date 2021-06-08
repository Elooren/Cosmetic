<?php

namespace Elooren\Events;

use pocketmine\event\Listener;
use pocketmine\item\Item;
use Elooren\Forms\{Form, ModalForm, CustomForm, SimpleForm};
use pocketmine\Player;
use Elooren\Main;
use Elooren\Task\RunParticleTask;
use pocketmine\entity\Skin;
use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent, PlayerChangeSkinEvent};

class FormsEvent implements Listener{
	
	public function __construct(Main $plugin){
		$this->p = $plugin;
	}
	
	public function mainForm($player){
		$form = new SimpleForm(function (Player $e, int $args = null){
			$player = $e->getPlayer();
			
			switch($args){
				case 0:
				$this->killParticleForm($player);
				break;
				
				case 1:
				$this->runParticleForm($player);
				break;
				
				case 2:
				$this->capesForm($player);
			 break;

			    case 3:
			   break;
			}
		});
		
		$form->setTitle("§3Sunucuİsmi §7- §fKozmetik");
		$form->addButton("Öldürme Efekti", 1 ,"https://i.resmim.net/i/skull.png");
		$form->addButton("Yürüme Efekti", 1, "https://i.hizliresim.com/tvyr5nd.png");
		$form->addButton("Pelerin Ekrani", 1, "https://i.hizliresim.com/5n844xu.png");
		$form->addButton("Çıkış Yap", 0, "textures/blocks/barrier");
		$form->sendToPlayer($player);
		
	}
	
	public function killParticleForm($player){
		$form = new SimpleForm(function(Player $e, int $args = null){
			$player = $e->getPlayer();
			
			switch($args){
				
				case 0:
					$this->p->clearKillParticle($player);
					$this->p->killParticles->save();
				break;
				
				case 1:
				if($player->hasPermission("killparticle.lavadrip")){
					$this->p->clearKillParticle($player);
					$this->p->killParticles->set($player->getName(), "lavadrip");
					$this->p->killParticles->save();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				break;
				
				case 2:
				if($player->hasPermission("killparticle.ink")){
					$this->p->clearKillParticle($player);
					$this->p->killParticles->set($player->getName(), "ink");
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->killParticles->save();
					
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				break;
				
				case 3:
				if($player->hasPermission("killparticle.critical")){
					$this->p->clearKillParticle($player);
					$this->p->killParticles->set($player->getName(), "critical");
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->killParticles->save();
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				break;
				
				
				
			}
		});
		
		$form->setTitle("§8Öldürme Efektleri");
		$form->addButton("Efekti Kaldir", 1, "https://www.resimyukle.link/img/Xx28m.png");
		$form->addButton("Lav Prtikül", 1, "https://i.resmim.net/i/lava.png");
		$form->addButton("Mürekkep Partikül", 0, "textures/ui/color_picker");
		$form->addButton("Kritik  Partikül", 0, "textures/ui/strength_effect");
		
		$form->sendToPlayer($player);
	}
	
	
	
	public function runParticleForm($player){
		$form = new SimpleForm(function(Player $e, int $args = null){
			$player = $e->getPlayer();
			
			switch($args){
				
				case 0:
					$this->p->clearRunParticle($player);
					$this->p->runParticles->save();
				break;
				
				case 1:
				if($player->hasPermission("runparticle.snowball")){
					$this->p->clearRunParticle($player);
					$this->p->runParticles->set($player->getName(), "snowball");
					$this->p->runParticles->save();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->getScheduler()->scheduleRepeatingTask(new RunParticleTask(), 20);
					
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				break;
				
				case 2:
				if($player->hasPermission("runparticle.heart")){
					$this->p->clearRunParticle($player);
					$this->p->runParticles->set($player->getName(), "heart");
					$this->p->runParticles->save();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->getScheduler()->scheduleRepeatingTask(new RunParticleTask(), 25);
					
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				break;
				
				case 3:
				if($player->hasPermission("runparticle.lava")){
					$this->p->clearRunParticle($player);
					$this->p->runParticles->set($player->getName(), "lava");
					$this->p->runParticles->save();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->getScheduler()->scheduleRepeatingTask(new RunParticleTask(), 20);
					
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				break;
			
				case 4:
				if($player->hasPermission("runparticle.raincloud")){
					$this->p->clearRunParticle($player);
					$this->p->runParticles->set($player->getName(), "raincloud");
					$this->p->runParticles->save();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->getScheduler()->scheduleRepeatingTask(new RunParticleTask(), 20);
					
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}
				
				break;

     case 5:
     if($player->hasPermission("runparticle.flame")){
					$this->p->clearRunParticle($player);
					$this->p->runParticles->set($player->getName(), "flame");
					$this->p->runParticles->save();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Partikül etkinleştirildi!");
					$this->p->getScheduler()->scheduleRepeatingTask(new RunParticleTask(), 20);
					
				}else{
					$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
				}



    break;
				
			}
		});
		
		$form->setTitle("§8Yürüme Efektleri");
		$form->addButton("Efekti Kaldır", 1, "https://www.resimyukle.link/img/Xx28m.png");
		$form->addButton("Kar Topu Partikül", 1, "https://i.resmim.net/i/snowman.png");
		$form->addButton("Kalp Partikül", 1, "https://i.resmim.net/i/love.png");
		$form->addButton("Lav Partikül", 1, "https://i.resmim.net/i/lava.png");
		$form->addButton("Yağış Partikül", 1, "https://i.resmim.net/i/storm.png");
		$form->addButton("Ateş Partikül", 1, "https://i.resmim.net/i/fire-1.png");
		$form->sendToPlayer($player);
		
	
	}

		public function capesForm($player){
			$form = new SimpleForm(function(Player $e, int $args = null){
				$player = $e->getPlayer();
				
				switch($args){
					
					case 0:
										$oldSkin = $player->getSkin();
					$setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), "", $oldSkin->getGeometryName(), $oldSkin->getGeometryData()); 
					$player->setSkin($setCape);
					break;
					
					case 1:
					if($player->hasPermission("cape.deneme")){
						
							$oldSkin = $player->getSkin();
					$capeData = $this->p->olusturPelerin("deneme");
					$setCape = new Skin($oldSkin->getSkinId(), $oldSkin->getSkinData(), $capeData, $oldSkin->getGeometryName(), $oldSkin->getGeometryData());
					$player->setSkin($setCape);
					$player->sendSkin();
					$player->sendMessage("§4Sunucu§fİsmi §7» §7Pelerin güncellendi!");
					
					}else{
						$player->sendMessage("§4Sunucu§fİsmi §7» §cBu komutu kullanmak için yetkin yok!");
					}
					break;
					
				}
			});
			
			$form->setTitle("§8Pelerin Menüsü");
			$form->addButton("Pelerin Kaldir", 1, "https://www.resimyukle.link/img/Xx28m.png");
			$form->addButton("Turkiye Pelerin", 1, "https://i.hizliresim.com/4sl9ny7.png");
			$form->sendToPlayer($player);
		
		}

}
?>