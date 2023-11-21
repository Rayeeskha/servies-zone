<!DOCTYPE html>
<html lang="en">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}" /> 
<meta name="author" content="Khan Rayees">
<meta name="robots" content="noindex, nofollow">
<meta name="keywords" content="@yield('meta_keywords')">
<meta name="description" content="@yield('meta_description')">
<title>@yield('page_title')</title>

<!-- Bootstrap -->
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">



<!-- <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet"  /> -->
<link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet" />
<link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/owlcarousel/owl.carousel.min.css') }}" />
<link rel="stylesheet" href="{{ asset('frontend/css/owlcarousel/owl.theme.default.min.css') }}" />


</head>