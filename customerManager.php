<?php

class CustomerManager {
    private $dataFile = 'customers.json';
    private $customerList = [];

    public function __construct() {
        if (file_exists($this->dataFile)) {
            $data = file_get_contents($this->dataFile);
            $this->customerList = json_decode($data, true);
        }
    }

    public function tambahCustomer($nama, $email, $telepon) {
        $id = uniqid(); // Generate ID unik
        $customer = new Customer($id, $nama, $email, $telepon);
        $this->customerList[] = $customer;
        $this->simpanData();
    }

    public function getCustomers() {
        return $this->customerList;
    }

    public function hapusCustomer($id) {
        $this->customerList = array_filter($this->customerList, function ($customer) use ($id) {
            return $customer['id'] !== $id;
        });
        $this->simpanData();
    }

    private function simpanData() {
        file_put_contents($this->dataFile, json_encode($this->customerList, JSON_PRETTY_PRINT));
    }
}
?>
