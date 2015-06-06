<?
function loadCurlFile($cURL,$cache_url,$max_cachetime,$suppress_warnings){

//Variables you may edit

if(empty($max_cachetime)){ $max_cachetime = 60; } //60 minutes

//Don't edit the rest

define("MAX_CACHE_LIFETIME", 60 * $max_cachetime); 

$cachedInfo = null;
   
   if (file_exists($cache_url)) {
        if (time() - filemtime($cache_url) < MAX_CACHE_LIFETIME) {
            $cachedInfo = @file_get_contents($cache_url);
        }
    }
    if (empty($cachedInfo)) {
	
	$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "$cURL");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,0); 
		curl_setopt($ch, CURLOPT_TIMEOUT, 5); //timeout in seconds
		$headerCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$curl_errno = curl_errno($ch);
        $curl_error = curl_error($ch);
		if (file_exists($cache_url)) { $fileBackup = date ("F d Y H:i:s a | T", filemtime($cache_url)); }else{ $fileBackup = "No backup located"; }
		
	$cachedInfo = curl_exec($ch);

	if(curl_errno($ch))
		{
		if($suppress_warnings =="0"){ echo 'Cache error : ' . curl_errno($ch) . ' , Backup recovered from : ' . $fileBackup .'<br/><br/>'; }
		$cachedInfo = @file_get_contents($cache_url);
		}else{
			if ($headerCode == "200") //Making sure the page is totally working as intended
			{
				file_put_contents($cache_url, $cachedInfo); 
			}
		}
	
	
	curl_close($ch);
	}
	
	return($cachedInfo);
	//Should have an additional catch to cover any returned value that is totally empty
}
?>