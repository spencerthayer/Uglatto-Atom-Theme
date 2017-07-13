<?php
    $dir = getcwd()."/mp3/"; //dir absolute path
    $interval = strtotime('-2 weeks'); //files older than
    foreach (glob($dir."*") as $file)
    if (filemtime($file) <= $interval ) unlink($file); //delete if older
    header('Content-Type: application/xml; charset=utf-8');
    include "vars.php";
    $getid3_engine = NULL;
    if(strlen($getid3_dir) != 0) {
        require_once($getid3_dir . 'getid3.php');
        $getid3_engine = new getID3;
    }
    // Write XML heading
    echo '<?xml version="1.0" encoding="utf-8" ?>';
?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">
  <channel>
    <title><?=$feed_title;?></title>
    <link><?=$feed_link;?></link>
    <!-- iTunes-specific metadata -->
    <itunes:author><?=$feed_author;?></itunes:author>
    <itunes:owner>
        <itunes:name><?=$feed_author;?></itunes:name>
        <itunes:email><?=$feed_email;?></itunes:email>
    </itunes:owner>
    <itunes:image href="<?=$feed_image;?>" />
    <itunes:explicit><?=$feed_explicit;?></itunes:explicit>
    <itunes:category text="<?=$feed_category;?>">
        <itunes:category text="<?=$feed_subcategory;?>" />
    </itunes:category>
    <itunes:summary><?=$feed_description;?></itunes:summary>
    <!-- Non-iTunes metadata -->
    <category><?=$feed_category;?></category>
    <description><?=$feed_description;?></description>
    <language><?=$feed_lang;?></language>
    <copyright><?=$feed_copyright;?></copyright>
    <ttl><?=$feed_ttl;?></ttl>
    <?php
    // The file listings
    $directory = opendir($files_dir) or die($php_errormsg);
    // Step through file directory
    while(false !== ($file = readdir($directory))) {
        $file_path = $files_dir . $file;
        // not . or .., ends in .mp3
        if(is_file($file_path) && strrchr($file_path, '.') == ".mp3" || is_file($file_path) && strrchr($file_path, '.') == ".mp4") {
            // Initialise file details to sensible defaults
            $file_title = $file;
            $file_url = $files_url . $file;
            $file_author = $feed_author;
            $file_duration = "";
            $file_description = "";
            $file_date = date(DateTime::RFC2822, filemtime($file_path));
            $file_size = filesize($file_path);
            // Read file metadata from the ID3 tags
            if(!is_null($getid3_engine)) {
                $id3_info = $getid3_engine->analyze($file_path);
                getid3_lib::CopyTagsToComments($id3_info);
                $file_title = $id3_info["comments_html"]["title"][0];
                $file_author = $id3_info["comments_html"]["artist"][0];
                $file_duration = $id3_info["playtime_string"];
            }
    ?>
    <item>
        <title><?=$file_title;?></title>
        <link><?=$file_url;?></link>
        <itunes:author><?=$file_author;?></itunes:author>
        <itunes:category text="<?=$feed_category;?>">
            <itunes:category text="<?=$feed_subcategory;?>" />
        </itunes:category>
        <category><?=$feed_category;?></category>
        <duration><?=$file_duration;?></duration>
        <description><?=$file_description;?></description>
        <pubDate><?=$file_date;?></pubDate>
        <enclosure url="<?=$file_url;?>" length="<?=$file_size;?>" type="<?php
          if(is_file($file_path) && strrchr($file_path, '.') == ".mp3") { print "audio/mpeg"; }
          if(is_file($file_path) && strrchr($file_path, '.') == ".mp4") { print "video/mp4"; }
            ?>" />
        <guid><?=$file_url;?></guid>
        <author><?=$feed_email;?></author>
    </item>
    <?php
        }
    }// closedir($files_dir);
    ?>
  </channel>
</rss>
