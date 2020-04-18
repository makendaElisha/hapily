<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Apr 13 2020 12:33:25 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5e906edf2a9d692437d06e44" data-wf-site="5e87229d1e5bbf88766c2782">
<head>
  <meta charset="utf-8">
  <title>Hapily - Survey Email Notification</title>
  <meta content="Survey Result" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> --}}
  <link href="{{ asset('all/css/normalize.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('all/css/webflow.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('all/css/hapily-website.webflow.css')}}" rel="stylesheet" type="text/css">
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="{{ asset('all/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
  <link href="{{ asset('all/images/webclip.png')}}')}}" rel="apple-touch-icon">
</head>
<body>
    <div class="email-section">
        <div class="email-container">
          <h1 class="email-green-header">hapily</h1>
          <div class="email-bold-text">Hallo {{ $data['name'] }},</div>
          <div class="email-normal-text">danke, dass du den Glücks-Test durchgeführt hast.<br>Um deinen Test-Bericht aufzurufen, klicke bitte auf den folgenden Link:</div><a href="{{ $data['surveyLink'] }}" class="email-survey-button w-button">&gt; Hier geht&#x27;s zu deinem Glücks-Bericht</a>
          <div class="email-normal-text">Glückliche Grüße,<br>dein hapily-Team</div>
        </div>
        <div class="email-footer">
          <div class="email-social-icons"><img src="images/facebook-black.svg" alt="" class="email-facebook-icon"><img src="images/instagram-black.svg" alt="" class="email-instagram-icon"><img src="images/linkedin-black.svg" alt="" class="email-linkedin-icon"></div>
          <div class="email-footer-text">
            <div class="email-footer-div-divider"></div>
            <div class="email-footer-text-small">Use of the service and website is subject to our <a href="impressum.html">Terms of Use</a> and <a href="datenschutz.html">Privacy Statement.</a><br>© 2020 hapily. All rights reserved</div>
          </div>
        </div>
    </div>
    <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5e87229d1e5bbf88766c2782" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>  
    <script src="{{ asset('all/js/webflow.js')}}" type="text/javascript"></script>
    <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>