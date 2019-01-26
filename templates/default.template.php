<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
   <link rel="icon" href="favicon.ico" type="image/x-icon"/>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
	<meta name="author" content="Cryptocurrency faucet script" />

    <!-- Default CSS -->
    <link rel="stylesheet" href="./css/default.css" type="text/css" />

    <!-- Bootstrap CDN Minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Bootstrap CDN Minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

	<?php
        if ($this->config("use_ogimage"))
        {
    ?>
    <meta property="og:image" content={{OGIMAGE_LNK}} />
	<?php
		}
    ?>

    {{HEAD}}

	<title>{{TITLE}}</title>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>

    <!-- Recaptcha theme -->
     <script type="text/javascript">
        var RecaptchaOptions = {
        theme : 'white'
     };
    </script>

</head>
<body>

<div id="wrapper" class="container">

   <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <a href=".">
              <img alt="Brand" src="logo.png" class="mybrand">
            </a>
          </div>
         <ul class="nav navbar-nav navbar-right">
		   <li><a href="{{GITHUB_LNK}}" target="_blank">{{COINNAME}} Github</a></li>
           <li><a href="{{EXPLORER_LNK}}" target="_blank">Testnet Block Explorer</a></li>
         </ul>
        </div>
      </nav>

   <div class="page-header">
      <h1>{{COINNAME}} Testnet Faucet</h1>
   </div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Faucet stats</h3>
    </div>
    <div class="panel-body">
        <span>Balance:</span>
        <span class="highlight">{{BALANCE}}</span> {{SHORTNAME}}<br/>
        Already paid: <span class="highlight" >{{TOTAL_PAYOUT}}</span> {{SHORTNAME}} with <span class="highlight" >{{NUMBER_OF_PAYOUTS}}</span> payouts<br/><br/>

        How many payments are currently staged: <span class="highlight" >{{STAGED_PAYMENT_COUNT}}</span> payments.<br/>

        How many payments are left before they are executed: <span class="highlight" >{{STAGED_PAYMENTS_LEFT}}</span> payments.<br/>

        Payments will be done after <span class="highlight" >{{STAGED_PAYMENT_THRESHOLD}}</span> staged payments or automated every 10 minutes.<br/><br/>
        You can get free {{SHORTNAME}} (between <span class="highlight" >{{MINIMUM_PAYOUT}}</span> and <span class="highlight" >{{MAXIMUM_PAYOUT}}</span>) every <span class="highlight" >{{PAYOUT_INTERVAL}}</span>.
  </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Please donate to keep this faucet running</h3>
    </div>
    <div class="panel-body">
        {{DONATION_ADDRESS}}
    </div>
</div>

    <?php
        switch ($this->status())
        {
            case SF_STATUS_FAUCET_INCOMPLETE:
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            This faucet is incomplete, it may be missing settings or the RPC client is not available.
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_DRY_FAUCET:
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            This faucet is dry! Please donate.
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_RPC_CONNECTION_FAILED:
            case SF_STATUS_MYSQL_CONNECTION_FAILED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Cannot seem to connect at the moment, please come back later!
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_PAYOUT_ACCEPTED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Success! You have been awarded with {{PAYOUT_AMOUNT}} {{SHORTNAME}}!<br>
            Transaction: <a href="{{EXPLORER_LNK}}/tx/{{TX_HASH}}" target="_blank">{{TX_HASH}}</a><br>
			<?php
				if ($this->config("display_send_method"))
				{
			?>
			(using <em>{{TX_SEND_METHOD}}</em> method)
			<?php
				}
			?>
        </div>
    </div>
    <?php
    break;
            case SF_STATUS_PAYOUT_AND_PROMO_ACCEPTED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Success! You have been awarded with {{PAYOUT_AMOUNT}} {{COINNAME}}!<br/>
            Additionally, you received a bonus of {{PROMO_PAYOUT_AMOUNT}} {{COINNAME}}!<br>
            Transaction: <a href="{{EXPLORER_LNK}}/tx/{{TX_HASH}}" target="_blank">{{TX_HASH}}</a><br>
			<?php
				if ($this->config("display_send_method"))
				{
			?>
			[using <em>{{TX_SEND_METHOD}}</em> method]
			<?php
				}
			?>
        </div>
    </div>
	<?php
	break;
            case SF_STATUS_PAYOUT_ERROR:
    ?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            Something went wrong, could not send you {{SHORTNAME}}... Please try again later.
						<?php
				if ($this->config("display_send_method"))
				{
			?>
			[using <em>{{TX_SEND_METHOD}}</em> method]
			<?php
				}
			?>
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_PAYOUT_DENIED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            No more {{SHORTNAME}} for you! Try again later.
        </div>
    </div>
    <?php
    break;
            case SF_STATUS_PROXY_DETECTED:
	?>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            You are using a proxy! Proxies are not allowed.
        </div>
    </div>
    <?php
	break;
            case SF_STATUS_CAPTCHA_INCORRECT:
            case SF_STATUS_INVALID_DOGE_ADDRESS:
            case SF_STATUS_OPERATIONAL:
	?>

    <form method="post" action="">
        <div class="input-group input-group-sm">
            <span class="input-group-addon">{{COINNAME}} address</span>
            <input  name="dogecoin_address" type="text" class="form-control" value="" placeholder="Enter your {{COINNAME}} address here" />
        </div>
        <div class="margintop" id="captcha">{{CAPTCHA}}</div>
        <input id="send" name="dogecoin_submit" type="submit" class="btn btn-warning btn-md btn-block margintop" value="Send {{COINNAME}}" />
    </form>

	<?php
        if ($this->status() == SF_STATUS_INVALID_DOGE_ADDRESS)
        {
    ?>
    <div class="panel panel-default margintop">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            You entered an invalid {{COINNAME}} address!
        </div>
    </div>
    <?php
    }
	   elseif ($this->status() == SF_STATUS_CAPTCHA_INCORRECT)
	{
	?>
    <div class="panel panel-default margintop">
        <div class="panel-heading">
            <h3 class="panel-title">Status</h3>
        </div>
        <div class="panel-body">
            The CAPTCHA code you entered was incorrect!
        </div>
    </div>
    <?php
	}
    break;
    }
    ?>

</div>
<br><br>
</body>
</html>
