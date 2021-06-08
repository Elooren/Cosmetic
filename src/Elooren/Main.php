<?php

namespace Elooren;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\utils\Config;
use Elooren\Task\{KillParticleTask, RunParticleTask};
use Elooren\Events\{FormsEvent, KillParticle, RunParticle, EggParticle};
use pocketmine\command\{CommandSender, Command};
use pocketmine\entity\Skin;
use pocketmine\event\player\{PlayerJoinEvent, PlayerQuitEvent, PlayerChangeSkinEvent};

class Main extends PluginBase implements Listener{
	
	private static $api;
	
   public function onLoad() {
		self::$api = $this;
		
	}
	
	public function onEnable(){
		$this->getLogger()->info("§dPartikül Sistemi Etkinleştirildi!");
		$this->getServer()->getPluginManager()->registerEvents(new KillParticle($this), $this);
		$this->getServer()->getPluginManager()->registerEvents(new FormsEvent($this), $this);
		$this->f = new FormsEvent($this);
		$this->killParticles = new Config($this->getDataFolder()."KillParticleSettings.yml", Config::YAML);
		$this->runParticles = new Config($this->getDataFolder()."RunParticleSettings.yml", Config::YAML);
		
			$this->saveResource("capes.yml");
		$this->cfg = new Config($this->getDataFolder() . "capes.yml", Config::YAML);
		foreach($this->cfg->get("capes") as $cape){
			$this->saveResource("$cape.png");
		}
		
		
	}

  public static function getInstance() : Main{
   return self::$api;
    
    
} 
	
	public function addKillParticle($player, $x, $y, $z, $level){
		if($this->killParticles->get($player->getName()) == "lavadrip"){
			$this->getScheduler()->scheduleRepeatingTask(new KillParticleTask(3, $x, $y, $z, "lavadrip", $player, $level), 20);
		
	}	elseif($this->killParticles->get($player->getName()) == "ink"){
			$this->getScheduler()->scheduleRepeatingTask(new KillParticleTask(3, $x, $y, $z, "ink", $player, $level), 20);
			
		}elseif($this->killParticles->get($player->getName()) == "critical"){
			$this->getScheduler()->scheduleRepeatingTask(new KillParticleTask(3, $x, $y, $z, "critical", $player,$level), 20);
		}	
	}	
	
	public function clearKillParticle($name){
		$this->killParticles->set($name->getName(), null);
		$this->killParticles->save();
	}
	
	public function clearRunParticle($name){
		$this->runParticles->set($name->getName(), null);
		$this->runParticles->save();
	}
	
	public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool
    {
    	
    	if($command == "kozmetik"){
    		$this->f->mainForm($sender);
    	}
    	return true;
    	}
    	
    	
    public function onJoin(PlayerJoinEvent $e){
		$player = $e->getPlayer();
		$this->skin[$player->getName()] = $player->getSkin();
	}

	public function onQuit(PlayerQuitEvent $e){
		$player = $e->getPlayer();
		unset($this->skin[$player->getName()]);
	}

   public function onChangeSkin(PlayerChangeSkinEvent $e){
		$player = $e->getPlayer();
		$this->skin[$player->getName()] = $player->getSkin();
	}
	
	public function olusturPelerin($capeName){
		$path = $this->getDataFolder()."{$capeName}.png";
		$img = @imagecreatefrompng($path);
		$bytes = '';
		$l = (int) @getimagesize($path)[1];
		for($y = 0; $y < $l; $y++){
			for($x = 0; $x < 64; $x++){
				$rgba = @imagecolorat($img, $x, $y);
				$a = ((~((int)($rgba >> 24))) << 1) & 0xff;
				$r = ($rgba >> 16) & 0xff;
				$g = ($rgba >> 8) & 0xff;
				$b = $rgba & 0xff;
				$bytes .= chr($r) . chr($g) . chr($b) . chr($a);
			}
		}
		@imagedestroy($img);
		return $bytes;
	}
	
		
	public function SetSkin($player, string $file, string $ex, string $geo){
		$skin = $player->getSkin();
		$path = $this->getDataFolder() . $file . $ex;
		$img = @imagecreatefrompng($path);
		$skinbytes = "";
		$s = (int)@getimagesize($path)[1];

		for($y = 0; $y < $s; $y++){
			for($x = 0; $x < 64; $x++){
				$colorat = @imagecolorat($img, $x, $y);
				$a = ((~((int)($colorat >> 24))) << 1) & 0xff;
				$r = ($colorat >> 16) & 0xff;
				$g = ($colorat >> 8) & 0xff;
				$b = $colorat & 0xff;
				$skinbytes .= chr($r) . chr($g) . chr($b) . chr($a);
			}
		}
		@imagedestroy($img);
	}
	
}


?>