<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php echo ($title ?? 'BuyList') . ' | BuyList' ?>
    </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="icon" type="image/png" href="favicon.png">
</head>

<body>

<div class="wrapper min-vh-100 d-flex flex-column">

<?php $this->load->helper('url') ?>

<header class="header bg-light">
    <div class="container">
        <div class="header__body">

            <nav class="navbar navbar-expand-lg navbar-light">
                <span class="navbar-brand">BuyList</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a href="/buys" 
                                class="nav-link <?php echo current_url() == site_url('buys') ? 'active' : '' ?>">List</a>
                        </li>
                        <li class="nav-item">
                            <a href="/categories"
                                class="nav-link <?php echo current_url() == site_url('categories') ? 'active' : '' ?>">Categories</a>
                        </li>
                    </ul>
                </div>
            </nav>

        </div>
    </div>
</header>

<main class="main flex-grow-1 pt-3 pb-3">
