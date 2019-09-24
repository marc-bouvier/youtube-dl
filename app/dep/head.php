<?php
$root = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
define("ROOT",$root);
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CrunchyRIP</title>

        <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo ROOT; ?>dep/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ROOT; ?>dep/css/jquery.fancybox.css" type="text/css" media="screen" />
    <style>

	.commands-table th{
		text-align : right;
	}
	.commands-table>tbody>tr>td, .commands-table>tbody>tr>th {
		padding : 2px;
	}

    .dataFancy table{
    background-color:#303030;
    }

    .dataFancy td{

    text-align : center;
    }

    .dataFancy ul{

    text-align : left;
    }

    .dosbox a{
        color : orange !important;
    }
    </style>

    <!-- Optional theme -->
   <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body role="document">
      <!-- Fixed navbar -->
