<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <meta name="author" content="duchanh" />

    <title>Crawl</title>

</head>

<?php


ini_set('max_execution_time', 400);
include_once('simple_html_dom.php');



$link= 'http://www.24h.com.vn/tin-van-bong-da-c409.html';

$opts = array('http'=>array('header' => "Mozilla/5.0 (iPad; CPU OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1"));
$context = stream_context_create($opts);
$html = file_get_html($link,false,$context);

function get_web_page( $url )
    {
        $user_agent='Mozilla/5.0 (Windows NT 6.1; rv:8.0) Gecko/20100101 Firefox/8.0';

        $options = array(

            CURLOPT_CUSTOMREQUEST  =>"GET",        //set request type post or get
            CURLOPT_POST           =>false,        //set to GET
            CURLOPT_USERAGENT      => $user_agent, //set user agent
            CURLOPT_RETURNTRANSFER => true,     // return web page
            CURLOPT_HEADER         => false,    // don't return headers
            CURLOPT_FOLLOWLOCATION => true,     // follow redirects
            CURLOPT_ENCODING       => "",       // handle all encodings
            CURLOPT_AUTOREFERER    => true,     // set referer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
            CURLOPT_TIMEOUT        => 120,      // timeout on response
            CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
        );

        $ch      = curl_init( $url );
        curl_setopt_array( $ch, $options );
        $content = curl_exec( $ch );
        $err     = curl_errno( $ch );
        $errmsg  = curl_error( $ch );
        $header  = curl_getinfo( $ch );
        curl_close( $ch );

        $header['errno']   = $err;
        $header['errmsg']  = $errmsg;
        $header['content'] = $content;
        var_dump($header);
        return $header;
    }
	
// Find all images
foreach($html->find('/html/body/div[2]/div[3]/table/tbody/tr/td[1]/div/div/span[2]/h2/a') as $element1a){
	
	 $link2 = "http://www.24h.com.vn".$element1a ->href;


	  $url1="http://localhost/tvvietnam/news-getcontent.php?link=".$link2;
	$url=$url1;
        try {
            $ch = curl_init();

            if (FALSE === $ch)
                throw new Exception('failed to initialize');

            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            

            $content = curl_exec($ch);

            if (FALSE === $content)
                throw new Exception(curl_error($ch), curl_errno($ch));
            echo $url." ======> SUCCESS!"."</br>";
            // ...process $content now
        } catch(Exception $e) {

            trigger_error(sprintf(
                'Curl failed with error #%d: %s',
                $e->getCode(), $e->getMessage()),
                E_USER_ERROR);

        }

	

}
	  
	





	   

	 

?>