<?php


class Address {

	public function __construct(
    	public readonly string $street,
    	public readonly string $houseNumber,
    	public readonly string $zip,
    	public readonly string $city,
    	public readonly string $country, // based on http://country.io/names.json
	){}

}