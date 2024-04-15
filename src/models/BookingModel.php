<?php

namespace Src\models;

use Src\controllers\Client;
use Src\controllers\Dog;
use Src\helpers\Helpers;

class BookingModel {

	private $bookingData;

    /**
     * @var Helpers
     */
    private $helper;
    /**
     * @var Client
     */
    private $client;
    /**
     * @var Dog
     */
    private $dog;

    function __construct() {
        $this->helper = new Helpers();
        $this->client = new Client();
        $this->dog = new Dog();
		$string = file_get_contents(dirname(__DIR__) . '../../scripts/bookings.json');
		$this->bookingData = json_decode($string, true);
	}

	public function getBookings() {
		return $this->bookingData;
	}

    public function createBooking($data) {
        $bookings = $this->getBookings();

        $data['id'] = end($bookings)['id'] + 1;
        $bookings[] = $data;



        $this->helper->putJson($bookings, 'bookings');

        return $data;
    }

    public function getAverageOfDogsByClient($id) {

        $dogs = $this->client->getDogsByClientId($id);
        return $this->dog->getAgeAverage($dogs);
    }
}