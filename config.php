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
    "coinname" => "Veil",
	"shortname" => "Veil",

	// RPC settings:
    "rpc_user" => "veilrpc",
	"rpc_password" => "",
	"rpc_host" => "127.0.0.1",
	"rpc_port" => "58813",

	// MySQL settings:
        "mysql_user" => "",
	"mysql_password" => "",
	"mysql_host" => "localhost",
	"mysql_database" => "faucet", // faucet database name
	"mysql_table_prefix" => "sf_", // table prefix to use

	// Coin values:
	"minimum_payout" => 10, // minimum coins to be awarded
	"maximum_payout" => 200, // maximum coins to be awarded
	"payout_threshold" => 500, // payout threshold, if the faucet contains less coins than this, display the 'dry_faucet' message
	"payout_interval" => "10m", // payout interval, the wait time for a user between payouts. Type any numerical value with either a "m" (minutes), "h" (hours), or "d" (days), attached. Examples: 50m for a 50 minute delay, 7h for a 7 hour delay, etc.
	
	// Links
	"explorer_lnk" => "https://testnet.veil-project.com",	// link to block explorer
	"github_lnk" => "https://github.com/Veil-Project/Veil",	// link to github page
	"use_ogimage" => true,	// use a og:image in the webpage, link defined below
	"ogimage_lnk" => "https://veil-project.com/icons/logo.png",


    // Payment system:
	"display_send_method" => true,	// after making a payment, display which rpc call has been used
	"send_methods" => array(
		// ordered list of rpc call methods to use (lower index has higher priority)
		// each entry is index => array("rpc", "args")
		// "rpc" holds the name of the rpc method to call
		// "args" holds the template for arguments (need to include strings "address" and "amount")
		array(
			"rpc" => "spendzerocoin",
			"args" => array("amount", true, true, 100, "address")
		),
		array(
			"rpc" => "sendringcttoringct",
			"args" => array("address", "amount")
		),
		array(
			"rpc" => "sendringcttostealth",
			"args" => array("address", "amount")
		),
		array(
			"rpc" => "sendringcttobasecoin",
			"args" => array("address", "amount")
		),
		array(
			"rpc" => "sendstealthtoringct",
			"args" => array("address", "amount")
		),
		array(
			"rpc" => "sendstealthtostealth",
			"args" => array("address", "amount")
		),
		array(
			"rpc" => "sendstealthtobasecoin",
			"args" => array("address", "amount")
		),
		array(
			"rpc" => "sendtoaddress",
			"args" => array("address", "amount")
		)
	),
	"stage_payments" => false, // stage payments in the database, to be executed later
	"stage_payment_account_name" => "", // account name to send transactions with, needs to be valid // you also can leave it empty
	"staged_payment_threshold" => 5, // staged payment threshold, all staged payments are executed when this number is reached
	"staged_payment_cron_only" => false, // ignore the stage_amount counter, only execute staged payments when the cron script is called

	// this option has 3 possible values: "ip_address", "coin_address", and "both". It defines what to check for when a user enters a coin address in order to decide whether or not to award coins to this user.
	// "ip_address": checks the user IP address in the payout history.
	// "coin_address": checks the user coins address in the payout history.
	// "both": check both the IP and coins address in the payout history.
	"user_check" => "both",

	"use_captcha" => true, // require the user to enter a captcha

	"captcha" => "recaptcha2", // valid options: recaptcha, recaptcha2, solvemedia

	"captcha_https" => true, // use https (only for recaptcha2) valid options: true, false

	// enter your private and public reCAPTCHA key here:
	"captcha_config" => array(
		"private_key" => "xxx",
		"public_key" => "xxx"
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
	"donation_address" => "tps1qqph0n7p6g2zzvr0hhdnywznx8u8llyr7khvce7v8lkadajx79dqalcpqd9gxns2q62ld07802g95hhcsjk9wh9jdzkuc5wq9hv8xlaxlw2p7qqqn00lur", // donation address to display

	// Faucet look and feel:
	"title" => "Veil Testnet Faucet", // page title, may be used by the template too
	"template" => "default", // template to use (see the templates directory)
    //code for advertisements:
    "ads" => "<iframe></iframe>"
	);


// Do not change this.
defined("SIMPLE_FAUCET") || header(".");
?>
