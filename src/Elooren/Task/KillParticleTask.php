<?php

namespace Elooren\Task;

use pocketmine\scheduler\Task;
use pocketmine\Server;
use pocketmine\level\particle\{HappyVillagerParticle, AngryVillagerParticle, WaterDripParticle, RedstoneParticle, ExplodeParticle, LavaParticle, InkParticle};
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

class KillParticleTask extends Task {

    public $time;

    public function __construct(int $time = 2, $x, $y, $z, $type, $player, $level) {
        $this->time = $time;
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
        $this->player = $player;
        $this->level = $level;
        $this->type = $type;
        $this->pos = new Vector3($this->x + 0.5, $this->y, $this->z + 0,5);
    }

    /**
     * @param int $currentTick 
     */

    public function onRun(int $currentTick) {
        $this->time--;

        if ($this->time <= 2 && $this->time > 0) {
        	
        	
  	$cpos = $this->pos;
		$time = 1;
		$pi = 3.14159;
		$time = $time + 0.1 / $pi;
		for($i = 0; $i <= 2 * $pi; $i += $pi / 8){
			$x = $time * cos($i);
			$y = exp(-0.1 * $time) * sin($time) + 1.5;
			$z = $time * sin($i);
			
			if($this->type == "lavadrip"){
				
				$center = new Vector3($this->x, $this->y, $this->z);
				for($yaw = 0; $yaw <= 10; $yaw += (M_PI * 2) / 20){
					$xx = -sin($yaw) + $center->x;
					$zz = cos($yaw) + $center->z;
					$yy = $center->y;
					$this->level->addParticle(new LavaParticle(new Vector3($xx, $yy + 1.5, $zz))); 

			}
			
	     	}elseif($this->type == "ink"){
	     		$this->level->addParticle(new InkParticle($cpos->add($x, $y, $z)));
	     		$this->level->addParticle(new InkParticle($cpos->add($x, $y, $z)));
	     		
	     	}elseif($this->type == "critical"){
	     		
	     	}
		   }
    }elseif($this->time == 0){

        	 $this->level->addSound(new AnvilBreakSound($this->player));
      }
    }
}