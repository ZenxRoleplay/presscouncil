<?php
if (isset($_GET['download'])) {
    date_default_timezone_set('Asia/Kolkata');
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf([
        'mode'             => 'utf-8',
        'format'           => 'A4',
        'margin_top'       => 20,
        'margin_bottom'    => 20,
        'margin_left'      => 20,
        'margin_right'     => 20,
        'default_font'     => 'nirmala',
        'autoScriptToLang' => true,
        'autoLangToFont'   => true,
        'fontdata'         => [
            'nirmala' => [
                'R'      => 'Nirmala.ttf',
                'B'      => 'NirmalaB.ttf',
                'useOTL' => 0xFF,
            ],
        ],
    ]);

    $html = '
    <style>
        body { font-family: nirmala; font-size: 11pt; color: #1a1a1a; line-height: 1.8; }
        .jh { border-bottom: 2px solid #1a3a5c; padding-bottom: 10px; margin-bottom: 14px; }
        .jh-name { font-size: 13pt; font-weight: bold; color: #1a3a5c; }
        .jh-meta { font-size: 9pt; color: #888; margin-top:3px; }
        .gold-bar { height:3px; background:#c8a84b; margin-bottom:20px; }
        .meta-box { background:#f4f2ee; border-left:4px solid #c8a84b; padding:8px 12px; margin-bottom:16px; font-size:9pt; color:#444; }
        .title { font-size:16pt; font-weight:bold; color:#1a3a5c; line-height:1.4; margin-bottom:6px; }
        .subtitle { font-size:11pt; color:#555; margin-bottom:12px; }
        .authors { font-size:11pt; font-weight:bold; margin-bottom:3px; }
        .affil { font-size:9.5pt; color:#666; font-style:italic; margin-bottom:14px; }
        .abs-box { border:1px solid #d4c9a8; background:#fffdf6; padding:12px 14px; margin-bottom:14px; }
        .abs-label { font-size:9pt; font-weight:bold; text-transform:uppercase; color:#1a3a5c; margin-bottom:6px; }
        .kw { font-size:9.5pt; color:#444; margin-bottom:5px; }
        hr { border:none; border-top:1px solid #ddd; margin: 18px 0; }
        p { margin-bottom:12px; text-align:justify; font-size:11pt; }
        .footer { border-top:2px solid #1a3a5c; padding-top:8px; font-size:8.5pt; color:#888; }
    </style>

    <div class="jh">
        <div class="jh-name">Information of Press Council of Maharashtra</div>
        <div class="jh-meta">ISSN (Online): Applied for / Pending &nbsp;|&nbsp; Vol. 1, Issue 1, January 2026</div>
    </div>
    <div class="gold-bar"></div>
    <div class="meta-box">Article 3 &nbsp;|&nbsp; Pages: 23–32 &nbsp;|&nbsp; Language: Marathi &nbsp;|&nbsp; Published: January 2026</div>

    <div class="title">पत्रकार सुरक्षा कायदा : लोकशाहीच्या चौथ्या स्तंभाचे संरक्षण</div>
    <div class="subtitle">(Journalist Protection Law: Protecting the Fourth Pillar of Democracy)</div>

    <div class="authors">Adv. Iliyas Abdulmajeed Khan</div>
    <div class="affil">Information Of Press Council of Maharashtra, Mumbai, Maharashtra, India</div>

    <div class="abs-box">
        <div class="abs-label">Abstract / सारांश</div>
        लोकशाही व्यवस्थेत पत्रकारिता हा समाजाचा चौथा स्तंभ मानला जातो. गेल्या काही वर्षांत पत्रकारांवर होणाऱ्या हल्ल्यांच्या घटनांमध्ये वाढ झाल्यामुळे पत्रकारांच्या सुरक्षेचा प्रश्न गंभीर बनला आहे. महाराष्ट्र राज्याने पत्रकारांच्या संरक्षणासाठी "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" हा कायदा लागू केला. महाराष्ट्र हे असा स्वतंत्र कायदा करणारे देशातील पहिले राज्य ठरले. पत्रकारांचे संरक्षण म्हणजे लोकशाहीचे संरक्षण होय असे प्रतिपादन या अभ्यासात केले आहे.
    </div>
    <div class="kw"><strong>Keywords:</strong> पत्रकार सुरक्षा, लोकशाही, महाराष्ट्र, मीडिया कायदा, पत्रकारिता, press freedom, journalist protection</div>
    <hr>

    <p>लोकशाही व्यवस्थेत पत्रकारिता हा चौथा स्तंभ मानला जातो. शासन, प्रशासन आणि समाजातील घडामोडी जनतेपर्यंत पोहोचवणे, अन्याय व भ्रष्टाचार उघड करणे आणि लोकमत जागृत ठेवणे हे पत्रकारांचे महत्त्वाचे कर्तव्य आहे. परंतु सत्य मांडण्याच्या या प्रक्रियेत अनेकदा पत्रकारांना धमक्या, हल्ले, खोटे गुन्हे किंवा दबावाला सामोरे जावे लागते. त्यामुळे पत्रकारांच्या सुरक्षेसाठी प्रभावी कायदे आणि ठोस उपाययोजना असणे अत्यंत आवश्यक आहे.</p>

    <p>महाराष्ट्र राज्याने पत्रकारांच्या संरक्षणासाठी एक महत्त्वाचे पाऊल उचलले आहे. पत्रकार आणि माध्यम संस्थांवर होणाऱ्या हिंसाचाराला आळा घालण्यासाठी राज्यात "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" हा विशेष कायदा लागू करण्यात आला. या कायद्यामुळे पत्रकारांवर हल्ला करणे हा गंभीर गुन्हा मानला जातो.</p>

    <p>या कायद्याच्या तरतुदीनुसार पत्रकार किंवा मीडिया संस्थेवर हल्ला केल्यास संबंधित आरोपीवर गुन्हा दाखल होऊन त्याला कारावास व दंडाची शिक्षा होऊ शकते. तसेच पत्रकारांच्या मालमत्तेचे किंवा मीडिया संस्थेच्या कार्यालयाचे नुकसान झाल्यास आरोपीकडून त्याची भरपाई वसूल करण्याची तरतूद आहे. या प्रकारच्या गुन्ह्यांची चौकशी वरिष्ठ पोलिस अधिकाऱ्यांकडून करण्यात येते, ज्यामुळे प्रकरणाची गंभीरता लक्षात घेऊन योग्य तपास होण्याची अपेक्षा आहे.</p>

    <p>तथापि, कायदा अस्तित्वात असला तरी प्रत्यक्षात त्याची प्रभावी अंमलबजावणी होणे अत्यंत आवश्यक आहे. काही वेळा पत्रकारांवर हल्ला झाल्यानंतर तक्रार नोंदवण्यात विलंब होतो किंवा प्रकरणे दीर्घकाळ प्रलंबित राहतात. यामुळे पत्रकारांमध्ये असुरक्षिततेची भावना निर्माण होते. विशेषतः ग्रामीण भागातील पत्रकारांना अनेकदा स्थानिक दबाव, गुन्हेगारी प्रवृत्ती किंवा राजकीय हस्तक्षेपाचा सामना करावा लागतो.</p>

    <p>पत्रकारांच्या सुरक्षेसाठी केवळ कायदा असणे पुरेसे नाही; त्याची काटेकोर अंमलबजावणीही तितकीच महत्त्वाची आहे. यासाठी पत्रकारांवरील हल्ल्यांच्या प्रकरणांची त्वरित FIR नोंदवणे, वेळबद्ध तपास करणे आणि दोषींवर कठोर कारवाई करणे आवश्यक आहे. याशिवाय पत्रकारांच्या तक्रारींसाठी स्वतंत्र यंत्रणा किंवा सुरक्षा प्राधिकरण स्थापन करण्याची गरज आहे.</p>

    <p>आजच्या डिजिटल युगात पत्रकारितेचे स्वरूपही बदलले आहे. अनेक पत्रकार ऑनलाइन पोर्टल, वेब मीडिया आणि सामाजिक माध्यमांवर काम करतात. त्यामुळे अशा डिजिटल पत्रकारांनाही कायद्याच्या संरक्षणाच्या कक्षेत स्पष्टपणे समाविष्ट करणे आवश्यक आहे.</p>

    <p>पत्रकारांची सुरक्षा ही केवळ पत्रकारांचा प्रश्न नसून ती लोकशाहीच्या आरोग्याशी संबंधित बाब आहे. पत्रकार सुरक्षित असतील तरच ते निर्भयपणे सत्य मांडू शकतात आणि समाजाला योग्य माहिती मिळू शकते. म्हणूनच पत्रकारांचे संरक्षण म्हणजे लोकशाहीचे संरक्षण होय.</p>

    <p>आज गरज आहे ती पत्रकारांविषयी आदराची भावना निर्माण करण्याची आणि त्यांच्या सुरक्षेसाठी कायदेशीर तसेच सामाजिक स्तरावर ठोस पावले उचलण्याची. राज्य सरकार, प्रशासन आणि समाज यांनी एकत्रितपणे प्रयत्न केल्यास पत्रकारिता अधिक सुरक्षित, सक्षम आणि प्रभावी होऊ शकते.</p>

    <div class="footer">© 2026 Press Council of Maharashtra. All rights reserved. &nbsp;|&nbsp; Information of Press Council of Maharashtra, Vol. 1, Issue 1, Jan 2026<br><span style="font-size:8pt;color:#aaa;">Downloaded: ' . date('d M Y, g:i A') . ' IST</span></div>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('article-003-patarkar-suraksha-marathi.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    exit;
}
