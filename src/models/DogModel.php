<?php

namespace Src\models;

use Src\helpers\Helpers;

class DogModel {

	private $dogData;

	function __construct() {
		$this->helper = new Helpers();
		$string = file_get_contents(dirname(__DIR__) . '/../scripts/dogs.json');
		$this->dogData = json_decode($string, true);
	}

	public function getDogs() {
		return $this->dogData;
	}

    public function getDogAgeById($id)
    {
        $dogs = $this->getDogs();
        foreach ($dogs as $dog) {
            if ($dog['id'] == $id) {
                return $dog['age'];
            }
        }
        return null;
    }

    public function getAgeAverage(array $dogs)
    {
//        $average = array_sum($dogs['age'])/count($dogs);
        $average = 0;

        foreach ($dogs as $dogId) {
            $average += $this->getDogAgeById($dogId);
        }

//        return $average;
        return ($average / count($dogs));
    }
}