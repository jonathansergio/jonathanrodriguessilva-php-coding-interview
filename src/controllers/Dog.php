<?php

namespace Src\controllers;

use Src\models\DogModel;

class Dog {

	private function getDogModel(): DogModel {
		return new DogModel();
	}

	public function getDogs() {
		return $this->getDogModel()->getDogs();
	}

    public function getAgeAverage($dogs) {
        return $this->getDogModel()->getAgeAverage($dogs);
    }
}