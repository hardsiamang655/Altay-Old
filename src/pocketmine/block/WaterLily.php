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

namespace pocketmine\block;

use pocketmine\item\Item;
use pocketmine\math\AxisAlignedBB;
use pocketmine\math\Vector3;
use pocketmine\Player;

class WaterLily extends Flowable{

	protected $id = self::WATER_LILY;

	public function __construct(int $meta = 0){
		$this->meta = $meta;
	}

	public function getName() : string{
		return "Lily Pad";
	}

	public function getHardness() : float{
		return 0.6;
	}

	protected function recalculateBoundingBox() : ?AxisAlignedBB{
		static $f = 0.0625;
		return new AxisAlignedBB($f, 0, $f, 1 - $f, 0.015625, 1 - $f);
	}

	public function place(Item $item, Block $blockReplace, Block $blockClicked, int $face, Vector3 $clickVector, Player $player = null) : bool{
		if($blockClicked instanceof Water){
			$up = $blockClicked->getSide(Vector3::SIDE_UP);
			if($up->getId() === Block::AIR){
				$this->getLevel()->setBlock($up, $this, true, true);
				return true;
			}
		}

		return false;
	}

	public function onNearbyBlockChange() : void{
		if(!($this->getSide(Vector3::SIDE_DOWN) instanceof Water)){
			$this->getLevel()->useBreakOn($this);
		}
	}

	public function getVariantBitmask() : int{
		return 0;
	}
}