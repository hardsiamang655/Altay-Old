<?php

/*
 *               _ _
 *         /\   | | |
 *        /  \  | | |_ __ _ _   _
 *       / /\ \ | | __/ _` | | | |
 *      / ____ \| | || (_| | |_| |
 *     /_/    \_|_|\__\__,_|\__, |
 *                           __/ |
 *                          |___/
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author TuranicTeam
 * @link https://github.com/TuranicTeam/Altay
 *
 */

declare(strict_types=1);

namespace pocketmine\entity\behavior;

use pocketmine\entity\Entity;
use pocketmine\entity\Mob;

class FloatBehavior extends Behavior{
	
	public function canStart() : bool{
		if($this->mob->isInsideOfWater()){
			$this->mob->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_SWIMMER, true);
			if($this->random->nextFloat() < 0.8){
				$this->mob->jump();
			}
		}else{
			$this->mob->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_SWIMMER, false);
		}
		
		return false;
	}
	
	public function canContinue() : bool{
		return false;
	}
}