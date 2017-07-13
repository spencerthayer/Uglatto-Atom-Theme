<?php
    $streamURL = "http://live.majority.fm:8000/live";
    $length = "3.15";
    $timeCalc = $length*60*60;
    // $dir_name  = "majorityreport";
    $dir_name  = basename(__DIR__);
    $file_name = "mrl";
    // Location of MP3's on server. TRAILING SLASH REQ'D.
    $files_dir = "/home/spencerthayer/www/uglatto.com/".$dir_name."/mp3/";
    // Corresponding url for accessing the above directory. TRAILING SLASH REQ'D.
    $files_url = "http://uglatto.com/".$dir_name."/mp3/";
    // Date format
    $dateTime = date("mdy");
    // Location of getid3 folder, leave blank to disable. TRAILING SLASH REQ'D.
    $getid3_dir = "";
    // ====================================================== Generic feed options
    // Your feed's title
    $feed_title = "The Majority Report";
    // 'More info' link for your feed
    $feed_link = "http://majority.fm/report";
    // Brief description
    $feed_description = "The Majority Report is a daily political talk show hosted by Sam Seder. Call in to the show M-F 12 Noon EST: 646-257-3920. Add us all over the web!";
    // Copyright / license information
    $feed_copyright = "All content &#0169; The Majority Report " . date("Y");
    // How often feed readers check for new material (in seconds) -- mostly ignored by readers
    $feed_ttl = 60*60*24;
    // Language locale of your feed, eg en-us, de, fr etc. See http://www.rssboard.org/rss-language-codes
    $feed_lang = "en-us";
    // ============================================== iTunes-specific feed options
    // You, or your organisation's name
    $feed_author = "The Majority Report";
    // Feed author's contact email address
    $feed_email="sam@majority.fm";
    // Url of a 170x170 .png image to be used on the iTunes page
    $feed_image = "http://majority.fm/wp-content/uploads/2015/09/MR+MajorityFM+LOGO+opaque+face+copy.jpg";
    // If your feed contains explicit material or not (yes, no, clean)
    $feed_explicit = "clean";
    // iTunes major category of your feed
    $feed_category = "News &amp; Politics";
    // iTunes minor category of your feed
    $feed_subcategory = "Politics";
?>
