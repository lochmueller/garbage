<?php

interface ProviderInterface {


	public function canHandleAddress(Address $address):bool;

}