<!DOCTYPE html>
<html lang="en" ng-app="app" ng-class="{'full-page-map': isFullPageMap}">
<head>
    <base href="/" />
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#ffffff" />
    
    <title ng-bind="pageTitle + ' - App'">Loading... - App</title>
    
    <link href="assets/css/vendors.css" rel="stylesheet" />
    <link href="assets/css/app.css" rel="stylesheet" />
    
    <script charset="utf-8" src="assets/js/vendor.bundle.js"></script>
    <script charset="utf-8" src="assets/js/musichash.js"></script>
</head>

<body ng-controller="MainController" scroll-spy id="top" ng-class="[theme.template, theme.color]">
    <!--[if lt IE 7]>
      <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    
    <!-- Application content -->
    <music-hash />
    
    <!-- Google Analytics -->
     <script>
       (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
       m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
       })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

       ga('create', 'UA-XXXXX-X');
       ga('send', 'pageview');
    </script>
   
    <div class="alert-container-top-right"></div>
</body>
</html>