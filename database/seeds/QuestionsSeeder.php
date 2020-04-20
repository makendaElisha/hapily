<?php

use App\Entities\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;


class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrayQuestions = [
            [
               "id" => "zXWm44r6k8dx",
               "title" => "Hallo! Sch\u00f6n, dass du da bist :) Bitte verrate uns deinen *Namen:*",
               "type" => "short_text",
               "ref" => "prename_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "WOFCgJul1ytn",
               "title" => "An welche *E-Mail* Adresse d\u00fcrfen wir dir gleich deinen *pers\u00f6nlichen Gl\u00fccks-Bericht* senden?",
               "type" => "email",
               "ref" => "email_address_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "lEj6UHOsIVwi",
               "title" => "Wann hast du *Geburtstag*?",
               "type" => "date",
               "ref" => "date_of_birth_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "LjogjuMddpXD",
               "title" => "Bitte verrate uns dein *Geschlecht.*",
               "type" => "multiple_choice",
               "ref" => "gender_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "O9zpkyNj2e5y",
                     "label" => "Weiblich"
                  ],
                  [
                     "id" => "x5Qp2P47E230",
                     "label" => "M\u00e4nnlich"
                  ],
                  [
                     "id" => "l0PJBMsFC4do",
                     "label" => "Divers"
                  ]
               ]
            ],
            [
               "id" => "rYMBiWyiNNsI",
               "title" => "In welcher *Postleitzahl* bist du Zuhause?",
               "type" => "number",
               "ref" => "postal_code_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "HsPHHEiFqGu4",
               "title" => "Hast du bereits *Kinder*?",
               "type" => "yes_no",
               "ref" => "children_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "O84QJwO9jYDI",
               "title" => "Wie gl\u00fccklich bist du allgemein mit deinem Leben? ",
               "type" => "rating",
               "ref" => "score_overall_happiness_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "PRlai8HsaeIy",
               "title" => "Wie gl\u00fccklich bist du im Bereich *Beruf & Karriere*?",
               "type" => "rating",
               "ref" => "score_beruf_und_karriere_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "kvn0GkPEZ360",
               "title" => "Stichwort *Beruf & Karriere*: Welche der folgenden Aussagen treffen auf dich zu? ",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_beruf_und_karriere_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "aLv6XV2oZUXG",
                     "label" => "Ich w\u00fcrde mir gerne finanziell mehr leisten k\u00f6nnen"
                  ],
                  [
                     "id" => "TBNx0js7FIvl",
                     "label" => "Ich werde f\u00fcr meine Leistung nicht ausreichend bezahlt"
                  ],
                  [
                     "id" => "yGX3law2WbVH",
                     "label" => "Ich wei\u00df nicht welcher Beruf mich gl\u00fccklich machen w\u00fcrde"
                  ],
                  [
                     "id" => "H4t8LEuVnhbV",
                     "label" => "Ich w\u00fcrde mich gern zur F\u00fchrungskraft entwickeln"
                  ],
                  [
                     "id" => "OoxyA9Hkvsr9",
                     "label" => "Ich kenne meine Berufung, lebe sie aber noch nicht"
                  ],
                  [
                     "id" => "tJ7pyLh83K3K",
                     "label" => "Ich sehe keine Aufstiegsm\u00f6glichkeiten"
                  ],
                  [
                     "id" => "uzbEN2Xza9tk",
                     "label" => "Ich habe Angst zu scheitern"
                  ],
                  [
                     "id" => "giGSJ3grTZtQ",
                     "label" => "Ich habe Angst meinen Job zu verlieren"
                  ],
                  [
                     "id" => "Rjtpe00ScxOE",
                     "label" => "Mein Beruf erf\u00fcllt mich nicht"
                  ],
                  [
                     "id" => "OBQCblojJ54u",
                     "label" => "Ich w\u00fcrde mich gern selbst\u00e4ndig machen"
                  ],
                  [
                     "id" => "gM6p5um1xB4n",
                     "label" => "Ich bin gl\u00fccklich mit meiner beruflichen Situation"
                  ]
               ]
            ],
            [
               "id" => "j0YCZtbZWhVi",
               "title" => "Wie gl\u00fccklich bist du im Bereich *Partnerschaft*?",
               "type" => "rating",
               "ref" => "score_partnerschaft_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "XxF7b3SZEz85",
               "title" => "Stichwort *Partnerschaft*: Welche der folgenden Aussagen treffen auf dich zu? ",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_partnerschaft_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "k9XQRBd3crv3",
                     "label" => "Mein Partner und ich streiten h\u00e4ufig"
                  ],
                  [
                     "id" => "ihxcYcq5rVNQ",
                     "label" => "Ich glaube mein Partner und ich passen eigentlich nicht zusammen"
                  ],
                  [
                     "id" => "Z0Wr3fXRe85t",
                     "label" => "Ich habe Liebeskummer"
                  ],
                  [
                     "id" => "jSHguZULf5Op",
                     "label" => "Mein Partner versteht mich nicht"
                  ],
                  [
                     "id" => "nBcZYzeXUwDM",
                     "label" => "Ich habe Angst, dass mein Partner mich betr\u00fcgt"
                  ],
                  [
                     "id" => "GECKMXFaenGw",
                     "label" => "Ich bin schon l\u00e4ngere Zeit Single und w\u00fcnsche mir eine Beziehung"
                  ],
                  [
                     "id" => "X7zNRY7JaPiu",
                     "label" => "Ich f\u00fchle mich in einer Beziehung schnell eingeengt"
                  ],
                  [
                     "id" => "FlYaAAbp1PWs",
                     "label" => "Ich wurde betrogen und wei\u00df nicht ob ich jemals wieder vertrauen kann"
                  ],
                  [
                     "id" => "H4huETN0i3FC",
                     "label" => "Ich habe das Gef\u00fchl mein Partner will sich nicht binden"
                  ],
                  [
                     "id" => "iPB8Z4PHQtpq",
                     "label" => "Ich habe die Hoffnung auf eine erf\u00fcllende Partnerschaft aufgegeben"
                  ],
                  [
                     "id" => "iaHcoXKPzpFQ",
                     "label" => "Ich bin im Bereich Partnerschaft wunschlos gl\u00fccklich"
                  ]
               ]
            ],
            [
               "id" => "rKKe9yCJsO6c",
               "title" => "Wie gl\u00fccklich bist du im Bereich *Sexualit\u00e4t*?",
               "type" => "rating",
               "ref" => "score_sexualitaet_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "y1hySopQ572w",
               "title" => "Stichwort *Sexualit\u00e4t*: Welche der folgenden Aussagen treffen auf dich zu? ",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_sexualitaet_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "Gn4i4y5kj29x",
                     "label" => "Mein Partner geht nicht auf meine Bed\u00fcrfnisse ein"
                  ],
                  [
                     "id" => "XPXjUtjYrhLt",
                     "label" => "Ich empfinde eher selten sexuelle Lust"
                  ],
                  [
                     "id" => "sQfk2h6qaK9Z",
                     "label" => "Ich w\u00fcnsche mir eine offene Beziehung"
                  ],
                  [
                     "id" => "pOZwnYfI7Gh4",
                     "label" => "Ich habe Schwierigkeiten einen Orgasmus zu erreichen"
                  ],
                  [
                     "id" => "T9FgNaUIAY4Y",
                     "label" => "Mir f\u00e4llt es schwer, offen \u00fcber Sex zu sprechen"
                  ],
                  [
                     "id" => "P6Eo5YWFsR7G",
                     "label" => "Ich w\u00e4re gern selbstsicherer beim Sex"
                  ],
                  [
                     "id" => "RVrMqP4GNr90",
                     "label" => "Bei meinem Partner und mir geht leider nicht mehr viel im Bett"
                  ],
                  [
                     "id" => "vNyRvRazE7BW",
                     "label" => "Ich bin sehr zufrieden mit meinem Liebesleben"
                  ]
               ]
            ],
            [
               "id" => "TrPaPMSMwHL2",
               "title" => "Wie gl\u00fccklich bist du im Bereich *K\u00f6rper & Gesundheit*?",
               "type" => "rating",
               "ref" => "score_koerper_und_gesundheit_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "gV9zynZ9W74m",
               "title" => "Stichwort *K\u00f6rper & Gesundheit*: Welche der folgenden Aussagen treffen auf dich zu?",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_koerper_und_gesundheit_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "ka2NUjC7nG3d",
                     "label" => "Ich finde mich eher unattraktiv"
                  ],
                  [
                     "id" => "diiCALYWHTQa",
                     "label" => "Ich h\u00e4tte gern einen sportlicheren K\u00f6rper"
                  ],
                  [
                     "id" => "vFyeY4i5IRHp",
                     "label" => "Ich bin gestresst und energielos"
                  ],
                  [
                     "id" => "PNNmZYktRr4G",
                     "label" => "Ich habe Konzentrationsschwierigkeiten"
                  ],
                  [
                     "id" => "r0OdM8gMeChE",
                     "label" => "Ich w\u00fcrde gern ges\u00fcnder leben, aber mir fehlt die Motivation"
                  ],
                  [
                     "id" => "XBI0W64NGzFC",
                     "label" => "Meine Work-Life-Balance macht mich unzufrieden"
                  ],
                  [
                     "id" => "he4yPaCDUHSi",
                     "label" => "Ich mache mir oft Sorgen"
                  ],
                  [
                     "id" => "mUf6MonGfO26",
                     "label" => "Immer wieder plagen mich Selbstzweifel"
                  ],
                  [
                     "id" => "TLBpHp7Npg4u",
                     "label" => "Ich w\u00fcnsche mir, gelassener mit Problemen umgehen zu k\u00f6nnen"
                  ],
                  [
                     "id" => "D5QM7mHJiWlF",
                     "label" => "Ich w\u00fcnsche mir mehr Ruhe und Entspannung"
                  ],
                  [
                     "id" => "GAENEhcxISUY",
                     "label" => "Ich f\u00fchle mich rundum wohl mit meinem K\u00f6rper und meiner Gesundheit"
                  ]
               ]
            ],
            [
               "id" => "HptARk7w8nlI",
               "title" => "Wie gl\u00fccklich bist du im Bereich *Freundschaften*?",
               "type" => "rating",
               "ref" => "score_freundschaften_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "wXG0lfEHA9ga",
               "title" => "Stichwort *Freundschaften*: Welche der folgenden Aussagen treffen auf dich zu?",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_freundschaften_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "W0sVBHNSCKGw",
                     "label" => "Ich bin zu sch\u00fcchtern, um auf Menschen zuzugehen"
                  ],
                  [
                     "id" => "sESJ4YGILMl8",
                     "label" => "Ich habe zu wenig Zeit, um meine Freundschaften zu pflegen"
                  ],
                  [
                     "id" => "BJyVuTGnixG5",
                     "label" => "Ich habe das Gef\u00fchl, dass ich nicht besonders beliebt bin"
                  ],
                  [
                     "id" => "I3tskDBDJBuj",
                     "label" => "Meine Freundschaften halten meist nur f\u00fcr eine kurze Zeit"
                  ],
                  [
                     "id" => "v3N1WWrWLg78",
                     "label" => "Ich h\u00e4tte gern einen gr\u00f6\u00dferen Freundeskreis"
                  ],
                  [
                     "id" => "K9ibsXA0kruN",
                     "label" => "Ich w\u00fcnsche mir eine beste Freundin\/einen besten Freund"
                  ],
                  [
                     "id" => "N0xn0Ov8W0q1",
                     "label" => "Freunde entt\u00e4uschen einen sowieso nur, deshalb habe ich lieber keine"
                  ],
                  [
                     "id" => "zW6RoqVaXYdR",
                     "label" => "Ich neige dazu, an Freundschaften festzuhalten, die nicht gut f\u00fcr mich sind"
                  ],
                  [
                     "id" => "vIqJkMG9iPaA",
                     "label" => "Im habe einen intakten Freundeskreis"
                  ]
               ]
            ],
            [
               "id" => "vfvgdonK2CT3",
               "title" => "Wie gl\u00fccklich bist du im Bereich *Familie*?",
               "type" => "rating",
               "ref" => "score_familie_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "jKIMREgiyO9V",
               "title" => "Stichwort *Familie*: Welche der folgenden Aussagen treffen auf dich zu?",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_familie_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "S1JyLJz02svO",
                     "label" => "Ich gebe bestimmten Personen aus meiner Familie die Schuld daf\u00fcr, dass ich heute ungl\u00fccklich bin"
                  ],
                  [
                     "id" => "z31PY2nx70XH",
                     "label" => "Ich streite mich immer wieder mit meinen Eltern oder Geschwistern und wir drehen uns im Kreis"
                  ],
                  [
                     "id" => "RnTvjMwEnzXZ",
                     "label" => "Ich habe den Kontakt zu meinen Eltern abgebrochen"
                  ],
                  [
                     "id" => "frbUBNPyF4i0",
                     "label" => "Meine Familie versteht sich nicht mit meinem Partner"
                  ],
                  [
                     "id" => "TVEYZEfivVoK",
                     "label" => "Ich beziehe in alles, was ich tue, die Meinung meiner Eltern ein"
                  ],
                  [
                     "id" => "Id197U9g1HkL",
                     "label" => "Meine Eltern glauben zu wissen, was das beste f\u00fcr mich ist und mischen sich st\u00e4ndig ein"
                  ],
                  [
                     "id" => "c95FI6AWe5Ns",
                     "label" => "F\u00fcr mich ist die Familie das Wichtigste auf der Welt"
                  ],
                  [
                     "id" => "ci2SQqSoMbsE",
                     "label" => "Die Familie hat f\u00fcr mich keine besondere Bedeutung und ist austauschbar"
                  ],
                  [
                     "id" => "OvlkL6j5KPyn",
                     "label" => "Ich w\u00fcnsche mir manchmal eine andere Familie"
                  ],
                  [
                     "id" => "Y91s20LswxV6",
                     "label" => "Ich habe die beste Familie der Welt"
                  ]
               ]
            ],
            [
               "id" => "jwFhvNjs3RQd",
               "title" => "Wie gl\u00fccklich bist du im Bereich *Spiritualit\u00e4t*?",
               "type" => "rating",
               "ref" => "score_spiritualitaet_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "EFfH9Le9Ioi0",
               "title" => "Stichwort *Spiritualit\u00e4t*: Welche der folgenden Aussagen treffen auf dich zu?",
               "type" => "multiple_choice",
               "allow_multiple_selections" => true,
               "allow_other_choice" => true,
               "ref" => "symptoms_spiritualitaet_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "fxpJKsBCPPd7",
                     "label" => "Ich frage mich manchmal, was meine Bestimmung ist"
                  ],
                  [
                     "id" => "GgdbAvb7lt7x",
                     "label" => "Mich besch\u00e4ftigt die Frage nach dem Sinn des Lebens"
                  ],
                  [
                     "id" => "N1PrKCOXQD43",
                     "label" => "Ich w\u00fcrde gern bewusster und achtsamer durchs Leben gehen"
                  ],
                  [
                     "id" => "Vtqo5KSbxpii",
                     "label" => "Ich w\u00fcrde gern mehr \u00fcber das Thema Spiritualit\u00e4t erfahren"
                  ],
                  [
                     "id" => "b8gbz7s7dy10",
                     "label" => "Ich h\u00e4tte gern eine Anleitung, wie ich Spiritualit\u00e4t praktizieren kann"
                  ],
                  [
                     "id" => "d87IfIHMfNts",
                     "label" => "Ich praktiziere bereits regelm\u00e4\u00dfig meine Spiritualit\u00e4t"
                  ],
                  [
                     "id" => "IHHhMe2HcXQt",
                     "label" => "Ich w\u00fcrde gern den Zusammenhang zwischen K\u00f6rper, Geist und Seele verstehen"
                  ],
                  [
                     "id" => "TjESHlFeTkuD",
                     "label" => "Ich m\u00f6chte gern Achtsamkeitspraktiken wie Yoga und Meditation erlernen"
                  ],
                  [
                     "id" => "lLdmn3apOzvR",
                     "label" => "Ich glaube nur an das, was ich sehe"
                  ]
               ]
            ],
            [
               "id" => "ZYHWmGDcz9aK",
               "title" => "Wie viel *Zeit* w\u00fcrdest du *pro Monat* investieren, um an deinen Herausforderungen zu arbeiten und *gl\u00fccklicher* zu werden? ",
               "type" => "multiple_choice",
               "ref" => "time_invest_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "SYaL3CzzZkUo",
                     "label" => "Gar keine"
                  ],
                  [
                     "id" => "SKZV2TwKqRBF",
                     "label" => "Einige Stunden"
                  ],
                  [
                     "id" => "xtdi8E38ZWWv",
                     "label" => "Einige Tage"
                  ],
                  [
                     "id" => "auWQBKFOo3Np",
                     "label" => "So viel wie n\u00f6tig"
                  ]
               ]
            ],
            [
               "id" => "LRTcp3Ig004b",
               "title" => "Wie viel Geld ist es dir wert, deine* Herausforderungen zu meistern und ein erf\u00fcllteres Leben zu f\u00fchren?*",
               "type" => "multiple_choice",
               "allow_other_choice" => true,
               "ref" => "money_invest_user",
               "properties" => [
         
               ],
               "choices" => [
                  [
                     "id" => "kkxgk7acucvk",
                     "label" => "Gar keins"
                  ],
                  [
                     "id" => "am5HgMVYdoUh",
                     "label" => "Bis zu 250\u20ac"
                  ],
                  [
                     "id" => "iu6tGuzeBCNm",
                     "label" => "So viel wie n\u00f6tig"
                  ]
               ]
            ],
            [
               "id" => "vFJwdHOgogcc",
               "title" => "M\u00f6chtest du zus\u00e4tzlich zum Testergebnis* kostenlose* *Tipps* erhalten?",
               "type" => "yes_no",
               "ref" => "call_optin_user",
               "properties" => [
         
               ]
            ],
            [
               "id" => "eiSQn5yGLDGp",
               "title" => "Sollen wir dich \u00fcber *spannende und interessante Neuigkeiten* zum Thema Gl\u00fcck *per E-Mail* auf dem Laufenden halten?",
               "type" => "yes_no",
               "ref" => "newsletter_optin_user",
               "properties" => [
         
               ]
            ]
        ];

        foreach ($arrayQuestions as $question) {
            Question::create([
                'name' => $question['title'],
                'reference' => $question['ref'],
            ]);
        }
    }
}
