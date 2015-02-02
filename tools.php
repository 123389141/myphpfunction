<?php
class tools {
	//文件下载
	function download($filedir){  //$filedir为路径+文件名
		$filedir=$_GET["filedir"];
		$value=explode('\\',$filedir);
		$filename = $value[count($value)-1];
		$filedir = iconv('utf-8','gb2312',$filedir);
		if(is_file($filedir)) {
			header("Content-Type: application/force-download");
			header("Content-Disposition: attachment; filename=".$filename);
			ob_clean();
			flush();
			readfile($filedir);
			exit;
		}else{
			echo "{$filedir}文件不存在！";
			exit;
		}
	}
	//服务器端get请求
	function requestget($id){
		$ch = curl_init();
		$timeout = 5;
		$url="http://aos.corp.elong.com/apus_web/DeployInstance/GetVersions?nodeId=nodeId&moduleName=moduleName&allowThreeVersion=false&allowFourVersion=true";
		curl_setopt ($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		$file_contents = curl_exec($ch);
		curl_close($ch);
	}
	//服务器端发post请求
	function requestpost($nodeId,$moduleName,$metaId,$i){
		$ch = curl_init();
		$timeout = 5;
		$url="http://aos.corp.elong.com/apus_web/DeployInstance/Run?metaId=$metaId";
		$data = array (
				'nodeId' => $nodeId,
				'version' => $maxver,
				'deployType'=>'module'
		);
		curl_setopt ( $ch, CURLOPT_URL, $url );
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
		$file_contents = curl_exec($ch);
		$aaaa =  (Array)json_decode($file_contents);
		curl_close($ch);
	}
	
}

?>