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
    <div class="meta-box">Article 2 &nbsp;|&nbsp; Pages: 11–22 &nbsp;|&nbsp; Language: Hindi &nbsp;|&nbsp; Published: January 2026</div>

    <div class="title">महाराष्ट्र से शुरू हुआ पत्रकार सुरक्षा कानून : पूरे भारत में लागू होना समय की माँग</div>

    <div class="authors">Adv. Akramkhan Abdulmajeedkhan Pathan</div>
    <div class="affil">Information Of Press Council of Maharashtra, Mumbai, Maharashtra, India</div>

    <div class="abs-box">
        <div class="abs-label">Abstract / सारांश</div>
        लोकतंत्र की मजबूती का आधार केवल संविधान या शासन व्यवस्था नहीं होता, बल्कि स्वतंत्र और निर्भीक पत्रकारिता भी उतनी ही महत्वपूर्ण होती है। महाराष्ट्र सरकार ने वर्ष 2017 में "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" लागू किया — यह भारत का पहला ऐसा कानून है जो पत्रकारों की सुरक्षा सुनिश्चित करता है। यह लेख इस कानून की प्रमुख तरतूदों का विश्लेषण करता है और तर्क करता है कि इसे पूरे भारत में लागू करने की आवश्यकता है।
    </div>
    <div class="kw"><strong>Keywords:</strong> पत्रकार सुरक्षा, महाराष्ट्र, राष्ट्रीय कानून, लोकतंत्र, press freedom, journalist protection law</div>
    <hr>

    <p>लोकतंत्र की मजबूती का आधार केवल संविधान या शासन व्यवस्था नहीं होता, बल्कि स्वतंत्र और निर्भीक पत्रकारिता भी उतनी ही महत्वपूर्ण होती है। पत्रकारिता को लोकतंत्र का चौथा स्तंभ इसलिए कहा जाता है क्योंकि यह समाज और सरकार के बीच सेतु का काम करती है। पत्रकार जनहित से जुड़े मुद्दों को सामने लाते हैं, भ्रष्टाचार का पर्दाफाश करते हैं और जनता की आवाज़ शासन तक पहुँचाते हैं।</p>

    <p>लेकिन पिछले कुछ वर्षों में देशभर में पत्रकारों पर हमले, धमकियाँ, झूठे मुकदमे और दबाव की घटनाएँ बढ़ी हैं। कई पत्रकारों को अपनी जान जोखिम में डालकर सच सामने लाना पड़ता है। ऐसे वातावरण में पत्रकारों की सुरक्षा सुनिश्चित करने के लिए एक मजबूत कानूनी व्यवस्था होना अत्यंत आवश्यक है। इसी दिशा में महाराष्ट्र राज्य ने एक ऐतिहासिक पहल करते हुए पत्रकार सुरक्षा कानून लागू किया, जो पूरे देश के लिए एक आदर्श उदाहरण बन सकता है।</p>

    <p><strong>महाराष्ट्र का पत्रकार सुरक्षा कानून : एक ऐतिहासिक पहल</strong></p>

    <p>महाराष्ट्र सरकार ने वर्ष 2017 में "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" लागू किया। यह भारत का पहला ऐसा कानून है, जिसका उद्देश्य पत्रकारों और मीडिया संस्थानों पर होने वाली हिंसा को रोकना और उनकी सुरक्षा सुनिश्चित करना है।</p>

    <p>इस कानून के अंतर्गत पत्रकारों पर हमला करना एक गंभीर और दंडनीय अपराध माना गया है। यदि कोई व्यक्ति पत्रकार या मीडिया संस्थान पर हमला करता है या उनकी संपत्ति को नुकसान पहुँचाता है, तो उसके खिलाफ कठोर कानूनी कार्रवाई की जा सकती है। इस कानून में जेल और जुर्माने दोनों की व्यवस्था है।</p>

    <p>इसके साथ ही कानून में यह भी प्रावधान किया गया है कि पत्रकार या मीडिया संस्थान को हुए नुकसान की भरपाई आरोपी से वसूल की जा सकती है। इस प्रकार यह कानून केवल दंडात्मक ही नहीं बल्कि संरक्षणात्मक भी है। महाराष्ट्र द्वारा लागू किया गया यह कानून देशभर में पत्रकार सुरक्षा की दिशा में एक मील का पत्थर माना जाता है।</p>

    <p><strong>पत्रकारों पर बढ़ते हमले : एक गंभीर चिंता</strong></p>

    <p>भारत में पत्रकारों के सामने कई प्रकार की चुनौतियाँ हैं। विशेष रूप से भ्रष्टाचार, अवैध खनन, भूमाफिया, अवैध निर्माण, तस्करी या संगठित अपराध से जुड़े मामलों की रिपोर्टिंग करने वाले पत्रकार अक्सर हमलों का शिकार होते हैं।</p>

    <p>कई बार पत्रकारों को जान से मारने की धमकी दी जाती है, झूठे मुकदमों में फँसाने की कोशिश की जाती है, शारीरिक हमला किया जाता है और सोशल मीडिया पर बदनाम किया जाता है। ग्रामीण और छोटे शहरों में काम करने वाले पत्रकारों की स्थिति और भी कठिन होती है, क्योंकि वहाँ उन्हें स्थानीय दबाव, राजनीतिक प्रभाव और प्रशासनिक उदासीनता का सामना करना पड़ता है।</p>

    <p>इस स्थिति में यदि पत्रकारों को पर्याप्त कानूनी सुरक्षा न मिले तो स्वतंत्र पत्रकारिता कमजोर पड़ सकती है, जो लोकतंत्र के लिए गंभीर खतरा है।</p>

    <p><strong>पूरे भारत में पत्रकार सुरक्षा कानून क्यों आवश्यक है</strong></p>

    <p>महाराष्ट्र ने पत्रकार सुरक्षा कानून लागू करके एक सकारात्मक उदाहरण प्रस्तुत किया है। लेकिन केवल एक राज्य में कानून होने से समस्या का पूर्ण समाधान नहीं होगा। भारत एक विशाल और विविधतापूर्ण देश है, जहाँ हजारों पत्रकार अलग-अलग राज्यों में काम करते हैं। इसलिए आवश्यक है कि पूरे भारत में एक समान और प्रभावी पत्रकार सुरक्षा कानून लागू किया जाए।</p>

    <p>राष्ट्रीय स्तर पर पत्रकार सुरक्षा कानून लागू होने से कई महत्वपूर्ण लाभ होंगे : देशभर के पत्रकारों को कानूनी सुरक्षा का भरोसा मिलेगा; अपराधियों पर प्रभावी नियंत्रण होगा; स्वतंत्र और निर्भीक पत्रकारिता को बढ़ावा मिलेगा; और सरकार व प्रशासन की जवाबदेही बढ़ने से लोकतंत्र और मजबूत होगा।</p>

    <p><strong>पत्रकार सुरक्षा कानून में क्या होना चाहिए</strong></p>

    <p>यदि पूरे भारत में पत्रकार सुरक्षा कानून लागू किया जाता है, तो उसमें निम्नलिखित महत्वपूर्ण प्रावधान होना आवश्यक है : पत्रकारों पर हमले को गंभीर अपराध घोषित किया जाए; त्वरित FIR और समयबद्ध जांच सुनिश्चित की जाए; वरिष्ठ अधिकारी द्वारा निष्पक्ष जांच हो; नुकसान की भरपाई आरोपी से कराई जाए; डिजिटल पत्रकारों को भी कानून के दायरे में शामिल किया जाए; और राष्ट्रीय या राज्य स्तर पर एक स्वतंत्र Journalist Protection Authority बनाई जाए।</p>

    <p><strong>समाज और सरकार की संयुक्त जिम्मेदारी</strong></p>

    <p>पत्रकारों की सुरक्षा केवल सरकार की जिम्मेदारी नहीं है, बल्कि समाज की भी जिम्मेदारी है। समाज को यह समझना चाहिए कि पत्रकार केवल खबरें नहीं लिखते, बल्कि वे जनता के अधिकारों और लोकतंत्र की रक्षा के लिए काम करते हैं। सरकार को चाहिए कि वह पत्रकारों की सुरक्षा के लिए स्पष्ट नीतियाँ बनाए, कानून लागू करे और उसकी सख्ती से पालन सुनिश्चित करे।</p>

    <p><strong>निष्कर्ष</strong></p>

    <p>महाराष्ट्र राज्य द्वारा लागू किया गया पत्रकार सुरक्षा कानून एक महत्वपूर्ण और सराहनीय कदम है। इसने यह सिद्ध किया है कि यदि राजनीतिक इच्छाशक्ति हो तो पत्रकारों की सुरक्षा के लिए प्रभावी कानून बनाया जा सकता है। आज समय की माँग है कि महाराष्ट्र मॉडल को पूरे भारत में लागू किया जाए और एक मजबूत राष्ट्रीय पत्रकार सुरक्षा कानून बनाया जाए।</p>

    <p>पत्रकार सुरक्षित होंगे तो वे निर्भय होकर सच लिख पाएंगे। और जब सच सामने आएगा, तब ही लोकतंत्र मजबूत होगा। इसलिए यह कहना गलत नहीं होगा कि पत्रकारों की सुरक्षा केवल पत्रकारों की सुरक्षा नहीं, बल्कि लोकतंत्र की सुरक्षा है।</p>

    <div class="footer">© 2026 Press Council of Maharashtra. All rights reserved. &nbsp;|&nbsp; Information of Press Council of Maharashtra, Vol. 1, Issue 1, Jan 2026<br><span style="font-size:8pt;color:#aaa;">Downloaded: ' . date('d M Y, g:i A') . ' IST</span></div>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('article-002-patarkar-suraksha-kanoon.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    exit;
}
