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
        .title { font-size:16pt; font-weight:bold; color:#1a3a5c; line-height:1.4; margin-bottom:12px; }
        .authors { font-size:11pt; font-weight:bold; margin-bottom:3px; }
        .affil { font-size:9.5pt; color:#666; font-style:italic; margin-bottom:14px; }
        .abs-box { border:1px solid #d4c9a8; background:#fffdf6; padding:12px 14px; margin-bottom:14px; }
        .abs-label { font-size:9pt; font-weight:bold; text-transform:uppercase; color:#1a3a5c; margin-bottom:6px; }
        .kw { font-size:9.5pt; color:#444; margin-bottom:5px; }
        h2 { font-size:12pt; font-weight:bold; color:#1a3a5c; margin-top:18px; margin-bottom:6px; border-bottom:1px solid #ddd; padding-bottom:3px; }
        h3 { font-size:11pt; font-weight:bold; color:#333; margin-top:14px; margin-bottom:4px; }
        ul { margin:6px 0 10px 18px; padding:0; }
        ul li { margin-bottom:5px; font-size:11pt; }
        hr { border:none; border-top:1px solid #ddd; margin: 18px 0; }
        p { margin-bottom:12px; text-align:justify; font-size:11pt; }
        .footer { border-top:2px solid #1a3a5c; padding-top:8px; font-size:8.5pt; color:#888; }
    </style>

    <div class="jh">
        <div class="jh-name">Information of Press Council of Maharashtra</div>
        <div class="jh-meta">ISSN (Online): Applied for / Pending &nbsp;|&nbsp; Vol. 1, Issue 1, January 2026</div>
    </div>
    <div class="gold-bar"></div>
    <div class="meta-box">Article 4 &nbsp;|&nbsp; Pages: 33–44 &nbsp;|&nbsp; Language: Marathi &nbsp;|&nbsp; Published: January 2026</div>

    <div class="title">महाराष्ट्र राज्यातील पत्रकारांशी संबंधित सुरक्षा कायदा आणि उपाय</div>

    <div class="authors">Vjay Harakchand Saklecha</div>
    <div class="affil">Information Of Press Council of Maharashtra, Mumbai, Maharashtra, India</div>

    <div class="abs-box">
        <div class="abs-label">Abstract / सारांश</div>
        लोकशाही व्यवस्थेत पत्रकारिता ही चौथा स्तंभ मानली जाते. महाराष्ट्र राज्याने "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" हा विशेष कायदा लागू केला. या कायद्यामुळे पत्रकारांवर हल्ला करणे हा गंभीर, cognizable आणि non-bailable गुन्हा ठरतो. या अभ्यासात कायद्याच्या प्रमुख तरतुदी, अंमलबजावणीतील समस्या आणि पत्रकार सुरक्षा अधिक मजबूत करण्यासाठी उपाय विश्लेषित केले आहेत. विशेष तपास पथक, डिजिटल पत्रकारांचे संरक्षण आणि राज्यस्तरीय Journalist Protection Authority स्थापन करणे हे प्रमुख उपाय सुचवले आहेत.
    </div>
    <div class="kw"><strong>Keywords:</strong> पत्रकार सुरक्षा, महाराष्ट्र कायदा 2017, लोकशाही, मीडिया संरक्षण, डिजिटल पत्रकारिता, press freedom</div>
    <hr>

    <p>लोकशाही व्यवस्थेत पत्रकारिता ही चौथा स्तंभ मानली जाते. शासन, प्रशासन आणि समाजातील भ्रष्टाचार, अन्याय व गैरव्यवहार उघड करण्याचे महत्त्वपूर्ण कार्य पत्रकार करत असतात. परंतु सत्य मांडण्याच्या या प्रक्रियेत अनेकदा पत्रकारांना धमक्या, हल्ले, खोटे गुन्हे आणि दबाव सहन करावे लागतात. त्यामुळे पत्रकारांच्या संरक्षणासाठी कायदेशीर चौकट असणे अत्यंत आवश्यक आहे. महाराष्ट्र राज्याने या संदर्भात भारतात प्रथमच विशेष कायदा लागू करून एक महत्त्वाचे पाऊल उचलले आहे.</p>

    <h2>१. महाराष्ट्रातील पत्रकार संरक्षण कायदा</h2>

    <p>महाराष्ट्र सरकारने "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" हा विशेष कायदा लागू केला. या कायद्याचा मुख्य उद्देश पत्रकारांवर होणारे हल्ले रोखणे आणि मीडिया संस्थांच्या मालमत्तेचे संरक्षण करणे हा आहे.</p>

    <h3>या कायद्याच्या प्रमुख तरतुदी</h3>

    <h3>पत्रकारांवर हल्ला हा गंभीर गुन्हा</h3>
    <p>पत्रकार किंवा मीडिया संस्थेवर हिंसा केल्यास ३ वर्षांपर्यंत कारावास किंवा दंड किंवा दोन्ही शिक्षा होऊ शकते.</p>

    <h3>गुन्हा Cognizable आणि Non-bailable</h3>
    <p>या कायद्यातील गुन्हे संज्ञेय (cognizable) आणि अजामीनपात्र (non-bailable) आहेत. त्यामुळे पोलिसांना तात्काळ कारवाई करण्याचा अधिकार आहे.</p>

    <h3>उच्च दर्जाच्या अधिकाऱ्यांकडून चौकशी</h3>
    <p>या प्रकारच्या गुन्ह्यांची चौकशी DySP किंवा त्याहून वरिष्ठ पोलिस अधिकारी करतील.</p>

    <h3>नुकसान भरपाईची तरतूद</h3>
    <p>पत्रकार किंवा मीडिया संस्थेच्या मालमत्तेचे नुकसान झाल्यास आरोपीला भरपाई आणि वैद्यकीय खर्च भरावा लागतो.</p>

    <h3>मीडिया संस्थेची विस्तृत व्याख्या</h3>
    <p>वृत्तपत्र, न्यूज चॅनल, ऑनलाइन न्यूज पोर्टल, फोटो पत्रकार, संपादक, रिपोर्टर इत्यादी सर्वांना या कायद्याखाली संरक्षण मिळते.</p>

    <h2>२. कायद्याची गरज का निर्माण झाली?</h2>

    <p>गेल्या काही दशकांत महाराष्ट्रात पत्रकारांवर अनेक हल्ल्यांच्या घटना घडल्या. तपास पत्रकारिता करताना माफिया, भ्रष्ट राजकारणी, अवैध बांधकाम माफिया किंवा गुन्हेगारी टोळ्यांकडून धमक्या मिळणे सामान्य झाले आहे. त्यामुळे पत्रकार संघटनांनी दीर्घकाळापासून स्वतंत्र संरक्षण कायद्याची मागणी केली होती.</p>

    <h2>३. प्रत्यक्ष अंमलबजावणीतील समस्या</h2>

    <p>कायदा अस्तित्वात असला तरी काही गंभीर अडचणी आजही दिसून येतात:</p>
    <ul>
        <li>गुन्ह्यांची नोंद करण्यात विलंब</li>
        <li>राजकीय किंवा स्थानिक दबाव</li>
        <li>पत्रकारांना पोलीस संरक्षण मिळण्यात अडथळे</li>
        <li>स्वतंत्र पत्रकार आणि डिजिटल मीडिया यांचे अपुरे संरक्षण</li>
    </ul>
    <p>काही प्रकरणांमध्ये पत्रकारांवर हल्ले झाल्यानंतरही योग्य वेळी कारवाई होत नसल्याचे दिसून आले आहे. उदाहरणार्थ, अवैध बांधकामावर रिपोर्टिंग करताना पत्रकारांवर हल्ला झाल्याच्या घटना न्यायालयापर्यंत गेल्या आहेत.</p>

    <h2>४. पत्रकार सुरक्षा मजबूत करण्यासाठी उपाय</h2>

    <h3>१. विशेष तपास पथक (SIT)</h3>
    <p>पत्रकारांवरील हल्ल्यांची चौकशी करण्यासाठी राज्यस्तरावर विशेष तपास पथक स्थापन करणे आवश्यक आहे.</p>

    <h3>२. त्वरित FIR आणि वेळबद्ध तपास</h3>
    <p>पत्रकारांवरील हल्ल्याच्या प्रकरणात 24 तासांत FIR आणि 90 दिवसांत तपास पूर्ण अशी कायदेशीर वेळमर्यादा असावी.</p>

    <h3>३. पत्रकार सुरक्षा प्राधिकरण</h3>
    <p>राज्य स्तरावर Journalist Protection Authority स्थापन करून तक्रारींचे त्वरित निवारण केले पाहिजे.</p>

    <h3>४. डिजिटल आणि स्वतंत्र पत्रकारांचे संरक्षण</h3>
    <p>आज अनेक पत्रकार YouTube, Web-media, Digital platforms वर काम करतात. त्यांनाही कायद्याच्या कक्षेत स्पष्टपणे समाविष्ट करणे आवश्यक आहे.</p>

    <h3>५. विमा व सुरक्षा योजना</h3>
    <p>राज्य सरकारने पत्रकारांसाठी जीवन विमा योजना, कायदेशीर मदत निधी आणि धमकी प्रकरणात तात्पुरते पोलीस संरक्षण या सुविधा उपलब्ध करून द्याव्यात.</p>

    <h2>५. निष्कर्ष</h2>

    <p>पत्रकारांची सुरक्षा ही केवळ एका व्यवसायाची बाब नसून लोकशाहीच्या आरोग्याशी संबंधित प्रश्न आहे. पत्रकार सुरक्षित असतील तरच शासनातील भ्रष्टाचार उघडकीस येईल आणि समाजाला सत्य माहिती मिळेल. महाराष्ट्राने पत्रकार संरक्षण कायदा लागू करून एक ऐतिहासिक पाऊल उचलले असले तरी त्याची कडक अंमलबजावणी, पारदर्शक तपास आणि संस्थात्मक संरक्षण व्यवस्था निर्माण करणे ही काळाची गरज आहे.</p>

    <p><strong>पत्रकारांचे संरक्षण म्हणजे लोकशाहीचे संरक्षण होय.</strong></p>

    <div class="footer">© 2026 Press Council of Maharashtra. All rights reserved. &nbsp;|&nbsp; Information of Press Council of Maharashtra, Vol. 1, Issue 1, Jan 2026<br><span style="font-size:8pt;color:#aaa;">Downloaded: ' . date('d M Y, g:i A') . ' IST</span></div>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('article-004-patarkar-suraksha-kayda-upay.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    exit;
}
