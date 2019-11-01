
<!DOCTYPE html>
<!--
    HyperGaming - Gaming CSS Framework
    NOTE: Chromium 73.0.3683.86 for Arch Linux 64 bits
    @author Gabriel Lopes Ferreira Ramos <gabrielramos149@gmail.com>
    @link https://hiperesp.github.io/
    @license UNDEFINED
-->
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="theme-color" content="#080325">
    <title><?php echo @$title; ?></title>
    <link rel="stylesheet" type="text/css" href="assets/css/layout.css">
    <link rel="stylesheet" type="text/css" href="assets/css/color/light.css">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Lato:300,400,700">
    <link rel="stylesheet" type="text/css" href="assets/font/materialdesignicons/material-icons.css">
    <script src="assets/js/script.js" defer=""></script>
</head>

<body>
    <div class="screen" data-screen="loading">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="-50 -50 200 200" preserveAspectRatio="xMidYMid" class="loading">
            <circle cx="50" cy="50" fill="none" r="40" stroke="#d92b4c" stroke-dasharray="60" stroke-linecap="round" stroke-width="4"></circle>
        </svg>
        <div class="loading-content">
            <img src="assets/images/logo_white.png">
        </div>
    </div>
    <div class="screen" data-screen="resize-warning">
        <div class="screen-content">
            <h1>Atenção</h1><br>
            <h3>Notamos que você redimensionou a janela do navegador.</h3><br>
            <p>Nosso site não funciona bem quando você alterna entre os modos mobile e PC sem recarregar a página.</p>
            <p>Recomendamos que você recarregue a página para que ele funcione perfeitamente no novo modo.</p>
            <p>Caso opte por não recarregar a página, o site pode se comportar de maneira instável, para contornar esse problema, recarregue a página.</p>
            <p>Caso escolha desativar esse aviso, você pode habilitar novamente limpando os cookies do site.</p><br><br>
            <a class="button-2" href="javascript:void(0)" data-resize-action="reload">Recarregar</a>
            <a class="button-1" href="javascript:void(0)" data-resize-action="no-reload">Não recarregar</a>
            <a class="button-1" href="javascript:void(0)" data-resize-action="disable-warning">Desativar esse aviso</a>
        </div>
    </div>
    <header>
        <div class="header-container">
            <input id="hamburger-controller" type="checkbox" class="hamburger-controller">
            <a href="#">
                <div class="logo">
                    <img src="assets/images/logo_white.png">
                </div>
            </a><!--
         --><label class="hamburger-controller-label only-mobile" for="hamburger-controller"><i class="material-icons menu-closed">menu</i><i class="material-icons menu-opened">close</i></label><!--
         --><nav>
                <ul class="menu menu-left">
                    <li class="menu-item">
                        <a href="javascript:void(0)">
                            <div class="menu-item-title">Aluguel <i class="material-icons">arrow_drop_down</i></div>
                            <div class="menu-item-subtitle">Veículos</div>
                        </a>
                        <div class="dropdown-content">
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Store Style 1</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Store Style 2</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Cart</a>
                                </li>
                            </ul>
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Product Style 1</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Product Style 2</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Checkout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)">
                            <div class="menu-item-title">Blog <i class="material-icons">arrow_drop_down</i></div>
                            <div class="menu-item-subtitle">News</div>
                        </a>
                        <div class="dropdown-content">
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Blog Style 1</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Blog Style 2</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Blog Style 3</a>
                                </li>
                            </ul>
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Blog Post 1</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Blog Post 2</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Blog Post 3</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)">
                            <div class="menu-item-title">Features <i class="material-icons">arrow_drop_down</i></div>
                            <div class="menu-item-subtitle">Full list</div>
                        </a>
                        <div class="dropdown-content">
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Forums</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Forums Topics</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Forums Single Topic</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Matches List</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Match</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Match with Maps</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Login</a>
                                </li>
                            </ul>
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Widgets <span class="badge-1">New</span></a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Components</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Coming Soon</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Contact Us</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Search</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">404</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Blank</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <ul class="menu menu-right">
                    <li class="menu-item menu-dropdown">
                        <a href="javascript:void(0)">
                            <div class="menu-item-title">Hiperesp <span class="badge-1">8</span> <i class="material-icons">arrow_drop_down</i></div>
                            <div class="menu-item-subtitle">User</div>
                        </a>
                        <div class="dropdown-content">
                            <ul class="dropdown-column">
                                <li class="dropdown-item">
                                    <a href="#">Activity</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Profile</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Messages <span class="badge-1">8</span></a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Messages Compose</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Settings</a>
                                </li>
                                <li class="dropdown-item">
                                    <a href="#">Documentation</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)">
                            <div class="menu-item-icon only-pc"><i class="material-icons">search</i></div>
                            <div class="menu-item-title only-mobile">Search</div>
                            <div class="menu-item-subtitle only-mobile">products</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)">
                            <div class="menu-item-icon only-pc"><i class="material-icons">shopping_cart</i></div>
                            <div class="menu-item-title only-mobile">Cart</div>
                            <div class="menu-item-subtitle only-mobile">products</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="javascript:void(0)">
                            <div class="menu-item-icon only-pc"><i class="material-icons">account_circle</i></div>
                            <div class="menu-item-title only-mobile">Account</div>
                            <div class="menu-item-subtitle only-mobile">login</div>
                        </a>
                    </li>
                </ul>
            </nav>
            <label class="hamburger-close-label only-mobile" for="hamburger-controller"></label>
        </div>
    </header>