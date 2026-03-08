<?php
// Auto-generate PDF using mPDF
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
    <div class="meta-box">Article 1 &nbsp;|&nbsp; Pages: 1–14 &nbsp;|&nbsp; Language: English &nbsp;|&nbsp; Published: January 2026</div>

    <div class="title">The Post-COVID Crisis in Maharashtra's Journalism and Newspaper Industry</div>

    <div class="authors">Adv. Iliyas Abdulmajeed Khan</div>
    <div class="affil">Information Of Press Council of Maharashtra, Mumbai, Maharashtra, India</div>

    <div class="abs-box">
        <div class="abs-label">Abstract</div>
        The COVID-19 pandemic has left a deep and lasting impact on the journalism and newspaper industry in Maharashtra. Newspapers have historically played a vital role in shaping public opinion, promoting democracy, and ensuring transparency in governance. Since the outbreak of COVID-19 in 2020, the media ecosystem — especially print journalism — has faced an unprecedented financial and operational crisis. This paper examines the key challenges including declining revenues, job losses, digital transition, and structural shifts in media consumption, and calls for coordinated policy support to sustain independent journalism in Maharashtra.
    </div>
    <div class="kw"><strong>Keywords:</strong> COVID-19, Maharashtra journalism, newspaper industry, print media crisis, digital transition, press freedom, media welfare</div>
    <hr>

    <p>The COVID-19 pandemic has left a deep and lasting impact on many sectors across India, and the journalism and newspaper industry in Maharashtra is among the most severely affected. Newspapers have historically played a vital role in shaping public opinion, promoting democracy, and ensuring transparency in governance. However, since the outbreak of COVID-19 in 2020, the media ecosystem — especially print journalism — has faced an unprecedented financial and operational crisis. Even several years after the pandemic, the industry continues to struggle with declining revenues, job losses, and structural changes in media consumption.</p>

    <p>During the initial lockdown period, the newspaper industry in Maharashtra experienced a sudden and sharp disruption. Due to strict movement restrictions and fear of virus transmission through physical surfaces, the distribution of printed newspapers was severely affected. In many cities, housing societies and residential complexes temporarily banned newspaper deliveries. This significantly reduced circulation numbers across the state. Newspapers that once relied on a steady daily distribution network found themselves unable to reach readers.</p>

    <p>Advertising revenue, which forms the backbone of the newspaper business, also collapsed during the pandemic. Businesses across sectors — including real estate, retail, tourism, education, and entertainment — either shut down temporarily or drastically reduced their marketing budgets. Government advertisements, which are a major financial support for regional newspapers, were also reduced or delayed during certain periods. As a result, many small and medium-sized newspapers in Maharashtra struggled to sustain their operations.</p>

    <p>For regional and small newspapers, particularly those published in Marathi, Urdu, and Hindi, the situation became extremely challenging. Unlike large national media houses, these publications often operate with limited financial reserves. The sudden loss of advertising income forced many publishers to reduce the number of pages, suspend editions, or temporarily stop printing. Some newspapers permanently shut down, leading to the loss of valuable voices in local journalism.</p>

    <p>Journalists themselves were among the worst affected during this period. Many reporters, photographers, and media staff members faced salary cuts, delayed payments, or job losses. Freelance journalists and small-town correspondents were particularly vulnerable because they often depend on per-story payments or modest honorariums. During the pandemic, when field reporting became difficult and budgets were reduced, many of these journalists lost their primary source of income.</p>

    <p>Despite these challenges, journalists continued to perform their duties on the front lines. They reported from hospitals, quarantine centers, and remote villages to inform the public about the spread of the virus, government policies, and health precautions. In many cases, journalists risked their own health and safety while covering pandemic-related news. Unfortunately, the lack of adequate financial and institutional support has left many media professionals feeling neglected.</p>

    <p>Another major challenge that emerged during the post-COVID period is the rapid shift toward digital media consumption. During the lockdown, readers increasingly turned to mobile phones, news websites, and social media platforms for instant updates. While this digital transformation opened new opportunities, it also created intense competition for traditional newspapers. Many print media organizations were not fully prepared for the technological investments required to build strong digital platforms.</p>

    <p>For smaller newspapers in Maharashtra, transitioning to digital publishing has been difficult due to financial constraints and limited technical resources. Developing mobile-friendly websites, managing online subscriptions, and maintaining social media presence requires dedicated teams and infrastructure. Without sufficient investment, many newspapers struggle to compete with large digital media networks.</p>

    <p>Rising production costs have further worsened the situation. The price of newsprint, printing ink, transportation, and other operational expenses has increased significantly in recent years. When combined with declining advertisement revenue and reduced circulation, these rising costs place immense pressure on newspaper publishers. In some cases, newspapers have had to increase cover prices, which can further reduce readership among price-sensitive consumers.</p>

    <p>The crisis has also raised serious concerns about the long-term sustainability of independent journalism in the state. Local newspapers play an important role in highlighting regional issues, exposing corruption, and providing a platform for grassroots voices. If these institutions weaken or disappear, the democratic flow of information at the local level could suffer greatly.</p>

    <p>In this context, several journalist organizations and media bodies in Maharashtra have emphasized the need for stronger policy support from the government. One important demand is the implementation of protective measures for journalists, including financial assistance schemes, health insurance, and emergency support funds. Additionally, many media organizations have called for fair and transparent distribution of government advertisements to support smaller publications that serve local communities.</p>

    <p>There is also a growing discussion about the need for a comprehensive Journalist Protection Law and structured media welfare policies. Such measures could help ensure that journalists are able to perform their professional duties without economic insecurity or external pressure. Strengthening the institutional framework for journalism would ultimately benefit society as a whole by preserving independent and responsible media.</p>

    <p>Furthermore, media organizations themselves must adapt to the changing environment. Innovation in digital journalism, diversification of revenue sources, and collaboration with technology platforms will be essential for survival. Subscription-based models, digital advertising, and multimedia storytelling can help newspapers rebuild their financial stability while continuing to serve the public interest.</p>

    <p>Educational institutions and journalism training centers also have an important role to play. By equipping young journalists with digital skills, data journalism techniques, and multimedia reporting capabilities, the next generation of media professionals can help revitalize the industry.</p>

    <p>In conclusion, the COVID-19 pandemic has fundamentally reshaped the journalism and newspaper industry in Maharashtra. The sector continues to face economic challenges, technological disruption, and shifting audience habits. However, the importance of credible journalism has never been greater. With coordinated efforts from government authorities, media organizations, journalist unions, and civil society, the newspaper industry in Maharashtra can recover from the post-pandemic crisis and continue to play its crucial role in strengthening democracy.</p>

    <div class="footer">© 2026 Press Council of Maharashtra. All rights reserved. &nbsp;|&nbsp; Information of Press Council of Maharashtra, Vol. 1, Issue 1, Jan 2026<br><span style="font-size:8pt;color:#aaa;">Downloaded: ' . date('d M Y, g:i A') . ' IST</span></div>
    ';

    $mpdf->WriteHTML($html);
    $mpdf->Output('article-001-post-covid-maharashtra-journalism.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    exit;
}
?>
<!DOCTYPE html>
<html lang="mr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>पत्रकार सुरक्षा कायदा — Information of Press Council of Maharashtra</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Devanagari:wght@400;500;600;700&family=Source+Sans+3:wght@400;600;700&display=swap');

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
      font-family: 'Noto Sans Devanagari', 'Source Sans 3', Arial, sans-serif;
      font-size: 13pt;
      color: #1a1a1a;
      background: #fff;
      line-height: 1.85;
    }

    .page {
      max-width: 800px;
      margin: 0 auto;
      padding: 40px 50px 60px;
    }

    /* Journal Header */
    .journal-header {
      border-bottom: 3px solid #1a3a5c;
      padding-bottom: 14px;
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }
    .jh-left .jh-name {
      font-family: 'Source Sans 3', Arial, sans-serif;
      font-size: 13pt;
      font-weight: 700;
      color: #1a3a5c;
    }
    .jh-left .jh-issn {
      font-size: 10pt;
      color: #888;
      margin-top: 3px;
    }
    .jh-right {
      text-align: right;
      font-size: 10pt;
      color: #555;
    }

    /* Gold accent bar */
    .gold-bar {
      height: 4px;
      background: linear-gradient(90deg, #c8a84b, #e0c070, #c8a84b);
      margin-bottom: 28px;
      border-radius: 2px;
    }

    /* Article Meta */
    .article-meta {
      background: #f4f2ee;
      border-left: 4px solid #c8a84b;
      padding: 12px 16px;
      margin-bottom: 24px;
      font-size: 10.5pt;
      color: #444;
      line-height: 1.7;
    }
    .article-meta strong { color: #1a3a5c; }

    /* Title */
    .article-title {
      font-size: 19pt;
      font-weight: 700;
      color: #1a3a5c;
      line-height: 1.4;
      margin-bottom: 10px;
    }

    /* Authors */
    .article-authors {
      font-size: 12pt;
      font-weight: 600;
      color: #333;
      margin-bottom: 4px;
    }
    .article-affiliation {
      font-size: 10.5pt;
      color: #666;
      font-style: italic;
      margin-bottom: 20px;
    }

    /* Abstract box */
    .abstract-box {
      border: 1px solid #d4c9a8;
      background: #fffdf6;
      padding: 16px 20px;
      margin-bottom: 20px;
      border-radius: 4px;
    }
    .abstract-label {
      font-size: 10pt;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1px;
      color: #1a3a5c;
      margin-bottom: 8px;
    }
    .abstract-text {
      font-size: 11.5pt;
      line-height: 1.8;
      color: #333;
    }

    /* Keywords */
    .keywords {
      font-size: 10.5pt;
      color: #444;
      margin-bottom: 6px;
    }
    .keywords strong { color: #1a3a5c; }

    /* Divider */
    .section-divider {
      border: none;
      border-top: 1px solid #ddd;
      margin: 24px 0;
    }

    /* Body text */
    .article-body h2 {
      font-size: 13pt;
      color: #1a3a5c;
      margin: 22px 0 8px;
      font-weight: 700;
    }
    .article-body p {
      margin-bottom: 14px;
      text-align: justify;
      font-size: 12.5pt;
    }

    /* Footer */
    .article-footer {
      margin-top: 40px;
      border-top: 2px solid #1a3a5c;
      padding-top: 12px;
      font-size: 10pt;
      color: #888;
      display: flex;
      justify-content: space-between;
    }

    /* Print button — hidden when printing */
    .print-btn {
      position: fixed;
      top: 20px;
      right: 20px;
      background: #1a3a5c;
      color: #fff;
      border: none;
      padding: 12px 22px;
      font-size: 14px;
      font-weight: 600;
      border-radius: 6px;
      cursor: pointer;
      box-shadow: 0 2px 10px rgba(0,0,0,0.2);
      z-index: 9999;
    }
    .print-btn:hover { background: #25527d; }

    @media print {
      .print-btn { display: none; }
      body { font-size: 11pt; }
      .page { padding: 0; max-width: 100%; }
      .article-body p { font-size: 11pt; }
    }
  </style>
</head>
<body>

<button class="print-btn" onclick="window.print()">⬇ Save as PDF (Ctrl+P)</button>

<div class="page">

  <!-- Journal Header -->
  <div class="journal-header">
    <div class="jh-left">
      <div class="jh-name">Information of Press Council of Maharashtra</div>
      <div class="jh-issn">ISSN (Online): Applied for / Pending &nbsp;|&nbsp; Press Council of Maharashtra</div>
    </div>
    <div class="jh-right">
      Vol. 1, Issue 1<br>January 2026
    </div>
  </div>
  <div class="gold-bar"></div>

  <!-- Article Meta -->
  <div class="article-meta">
    <strong>Article 1</strong> &nbsp;|&nbsp; Pages: 1–10 &nbsp;|&nbsp; Language: Marathi &nbsp;|&nbsp; Published: January 2026 &nbsp;|&nbsp; DOI: Pending
  </div>

  <!-- Title -->
  <div class="article-title">पत्रकार सुरक्षा कायदा : लोकशाहीच्या चौथ्या स्तंभाचे संरक्षण</div>
  <div class="article-title" style="font-size:13pt;font-weight:600;color:#555;margin-top:6px;">
    (Journalist Protection Law: Protecting the Fourth Pillar of Democracy)
  </div>

  <br>

  <!-- Authors -->
  <div class="article-authors">[FILL: Author Name(s)]</div>
  <div class="article-affiliation">Information Of Press Council of Maharashtra, Mumbai, Maharashtra, India</div>

  <!-- Abstract -->
  <div class="abstract-box">
    <div class="abstract-label">Abstract / सारांश</div>
    <div class="abstract-text">
      लोकशाही व्यवस्थेत पत्रकारिता हा समाजाचा चौथा स्तंभ मानला जातो. गेल्या काही वर्षांत पत्रकारांवर होणाऱ्या हल्ल्यांच्या घटनांमध्ये वाढ झाल्यामुळे पत्रकारांच्या सुरक्षेचा प्रश्न गंभीर बनला आहे. महाराष्ट्र राज्याने पत्रकारांच्या संरक्षणासाठी "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" हा कायदा लागू केला. महाराष्ट्र हे असा स्वतंत्र कायदा करणारे देशातील पहिले राज्य ठरले. या लेखात या कायद्याच्या तरतुदी, अंमलबजावणीतील आव्हाने आणि डिजिटल युगातील पत्रकारांच्या सुरक्षेसाठी आवश्यक उपाययोजनांचा विस्तृत आढावा घेण्यात आला आहे.
    </div>
  </div>

  <!-- Keywords -->
  <div class="keywords"><strong>Keywords:</strong> पत्रकार सुरक्षा, लोकशाही, महाराष्ट्र, मीडिया कायदा, पत्रकारिता, press freedom, journalist protection, Maharashtra media law</div>

  <hr class="section-divider">

  <!-- Full Article Body -->
  <div class="article-body">

    <p>लोकशाही व्यवस्थेत पत्रकारिता हा समाजाचा चौथा स्तंभ मानला जातो. शासनाच्या धोरणांवर लक्ष ठेवणे, समाजातील समस्या उजेडात आणणे आणि जनतेला योग्य माहिती पुरवणे ही पत्रकारांची महत्त्वाची जबाबदारी असते. त्यामुळे पत्रकारांचे कार्य केवळ माहिती देण्यापुरते मर्यादित नसून ते लोकशाही टिकवून ठेवण्यासाठी अत्यंत महत्त्वाचे आहे. परंतु गेल्या काही वर्षांत पत्रकारांवर होणाऱ्या हल्ल्यांच्या घटनांमध्ये वाढ झाल्यामुळे पत्रकारांच्या सुरक्षेचा प्रश्न गंभीर बनला आहे.</p>

    <p>याच पार्श्वभूमीवर महाराष्ट्र राज्याने पत्रकारांच्या संरक्षणासाठी विशेष कायदा लागू करून एक महत्त्वपूर्ण पाऊल उचलले आहे. पत्रकार आणि माध्यम संस्थांवर होणाऱ्या हिंसाचाराला आळा घालण्यासाठी राज्यात "Maharashtra Mediapersons and Media Institutions (Prevention of Violence and Damage or Loss to Property) Act, 2017" हा कायदा लागू करण्यात आला. या कायद्याचा मुख्य उद्देश पत्रकारांना सुरक्षित वातावरण उपलब्ध करून देणे आणि पत्रकारांवर हल्ला करणाऱ्यांना कठोर शिक्षा करणे हा आहे.</p>

    <p>या कायद्यानुसार पत्रकार किंवा मीडिया संस्थेवर हल्ला करणे हा गंभीर गुन्हा मानला जातो. अशा गुन्ह्यासाठी आरोपीला कारावास आणि दंडाची शिक्षा होऊ शकते. तसेच पत्रकारांच्या कार्यालयावर किंवा उपकरणांवर हल्ला करून नुकसान केल्यास त्याची भरपाई आरोपीकडून वसूल करण्याची तरतूदही करण्यात आली आहे. या प्रकरणांची चौकशी वरिष्ठ पोलीस अधिकाऱ्यांकडून केली जाते, ज्यामुळे तपास अधिक प्रभावीपणे होण्याची अपेक्षा आहे.</p>

    <p>महाराष्ट्र हे पत्रकार संरक्षणासाठी स्वतंत्र कायदा करणारे देशातील पहिले राज्य ठरले. पत्रकार संघटना आणि सामाजिक कार्यकर्त्यांनी दीर्घकाळ या कायद्याची मागणी केली होती. अनेक वेळा भ्रष्टाचार, गुन्हेगारी किंवा स्थानिक गैरप्रकारांवर वृत्तांकन करताना पत्रकारांवर हल्ले झाले. काही पत्रकारांना जीव गमवावा लागला, तर काहींना धमक्या आणि दबावाचा सामना करावा लागला. या घटनांनी पत्रकारांच्या सुरक्षिततेबाबत गंभीर चिंता निर्माण केली आणि अखेर सरकारला हा कायदा लागू करावा लागला.</p>

    <p>तथापि, कायदा अस्तित्वात असणे पुरेसे नाही; त्याची प्रभावी अंमलबजावणी होणेही तितकेच महत्त्वाचे आहे. अनेक वेळा पत्रकारांवर हल्ला झाल्यानंतर गुन्हा दाखल करण्यात विलंब होतो किंवा तपास प्रक्रियेला वेळ लागतो. यामुळे आरोपींना धाक बसत नाही आणि पत्रकारांमध्ये असुरक्षिततेची भावना वाढते. विशेषतः ग्रामीण भागातील पत्रकारांना स्थानिक राजकीय दबाव, गुन्हेगारी प्रवृत्ती किंवा आर्थिक स्वार्थांमुळे मोठ्या अडचणींना सामोरे जावे लागते.</p>

    <p>आजच्या डिजिटल युगात पत्रकारितेचे स्वरूपही मोठ्या प्रमाणावर बदलले आहे. पारंपरिक वृत्तपत्रे आणि दूरदर्शन वाहिन्यांसोबतच डिजिटल माध्यमे, वेब पोर्टल आणि सोशल मीडिया प्लॅटफॉर्मवरही पत्रकारिता मोठ्या प्रमाणावर केली जात आहे. त्यामुळे या नव्या माध्यमांमध्ये कार्यरत असलेल्या पत्रकारांनाही कायद्याच्या संरक्षणाच्या कक्षेत स्पष्टपणे समाविष्ट करणे आवश्यक आहे.</p>

    <p>पत्रकारांच्या सुरक्षेसाठी काही महत्त्वाच्या उपाययोजना देखील आवश्यक आहेत. सर्वप्रथम, पत्रकारांवरील हल्ल्यांच्या प्रकरणांमध्ये त्वरित एफआयआर नोंदवून तपास जलद गतीने पूर्ण केला पाहिजे. दुसरे म्हणजे, अशा प्रकरणांसाठी विशेष तपास पथक स्थापन करून तपास प्रक्रियेला गती देणे गरजेचे आहे. तिसरे म्हणजे, पत्रकारांच्या तक्रारींसाठी स्वतंत्र प्राधिकरण स्थापन करून त्यांचे प्रश्न तातडीने सोडवले पाहिजेत. याशिवाय पत्रकारांसाठी विमा योजना, कायदेशीर मदत आणि आवश्यकतेनुसार पोलीस संरक्षण यांसारख्या सुविधा उपलब्ध करून देणेही महत्त्वाचे ठरेल.</p>

    <p>पत्रकारांच्या सुरक्षेचा प्रश्न हा केवळ एका व्यवसायाचा प्रश्न नाही; तो लोकशाहीच्या आरोग्याशी थेट संबंधित आहे. पत्रकार निर्भयपणे काम करू शकतील तरच शासनातील त्रुटी उघड होतील आणि समाजाला सत्य माहिती मिळेल. त्यामुळे पत्रकारांचे संरक्षण करणे ही केवळ सरकारचीच नव्हे तर संपूर्ण समाजाची जबाबदारी आहे.</p>

    <p>आजच्या काळात माहितीची देवाणघेवाण अत्यंत वेगाने होत असताना पत्रकारांची भूमिका अधिक महत्त्वाची बनली आहे. अशा परिस्थितीत पत्रकारांना सुरक्षित वातावरण मिळणे अत्यावश्यक आहे. पत्रकारांवर होणाऱ्या हल्ल्यांना आळा घालण्यासाठी कायद्याची कडक अंमलबजावणी, प्रशासनाची तत्परता आणि समाजाची जागरूकता आवश्यक आहे.</p>

    <p>शेवटी असे म्हणता येईल की, पत्रकारांचे संरक्षण म्हणजे लोकशाहीचे संरक्षण होय. पत्रकार सुरक्षित असतील तरच लोकशाही अधिक मजबूत आणि पारदर्शक राहू शकते. त्यामुळे पत्रकार सुरक्षा कायद्याची प्रभावी अंमलबजावणी करून पत्रकारांना निर्भयपणे काम करण्याचे वातावरण निर्माण करणे ही आजची गरज आहे.</p>

  </div>

  <!-- Footer -->
  <div class="article-footer">
    <span>© 2026 Press Council of Maharashtra. All rights reserved.</span>
    <span>Information of Press Council of Maharashtra, Vol. 1, Issue 1, Jan 2026</span>
  </div>

</div>
</body>
</html>
