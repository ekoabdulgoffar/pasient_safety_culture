<?php
	function myencrypt($data, $key)
    {
		//$data = base64_encode($data);
        $l = strlen($key);
        if ($l < 16)
            $key = str_repeat($key, ceil(16/$l));

        if ($m = strlen($data)%8)
            $data .= str_repeat("\x00",  8 - $m);
        if (function_exists('mcrypt_encrypt'))
            $val = mcrypt_encrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_ECB);
        else
            $val = openssl_encrypt($data, 'BF-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
		$val = str_replace(array('+', '/'), array('-', '_'), base64_encode($val));
        return $val;
    }

    function mydecrypt($data, $key)
    {
		$data = base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));
        $l = strlen($key);
        if ($l < 16)
            $key = str_repeat($key, ceil(16/$l));

        if (function_exists('mcrypt_encrypt'))
            $val = mcrypt_decrypt(MCRYPT_BLOWFISH, $key, $data, MCRYPT_MODE_ECB);
        else
            $val = openssl_decrypt($data, 'BF-ECB', $key, OPENSSL_RAW_DATA | OPENSSL_NO_PADDING);
		//$val = base64_decode($val);
        return $val;
    }
	
	function round_up($value, $precision) {
		if (is_numeric($value) && is_numeric($precision)) {
			$pow = pow (10,  $precision);
			return (ceil($pow * $value) + ceil ( $pow * $value - ceil ($pow*$value))) / $pow;
		} else {
			return 0;
		}
	}
	
	function get_url_api_payment () {
		$url = "https://edurisk-api.drrc.my.id/";
		return $url;
	}
?>