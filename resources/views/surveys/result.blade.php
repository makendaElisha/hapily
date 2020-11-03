<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Mon Apr 13 2020 12:33:25 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="5e906edf2a9d692437d06e44" data-wf-site="5e87229d1e5bbf88766c2782">
<head>
  <meta charset="utf-8">
  <title>Survey Result</title>
  <meta content="Survey Result" property="og:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}"> --}}
  <link href="{{ asset('all/css/normalize.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('all/css/webflow.css')}}" rel="stylesheet" type="text/css">
  <link href="{{ asset('all/css/hapily-website.webflow.css')}}" rel="stylesheet" type="text/css">
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="{{ asset('all/images/favicon.png')}}" rel="shortcut icon" type="image/x-icon">
  <link href="{{ asset('all/images/webclip.png')}}')}}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    .moreSymtpoms:hover {
      text-decoration: underline;
      cursor: pointer;
    }
    #myBtn {
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 16px;
      border: none;
      outline: none;
      background-color: #DD22EF;
      color: white;
      cursor: pointer;
      padding: 10px;
      border-radius: 4px;
      margin-right: 5.5%;
    }
    #myBtn:hover {
      color: blue;
      text-decoration: underline;
    }

      /* The Modal (background) */
    .modal {
      display: none; /* Hidden by default */
      position: fixed; /* Stay in place */
      z-index: 1; /* Sit on top */
      padding-top: 100px; /* Location of the box */
      left: 0;
      top: 0;
      width: 100%; /* Full width */
      height: 100%; /* Full height */
      overflow: auto; /* Enable scroll if needed */
      background-color: rgb(0,0,0); /* Fallback color */
      background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    }
  
    /* Modal Content */
    .modal-content {
      background-color: #fefefe;
      margin: 0 auto;
      padding: 30px;
      border: 1px solid #888;
      width: 600px;
      text-align: center;
      padding-top: 15px;
    }
    
    /* The Close Button */
    .close {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .close:hover,
    .close:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }

    /* model 2 */

    .model2header {
      color: #65DE94;
      font-size: 26px;
      margin-bottom: 10px;
    }

    .model2text {
      color: #212121;
      font-size: 24px;
      line-height: 24px;
      margin-bottom: 30px;
    }

    .modalTextContent {
      width: 70%;
      text-align: center;
      margin: 0 auto;
    }

    .model2YesButton {
      background: #DF52E8;
      color: #fff;
      font-size: 16px;
      width: 100%;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
      margin-top: 20px;
      border-radius: 5px;
      -webkit-border-radius: 5px; 
      -moz-border-radius: 5px; 
    }


    .model2YesButton:hover {
      background: #A225B6;
      color: #fff;
      font-size: 16px;
      width: 100%;
      text-align: center;
      padding-top: 10px;
      padding-bottom: 10px;
      margin-top: 20px;
    }


    .closeSpanThankYou {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    .closeSpanThankYou {
      color: #aaaaaa;
      float: right;
      font-size: 28px;
      font-weight: bold;
    }
    
    .closeSpanThankYou:hover,
    .closeSpanThankYou:focus {
      color: #000;
      text-decoration: none;
      cursor: pointer;
    }    

    @media screen and (max-width: 400px) {
      .modal-content {
        padding: 20px;
        width: 300px;
      }
    }
  </style>
  
<script>
  //click-heatmap snippet
window['_fs_debug'] = false;
window['_fs_host'] = 'fullstory.com';
window['_fs_script'] = 'edge.fullstory.com/s/fs.js';
window['_fs_org'] = 'V90YR';
window['_fs_namespace'] = 'FS';
(function(m,n,e,t,l,o,g,y){
    if (e in m) {if(m.console && m.console.log) { m.console.log('FullStory namespace conflict. Please set window["_fs_namespace"].');} return;}
    g=m[e]=function(a,b,s){g.q?g.q.push([a,b,s]):g._api(a,b,s);};g.q=[];
    o=n.createElement(t);o.async=1;o.crossOrigin='anonymous';o.src='https://'+_fs_script;
    y=n.getElementsByTagName(t)[0];y.parentNode.insertBefore(o,y);
    g.identify=function(i,v,s){g(l,{uid:i},s);if(v)g(l,v,s)};g.setUserVars=function(v,s){g(l,v,s)};g.event=function(i,v,s){g('event',{n:i,p:v},s)};
    g.anonymize=function(){g.identify(!!0)};
    g.shutdown=function(){g("rec",!1)};g.restart=function(){g("rec",!0)};
    g.log = function(a,b){g("log",[a,b])};
    g.consent=function(a){g("consent",!arguments.length||a)};
    g.identifyAccount=function(i,v){o='account';v=v||{};v.acctId=i;g(o,v)};
    g.clearUserCookie=function(){};
    g._w={};y='XMLHttpRequest';g._w[y]=m[y];y='fetch';g._w[y]=m[y];
    if(m[y])m[y]=function(){return g._w[y].apply(this,arguments)};
    g._v="1.2.0";
})(window,document,window['_fs_namespace'],'script','user');
</script>


<!-- Start VWO Async Smartcode -->
<script type='text/javascript'>
window._vwo_code = window._vwo_code || (function(){
var account_id=501159,
settings_tolerance=2000,
library_tolerance=2500,
use_existing_jquery=false,
is_spa=1,
hide_element='body',

/* DO NOT EDIT BELOW THIS LINE */
f=false,d=document,code={use_existing_jquery:function(){return use_existing_jquery;},library_tolerance:function(){return library_tolerance;},finish:function(){if(!f){f=true;var a=d.getElementById('_vis_opt_path_hides');if(a)a.parentNode.removeChild(a);}},finished:function(){return f;},load:function(a){var b=d.createElement('script');b.src=a;b.type='text/javascript';b.innerText;b.onerror=function(){_vwo_code.finish();};d.getElementsByTagName('head')[0].appendChild(b);},init:function(){
window.settings_timer=setTimeout('_vwo_code.finish()',settings_tolerance);var a=d.createElement('style'),b=hide_element?hide_element+'{opacity:0 !important;filter:alpha(opacity=0) !important;background:none !important;}':'',h=d.getElementsByTagName('head')[0];a.setAttribute('id','_vis_opt_path_hides');a.setAttribute('type','text/css');if(a.styleSheet)a.styleSheet.cssText=b;else a.appendChild(d.createTextNode(b));h.appendChild(a);this.load('https://dev.visualwebsiteoptimizer.com/j.php?a='+account_id+'&u='+encodeURIComponent(d.URL)+'&f='+(+is_spa)+'&r='+Math.random());return settings_timer; }};window._vwo_settings_timer = code.init(); return code; }());
</script>
<!-- End VWO Async Smartcode -->
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body>
  <!-- Trigger/Open The Modal -->
  {{-- <button id="myBtn2">Open Modal</button> --}}


      <!-- The Modal -->
      <div id="myModal2" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
          <p style="text-align: right;"><span class="close">&times;</span>
          <div class="modalTextContent">
            <h2 class="model2header">GRATIS eBook</h2>
            <p class="model2text">"Die 9 größten Karriere-Irrtümer un <strong>27 erprobte Tipps,</strong> die dich deinem Traumjob näher bringen"</p>
            <p>Mit einem Klick auf den Button meldest du dich für unseren Newsletter an und erhältst das eBook!</p>
            <input type="hidden" id="user_token" value="{{$customer->token}}">
            <button class="model2YesButton" id="agreeBtn"> > JETZT ANMELDEN</button>
          </div>
        </div>
      </div>

  <button onclick="topFunction()" id="myBtn" title="Go to top">> Zur Übersicht</button>
  <div class="section-header"><img src="{{ asset('all/images/hapily_logoprimary.svg')}}" alt="" class="survey-logo">
    <div class="survey_header_columns w-row">
      <div class="survey_header_columns_col1 w-col w-col-6 w-col-medium-6 w-col-small-6">
        <div class="survey_header_col1_container">
          <h1 class="surveh_header_col1_h1">Hier ist dein persönlicher Glücksbericht.</h1>
          <p class="survey_header_paragraph">Wir wünschen dir spannende Erkenntnisse!</p><img src="{{ asset('all/images/survey_signature.png')}}" loading="lazy" alt="" class="survey_signature"></div>
      </div>
      <div class="survey_header_columns_col2 w-col w-col-6 w-col-medium-6 w-col-small-6">
        <div class="survey_header_col2_container"><img src="{{ asset('all/images/survey_header_image.png')}}" loading="lazy" alt=""></div>
      </div>
    </div>
  </div>
  <div class="side-green-container">
    <h4 class="side-green-container-header">Kostenloses Online-Training - Entfalte jetzt dein Glücks-Potenzial!</h4><a href="https://event.webinarjam.com/register/1/8r85qtn" target="_blank" class="side-green-container-button w-button">&gt; Kostenlos anmelden</a>
    <h5 class="side-green-container-header-small">Was du im Training <br>lernen wirst:</h5>
    <ul class="side-green-list w-list-unstyled">
      <li class="side-green-list-item">Was Glück wirklich bedeutet und was ein erfülltes Leben ausmacht.</li>
      <li class="side-green-list-item">Was dich bisher davon abgehalten hat, glücklich zu sein.</li>
      <li class="side-green-list-item">3 Tipps, mit denen du dein Leben veränderst und sofort glücklicher wirst.</li>
      <li class="side-green-list-item">Wie du in allen Lebensbereichen dauerhaft glücklich bleibst und ein gutes Leben führst.</li>
      <li class="side-green-list-item">Wie du andere Menschen glücklich machen kannst.</li>
    </ul>
  </div>
  <div class="section-greeting">
    <div class="section-greeting-container">
      <div class="greeting-text">
        <div class="bold-text">Hallo {{$customer->prename}},</div>
        <p class="paragraph">schön, dass du den Test abgeschlossen hast und mehr darüber erfahren möchtest, wie glücklich du momentan in deinem Leben bist und wie du dein persönliches Glück positiv beeinflussen kannst.</p>
        <p class="paragraph-4">Dein berechneter <strong>Happiness Score</strong> liegt bei <strong>{{$userScore}} von {{$numberAreas * 10}} Punkten.</strong></p>
        <p class="paragraph-2">Struktur macht glücklich 🍀 😊 Nutze deshalb folgende Checkliste für deine nächsten Schritte und hake ab:</p>
      </div>

      <div class="section-survey-checkboxes">
        <div class="survey_checkboxes_form w-form">
          <form id="email-form" name="email-form" data-name="Email Form" class="survey_form">
            <label class="w-checkbox survey_check_field">
              <div class="w-checkbox-input w-checkbox-input--inputType-custom survey_check_box_item @if($customer || $customer->feedback->option1) w--redirected-checked @endif"></div>
              <input type="checkbox" id="checkbox_one" name="checkbox" data-name="Checkbox" style="opacity:0;position:absolute;z-index:-1" disabled>
              <span class="survey_checkbox_label w-form-label">Du hast den Glückstest abgeschlossen. Deine Ergebnisse findest du weiter unten.</span>
            </label>

            <label class="w-checkbox survey_check_field">
              <div class="w-checkbox-input w-checkbox-input--inputType-custom survey_check_box_item @if($customer->feedback && $customer->feedback->option2) w--redirected-checked @endif"></div>
              <input type="checkbox" id="checkbox_two" name="checkbox" data-name="Checkbox" style="opacity:0;position:absolute;z-index:-1">
              <span class="survey_checkbox_label w-form-label">Folge uns auf <a href="https://www.instagram.com/hapily.de/" target="_blank" class="survey_check_link">&gt; Instagram</a> und tritt unserer <a href="https://www.facebook.com/groups/2616756118542821" target="_blank" class="survey_check_link">&gt; Facebook-Gruppe</a> bei - für regelmäßige Glücksimpulse</span>
            </label>
              
            <label class="w-checkbox survey_check_field">
              <div class="w-checkbox-input w-checkbox-input--inputType-custom survey_check_box_item @if($customer->feedback && $customer->feedback->option3) w--redirected-checked @endif"></div>
              <input type="checkbox" id="checkbox_three" name="checkbox" data-name="Checkbox" style="opacity:0;position:absolute;z-index:-1">
              <span class="survey_checkbox_label w-form-label">Nimm an unserem kostenlosen Webinar teil und lerne mehr über das Thema Glück <a href="https://event.webinarjam.com/register/1/8r85qtn?_ga=2.126112840.455767265.1603307356-1514692214.1600091757" target="_blank" class="survey_check_link">&gt; Jetzt anmelden</a></span>
            </label>
            
            <label class="w-checkbox survey_check_field">
              <div class="w-checkbox-input w-checkbox-input--inputType-custom survey_check_box_item @if($customer->feedback && $customer->feedback->option4) w--redirected-checked @endif"></div>
              <input type="checkbox" id="checkbox_four" name="checkbox" data-name="Checkbox" style="opacity:0;position:absolute;z-index:-1">
              <span class="survey_checkbox_label w-form-label"><strong>Unser TIPP:</strong> Vereinbare ein kostenloses Telefon-Coaching <a href="https://calendly.com/hapily-gratis-coaching/15min?back=1&amp;month=2020-10" target="_blank" class="survey_check_link">&gt; Termin vereinbaren</a></span>
            </label>
            
            <!-- option5 to show only if $customer->newsletter_opt_in 0 -->

            @if($customer->newsletter_opt_in == 0)
              <label class="w-checkbox survey_check_field">
                <div class="w-checkbox-input w-checkbox-input--inputType-custom survey_check_box_item @if($customer->newsletter_opt_in == 1 || $customer->feedback && $customer->feedback->option5) w--redirected-checked @endif"></div>
                <input type="checkbox" id="checkbox_five" name="checkbox" data-name="Checkbox" style="opacity:0;position:absolute;z-index:-1"  @if($customer->newsletter_opt_in == 1 || $customer->feedback && $customer->feedback->option5) disabled @else disabled @endif>
                <span class="survey_checkbox_label w-form-label">Falls du unseren Newsletter noch nicht abonniert hast, hole das jetzt nach und erhalte wertvolle Impulse rund um das Thema Glück <a href="#" class="survey_check_link" id="subscription_trigger">&gt; Newsletter abonnieren</a></span>
              </label>
            @endif

            <label class="w-checkbox"><div class="w-checkbox-input w-checkbox-input--inputType-custom survey_check_box_item @if($customer->feedback && $customer->feedback->option6) w--redirected-checked @endif"></div>
              <input type="checkbox" id="checkbox_six" name="checkbox" data-name="Checkbox" style="opacity:0;position:absolute;z-index:-1">
              <span class="survey_checkbox_label w-form-label">War der Test hilfreich? Wir wollen uns fortlaufend verbessern und brauchen dafür dein Feedback <a href="https://hapily.typeform.com/to/rSGaWr" target="_blank" class="survey_check_link">&gt; Feedback geben</a></span>
            </label>
          </form>          
          
          <div class="w-form-done">
            <div>Thank you! Your submission has been received!</div>
          </div>
          <div class="w-form-fail">
            <div>Oops! Something went wrong while submitting the form.</div>
          </div>
        </div>
      </div>

      <div class="score-elements" id="top">
        <h3 class="heading-6">Dein Happiness-Score pro Lebensbereich</h3>
        <div class="score-columns w-row">
          <div class="score-column1 w-col w-col-6 w-col-medium-6">
            <div class="score-column1-columns w-row">
              <div class="score-column1-col1 w-col w-col-6">
                <div class="score-column1-col1-container">
                  <h5 class="score-column-heading5-centered">Dein <br>Happiness-Score</h5>
                  <div class="organge-score">{{$userScore}}</div>
                  <div class="score-grey-text">Durchschnitt aller <br>Teilnehmer: {{$averageHappinessAllParticipants}}</div>
                </div>
              </div>
              <div class="score-column1-col2 w-col w-col-6">
                <div class="score-column1-col2-container">
                  <h5 class="score-column-heading5-centered">Dein Score liegt<br></h5>
                  <div class="red-score-with-big-padding">{{$maxPotential}}%</div>
                  <div class="score-grey-text">Unter deinem <br>max. Glücks-Level</div>
                </div>
              </div>
            </div>
            <ul class="socre-list w-list-unstyled">
              <li class="list-item-score">Am <span class="green-list-text-span">glücklichsten </span>schätzt du dich im Lebensbereich <strong>{{$resultData[0]->name}} </strong>ein, gefolgt von <strong>{{$resultData[1]->name}}</strong> und <strong>{{$resultData[2]->name}}.</strong></li>
              <li class="list-item-score">Das größte <span class="text-span-5">Verbesserungspotenzial</span> scheinst du im Bereich <strong>{{end($resultData)->name}}</strong> zu haben.</li>
            </ul>
          </div>
          <div class="score-column2 w-col w-col-6 w-col-medium-6">
            <div class="score-column2-container">
              <div class="score-column2-div-header">
                <div class="inline-text-left">Lebensbereich</div>
                <div class="inline-text-right">Happiness Score</div>
              </div>
              
              <div class="score-progress-bar-container">

                @foreach ($resultData as $area)
                  <div class="progress-bar-wrapper">
                    <div class="embed-score-pogress-bar-label-container">
                      {{-- <div class="embeded-score-label">Beruf &amp; Karriere</div> --}}
                      <div class="embeded-score-label"><a href="#{{$area->name}}" style="color: #333;">> {{$area->name}}</a></div>
                      <div class="embeded-score-label">{{$area->areaScore}}</div>
                    </div>
                    <div class="embeded-score-progress-bar-career w-embed">
                      <div style="width: 100%;">
                        <div class="" style="position: relative; width: {{$area->averageAreaScore * 10}}%; height: 16px; border-right: 1px solid #dd22ef;"></div>
                      </div>
                      <div class="progress" style="background-color: #ffeadd; border-radius: 10px; margin-top: -16px;">
                        <div class="progress-bar" role="progressbar" style="width: {{$area->areaScore * 10}}%; background-color: #33dd93; border-radius: 10px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>

              <div class="score-legend">
                <div class="score-legend-content">
                  <div class="rounded-green-colored-legend"></div>
                  <div class="score-legend-text">Aktuelles Glück</div>
                </div>
                <div class="score-legend-content">
                  <div class="rounded-orange-colored-legend"></div>
                  <div class="score-legend-text">Potenzial</div>
                </div>
              </div>
              <div class="score-legend-caption"><span class="score-legend-caption-bar">|</span> Durchschnittliches Glücks-Level aller Teilnehmer</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="section-analyse">
    <div class="section-analyse-div-container">
      <h1 class="section-analyse-header heading-6">Deine Analyse pro Lebensbereich<br></h1>
      <div class="section-analyse-text">In der Glücksforschung ist man sich einig, dass es - obwohl Glück für jeden etwas anderes bedeuten kann - ein paar <strong>Glücksfaktoren</strong> gibt, die für alle Menschen gelten. Dazu gehören z.B., dass wir einem <strong>erfüllenden Beruf</strong> nachgehen, <strong>liebevolle Beziehungen</strong> pflegen, physisch und mental <strong>gesund</strong> sind und einen <strong>Sinn</strong> in unserem Leben erkennen.<br><br>Lass uns nun einen tieferen Blick auf <strong>deine Potenziale</strong> pro Lebensbereich werfen:<br></div>
    </div>
    
    @foreach ($resultData as $areaKey => $area)
    <div class="area-of-life-symptoms-container w-container">
      <div class="life-area-container">
        <div class="life-area-container-header">
          <h3 class="life-area-header" id="{{$area->name}}">{{$area->name}}</h3>
          <div class="life-area-score-columns-container">
            <div class="score-column1-columns life-area-columns w-row">
              <div class="score-column1-col1 w-col w-col-6">
                <div class="life-area-score-container1">
                  <h5 class="score-column-heading5-centered">Dein <br>Happiness-Score</h5>
                  <div class="red-score">{{$area->areaScore}}</div>
                  <div class="score-grey-text">Durchschnitt aller <br>Teilnehmer: {{$area->averageAreaScore}}</div>
                </div>
              </div>
              <div class="score-column1-col2 w-col w-col-6">
                <div class="life-area-score-container2">
                  <h5 class="score-column-heading5-centered">Herausforderungen<br></h5>
                  <div class="organge-score-life-area-score">{{$area->userSelectedSymptoms}}</div>
                  <div class="score-grey-text">Deine Herausforderungen stellen gleichzeitig dein Potenzial dar</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @if (count($area->symptoms) == 0)
          <div class="section-analyse-purple-header-container">
            <p class="normal-text" ><br />
              Im Bereich <strong>{{$area->name}}</strong> hast du scheinbar keine offensichtlichen Themen, die dich unglücklich machen. Im Besten Fall gibt es hier demnach einfach wenig Verbesserungspotential für dich. Manchmal sind Themen, die uns unglücklich machen, allerdings auch unterbewusst vorhanden. Regelmäßige Reflektion und Journaling können uns dabei helfen, solche möglichen Herausforderungen aus dem Unterbewusstsein offenzulegen. Mehr dazu erfährst du in unserem kostenlosen Online-Training.
            </p>
            <div class="recommanded-book-purple-link" style="text-align: left;"><a href="https://event.webinarjam.com/register/1/8r85qtn" class="recommanded-book-purple-link" target="_blank">&gt; Jetzt kostenlos anmelden...</a></div>
          </div>
      @else
        @php
            $supportImageExtensions = ['gif','jpg','jpeg','png'];
            $imgUrl   = 'https://process.fs.teachablecdn.com'; //for valid image per its url
        @endphp
        @foreach ($area->symptoms as $key => $symptom)
          @if($key <= 1)
            <div class="section-analyse-purple-header-container">
              <h4 class="purple-header">{{$key + 1}}. {{$symptom->name}}</h4>
              <p class="centered-paragraph"><strong>{{$symptom->othersHavingThis}}%</strong> aller Teilnehmer teilen deine Herausforderung</p>
              <div class="indented-content-container">
                <div class="text-contet">
                  <p class="normal-text"><strong>Sofort-Tipp</strong></p>
                  <p class="normal-text">{{$symptom->instant_help}}</p>
                </div>
                <!-- coaching content here -->
                {{-- @if(strlen($symptom->recom_program) != 0)) --}}
                  <div class="coaching-tip-content">
                    <p class="normal-text"><strong>Coaching-Tipp</strong></p>
                    <div class="coach-image-box">
                      <div class="coach-box-columns w-row">
                        <div class="coach-box-col1 w-col w-col-3">
                          @php
                              $ext = strtolower(pathinfo($symptom->recom_program_image, PATHINFO_EXTENSION));
                              $pos = strpos($symptom->recom_program_image, $imgUrl);
                          @endphp
                          @if(in_array($ext, $supportImageExtensions))
                            <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{$symptom->recom_program_image}}" class="book-image" /></a>
                          @elseif($pos !== false)
                            <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{$symptom->recom_program_image}}" class="book-image" /></a>
                          @else
                            <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{ asset('all/images/hapily-coach-image2.png')}}" alt="" class="coach-image"></a>
                          @endif
                        </div>
                        <div class="coach-box-col2 w-col w-col-9">
                          <div class="coach-box-conent">
                            <p class="coach-box-content-paragraph">
                              @php
                                $programText = $symptom->recom_program_description;
                                $position = false;
                                if (strlen($programText) > 301) {
                                  $position = strpos($programText, ' ', 300);
                                }
                              @endphp
                              @if ($position !== false)
                                  <span>
                                      {{substr($programText, 0, $position)}}
                                  </span>
                                  <span id="{{$areaKey + 1}}-program-{{$key + 1}}" style="display:none">
                                      {{substr($programText, $position)}}
                                  </span>
                                  <button class="btn btn-link" onclick="showMore('{{$areaKey + 1}}-program-{{$key + 1}}')">Weiterlesen...</button>
                              @else
                              {{-- Making Gratis-Coaching bold --}}
                                @php
                                  $pos = strpos($programText, 'Gratis-Coaching');
                                  $length = strlen('Gratis-Coaching');
                                @endphp
                                @if ($pos !== false)
                                  {{substr($programText, 0, $pos)}} <strong>Gratis-Coaching</strong> {{substr($programText, $pos + $length)}}
                                @else
                                  {{$programText}}
                                @endif
                              @endif
                            </p>
                            <div class="recommanded-book-purple-link"><a class="recommanded-book-purple-link" href="{{ $symptom->recom_program_url ? $symptom->recom_program_url : '#'}}"  target="_blank">&gt; Mehr erfahren...</a></div> 
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                {{-- @endif --}}
                <!-- coaching content ends here -->

                <!-- book content starts here -->
                <div class="book-tip-content">
                  <p class="normal-text"><strong>Buch-Tipp</strong></p>
                  <div class="coach-image-box">
                    <div class="coach-box-columns w-row">
                      <div class="coach-box-col1 w-col w-col-3"><a href="{{ $symptom->recom_book_url ? $symptom->recom_book_url : '#'}}"  target="_blank" rel="nofollow"><img src="{{ $symptom->recom_book_image ? $symptom->recom_book_image : asset('all/images/book-cover.png')}}" alt="" class="book-image"></a></div>
                      <div class="coach-box-col2 w-col w-col-9">
                        <div class="coach-box-conent">
                          <p class="coach-box-content-paragraph">
                            <span>
                              @php
                                $bookText = $symptom->recom_book_description;
                                $position = false;
                                if (strlen($bookText) > 301) {
                                    $position = strpos($bookText, ' ', 300);
                                }
                              @endphp
                              @if ($position !== false)
                                  <span>
                                      {{substr($bookText, 0, $position)}}
                                  </span>
                                  <span id="{{$areaKey + 1}}-book-{{$key + 1}}" style="display:none">
                                      {{substr($bookText, $position)}}
                                  </span>
                                  <button class="btn btn-link" onclick="showMore('{{$areaKey + 1}}-book-{{$key + 1}}')">Weiterlesen...</button>
                              @else
                                  {{$bookText}}   
                              @endif
                          </p>
                          <div class="recommanded-book-purple-link"><a class="recommanded-book-purple-link" href="{{ $symptom->recom_book_url ? $symptom->recom_book_url : '#'}}"  target="_blank" rel="nofollow">&gt; Bestellen...</a></div> 
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- book content ends here -->
              </div>
            </div>
            @if(count($area->symptoms) > 2  && $key == 1)
              <p class="purple-header moreSymtpoms" onclick="showMoreSymptoms({{($areaKey + 1)}})">&gt; {{ count($area->symptoms) - 2 }} <span id="totalSymptoms-{{($areaKey + 1)}}" style="display: none;">{{ count($area->symptoms) - 2 }}</span> <span id="symptomShowMoreText-{{($areaKey + 1)}}">weitere </span>@if(count($area->symptoms) - 2 == 1)<span id="showLessTextSingular-{{ ($areaKey + 1) }}">Herausforderung</span> @else <span id="showLessTextPlural-{{ ($areaKey + 1) }}">Herausforderungen</span> @endif anzeigen</p>
            @endif
          @endif
          <!-- hidden symptoms start here -->
            @if($key > 1)
              <div class="hidden-symptoms-{{($areaKey + 1)}}" id="symptom-div-{{($areaKey + 1)}}" style="display: none;">
                <div class="section-analyse-purple-header-container">
                  <h4 class="purple-header">{{$key + 1}}. {{$symptom->name}}</h4>
                  <p class="centered-paragraph"><strong>{{$symptom->othersHavingThis}}%</strong> aller Teilnehmer teilen deine Herausforderung</p>
                  <div class="indented-content-container">
                    <div class="text-contet">
                      <p class="normal-text"><strong>Sofort-Tipp</strong></p>
                      <p class="normal-text">{{$symptom->instant_help}}</p>
                    </div>
                    <!-- coaching content here -->
                    {{-- @if(strlen($symptom->recom_program) != 0)) --}}
                      <div class="coaching-tip-content">
                        <p class="normal-text"><strong>Coaching-Tipp</strong></p>
                        <div class="coach-image-box">
                          <div class="coach-box-columns w-row">
                            <div class="coach-box-col1 w-col w-col-3">
                              @php
                                  $ext = strtolower(pathinfo($symptom->recom_program_image, PATHINFO_EXTENSION));
                                  $pos = strpos($symptom->recom_program_image, $imgUrl);
                              @endphp
                              @if(in_array($ext, $supportImageExtensions))
                                <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{$symptom->recom_program_image}}" class="book-image" /></a>
                              @elseif($pos !== false)
                                <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{$symptom->recom_program_image}}" class="book-image" /></a>
                              @else
                                <a href="{{$symptom->recom_program_url}}" target="_blank"><img src="{{ asset('all/images/hapily-coach-image2.png')}}" alt="" class="coach-image"></a>
                              @endif
                            </div>
                            <div class="coach-box-col2 w-col w-col-9">
                              <div class="coach-box-conent">
                                <p class="coach-box-content-paragraph">
                                  @php
                                    $programText = $symptom->recom_program_description;
                                    $position = false;
                                    if (strlen($programText) > 301) {
                                      $position = strpos($programText, ' ', 300);
                                    }
                                  @endphp
                                  @if ($position !== false)
                                    <span>
                                        {{substr($programText, 0, $position)}}
                                    </span>
                                    <span id="{{$areaKey + 1}}-program-{{$key + 1}}" style="display:none">
                                        {{substr($programText, $position)}}
                                    </span>
                                    <button class="btn btn-link" onclick="showMore('{{$areaKey + 1}}-program-{{$key + 1}}')">Weiterlesen...</button>
                                  @else
                                  {{-- Making Gratis-Coaching bold --}}
                                    @php
                                      $pos = strpos($programText, 'Gratis-Coaching');
                                      $length = strlen('Gratis-Coaching');
                                    @endphp
                                    @if ($pos !== false)
                                      {{substr($programText, 0, $pos)}} <strong>Gratis-Coaching</strong> {{substr($programText, $pos + $length)}}
                                    @else
                                      {{$programText}}
                                    @endif
                                  @endif
                                </p>
                                <div class="recommanded-book-purple-link"><a class="recommanded-book-purple-link" href="{{ $symptom->recom_program_url ? $symptom->recom_program_url : '#'}}"  target="_blank">&gt; Mehr erfahren...</a></div> 
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    {{-- @endif --}}
                    <!-- coaching content ends here -->

                    <!-- book content starts here -->
                    <div class="book-tip-content">
                      <p class="normal-text"><strong>Buch-Tipp</strong></p>
                      <div class="coach-image-box">
                        <div class="coach-box-columns w-row">
                          <div class="coach-box-col1 w-col w-col-3"><a href="{{ $symptom->recom_book_url ? $symptom->recom_book_url : '#'}}"  target="_blank" rel="nofollow"><img src="{{ $symptom->recom_book_image ? $symptom->recom_book_image : asset('all/images/book-cover.png')}}" alt="" class="book-image"></a></div>
                          <div class="coach-box-col2 w-col w-col-9">
                            <div class="coach-box-conent">
                              <p class="coach-box-content-paragraph">
                                <span>
                                  @php
                                    $bookText = $symptom->recom_book_description;
                                    $position = false;
                                    if (strlen($bookText) > 301) {
                                        $position = strpos($bookText, ' ', 300);
                                    }
                                  @endphp
                                  @if ($position !== false)
                                    <span>
                                        {{substr($bookText, 0, $position)}}
                                    </span>
                                    <span id="{{$areaKey + 1}}-book-{{$key + 1}}" style="display:none">
                                        {{substr($bookText, $position)}}
                                    </span>
                                    <button class="btn btn-link" onclick="showMore('{{$areaKey + 1}}-book-{{$key + 1}}')">Weiterlesen...</button>
                                  @else
                                    {{$bookText}}   
                                  @endif
                              </p>
                              <div class="recommanded-book-purple-link"><a class="recommanded-book-purple-link" href="{{ $symptom->recom_book_url ? $symptom->recom_book_url : '#'}}"  target="_blank" rel="nofollow">&gt; Bestellen...</a></div> 
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- book content ends here -->
                  </div>
                </div>
              </div>
            @endif
          <!-- end hidden symptoms -->
        @endforeach 
      @endif
    </div>
    @endforeach

  </div>
  <div class="section-text-after-analyse">
    <div class="section-text-after-analyse-container">
      <h3 class="section-analyse-header heading-6">Deine Glaubenssätze<br></h3>
      <p class="paragraph">In einigen Fällen sind unsere Herausforderungen von äußeren Faktoren bestimmt, die wir nicht beeinflussen können. Oftmals sind sie aber auch hausgemacht - weil wir Überzeugungen von uns selbst haben, die uns einschränken. Lass uns daher einmal schauen, wie es in deinem Fall aussieht…</p>
      <p class="paragraph">Könnte es sein, dass du schon einmal eine oder mehrere der folgenden Aussagen über dich geglaubt hast?</p><br />
      <!-- belief content starts here -->
      @php
        count($userBelives) > 9 ? $believesToShow = array_slice($userBelives, 0, 9) : $believesToShow = $userBelives;
        $believesChunks = array_chunk($believesToShow, 3, "preserve_keys");
      @endphp
    
      @foreach ($believesChunks as $believesArray)
        <div class="_3-columns-text-separated">
          @foreach ($believesArray as $belief)
            <div class="_3-columns-text">{{$belief}}</div>
          @endforeach
        </div>
      @endforeach
      <!-- belief content ends here -->

      {{-- <h3 class="h3-black-heading">Könnte es sein, dass du schon einmal eine oder mehrere der folgenden Aussagen über dich geglaubt hast?</h3>
      <div class="_3-columns-text-separated">
        <div class="_3-columns-text">Ich genüge nicht</div>
        <div class="_3-columns-text">Ich bin nix wert</div>
        <div class="_3-columns-text">Ich bin zu dick</div>
      </div>
      <div class="_3-columns-text-separated">
        <div class="_3-columns-text">Ich falle zur Last</div>
        <div class="_3-columns-text">Ich werde nicht geliebt</div>
        <div class="_3-columns-text">Das Leben ist hart</div>
      </div> --}}
      <div class="section-after-analyse-text-content">
        <div class="section-after-analyse-text"><br />Wie wir bestimmte Situationen bewerten, hängt maßgeblich von unseren Erfahrungen als Kind sowie im weiteren Verlauf unseres Lebens ab.<br><br>Wenn dir damals in der Schule ein Lehrer z.B. immer wieder gesagt hat, dass du ein Versager bist, prägt sich diese Aussage in deinem Unterbewusstsein ein. Das kann zur Folge haben, dass du später als Erwachsener Herausforderungen vermeidest, weil du der Überzeugung bist, dass du sowieso scheitern wirst.<br><br>&quot;<strong>Ich bin nicht gut genug</strong>&quot; ist eine der häufigsten negativen Überzeugungen, die wir von uns haben.<br><br>Das Problem solcher <strong>limitierenden Glaubenssätze</strong> ist: Sie laufen automatisch ab - wie ein Softwareprogramm auf deinem Computer - das im Hintergrund läuft, ohne dass du es mitbekommst. Wissenschaftler gehen davon aus, dass unser Verhalten zu bis zu 90% von unserem <strong>Unterbewusstsein gesteuert</strong> wird, d.h. du handelst nur in den seltensten Fällen bewusst.</div><img src="{{ asset('all/images/male_sofa_image-small.png')}}" height="320" width="800" sizes="(max-width: 479px) 92vw, (max-width: 991px) 95vw, 800px" alt="" class="male-in-sofa-image">
        <div class="section-after-analyse-text">Die oben aufgeführten Glaubenssätze passen zu deinen Angaben im Glücks-Test und die Wahrscheinlichkeit ist hoch, dass diese <strong>limitierenden Überzeugungen</strong> in deinem Unterbewusstsein ablaufen und <strong>dich täglich davon abhalten, dein volles Potenzial zu entfalten.<br></strong><br>Willst du dein Leben einfach nur automatisch an dir vorbeiziehen lassen? Oder möchtest du selbst die <strong>Kontrolle </strong>darüber haben, was du denkst, wie du fühlst und welche Ergebnisse du erzielst?<br><strong>Die meisten Menschen überlassen ihr Leben dem Autopiloten</strong> und kommen nicht voran. Auf diese Weise ist <strong>Unglück vorprogrammiert</strong> und ein glückliches Leben quasi unmöglich.<br></div>
      </div>
    </div>
  </div>
  <div class="section-green-background">
    <div class="section-green-container">
      <h3 class="section-green-header"><span class="green-text">Die gute Nachricht ist :</span> Du bist deinen negativen Glaubenssätzen und den damit verbundenen Gefühlen nicht hilflos ausgeliefert.</h3>
      <div class="section-green-normal-text">Aus der Neurowissenschaft sowie aus unzähligen Coachings wissen wir, dass es möglich ist, aus seinem aktuellen Leben auszubrechen und sich systematisch ein erfülltes und glückliches Leben zu erschaffen. Und zwar mit sofortigen Ergebnissen!<br><br>Aus diesem Grund haben wir ein <strong>kostenloses Glücks-Training entwickelt</strong>, in dem wir dir zeigen, wie du deine negativen Glaubenssätze durch positive Überzeugungen ersetzen kannst. Lerne noch HEUTE, was Glück wirklich bedeutet und wie du <strong>dir Schritt für Schritt dein Wunschleben</strong> kreierst.</div>
      <div class="section-green-image-text-container"><img src="{{ asset('all/images/online_traning_image.png')}}" width="320" height="216" sizes="(max-width: 479px) 92vw, (max-width: 767px) 346.671875px, 320px" alt="" class="section-green-lady-image">
        <div class="section-green-right-content">
          <div class="sectionn-green-right-content-text"><strong>Gratis Online-Training<br></strong><br>In dir steckt so viel Potenzial - Mache jetzt den ersten Schritt und melde dich für das kostenlose Glücks-Training an.</div><a href="https://event.webinarjam.com/register/1/8r85qtn" target="_blank" class="section-green-purple-button w-button">&gt; Ich bin dabei!</a>
          <p class="section-green-right-content-small-text">Nur 100 Gratis-Plätze verfügbar - <strong>Jetzt anmelden!</strong></p>
        </div>
      </div>
    </div>
  </div>
  <div class="section-before-footer">
    <div class="section-before-footer-container">
      <h3 class="section-before-footer-header heading-6">Wer steckt hinter dem Glücks-Test?</h3>
      <div class="section-before-footer-text">Die Glücks-Experten Denis Martin und Marcus Börner haben hapily gegründet, um Menschen dabei zu unterstützen, die wohl wichtigste Frage für sich zu klären: Was macht ein glückliches Leben aus?<br><br>Als Autor von &quot;Managing Happiness&quot; konnte Marcus bereits unzähligen Menschen dabei helfen, sich ein erfülltes Leben zu erschaffen. Denis hat als Life Coach hunderte von Menschen auf dem Weg zu ihrem Wunschleben begleitet.<br><br>Mit hapily haben die beiden eine Akademie für persönliches Wachstum gegründet, um fortan noch viel mehr Menschen erreichen und bei ihrer Transformation begleiten zu können.<br><br>Mehr erfahren auf: <span class="blue-text"><a href="https://www.hapily.de" target="_blank">www.hapily.de</a></span></div>
      <div class="section-before-footer-two-images-content"><img src="{{ asset('all/images/marcus-image.png')}}" width="150" height="150" srcset="{{ asset('all/images/marcus-image-p-500.png')}} 500w, images/marcus-image.png')}} 544w" sizes="(max-width: 479px) 120px, 150px" alt="" class="section-before-footer-image1"><img src="{{ asset('all/images/denis-image.png')}}" width="150" height="150" alt="" class="section-before-footer-image2"></div>
      <p class="section-before-footer-quote"><span class="green-quote">&quot;</span><strong>Jede Transformation fängt mit einer Erkenntnis und dem Willen für Veränderung an</strong><span class="green-quote">&quot;</span> <br>- Denis &amp; Marcus (Autoren, Coaches und Gründer von hapily)</p>
      <div class="section-before-footer-separator"></div>
    </div>
  </div>
  <div class="footer-section-container">
    <div class="section-footer">
      <div class="section-footer-wrapper"><a href="https://hapily.de"><img src="{{ asset('all/images/hapily_logo_primary.svg')}}" alt="" class="footer-logo"></a>
        <div class="footer-text-one"><a href="https://www.hapily.de/impressum" target="_blank" class="link-32">Impressum</a></div>
        <div class="footer-text"><a href="https://www.hapily.de/datenschutz" target="_blank" class="link-33">Datenschutzbestimmungen</a></div>
        <a href="https://www.facebook.com/hapily.de" target="_blank" class="footer-facebook-link w-inline-block"><img src="{{ asset('all/images/facebook-black.svg')}}" alt="" class="footer-social-icon-facebook"></a>
        <a href="http://instagram.com/hapily.de" target="_blank" class="footer-instagram-link w-inline-block"><img src="{{ asset('all/images/instagram-black.svg')}}" alt="" class="footer-social-icon-instagram"></a>
        <a href="https://www.linkedin.com/company/hapily" target="_blank" class="footer-linkedin-link w-inline-block"><img src="{{ asset('all/images/linkedin-black.svg')}}" alt="" class="footer-social-icon-linkedin"></a>
      </div>
    </div>
  </div>

  <!-- popup modals here -->


  <!-- The Modal -->
  <div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="modal-content">
      <p style="text-align: right;"><span class="closeSpanThankYou">&times;</span>
      <p style="text-align: center;"><img src="{{ asset('all/images/subscriptioncheckmark.svg')}}" alt="" height="100" width="100" /></p>
      <h2>Prima, das hat geklappt!</h2>
      <p>Du bist jetzt für unseren Newsletter angemeldet<p>
    </div>
  </div>


  <!-- end popup modals here -->

  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5e87229d1e5bbf88766c2782" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="{{ asset('all/js/webflow.js')}}" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

<script>
  // Get the modal for thank
  var modalThankYou = document.getElementById("myModal");

  // Get modal for confirmation
  var modal = document.getElementById("myModal2");
  
  // Get the button that opens the modal
  var btn = document.getElementById("myBtn2");

  // The subscription trigger in option 5
  var subscriptionTrigger = document.getElementById("subscription_trigger");
  
  // Get the <span> element that closes the thank you modal
  var span = document.getElementsByClassName("closeSpanThankYou")[0];

  var spanCloseConfirm = document.getElementsByClassName("close")[0];
  
  // When the user clicks the button, open the modal 
  subscriptionTrigger.onclick = function() {
    modal.style.display = "block";
  }


  //subscribe functionalities
  $('#agreeBtn').click(function(event) {
    let token = $('#user_token').val();
    let option = "option5"; //to subscribe
    let _token   = $('meta[name="csrf-token"]').attr('content');

    let modalConfirm = document.getElementById("myModal2");
    let modalThankYouToDisplay = document.getElementById("myModal");

    //do ajax here and response will hide the modal and display the thank you one.
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            //console.log(response);
            //if unchecked, check else uncheck
            if(response.message == 'set-to-true') {
              $("#checkbox_five").prop("checked", true);
              $("#checkbox_five").prop('disabled', true);
              modalConfirm.style.display = "none";
              setTimeout(function(){ 
                modalThankYouToDisplay.style.display = "block";
              }, 3000);

              //$("#checkbox_five").style.display = "none";
            } else {
              alert('There was a problem. Please try again later...');
              console.log('response not okay');
              $("#checkbox_one").prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });


  // When the user clicks on <span> (x), close the modal
  span.onclick = function() {
    modalThankYou.style.display = "none";
    
    location.reload(); //reload the page
  }
  
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modalThankYou.style.display = "none";
      location.reload(); //reload the page
    }
  }

  spanCloseConfirm.onclick = function() {
    modal.style.display = "none";
  }
  
</script>


<script type="text/javascript">
  $("#checkbox_one").change(function(event) {
    let thisCheck = $(this);
    let url = window.location.href;
    let token = window.location.href.split("/").pop();
    let option = "option1";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            //console.log(response);
            //if unchecked, check else uncheck
            if(response.message == 'set-to-true') {
              thisCheck.prop("checked", true);
              console.log('response okay');
            } else {
              console.log('response not okay');
              thisCheck.prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });

  $("#checkbox_two").change(function(event) {
    let thisCheck = $(this);
    let url = window.location.href;
    let token = window.location.href.split("/").pop();
    let option = "option2";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            if(response.message == 'set-to-true') {
              thisCheck.prop("checked", true);
              console.log('response okay');
            } else {
              console.log('response not okay');
              thisCheck.prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });

  $("#checkbox_three").change(function(event) {
    let thisCheck = $(this);
    let url = window.location.href;
    let token = window.location.href.split("/").pop();
    let option = "option3";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            if(response.message == 'set-to-true') {
              thisCheck.prop("checked", true);
              console.log('response okay');
            } else {
              console.log('response not okay');
              thisCheck.prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });

  $("#checkbox_four").change(function(event) {
    let thisCheck = $(this);
    let url = window.location.href;
    let token = window.location.href.split("/").pop();
    let option = "option4";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            if(response.message == 'set-to-true') {
              thisCheck.prop("checked", true);
              console.log('response okay');
            } else {
              console.log('response not okay');
              thisCheck.prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });
  

  $("#checkbox_five").change(function(event) {
    let thisCheck = $(this);
    let url = window.location.href;
    let token = window.location.href.split("/").pop();
    let option = "option5";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            if(response.message == 'set-to-true') {
              thisCheck.prop("checked", true);
              console.log('response okay');
            } else {
              console.log('response not okay');
              thisCheck.prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });

  $("#checkbox_six").change(function(event) {
    let thisCheck = $(this);
    let url = window.location.href;
    let token = window.location.href.split("/").pop();
    let option = "option6";
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
          url: "/survey/feedback",
          type:"POST",
          data:{
            token:token,
            option:option,
            _token: _token,
          },
          success:function(response){
            if(response.message == 'set-to-true') {
              thisCheck.prop("checked", true);
              console.log('response okay');
            } else {
              console.log('response not okay');
              thisCheck.prop("checked", false);
            }
          },
          error: function(){
            console.log("something went wrong");
          }
    });
    event.preventDefault();
  });
</script>

<script>
  function showMore(id) {
      var x = document.getElementById(id);
      var nextBtn = x.nextElementSibling;
      if (x.style.display === "none") {
          x.style.display = "inline";
          nextBtn.innerHTML = "Weniger lesen...";
      } else {
          x.style.display = "none";
          nextBtn.innerHTML = "Weiterlesen...";
      }
  }
  function showMoreSymptoms(id) {
    // var divBlock = document.getElementById('symptom-div-'+id);
    //need to use class as there many divs to turn display from none to block
    var divBlock = document.getElementsByClassName("hidden-symptoms-"+id); 
    var symptonMoreText = document.getElementById('symptomShowMoreText-'+id);
    var symptomCount = document.getElementById('totalSymptoms-'+id).innerText;
    
    if(symptomCount == 1){
      var showLessTextSingular = document.getElementById('showLessTextSingular-'+id);
    } else {
      var showLessTextPlural = document.getElementById('showLessTextPlural-'+id);
    }
    for (var i = 0; i < divBlock.length; i++) {
      if (divBlock[i].style.display === "none") {
        divBlock[i].style.display = "block";
        symptonMoreText.innerHTML = "weniger ";
        if(symptomCount > 1){
            showLessTextPlural.innerHTML = "";
        } else {
            showLessTextSingular.innerHTML = "";
        }
      } else {
        divBlock[i].style.display = "none";
        symptonMoreText.innerHTML = "weitere ";
        if(symptomCount > 1){
            showLessTextPlural.innerHTML = "Herausforderungen"; //to see how it looks like for one symptom
        } else {
            showLessTextSingular.innerHTML = "Herausforderung";
        }
      }
    }
  }
  //Scroll top button
  //Get the button
  var mybutton = document.getElementById("myBtn");
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};
  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }
  // When the user clicks on the button, scroll to the top of the document (To the div with id="top")
  function topFunction() {
    var topDiv = document.getElementById('top');
    //document.body.scrollTop = 600;
    //document.documentElement.scrollTop = 600;
    topDiv.scrollIntoView();
  }
</script>
