<?php



class GermanyBielefeld implements ProviderInterface{


	public function canHandleAddress(Address $address):bool {
		return in_array($address->zip, [
			'33602', 
			'33604', 
			'33605', 
			'33607', 
			'33609', 
			'33611', 
			'33613', 
			'33615', 
			'33617', 
			'33647', 
			'33649', 
			'33699', 
			'33739', 
			'', 
			'']) && $address->country == 'DE';

	}

	public function getGarbageInformation(){
		
	}

}

https://anwendungen.bielefeld.de/WasteManagementBielefeld/WasteManagementServlet?SubmitAction=wasteDisposalServices