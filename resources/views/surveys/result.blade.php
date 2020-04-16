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
  <link href="{{ asset('all/images/favicon.ico')}}" rel="shortcut icon" type="image/x-icon">
  <link href="{{ asset('all/images/webclip.png')}}')}}" rel="apple-touch-icon">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
  <div class="section-header"><img src="{{ asset('all/images/hapily_logoprimary.svg')}}" alt="" class="survey-logo">
    <h1 class="heading-5">Dein Glücks-Bericht<br></h1>
  </div>
  <div class="side-green-container">
    <h4 class="side-green-container-header">Kostenloses Online-Training - Entfalte jetzt dein Glücks-Potenzial!</h4><a href="#" class="side-green-container-button w-button">&gt; Kostenlos anmelden</a>
    <h5 class="side-green-container-header-small">Was du im Training <br>lernen wirst</h5>
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
        <div class="bold-text">Hey {{$customer->first_name}},</div>
        <p class="paragraph">schön, dass du den Test abgeschlossen hast und deinem Glück auf die Sprünge helfen willst :-) Deine aktuelle Situation sowie die Ursachen dafür besser zu verstehen, ist der erste Schritt in Richtung eines erfüllteren und zufriedeneren Lebens.<br>‍</p>
        <p>Dein berechneter <strong>Happiness Score</strong> liegt bei <strong>{{$totalAllAreasHappiness}} von {{$numberAreas * 10}} Punkten</strong></p>
        <p class="paragraph-2">Im Durchschnitt erreichen Teilnehmer einen Score von 38. In der folgenden Grafik kannst du dein Glückslevel pro Lebensbereich ablesen und mit dem Durchschnitt der anderen Teilnehmer vergleichen.</p>
      </div>
      <div class="score-elements">
        <h3 class="heading-6">Dein Happiness-Score pro Lebensbereich</h3>
        <div class="score-columns w-row">
          <div class="score-column1 w-col w-col-6 w-col-medium-6">
            <div class="score-column1-columns w-row">
              <div class="score-column1-col1 w-col w-col-6">
                <div class="score-column1-col1-container">
                  <h5 class="score-column-heading5-centered">Dein <br>Happiness-Score</h5>
                  <div class="organge-score">{{$totalAllAreasHappiness}}</div>
                  <div class="score-grey-text">Durchschnitt aller <br>Teilnehmer: 38</div>
                </div>
              </div>
              <div class="score-column1-col2 w-col w-col-6">
                <div class="score-column1-col2-container">
                  <h5 class="score-column-heading5-centered">Dein Score liegt<br></h5>
                  <div class="red-score-with-big-padding">{{$percentageMaxPotential}}%</div>
                  <div class="score-grey-text">unter deinem <br>maximalen Potenzial</div>
                </div>
              </div>
            </div>
            <ul class="socre-list w-list-unstyled">
              <li class="list-item-score">Am <span class="green-list-text-span">glücklichsten </span>schätzt du dich im Lebensbereich <strong>Freundschaften </strong>ein, gefolgt von <strong>Beruf &amp; Karriere </strong>und <strong>Körper &amp; Gesundheit.</strong></li>
              <li class="list-item-score">Das größte <span class="text-span-5">Verbesserungspotenzial</span> scheinst du in der Liebe zu haben.</li>
            </ul>
          </div>
          <div class="score-column2 w-col w-col-6 w-col-medium-6">
            <div class="score-column2-container">
              <div class="score-column2-div-header">
                <div class="inline-text-left">Lebensbereich</div>
                <div class="inline-text-right">Happiness Score</div>
              </div>
              
              <div class="score-progress-bar-container">

                @foreach ($allAreasResults as $area)
                  <div class="progress-bar-wrapper">
                    <div class="embed-score-pogress-bar-label-container">
                      {{-- <div class="embeded-score-label">Beruf &amp; Karriere</div> --}}
                      <div class="embeded-score-label">{{$area->name}}</div>
                      <div class="embeded-score-label">{{$area->scoreAreaOfLife}}</div>
                    </div>
                    <div class="embeded-score-progress-bar-career w-embed">
                      <div style="width: 100%;">
                        <div class="" style="position: relative; width: 40%; height: 16px; border-right: 1px solid #dd22ef;"></div>
                      </div>
                      <div class="progress" style="background-color: #ffeadd; border-radius: 10px; margin-top: -16px;">
                        <div class="progress-bar" role="progressbar" style="width: {{$area->scoreAreaOfLife * 10}}%; background-color: #33dd93; border-radius: 10px" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
      <h3 class="section-analyse-header">Deine Analyse pro Lebensbereich<br></h3>
      <div class="section-analyse-text">In der Glücksforschung ist man sich einig, dass es - obwohl Glück für jeden etwas anderes bedeuten kann - ein paar <strong>Glücksfaktoren</strong> gibt, die für alle Menschen gelten. Dazu gehören z.B., dass wir einem <strong>erfüllenden Beruf</strong> nachgehen, <strong>liebevolle Beziehungen</strong> pflegen, physisch und mental <strong>gesund</strong> sind und einen <strong>Sinn</strong> in unserem Leben erkennen.<br><br>Lass uns nun einen tieferen Blick auf <strong>deine Potenziale</strong> pro Lebensbereich werfen:<br></div>
    </div>
    
    @foreach ($allAreasResults as $area)
      <div class="life-area-container">
        <div class="life-area-container-header"><img src="{{ asset('all/images/ring_icon.svg')}}" alt="" class="life-area-partnerschaft-image">
          <h3 class="life-area-header">{{$area->name}}</h3>
          <div class="life-area-score-columns-container">
            <div class="score-column1-columns life-area-columns w-row">
              <div class="score-column1-col1 w-col w-col-6">
                <div class="life-area-score-container1">
                  <h5 class="score-column-heading5-centered">Dein <br>Happiness-Score</h5>
                  <div class="red-score">{{$area->scoreAreaOfLife}}</div>
                  <div class="score-grey-text">Durchschnitt aller <br>Teilnehmer: xxx</div>
                </div>
              </div>
              <div class="score-column1-col2 w-col w-col-6">
                <div class="life-area-score-container2">
                  <h5 class="score-column-heading5-centered">Dein Score liegt<br></h5>
                  <div class="organge-score-life-area-score">xxx</div>
                  <div class="score-grey-text">Deine Herausforderungen stellen gleichzeitig dein Potenzial dar</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @foreach ($area->symptoms as $key => $symptom)
        <div class="section-analyse-purple-header-container">
          <h4 class="purple-header">{{$key + 1}}. {{$symptom->title}}</h4>
          <p class="normal-text">{{$symptom->instant_help}}.</p>
          <p class="centered-paragraph"><strong>12,3%</strong> aller Teilnehmer teilen diese Herausforderung</p>
        </div>
        <div class="life-area-recommandation-books-container">
          <div class="books-recommandation-columns-container w-row">
            <div class="books-recommandation-column1 w-col w-col-6">
              <div class="books-recommandation-column1-container">
                <div class="book-cover-container"><img src="{{ asset('all/images/book-cover.png')}}" alt="" class="book-cover-image"></div>
                <div class="recommanded-book-header">Unser Buch-Tipp</div>
                <div class="recommanded-book-normal-text">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea modo exercitation ullamco laboris nisi.</div>
                <div class="recommanded-book-purple-link">&gt; Bestellen</div>
              </div>
            </div>
            <div class="books-recommandation-column2 w-col w-col-6">
              <div class="book-recommandation-column2-container">
                <div class="book-coach-container"><img src="{{ asset('all/images/coach-cover.png')}}" alt="" class="coach-cover-image"></div>
                <div class="recommanded-book-header">Unser Coaching-Tipp</div>
                <div class="recommanded-book-normal-text">Quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea modo exercitation ullamco laboris nisi.</div>
                <div class="recommanded-book-purple-link">&gt; Mehr erfahren...</div>
              </div>
            </div>
          </div>
        </div>
      @endforeach 



      <div class="purple-paragraph-container">
        <p class="purple-header">&gt; 7 weitere Herausforderungen im Lebensbereich Partnerschaft anzeigen</p>
      </div>
          
    @endforeach





  </div>
  <div class="section-text-after-analyse">
    <div class="section-text-after-analyse-container">
      <h3 class="h3-black-heading">Könnte es sein, dass du schon einmal eine oder mehrere der folgenden Aussagen über dich geglaubt hast?</h3>
      <div class="_3-columns-text-separated">
        <div class="_3-columns-text">Ich genüge nicht</div>
        <div class="_3-columns-text">Ich bin nix wert</div>
        <div class="_3-columns-text">Ich bin zu dick</div>
      </div>
      <div class="_3-columns-text-separated">
        <div class="_3-columns-text">Ich falle zur Last</div>
        <div class="_3-columns-text">Ich werde nicht geliebt</div>
        <div class="_3-columns-text">Das Leben ist hart</div>
      </div>
      <div class="section-after-analyse-text-content">
        <div class="section-after-analyse-text">This is some text inside of a div block.Wie wir bestimmte Situationen bewerten, hängt maßgeblich von unseren Erfahrungen als Kind sowie im weiteren Verlauf unseres Lebens ab.<br><br>Wenn dir damals in der Schule ein Lehrer z.B. immer wieder gesagt hat, dass du ein Versager bist, prägt sich diese Aussage in deinem Unterbewusstsein ein. Das kann zur Folge haben, dass du später als Erwachsener Herausforderungen vermeidest, weil du der Überzeugung bist, dass du sowieso scheitern wirst.<br><br>&quot;<strong>Ich bin nicht gut genug</strong>&quot; ist eine der häufigsten negativen Überzeugungen, die wir von uns haben.<br><br>Das Problem solcher <strong>limitierenden Glaubenssätze</strong> ist: Sie laufen automatisch ab - wie ein Softwareprogramm auf deinem Computer - das im Hintergrund läuft, ohne dass du es mitbekommst. Wissenschaftler gehen davon aus, dass unser Verhalten zu bis zu 90% von unserem <strong>Unterbewusstsein gesteuert</strong> wird, d.h. du handelst nur in den seltensten Fällen bewusst.</div><img src="{{ asset('all/images/male_sofa_image-small.png')}}" height="320" width="800" srcset="{{ asset('all/images/male_sofa_image-small-p-500.png')}} 500w, images/male_sofa_image-small-p-800.png')}} 800w, images/male_sofa_image-small-p-1080.png')}} 1080w, images/male_sofa_image-small.png')}} 1600w" sizes="(max-width: 479px) 92vw, (max-width: 991px) 95vw, 800px" alt="" class="male-in-sofa-image">
        <div class="section-after-analyse-text">Die oben aufgeführten Glaubenssätze passen zu deinen Angaben im Glücks-Test und die Wahrscheinlichkeit ist hoch, dass diese <strong>limitierenden Überzeugungen</strong> in deinem Unterbewusstsein ablaufen und <strong>dich täglich davon abhalten, dein volles Potenzial zu entfalten.<br></strong><br>Willst du dein Leben einfach nur automatisch an dir vorbeiziehen lassen? Oder möchtest du selbst die <strong>Kontrolle </strong>darüber haben, was du denkst, wie du fühlst und welche Ergebnisse du erzielst?<br><strong>Die meisten Menschen überlassen ihr Leben dem Autopiloten</strong> und kommen nicht voran. Auf diese Weise ist <strong>Unglück vorprogrammiert</strong> und ein glückliches Leben quasi unmöglich.<br></div>
      </div>
    </div>
  </div>
  <div class="section-green-background">
    <div class="section-green-container">
      <h3 class="section-green-header"><span class="green-text">Die gute Nachricht ist</span>: Du bist deinen negativen Glaubenssätzen und den damit verbundenen Gefühlen nicht hilflos ausgeliefert.</h3>
      <div class="section-green-normal-text">Aus der Neurowissenschaft sowie aus unzähligen Coachings wissen wir, dass es möglich ist, aus seinem aktuellen Leben auszubrechen und sich systematisch ein erfülltes und glückliches Leben zu erschaffen. Und zwar mit sofortigen Ergebnissen!<br><br>Aus diesem Grund haben wir ein <strong>kostenloses Glücks-Training entwickelt</strong>, in dem wir dir zeigen, wie du deine negativen Glaubenssätze durch positive Überzeugungen ersetzen kannst. Lerne noch HEUTE, was Glück wirklich bedeutet und wie du <strong>dir Schritt für Schritt dein Wunschleben</strong> kreierst.</div>
      <div class="section-green-image-text-container"><img src="{{ asset('all/images/online_traning_image.png')}}" width="320" height="216" srcset="{{ asset('all/images/online_traning_image-p-500.png')}} 500w, images/online_traning_image.png')}} 642w" sizes="(max-width: 479px) 92vw, (max-width: 767px) 346.671875px, 320px" alt="" class="section-green-lady-image">
        <div class="section-green-right-content">
          <div class="sectionn-green-right-content-text"><strong>Gratis Online-Training<br></strong><br>In dir steckt so viel Potenzial - Mache jetzt den ersten Schritt und melde dich für das kostenlose Glücks-Training an.</div><a href="#" class="section-green-purple-button w-button">&gt; Ich bin dabei!</a>
          <p class="section-green-right-content-small-text">Nur 100 Gratis-Plätze verfügbar - <strong>Jetzt anmelden!</strong></p>
        </div>
      </div>
    </div>
  </div>
  <div class="section-before-footer">
    <div class="section-before-footer-container">
      <h3 class="section-before-footer-header">Wer steckt hinter dem Glücks-Test?</h3>
      <div class="section-before-footer-text">Die Glücks-Experten Denis Martin und Marcus Börner haben hapily gegründet, um Menschen dabei zu unterstützen, die wohl wichtigste Frage für sich zu klären: Was macht ein glückliches Leben aus?<br><br>Als Autor von &quot;Managing Happiness&quot; konnte Marcus bereits unzähligen Menschen dabei helfen, sich ein erfülltes Leben zu erschaffen. Denis hat als Life Coach hunderte von Menschen auf dem Weg zu ihrem Wunschleben begleitet.<br><br>Mit hapily haben die beiden eine Akademie für persönliches Wachstum gegründet, um fortan noch viel mehr Menschen erreichen und bei ihrer Transformation begleiten zu können.<br><br>Mehr erfahren auf: <span class="blue-text">www.hapily.de</span></div>
      <div class="section-before-footer-two-images-content"><img src="{{ asset('all/images/marcus-image.png')}}" width="150" height="150" srcset="{{ asset('all/images/marcus-image-p-500.png')}} 500w, images/marcus-image.png')}} 544w" sizes="(max-width: 479px) 120px, 150px" alt="" class="section-before-footer-image1"><img src="{{ asset('all/images/denis-image.png')}}" width="150" height="150" alt="" class="section-before-footer-image2"></div>
      <p class="section-before-footer-quote"><span class="green-quote">&quot;</span><strong>Jede Transformation fängt mit einer Erkenntnis und dem Willen für Veränderung an</strong><span class="green-quote">&quot;</span> <br>- Denis &amp; Marcus (Autoren, Coaches und Gründer von hapily)</p>
      <div class="section-before-footer-separator"></div>
    </div>
  </div>
  <div class="footer-section-container">
    <div class="section-footer">
      <div class="section-footer-wrapper"><img src="{{ asset('all/images/hapily_logo_primary.svg')}}" alt="" class="footer-logo">
        <div class="footer-text-one">Impressum</div>
        <div class="footer-text">Datenschutzbestimmungen</div><img src="{{ asset('all/images/facebook-black.svg')}}" alt="" class="footer-social-icon-facebook"><img src="{{ asset('all/images/instagram-black.svg')}}" alt="" class="footer-social-icon-instagram"><img src="{{ asset('all/images/linkedin-black.svg')}}" alt="" class="footer-social-icon-linkedin"></div>
    </div>
  </div>
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.4.1.min.220afd743d.js?site=5e87229d1e5bbf88766c2782" type="text/javascript" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>