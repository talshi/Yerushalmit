<?PHP
	$pluginStatus = null;
	
	function mapfig_premium__post($key) {
		if(isset($_POST[$key])) {
			return $_POST[$key];
		}
		else {
			return "";
		}
	}
	function mapfig_premium__get($key) {
		if(isset($_GET[$key])) {
			return $_GET[$key];
		}
		else {
			return "";
		}
	}
	
	function mapfig_premium_uploadShare($name) {
		$target_dir = MAPFIG_PREMIUM_EMP_DOCROOT."/images/share/";
		$target_file = $target_dir . $name . '.png';
		
		$imageFileType = pathinfo(basename($_FILES[$name]["name"]),PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES[$name]["tmp_name"]);
		if($check !== false) {
			
		} else {
			return $name." File is not an image.";
		}
		
		// Check if file already exists
		if (file_exists($target_file)) {
			@unlink($target_file);
		}
		
		// Check file size
		if ($_FILES[$name]["size"] > 300000) {
			return "Sorry, your file ".$name." is too large. Max allowed size is : 300kb";
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			return "Sorry, only JPG, JPEG, PNG & GIF files are allowed. ".$name." is not an image";
		}
		
		if (file_put_contents($target_file, file_get_contents($_FILES[$name]["tmp_name"]))) {
			return ""; //success
		} else {
			return "Sorry, there was an error uploading your file ".$name;
		}
	}

	
	function mapfig_premium_check_license($licensekey, $localkey='') {
		// -----------------------------------
		//  -- Configuration Values --
		// -----------------------------------

		// Enter the url to your WHMCS installation here
		$whmcsurl = 'https://www.mapfig.com/portal/';
		// Must match what is specified in the MD5 Hash Verification field
		// of the licensing product that will be used with this check.
		$licensing_secret_key = 'iLYIdf1uwMtWFzWRI2l7Qg9x1f0VaZ5d';
		// The number of days to wait between performing remote license checks
		$localkeydays = 1;
		// The number of days to allow failover for after local key expiry
		$allowcheckfaildays = 2;

		// -----------------------------------
		//  -- Do not edit below this line --
		// -----------------------------------

		$check_token = time() . md5(mt_rand(1000000000, 9999999999) . $licensekey);
		$checkdate = date("Ymd");
		$domain = $_SERVER['SERVER_NAME'];
		$usersip = isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : $_SERVER['LOCAL_ADDR'];
		$dirpath = dirname(__FILE__);
		$verifyfilepath = 'modules/servers/licensing/verify.php';
		$localkeyvalid = false;
		if ($localkey) {
			$localkey = str_replace("\n", '', $localkey); # Remove the line breaks
			$localdata = substr($localkey, 0, strlen($localkey) - 32); # Extract License Data
			$md5hash = substr($localkey, strlen($localkey) - 32); # Extract MD5 Hash
			if ($md5hash == md5($localdata . $licensing_secret_key)) {
				$localdata = strrev($localdata); # Reverse the string
				$md5hash = substr($localdata, 0, 32); # Extract MD5 Hash
				$localdata = substr($localdata, 32); # Extract License Data
				$localdata = base64_decode($localdata);
				$localkeyresults = unserialize($localdata);
				$originalcheckdate = $localkeyresults['checkdate'];
				if ($md5hash == md5($originalcheckdate . $licensing_secret_key)) {
					$localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - $localkeydays, date("Y")));
					if ($originalcheckdate > $localexpiry) {
						$localkeyvalid = true;
						$results = $localkeyresults;
						$validdomains = explode(',', $results['validdomain']);
						if (!in_array($_SERVER['SERVER_NAME'], $validdomains)) {
							$localkeyvalid = false;
							$localkeyresults['status'] = "Invalid";
							$results = array();
						}
						$validips = explode(',', $results['validip']);
						if (!in_array($usersip, $validips)) {
							$localkeyvalid = false;
							$localkeyresults['status'] = "Invalid";
							$results = array();
						}
						$validdirs = explode(',', $results['validdirectory']);
						if (!in_array($dirpath, $validdirs)) {
							$localkeyvalid = false;
							$localkeyresults['status'] = "Invalid";
							$results = array();
						}
					}
				}
			}
		}
		if (!$localkeyvalid) {
			$responseCode = 0;
			$postfields = array(
				'licensekey' => $licensekey,
				'domain' => $domain,
				'ip' => $usersip,
				'dir' => $dirpath,
			);
			if ($check_token) $postfields['check_token'] = $check_token;
			$query_string = '';
			foreach ($postfields AS $k=>$v) {
				$query_string .= $k.'='.urlencode($v).'&';
			}
			if (function_exists('curl_exec')) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $whmcsurl . $verifyfilepath);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);
				curl_setopt($ch, CURLOPT_TIMEOUT, 30);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				$data = curl_exec($ch);
				$responseCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
				curl_close($ch);
			} else {
				$responseCodePattern = '/^HTTP\/\d+\.\d+\s+(\d+)/';
				$fp = @fsockopen($whmcsurl, 80, $errno, $errstr, 5);
				if ($fp) {
					$newlinefeed = "\r\n";
					$header = "POST ".$whmcsurl . $verifyfilepath . " HTTP/1.0" . $newlinefeed;
					$header .= "Host: ".$whmcsurl . $newlinefeed;
					$header .= "Content-type: application/x-www-form-urlencoded" . $newlinefeed;
					$header .= "Content-length: ".@strlen($query_string) . $newlinefeed;
					$header .= "Connection: close" . $newlinefeed . $newlinefeed;
					$header .= $query_string;
					$data = $line = '';
					@stream_set_timeout($fp, 20);
					@fputs($fp, $header);
					$status = @socket_get_status($fp);
					while (!@feof($fp)&&$status) {
						$line = @fgets($fp, 1024);
						$patternMatches = array();
						if (!$responseCode
							&& preg_match($responseCodePattern, trim($line), $patternMatches)
						) {
							$responseCode = (empty($patternMatches[1])) ? 0 : $patternMatches[1];
						}
						$data .= $line;
						$status = @socket_get_status($fp);
					}
					@fclose ($fp);
				}
			}
			if ($responseCode != 200) {
				$localexpiry = date("Ymd", mktime(0, 0, 0, date("m"), date("d") - ($localkeydays + $allowcheckfaildays), date("Y")));
				if ($originalcheckdate > $localexpiry) {
					$results = $localkeyresults;
				} else {
					$results = array();
					$results['status'] = "Invalid";
					$results['description'] = "Remote Check Failed";
					return $results;
				}
			} else {
				preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $matches);
				$results = array();
				foreach ($matches[1] AS $k=>$v) {
					$results[$v] = $matches[2][$k];
				}
			}
			if (!is_array($results)) {
				die("Invalid License Server Response");
			}
			if (isset($results['md5hash']) && $results['md5hash']) {
				if ($results['md5hash'] != md5($licensing_secret_key . $check_token)) {
					$results['status'] = "Invalid";
					$results['description'] = "MD5 Checksum Verification Failed";
					return $results;
				}
			}
			if ($results['status'] == "Active") {
				$results['checkdate'] = $checkdate;
				$data_encoded = serialize($results);
				$data_encoded = base64_encode($data_encoded);
				$data_encoded = md5($checkdate . $licensing_secret_key) . $data_encoded;
				$data_encoded = strrev($data_encoded);
				$data_encoded = $data_encoded . md5($data_encoded . $licensing_secret_key);
				$data_encoded = wordwrap($data_encoded, 80, "\n", true);
				$results['localkey'] = $data_encoded;
			}
			$results['remotecheck'] = true;
		}
		unset($postfields,$data,$matches,$whmcsurl,$licensing_secret_key,$checkdate,$usersip,$localkeydays,$allowcheckfaildays,$md5hash);
		return $results;
	}
	
	
	function mapfig_premium_check_license_status() {
		$licensekey = get_option("mapfig_premium_licensekey", "");
		
		if($licensekey == "") {
			return "Empty";	// License key is not entered!
		}
		
		$localkey   = get_option("mapfig_premium_localkey", "");
		$results    = mapfig_premium_check_license($licensekey, $localkey);
		
		switch ($results['status']) {
			case "Active":
				if(isset($results['localkey'])) {
					update_option("mapfig_premium_localkey", $results['localkey']);
				}
				break;
			case "Invalid":
				//die("License key is Invalid");
				break;
			case "Expired":
				//die("License key is Expired");
				break;
			case "Suspended":
				//die("License key is Suspended");
				break;
			default:
				return "Invalid Response";
				break;
		}
		
		return $results['status'];
	}
	
	
	function mapfig_premium_admin_notice() {
		$totalMaps = mapfig_premium_model_mf_Table::getmf_map();
		$status = mapfig_premium_check_license_status();
		
		if(count($totalMaps)>=5 && $status != "Active") {
			echo '<div class="update-nag">You have reached the maximum allowed MapFig Maps.';
			if($status == "Empty") {
				echo 'Please <a href="https://www.mapfig.com/portal/cart.php?gid=1">get the License</a> and <a href="'.admin_url().'admin.php?page=mapfig-license">Click Here</a> to Setup It.</div>';
			}
			else {
				echo 'MapFig Leaflet Plug-in License is '.$status.' Please <a href="https://www.mapfig.com/portal/cart.php?gid=1">get the License</a> and <a href="'.admin_url().'admin.php?page=mapfig-license">Click Here</a> to Setup It.</div>';
			}
		}
	}
	add_action('admin_notices', 'mapfig_premium_admin_notice');
	
	
	function mapfig_premium_canAddMaps() {
		$totalMaps = mapfig_premium_model_mf_Table::getmf_map();
		$status = mapfig_premium_check_license_status();
		
		if(count($totalMaps)>=5 && $status != "Active") {
			return false;
		}
		
		return true;
	}
	
	
	function mapfig_premium_my_script_enqueuer() { 
	   
		wp_register_style('datatable_css', plugins_url( '../datatable/jquery.dataTables.css' , __FILE__ ));
		wp_register_style('validate_css', plugins_url( '../validate/validate.css' , __FILE__ ));
		wp_register_style('leaflet_css', plugins_url( '../leaflet/dist/leaflet.css' , __FILE__ ));
		wp_register_style('my_css', plugins_url( '/css/custom.css' , __FILE__ ));
		wp_register_style('font_awesome', plugins_url( '../font-awesome/css/font-awesome.css' , __FILE__ ));
		wp_register_style('markers_css', plugins_url( '../leaflet/dist/leaflet.awesome-markers.css' , __FILE__ ));
		
		wp_register_style('bootflat_css', plugins_url('../bootflat/css/site.min.css' , __FILE__));
		wp_register_style('bootstrap_slider_css', plugins_url('../bootstrap/css/bootstrap-slider.css' , __FILE__));
		wp_register_script('datatable_script',plugins_url( '../datatable/jquery.dataTables.js' , __FILE__ ), array( 'jquery' ),'',true);
		wp_register_script('validate_script',plugins_url( '../validate/jquery.validate.min.js' , __FILE__ ), array( 'jquery' ),'',true);
		
		wp_register_script('bootflat_js',plugins_url( '../bootflat/js/site.min.js' , __FILE__ ), array( 'jquery' ),'','');
		wp_register_script('leafletjs',plugins_url( '../leaflet/dist/leaflet.js' , __FILE__ ), array( 'jquery' ),'','');
		wp_register_script('leaflet_awesome',plugins_url( '../leaflet/dist/leaflet.awesome-markers.js' , __FILE__ ), array( 'jquery' ),'','');
		wp_register_script('tinymcejs',plugins_url( '../tinymce/js/tinymce/tinymce.min.js' , __FILE__ ), array( 'jquery' ),'','');
		wp_register_style ('mf_colorbox', plugins_url('../css/colorbox.css', __FILE__) );
		
		wp_register_style( 'mf_user_main', plugins_url('../css/main.css', __FILE__) );
		wp_register_script( 'mf_colorbox_js', plugins_url('../js/jquery.colorbox-min.js', __FILE__), array(), '1.0.0', true );
		wp_register_script( 'jquery-scrollto_js', plugins_url('../js/jquery-scrollto.js', __FILE__), array(), '1.0.0', true );
		wp_register_script( 'mf_selecttag_js', plugins_url('../js/jquery.SelectTag.js', __FILE__), array(), '1.0.0', true );
		wp_register_script( 'jquery_migrate_js', plugins_url('../js/jquery-migrate-1.2.1.js', __FILE__), array(), '1.0.0', true );
		wp_register_script( 'mf_custom_js', plugins_url('../js/custom.js', __FILE__), array(), '1.0.0', true ); 
		wp_register_script( 'mf_marker_preview_js', plugins_url('../js/marker_preview.js', __FILE__), array(), '1.0.0', true ); 
		
		wp_register_style('jquery_ui_css', plugins_url('../css/jquery-ui.css', __FILE__));
	   
		wp_register_script('bootstrap_alert_js', plugins_url('../bootstrap3-dialog/js/bootstrap-dialog.min.js', __FILE__));
		wp_register_style('bootstrap_alert_css', plugins_url('../bootstrap3-dialog/css/bootstrap-dialog.min.css', __FILE__));
		
		wp_register_script('bootstrap-js', plugins_url('../bootstrap/js/bootstrap.js', __FILE__));
		wp_register_style('bootstrap-css', plugins_url('../bootstrap/css/bootstrap.css', __FILE__));
		
		wp_register_script('leaflet-fullscreen-js', plugins_url('../external/Leaflet.fullscreen.min.js', __FILE__));
		wp_register_style('leaflet-fullscreen-css', plugins_url('../external/leaflet.fullscreen.css', __FILE__));
		
		wp_register_script('leaflet-controle-locate-js', plugins_url('../external/L.Control.Locate.js', __FILE__));
		wp_register_style('leaflet-controle-locate-css', plugins_url('../external/L.Control.Locate.css', __FILE__));
		
		wp_register_script('google-maps-api-js', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places');
		
		wp_register_style('google-font-roboto-css', 'https://fonts.googleapis.com/css?family=Roboto:300,400,500');
		wp_register_style('google-font-lato-css', 'https://fonts.googleapis.com/css?family=Lato:300,400,300italic,400italic');
		wp_register_style('google-font-montserrat-css', 'https://fonts.googleapis.com/css?family=Montserrat:400,700');
		
		wp_register_script('leaflet-draw-js', plugins_url('/../js/leaflet.draw.js', __FILE__));
		wp_register_style('leaflet-draw-css', plugins_url('/../css/leaflet.draw.css', __FILE__));
		
		wp_register_script('leaflet-measurecontrol-js', plugins_url('../external/leaflet.measurecontrol.js', __FILE__));
		wp_register_style('leaflet-measurecontrol-css', plugins_url('../external/leaflet.measurecontrol.css', __FILE__));
		
		wp_register_script('leaflet-minimap-js', plugins_url('../external/Control.MiniMap.js', __FILE__));
		wp_register_style('leaflet-minimap-css', plugins_url('../external/Control.MiniMap.css', __FILE__));
		
		wp_register_script('leaflet-search-js', plugins_url('../external/Leaflet.Search.js', __FILE__));
		
		wp_register_script('leaflet-export-js', plugins_url('../external/ExportControl.js', __FILE__));
		
		wp_register_script('colpick-js', plugins_url('/../colorpicker/js/colpick.js', __FILE__));
		wp_register_style('colpick-css', plugins_url('/../colorpicker/css/colpick.css', __FILE__));
		
		wp_register_script('helper-js', plugins_url('/../js/helper.js', __FILE__));
		wp_register_script('mf-js', plugins_url('/../js/mf.js', __FILE__));
		
		
		
		wp_enqueue_script('jquery');
		wp_enqueue_style('font_awesome');
		wp_enqueue_style('leaflet_css');
		wp_enqueue_style('markers_css');
		
		wp_enqueue_style('google-font-lato-css');
		wp_enqueue_style('google-font-montserrat-css');
		
		wp_enqueue_script('leafletjs');
		wp_enqueue_script('leaflet_awesome');
		
		
		$pluginPages = array(MF_PLUGIN_NAME,"my-maps","add-new-map","get-started","get_started_widget","map-edit","map-delete","layers","layers-edit","layers-add","groups","groups-edit","groups-add","social-share","social-share-settings","mapfig-license");
		if(!isset($_GET['page']) || !in_array($_GET['page'], $pluginPages)){
			return;
		}
		
	   
		wp_enqueue_style('datatable_css');   
		wp_enqueue_style('validate_css');  
		wp_enqueue_style('bootflat_css');
		wp_enqueue_style('bootstrap_slider_css');
		
		wp_enqueue_script( 'datatable_script' );
		wp_enqueue_script( 'validate_script' );
		wp_enqueue_script( 'bootflat_js' );
		
		wp_enqueue_style('mf_colorbox');
		wp_enqueue_style('mf_user_main');
		wp_enqueue_script( 'mf_colorbox_js' );
		wp_enqueue_script( 'jquery-scrollto_js' );
		wp_enqueue_script( 'mf_selecttag_js' );
		wp_enqueue_script( 'jquery_migrate_js' );
		
		wp_enqueue_script('jquery-ui-slider');
		wp_enqueue_style('jquery_ui_css');
		
		wp_enqueue_script('bootstrap_alert_js');
		wp_enqueue_style('bootstrap_alert_css');
	}
	
	function mapfig_premium_getLayersByGroupId($id){
		$baseLayers = array();
		
		$layers = mapfig_premium_model_mf_Table::mapfig_premium_getLayersByGroupId($id);
		
		foreach($layers as $layer) {
			$baseLayers[] = array('name' => $layer->name, 'url' => $layer->url, 'lkey' => $layer->lkey, 'accesstoken' => $layer->accesstoken, 'attribution' => $layer->attribution);
		}
		
		return $baseLayers;
	}
	
	function mapfig_premium_getDefaultLayer($id) {
		$layer = mapfig_premium_model_mf_Table::getLayer($id);
		if(!$layer) {
			$layer = mapfig_premium_model_mf_Table::mapfig_premium_getDefaultLayer();
		}
		
		$defaulLayer = array('url' => $layer->url, 'lkey' => $layer->lkey, 'accesstoken' => $layer->accesstoken, 'attribution' => $layer->attribution);
		return $defaulLayer;
	}
?>