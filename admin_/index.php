<!-- Panamá -->
<!DOCTYPE html>

<head>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Perfumes Factory</title>

    <!-- Bootstrap -->

    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <link href="../css/main.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script src="../js/bootstrap.min.js"></script>

    <!-- Bootstrap Validator -->

    <script type="text/javascript" src="../bootstrapValidator/js/bootstrapValidator.js"></script>

    <link rel="stylesheet" href="../bootstrapValidator/css/bootstrapValidator.css"/>

    <!-- Tweenmax para animaciones -->

    <script src="../js/src/TweenMax.min.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

    <![endif]-->

    <style>

        @font-face {



            font-family: gothamBook;



            src: url(../fonts/gotham-family/Gotham-Book.otf);



        }



        @media screen and (max-width: 768px) {



            #redes {



                display: none;



            }



            #slider_visibility {



                display: none;



            }



            #menuabajo {



                display: none;



            }



            #redes2 {



                margin-top: 25px !important;



                text-align: center



            }



            #copy {



                text-align: center



            }



            #powered {



                margin-top: 25px !important;



                text-align: center



            }



        }



        /*Esto es para centrar el menu*/



        @media (min-width: 768px) {



            .navbar .navbar-nav {



                display: inline-block;



                float: none;



                vertical-align: top;



            }



            .navbar .navbar-collapse {



                text-align: center;



            }



        }



        /*Hasta aqui*/



        /*Esto es para quitarle el borde al menu*/



        @media (min-width: 768px) {



            #menu {



                border-top: hidden;



                border-right: hidden;



                border-left: hidden



            }



        }



        .hideimg {



            display: block;



        }



        /*Hasta aqui*/



        body {



            font-family: gothamBook;



            font-size: 13px;



        }



        .btn-slider-right {



            margin: -110px 120px 114px auto;



        }



        .btn-slider-left {



            margin: -110px auto 114px 120px;



        }



        .btn-default {



            color: #fff;



            background-color: #beb193;



            border-color: #beb193;



        }



        .arrow {



            position: absolute;



            z-index: 99;



            padding-top: 50%;



            left: 50%;



            width: 50%;



            height: 30%;



            margin: -15% 0 0 -25%;



        }



        @media (min-width: 480px) and (max-width: 768px) {



            .carousel {



                display: none;



            }



            .hideimg {



                display: none;



            }



        }



        @media (min-width: 768px) and (max-width: 1024px) {



            .hideimg {



                display: block;



            }



            .btn-slider-right {



                margin: -68px 48px 40px auto;



            }



            .btn-slider-left {



                margin: -68px auto 40px 35px;



            }



        }



        /* Smartphones (portrait and landscape) ----------- */



        @media (min-width: 320px) and (max-width: 480px) {



            .carousel {



                display: none;



            }



            .hideimg {



                display: none;



            }



        }



        /* Smartphones (landscape) ----------- */



        @media (max-width: 320px) {



            .carousel {



                display: none;



            }



            .hideimg {



                display: none;



            }



        }

    </style>

</head>

<body>

<div class="container" style="background-color:#FFF;">

    <!--HEADER-->

    <?php require( "fr_header.php" ); ?>

    <!--FIN HEADER-->

    <!-- MAIN -->

    <div id="main" style="margin-top:5%;margin-bottom:5%;">

        <!-- SLIDER -->

        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">

            <!-- Wrapper for slides -->

            <div class="carousel-inner">

                <div class="item active" style="margin-bottom:64px;">
                    <img id="slider3" src="../images/slider/banner-10pma-50.png" alt="" border="0" width="1181" height="483"/>
                </div>

                <div class="item" style="margin-bottom:64px;">
                    <a href="aliados_info.php">
                        <img id="slider1a" src="../images/slider/BANNER-ALIADOS.png" alt="" border="0" width="1181" height="483"/>
                    </a>
                </div>

                <div class="item" style="margin-bottom:64px;">
                    <img id="slider3" src="../images/slider/banner-estandar-pa.png" alt="" border="0" width="1181" height="483"/>
                </div>

                <div class="item">

                    <img id="slider4" src="../images/slider/Slider-4.jpg" alt="" border="0" width="1181"

                         height="483"/>

                    <a href="kids-ninas.php">

                        <img src="../images/slider/slider-btn.png" alt="" class="btn-slider-left">

                    </a>

                </div>

                <div class="item">

                    <img id="slider5" src="../images/slider/Slider-5.jpg" alt="" border="0" width="1181"

                         height="483"/>

                    <a href="kids-ninos.php">

                        <img src="../images/slider/slider-btn.png" alt="" class="btn-slider-left">

                    </a>

                </div>                

                <div class="item" style="margin-bottom:64px;">

                    <a href="covers.php">

                        <img id="slider6" src="../images/slider/Banners-Covers-2018.png" alt="Nuevo Cover" border="0"

                             orgWidth="1181" orgHeight="483"/>

                    </a>

                </div>

            </div>

            <div id="slider_visibility" class="left carousel-control">

                <a href="#carousel-example-generic" data-slide="prev">

                    <!--<span class="glyphicon glyphicon-chevron-left"></span>-->

                    <img src="../images/slider_left.png">

                </a>

            </div>

            <div id="slider_visibility" class="right carousel-control">

                <a href="#carousel-example-generic" data-slide="next">

                    <!--<span class="glyphicon glyphicon-chevron-right"></span>-->

                    <img src="../images/slider_right.png">

                </a>

            </div>

        </div>

        <!-- FIN SLIDER -->

        <div class="row" style="margin-left:0px; margin-right:0px">

            <div class="col-sm-3 hideimg" style="padding:0px">

                <img src="../images/HOME-IMAGEN-PARTE-1.jpg" width="100%">

            </div>

            <div class="col-sm-3" style="padding:0px">

                <a href="productos.php">

                    <div style="position:relative; width:100%;" id="cuadro1">

                        <div class="arrow">

                            <!--<div style="text-align:center;" id="flecha1">

                                <img src="../images/flechaIzq.png" width="27"

                                     height="13">

                            </div>-->

                        </div>

                        <img src="../images/perfumes.jpg" width="100%">

                    </div>

                </a>

            </div>

            <div class="col-sm-3" style="padding:0px" align="center">
                <a href="aliados.php"><img src="../images/boton_aliados.png" width="255"></a>
            </div>

            <div class="col-sm-3" style="padding:0px">

                <a href="productos.php">

                    <div style="position:relative; width:100%;" id="cuadro2">

                        <div class="arrow">

                            <!--<div style="text-align:center;" id="flecha2">

                                <img src="../images/flechaIzq.png" width="27"

                                     height="13">

                            </div>-->

                        </div>

                        <a href="tu-perfume.php">

                            <img src="../images/cremas.jpg" width="100%">

                        </a>

                    </div>

                </a>

            </div>

            <div class="col-sm-3 hideimg" style="padding:0px">

                <img src="../images/HOME-IMAGEN-PARTE-2.jpg" width="100%">

            </div>

            <div class="col-sm-3 hideimg" style="padding:0px">

                <img src="../images/Covers1.jpg" width="100%">

            </div>

            <div class="col-sm-3 hideimg" style="padding:0px">

                <img src="../images/Covers2.jpg" width="100%">

            </div>

            <a href="spa.php">

                <div class="col-sm-3 hideimg" style="padding:0px">

                    <img src="../images/home_r2_c4.jpg" width="100%">

                </div>

            </a>

            <div class="col-sm-3" style="padding:0px">

                <a href="kids-ninas.php">

                    <div style="position:relative; width:100%;" id="cuadro3">

                        <!--<div class="arrow">

                            <div style="text-align:center;" id="flecha3">

                                <img src="../images/flechaDer.png" width="27"

                                     height="13">

                            </div>

                        </div>-->

                        <img src="../images/kids.jpg" width="100%">

                    </div>

                </a>

            </div>

            <a href="kids-ninos.php">

                <div class="col-sm-3" style="padding:0px">

                    <img src="../images/Logo-kids-.jpg" width="100%">

                </div>

            </a>

            <div class="col-sm-3" style="padding:0px">

                <a href="spa.php">

                    <div style="position:relative; width:100%;" id="cuadro4">

                        <div class="arrow">

                            <!--<div style="text-align:center;" id="flecha4">

                                <img src="../images/flechaDer.png" width="27"

                                     height="13">

                            </div>-->

                        </div>

                        <img src="../images/spa.jpg" width="100%">

                    </div>

                </a>

            </div>

            <a href="spa.php">

                <div class="col-sm-3 hideimg" style="padding:0px">

                    <img src="../images/home_r3_c4.jpg"

                         width="100%">

                </div>

            </a>

        </div>

    </div>

    <!-- FIN MAIN -->

    <!-- SLIDER -->

    <!--FOOTER-->







    <?php require("fr_footer.php"); ?>







    <!--FIN FOOTER-->

</div>

<!--FIN CONTAINER-->







<?php require("fr_footer2.php"); ?>

</body>

</html>







