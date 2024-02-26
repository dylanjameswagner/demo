<!doctype html>
<html>
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width,minimum-scale=0.5,maximum-scale=1.0,user-scalable=no"/>

    <meta name="apple-mobile-web-app-capable" content="default"/>

    <title>device</title>

    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="./-/images/apple-touch-icon-144x144-precomposed.png"/>

    <!-- <link rel="stylesheet" href="./-/styles/core.css"/> -->
    <link rel="stylesheet" href="./-/styles/custom.css"/>

    <script src="./-/scripts/html5shiv.printshiv-3.6.2.min.js"></script>
    <script src="./-/scripts/prefixfree-1.0.7.min.js"></script>

<!--[if IE 8]><script src="./-/scripts/selectivizr-1.0.2.min.js"></script><![endif]-->

</head>

<body>

    <noscript>
        <p>Enable JavaScript to run tests.</p>
    </noscript>

    <div id="top">

        <div id="content">

            <table class="measurements">
                <tr><th>useragent</th>   <td class="useragent"><script>document.write(navigator.userAgent);</script></td></tr>
                <tr><th>ratio</th>       <td class="ratio">@<script>document.write(('devicePixelRatio' in window) ? devicePixelRatio : 1);</script>x</td></tr>
                <tr><th>orientation</th> <td class="orientation"></td>
                <tr><th>pixels</th>
                <td>
                    <script>
                        var ratio = ('devicePixelRatio' in window) ? devicePixelRatio : 1;
                        document.write(Math.ceil(ratio * screen.width) + ' × ' + Math.ceil(ratio * screen.height));
                    </script>
                </td></tr>
                <tr><th>screen</th>   <td class="screen"></td></tr>
                <tr><th>viewport</th> <td class="viewport"></td></tr>
                <tr><th>document</th> <td class="document"></td></tr>
            </table>

            <table class="dimensions">
                <caption>Mobile CSS Measurments</caption>
                <thead>
                    <tr><th>Device</th>                                                                    <th>Screen</th>      <th>Viewport</th>      <th>Ratio</th> <th>Browser</th></tr>
                </thead>
                <tbody>
                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone 11 Pro</th>     <td>375 × 812</td>   <td>375 × 635-749</td> <td>@3x</td>   <td><small>Safari on iOS 14.4.2</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone 11 Pro</th>     <td>812 × 375</td>   <td>724 × 292-375</td> <td>@3x</td>   <td><small>Safari on iOS 14.4.2</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone XR</th>         <td>414 × 896</td>   <td>414 × 635</td>     <td>@2x</td>   <td><small>Safari on iOS 12.1.4</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone XR</th>         <td>896 × 414</td>   <td>724 × 414*</td>    <td>@2x</td>   <td><small>Safari on iOS 12.1.4</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone XS Max</th>     <td>414 × 896</td>   <td>414 × 635</td>     <td>@3x</td>   <td><small>Safari on iOS 12.1.4</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone XS Max</th>     <td>896 × 414</td>   <td>724 × 414*</td>    <td>@3x</td>   <td><small>Safari on iOS 12.1.4</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone X/XS</th>       <td>375 × 812</td>   <td>375 × 635</td>     <td>@3x</td>   <td><small>Safari on iOS 12.1.4</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone X/XS</th>       <td>812 × 375</td>   <td>724 × 375*</td>    <td>@3x</td>   <td><small>Safari on iOS 12.1.4</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone 6/7/8 Plus</th> <td>414 × 736</td>   <td>414 × 622</td>     <td>@3x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone 6/7/8 Plus</th> <td>736 × 414</td>   <td>736 × 331-414</td> <td>@3x</td>   <td><small>iOS ? Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone 6/7/8</th>      <td>375 × 667</td>   <td>375 × 559</td>     <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone 6/7/8</th>      <td>667 × 375</td>   <td>667 × 331</td>     <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone SE</th>         <td>320 × 568</td>   <td>320 × 454-529</td> <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone SE</th>         <td>568 × 320</td>   <td>568 × ???</td>     <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone 5</th>          <td>320 × 568</td>   <td>320 × 460</td>     <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone 5</th>          <td>568 × 320</td>   <td>568 × 212</td>     <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPhone 1/2/3/4</th>    <td>320 × 480</td>   <td>320 × 372</td>     <td>@1x</td>   <td><small>iOS 7 Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPhone 1/2/3/4</th>    <td>480 × 320</td>   <td>480 × 212</td>     <td>@1x</td>   <td><small>iOS 7 Safari</small></td></tr>
                </tbody>
                <tfoot>
                    <tr><td colspan="6">
                        * Width inside safe area. Safari has tabs, which causes VH to be reported not as expected.
                    </td></tr>
                </tfoot>
            </table>

            <table class="dimensions">
                <caption>Tablet CSS Measurments</caption>
                <thead>
                    <tr><th>Device</th>                                                                    <th>Screen</th>      <th>Viewport</th>     <th>Ratio</th> <th>Browser</th></tr>
                </thead>
                <tbody>
                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPad</th>              <td>768 × 1024</td>  <td>768 × 928</td>    <td>@2x</td>   <td><small>iOS 7 Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPad</th>              <td>1024 × 768</td>  <td>1024 × 672</td>   <td>@2x</td>   <td><small>iOS 7 Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPad Mini</th>         <td>768 × 1024</td>  <td>768 × 928</td>    <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPad Mini</th>         <td>1024 × 768</td>  <td>1024 × 671</td>   <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPad Pro 12.9"</th>    <td>1024 × 1366</td> <td>1024 × ???</td>   <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPad Pro 12.9"</th>    <td>1366 × 1024</td> <td>??? × 1024</td>   <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>

                    <tr><th><span class="glyph portrait"  title="portrait"></span>  iPad Pro 10.5</th>     <td>1112 × 834</td>  <td>1112 × ???</td>   <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> iPad Pro 10.5</th>     <td>834 × 1112</td>  <td>??? × 1112</td>   <td>@2x</td>   <td><small>iOS ? Safari</small></td></tr>
                </tbody>
                <tfoot>
                    <tr><td colspan="6">
                        * Width inside safe area. Safari has tabs, which causes VH to be reported not as expected.
                    </td></tr>
                </tfoot>
            </table>

            <table class="dimensions">
                <caption>Laptop CSS Measurements</caption>
                <thead>
                    <tr><th>Device</th>                                                               <th>Screen</th>      <th>Viewport</th>         <th>Ratio</th> <th>Browser</th></tr>
                </thead>
                <tbody>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1920 × 1200</td> <td>1920 × 1089-1112</td> <th>@2x</th>   <td><small>Safari 12</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1680 × 1050</td> <td>1680 × 939-962</td>   <th>@2x</th>   <td><small>Safari 12</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1440 × 900</td>  <td>1440 × 789-812</td>   <th>@2x</th>   <td><small>Safari 12</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1280 × 800</td>  <td>1280 × 689-712</td>   <th>@2x</th>   <td><small>Safari 12</small></td></tr>

                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1920 × 1200</td> <td>1920 × 1067-1090</td> <th>@2x</th>   <td><small>Google Chrome 71</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1680 × 1050</td> <td>1680 × 917-940</td>   <th>@2x</th>   <td><small>Google Chrome 71</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1440 × 900</td>  <td>1440 × 767-790</td>   <th>@2x</th>   <td><small>Google Chrome 71</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1280 × 800</td>  <td>1280 × 667-690</td>   <th>@2x</th>   <td><small>Google Chrome 71</small></td></tr>

                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1920 × 1200</td> <td>1920 × 1103-1126</td> <th>@2x</th>   <td><small>Firefox 65</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1680 × 1050</td> <td>1680 × 953-976</td>   <th>@2x</th>   <td><small>Firefox 65</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1440 × 900</td>  <td>1440 × 803-826</td>   <th>@2x</th>   <td><small>Firefox 65</small></td></tr>
                    <tr><th><span class="glyph landscape" title="landscape"></span> MacBook Pro</th>  <td>1280 × 800</td>  <td>1280 × 703-726</td>   <th>@2x</th>   <td><small>Firefox 65</small></td></tr>
                </tbody>
            </table>

        </div>

    </div><!--#top-->

    <script src="./-/scripts/jquery-1.11.0.min.js"></script>
    <script src="./-/scripts/custom.js"></script>

</body>
</html>
