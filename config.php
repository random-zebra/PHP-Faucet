<?php
/*

// Cryptocurrency faucet script

The MIT License (MIT)

Copyright (c) [2014] [Christian Grieger]

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.

*/

// Modify these settings to suit your needs.

$config = array(

    // Coin
    "coinname" => "PIVX",
	"shortname" => "tPIV",

	// RPC settings:
    "rpc_user" => "rpcuser",
	"rpc_password" => "rpcpassword",
	"rpc_host" => "127.0.0.1",
	"rpc_port" => "51473",

	// MySQL settings:
    "mysql_user" => "db_user",
	"mysql_password" => "db_password",
	"mysql_host" => "localhost",
	"mysql_database" => "faucet", // faucet database name
	"mysql_table_prefix" => "sf_", // table prefix to use

	// Coin values:
	"minimum_payout" => 100, // minimum coins to be awarded
	"maximum_payout" => 1500, // maximum coins to be awarded
	"payout_threshold" => 5000, // payout threshold, if the faucet contains less coins than this, display the 'dry_faucet' message
	"payout_interval" => "10m", // payout interval, the wait time for a user between payouts. Type any numerical value with either a "m" (minutes), "h" (hours), or "d" (days), attached. Examples: 50m for a 50 minute delay, 7h for a 7 hour delay, etc.
	
	// Links
	"explorer_lnk" => "https://testnet.pivx.link",	// link to block explorer
	"github_lnk" => "https://github.com/PIVX-Project/PIVX",	// link to github page
	"use_ogimage" => true,	// use a og:image in the webpage, link defined below
	"ogimage_lnk" => "https://github.com/PIVX-Project/Official-PIVX-Graphics/blob/master/digital/landscape/Colour/Dark_Purple_ldsp.png",


    // Payment system:
	"stage_payments" => false, // stage payments in the database, to be executed later
	"stage_payment_account_name" => "", // account name to send transactions with, needs to be valid // you also can leave it empty
	"staged_payment_threshold" => 5, // staged payment threshold, all staged payments are executed when this number is reached
	"staged_payment_cron_only" => false, // ignore the stage_amount counter, only execute staged payments when the cron script is called

	// this option has 3 possible values: "ip_address", "coin_address", and "both". It defines what to check for when a user enters a coin address in order to decide whether or not to award coins to this user.
	// "ip_address": checks the user IP address in the payout history.
	// "coin_address": checks the user coins address in the payout history.
	// "both": check both the IP and coins address in the payout history.
	"user_check" => "both",

	"use_captcha" => false, // require the user to enter a captcha

	"captcha" => "recaptcha", // valid options: recaptcha, recaptcha2, solvemedia

	"captcha_https" => false, // use https (only for recaptcha2) valid options: true, false

	// enter your private and public reCAPTCHA key here:
	"captcha_config" => array(
		"private_key" => "privatekey",
		"public_key" => "publickey"
		),

	// enter your private and public solvemedia key here:
	"solvemedia_config" => array(
		"public_key" => "publickey",
		"private_key" => "privatekey",
		"hash_key" => "hashkey"
	),

    // proxy filter:
	"filter_proxies" => false, // whether to filter proxies or not. It's up to you to fill the proxy ban table. (see also the tor node cron job in ./lib/proxy_filter/cron/tor.php)
	"proxy_filter_use_faucet_database" => false, // whether the proxy filter should use the faucet database connection or not. (if set to false, the proxy filter will connect to the database set in ./lib/proxy_filter/config.php)

    // promo codes:
	"use_promo_codes" => false, // accept promo codes


	// if the wallet is encrypted, enter the PASSPHRASE here. Leave it blank otherwise!
	"wallet_passphrase" => "",

	// Donation address:
	"donation_address" => "yBX3wx55kxntuzWWLujYrHH2fW4rZqdyTQ", // donation address to display

	// Faucet look and feel:
	"title" => "PIVX Testnet Faucet", // page title, may be used by the template too
	"template" => "default", // template to use (see the templates directory)
    //code for advertisements:
    "ads" => "<iframe></iframe>"
	);


// Do not change this.
defined("SIMPLE_FAUCET") || header(".");
?>
