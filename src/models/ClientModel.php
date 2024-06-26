<?php

namespace Src\models;

use Src\helpers\Helpers;

class ClientModel {

	private $clientData;
	private $helper;

    /**
     * @var DogModel
     */
    private $dog;

    function __construct() {
		$this->helper = new Helpers();
        $this->dog = new DogModel();
		$string = file_get_contents(dirname(__DIR__) . '../../scripts/clients.json');
		$this->clientData = json_decode($string, true);
	}

	public function getClients() {
		return $this->clientData;
	}

	public function createClient($data) {
		$clients = $this->getClients();

		$data['id'] = end($clients)['id'] + 1;
		$clients[] = $data;

		$this->helper->putJson($clients, 'clients');

		return $data;
	}

	public function updateClient($data) {
		$updateClient = [];
		$clients = $this->getClients();
		foreach ($clients as $key => $client) {
			if ($client['id'] == $data['id']) {
				$clients[$key] = $updateClient = array_merge($client, $data);
			}
		}

		$this->helper->putJson($clients, 'clients');

		return $updateClient;
	}

	public function getClientById($id) {
		$clients = $this->getClients();
		foreach ($clients as $client) {
			if ($client['id'] == $id) {
				return $client;
			}
		}
		return null;
	}


    public function getDogsByClientId($id): array
    {
        $dogs = $this->dog->getDogs();
        $clientDogs = [];
        foreach ($dogs as $dog) {
            if ($dog['clientid'] == $id) {
                $clientDogs[] = $dog['id'];
            }
        }
        return $clientDogs;
    }
}