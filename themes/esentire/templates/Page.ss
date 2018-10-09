<!DOCTYPE html>
<!--[if !IE]><!-->
<html lang="$ContentLocale">
<!--<![endif]-->
<!--[if IE 6 ]><html lang="$ContentLocale" class="ie ie6"><![endif]-->
<!--[if IE 7 ]><html lang="$ContentLocale" class="ie ie7"><![endif]-->
<!--[if IE 8 ]><html lang="$ContentLocale" class="ie ie8"><![endif]-->
<head>
	<% base_tag %>
	<title><% if $MetaTitle %>$MetaTitle<% else %>$Title<% end_if %> &raquo; $SiteConfig.Title</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	$MetaTags(false)
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
    <link rel="apple-touch-icon" sizes="180x180" href="apple-touch-icon.png?v=PY4ER8kmJx">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png?v=PY4ER8kmJx">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png?v=PY4ER8kmJx">
    <link rel="manifest" href="manifest.json?v=PY4ER8kmJx">
    <link rel="mask-icon" href="safari-pinned-tab.svg?v=PY4ER8kmJx" color="#a93439">
    <link rel="shortcut icon" href="favicon.ico?v=PY4ER8kmJx" type="image/x-icon">
    <meta name="theme-color" content="#ffffff">
</head>
<body class="$ClassName.ShortName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>
    <% include Navigation %>
<main class="main row no-margin" role="main" id="main">
    <div class="sidebar-wrapper">
        <% include SideBar %>
    </div>
    <div class="container">
        <h1 class="hero-title"><% if $HeaderTitle %>$HeaderTitle<% else %>$Title<% end_if %></h1>
        <% if $Subtitle %><p class="hero-subtitle">$Subtitle</p><% end_if %>
        $Layout
    </div>
    <div class="offset"></div>
</main>
<% include Footer %>
<div id="cookies" class="hidden container-fluid">
    <div class="center-xs middle-xs row">
        <p class="cookie-copy">This site uses cookies. The types of cookies we use, and the way we use them, are explained in our <a href="/privacy-policy/" title="Privacy Policy">Privacy Policy</a>. By clicking "Accept" or continuing to use our site, you agree to our use of Cookies.</p>
        <a class="cookies-state btn btn-accent" href="#cookies">Accept</a>
        <a class="cookies-state" href="#cookies">Decline</a>
	</div>
</div>


</body>
</html>
