<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Third Party Services
	|--------------------------------------------------------------------------
	|
	| This file is for storing the credentials for third party services such
	| as Stripe, Mailgun, Mandrill, and others. This file provides a sane
	| default location for this type of information, allowing packages
	| to have a conventional place to find your various credentials.
	|
	*/

	'mailgun' => [
		'domain' => '',
		'secret' => '',
	],

	'mandrill' => [
		'secret' => '',
	],

	'ses' => [
		'key' => '',
		'secret' => '',
		'region' => 'us-east-1',
	],

	'stripe' => [
		'model'  => 'App\User',
		'secret' => '',
	],

	'twitter' => [
		'client_id' => 'RndUCaygvI0zETsWqEpLteglT',
		'client_secret' => 'BWJ2nxUZS0gRS4mBmE9DClXRcW3n9fL4jajw48o15r917z7zyT',
		'redirect' => 'http://sardumoment.dev:8000/login/callback/twitter',
	],

    	'facebook' => [
        		'client_id'     => '1480239428950882',
        		'client_secret' => '384826c234173d00e66bd89e9441a806',
        		'redirect'      => 'http://sardumoment.dev:8000/login/callback/facebook',
    ],

];
