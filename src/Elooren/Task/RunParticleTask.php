<?php

namespace Elooren\Task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\level\particle\{HappyVillagerParticle, AngryVillagerParticle, WaterDripParticle, RedstoneParticle, ExplodeParticle, LavaParticle, SnowballPoofParticle, RainSplashParticle, MobSpawnParticle, HeartParticle, FlameParticle, PortalParticle};
use pocketmine\level\particle\Particle;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\level\sound;
use pocketmine\level\sound\BlazeShootSound;
use pocketmine\level\sound\AnvilFallSound;
use pocketmine\level\sound\AnvilUseSound;
use pocketmine\level\sound\ClickSound;
use pocketmine\level\sound\FizzSound;
use pocketmine\level\sound\AnvilBreakSound;
use pocketmine\level\sound\EndermanKillSound;
use Elooren\Main;
use pocketmine\Player;

class RunParticleTask extends Task {

    

    public function __construct() {
       
    }

    /**
     * @param int $currentTick 
     */

    public function onRun(int $currentTick) {
     

        	
        	foreach(Main::getInstance()->getServer()->getOnlinePlayers() as $player) {
        		$this->x = $player->getX();
        		$this->y = $player->getY();
        		$this->z = $player->getZ();
        		$this->type = Main::getInstance()->runParticles->get($player->getName());
        		$this->level = $player->getLevel();
        	
        	if($this->type == "heart"){
    
				
			     $this->pos = new Vector3($this->x, $this->y, $this->z);
   	$cpos = $this->pos;
		$time = 1;
		$pi = 3.14159;
		$time = $time + 0.1 / $pi;
		for($i = 0; $i <= 2 * $pi; $i += $pi / 8){
			$x = $time * cos($i);
			$y = exp(-0.1 * $time) * sin($time) + 1.5;
			$z = $time * sin($i);
	$this->level->addParticle(new HeartParticle($cpos->add($x, $y, $z)));
                }
        	}elseif($this->type == "snowball"){
        		
        		$center = new Vector3($this->x, $this->y + 2, $this->z);
				$particle = new SnowballPoofParticle($center, 1);
				
				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$x = -sin($yaw) + $center->x;
					$z = cos($yaw) + $center->z;
					$y = $center->y;
					
					$particle->setComponents($x, $y, $z);
					$this->level->addParticle($particle);
				}
				
				
        	}elseif($this->type == "lava"){
        		$this->level->addParticle(new LavaParticle(new Vector3($this->x, $this->y, $this->z - 1)));	
        		
        		
        		
        	}elseif($this->type == "raincloud"){
        		$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x, $this->y + 3, $this->z)));
            	$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x + 0.5, $this->y + 3, $this->z + 0.5)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x - 0.5, $this->y + 3, $this->z - 0.5)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x + 0.5, $this->y + 3, $this->z - 0.5)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x - 0.5, $this->y + 3, $this->z + 0.5)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x + 0.5, $this->y + 3, $this->z)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x - 0.5, $this->y + 3, $this->z)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x, $this->y + 3, $this->z + 0.5)));
				$this->level->addParticle(new MobSpawnParticle(new Vector3($this->x, $this->y + 3, $this->z - 0.5)));

                $this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.3, $this->y + 2, $this->z + 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.3, $this->y + 2, $this->z - 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.3, $this->y + 2, $this->z - 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.3, $this->y + 2, $this->z + 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.3, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.3, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z + 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z - 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.4, $this->y + 2, $this->z + 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.4, $this->y + 2, $this->z - 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.4, $this->y + 2, $this->z - 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.4, $this->y + 2, $this->z + 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.4, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.4, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z + 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z - 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.5, $this->y + 2, $this->z + 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.5, $this->y + 2, $this->z - 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.5, $this->y + 2, $this->z - 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.5, $this->y + 2, $this->z + 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.5, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.5, $this->y + 2, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z + 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2, $this->z - 0.5)));

				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.3, $this->y + 2.5, $this->z + 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.3, $this->y + 2.5, $this->z - 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.3, $this->y + 2.5, $this->z - 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.3, $this->y + 2.5, $this->z + 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.3, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.3, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z + 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z - 0.3)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.4, $this->y + 2.5, $this->z + 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.4, $this->y + 2.5, $this->z - 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.4, $this->y + 2.5, $this->z - 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.4, $this->y + 2.5, $this->z + 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.4, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.4, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z + 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z - 0.4)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.5, $this->y + 2.5, $this->z + 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.5, $this->y + 2.5, $this->z - 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.5, $this->y + 2.5, $this->z - 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.5, $this->y + 2.5, $this->z + 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x + 0.5, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x - 0.5, $this->y + 2.5, $this->z)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z + 0.5)));
				$this->level->addParticle(new RainSplashParticle(new Vector3($this->x, $this->y + 2.5, $this->z - 0.5)));
				      }elseif($this->type == "flame"){

    $this->pos = new Vector3($this->x, $this->y, $this->z);
   	$cpos = $this->pos;
		$time = 1;
		$pi = 3.14159;
		$time = $time + 0.1 / $pi;
		for($i = 0; $i <= 2 * $pi; $i += $pi / 8){
			$x = $time * cos($i);
			$y = exp(-0.1 * $time) * sin($time) + 1.5;
			$z = $time * sin($i);
	$this->level->addParticle(new FlameParticle($cpos->add($x, $y, $z)));
     }
         }
        	}
		   }
}