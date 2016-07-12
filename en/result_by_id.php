
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Share</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/landing-page.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
            <div class="container topnav">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand topnav" href="#">Ban Suan Pim</a>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                        <a href="index.html#about">ABOUT</a>
                    </li>
                    <li>
                        <a href="index.html#howto">HOW TO</a>
                    </li>
                    <li>
                        <a href="index.html#myfarm">MY FARM</a>
                    </li>
                    <li>
                        <a href="index.html#contact">CONTACT</a>
                    </li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container -->
        </nav>


        <!-- Header -->
        <a name="about"></a>
        <div class="intro-header">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12">
                        <div class="intro-message">
                            <h1>Fertilizer Recipe Sharing Platform</h1>
                            <h3>Contribute your success to the society</h3>
                            <hr class="intro-divider">
                            <ul class="list-inline intro-social-buttons">
                                <li>
                                    <a href="index.html#about" class="btn btn-default btn-lg"> <span class="network-name">About</span></a>
                                </li>
                                <li>
                                    <a href="share.html" class="btn btn-default btn-lg"> <span class="network-name">Share</span></a>
                                </li>
                                <li>
                                    <a href="search.html" class="btn btn-default btn-lg"> <span class="network-name">Search</span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.container -->

        </div>
        <!-- /.intro-header -->

        <!-- Page Content -->

        <a  name="services"></a>
        <div class="content-section-a">

            <div class="container">
                <p class="lead"><?php
                    include 'query_by_recipe_id.php';
					$this_recipe_id = mysql_real_escape_string($_GET['recipe_id'] );
					printFormattedRecipeInfo($this_recipe_id);
				?></p>

            </div>
      </div>
      <!-- /.content-section-a -->


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-inline">
                        <li>
                        <a href="index.html#about">ABOUT</a>
                    </li>
                    <li>
                        <a href="index.html#howto">HOW TO</a>
                    </li>
                    <li>
                        <a href="index.html#myfarm">MY FARM</a>
                    </li>
                    <li>
                        <a href="index.html#contact">CONTACT</a>
                    </li>
                    </ul>
                    <p class="copyright text-muted small">Special thanks to Manoom, Mek,Stephen, Nisa, Parit, my family and my farm for making my first project happen!</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>

