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
    <link rel="shortcut icon" href="themes/simple/images/favicon.ico" />
</head>
<body class="$ClassName.ShortName<% if not $Menu(2) %> no-sidebar<% end_if %>" <% if $i18nScriptDirection %>dir="$i18nScriptDirection"<% end_if %>>
<main class="main" role="main">
    <div class="container">
        <style>
            body {
                background-image: linear-gradient(to right, rgba(0,0,0,0) 95%, rgba(0,0,0,0.3) 100%),linear-gradient(33deg, hsla(357, 87%, 38%, 0.5), hsla(211, 100%, 21%, 0.5)),linear-gradient( to right, hsla(357, 87%, 38%, 0.5), hsla(211, 100%, 21%, 0.5)) !important;
            }
            .form-wrapper {
                padding: 24px;
                background-image: -webkit-gradient(linear, left bottom, left top, from(#F5F5FA), to(#fff));
                background-image: linear-gradient(to top, #F5F5FA, #fff);
                color: #3c3c3d;
                -webkit-box-shadow: 0 5px 15px 0 rgba(37,44,97,0.15), 0 2px 4px 0 rgba(93,100,148,0.2);
                box-shadow: 0 5px 15px 0 rgba(37,44,97,0.15), 0 2px 4px 0 rgba(93,100,148,0.2);
                border-radius: 2px;
                max-width: 400px;
                margin: 0 auto 5rem;
                align-items: center;
            }


            .middleColumn {
                margin-bottom: 1rem;
            }

            .middleColumn input {
                padding: 0.5rem 1rem;
                border: 1px solid #eaeaea;
                border-radius: 2px;
                width: 100%;
            }

            .middleColumn input:required {
                border-left: 2px red solid;
            }
            form input[type="submit"] {
                display: block;
                padding: 6px 20px;
                line-height: 1.7;
                border: 1px solid #007bff;
                transition: 0.7s;
                white-space: nowrap;
                cursor: pointer;
                transform-style: preserve-3d;
                font-weight: 600;
                letter-spacing: 1px;
                font-size: 18px;
                text-transform:uppercase;
                text-align: center;
                text-decoration: none;
                background-color: #007bff;
                background-image: linear-gradient(284deg, rgba(51, 105, 231, 0.62), rgba(0, 174, 255, 0.5));
                color: #fff;
                margin:1rem auto;
            }
            #ForgotPassword {
                text-align: center;
                padding: 1rem 1rem 0;
                margin: 0;
                font-size: 0.8rem;
            }

            #ForgotPassword a {
                text-decoration: none;
                transition: 0.5s;
                border-bottom-width: 1px;
                border-bottom-style: solid;
                border-bottom-color: transparent;
            }

            #ForgotPassword a:hover, #ForgotPassword a:focus {
                border-bottom-color: blue;
            }

            form label {
                font-size: 0.9rem;
                color: #8d8d8d;
                line-height: 2rem;
            }

            .text-white {
                color:#fff;
            }

            .message {
                text-align: center;
            }

            .message.bad {
                background: orange;
                color: white;
                font-weight: 500;
                padding: 0.7rem;
                font-size: 0.9rem;
                line-height: 1.5;
                margin: 0;
            }

        </style>
        <h1 class="center-xs h2 text-white">
            $Title
        </h1>
        <p class="center-xs lead text-white">
            Welcome back!
        </p>
        <div class="form-wrapper">
            $Form
        </div>
    </div>
</main>
</body>
</html>


