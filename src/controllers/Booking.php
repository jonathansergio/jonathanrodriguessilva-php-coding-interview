<?php

namespace Src\controllers;

use Src\models\BookingModel;

class Booking {

	private function getBookingModel(): BookingModel {
		return new BookingModel();
	}

	public function getBookings() {
		return $this->getBookingModel()->getBookings();
	}

    public function createBooking($booking) {
        return $this->getBookingModel()->createBooking($booking);
    }

    public function getAverageOfDogsByClient($booking) {
        return $this->getBookingModel()->getAverageOfDogsByClient($booking);
    }

}