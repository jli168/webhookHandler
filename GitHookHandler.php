<?php

class GitHookHandler {

	// data from githook
	protected $_data;

	protected $_downloadUrlPrefix = "";

	public function __construct( $data ) {
		$this->_data = $data;
	}

	// handle posted data from git hook request
	// return an array of added/modified/deleted files with content
	public function handleData( ) {
		$contentsUrlPrefix = str_replace("{+path}", "", $this->_data["repository"]["contents_url"]);
		$httpRequestContext = stream_context_create(array("http" => array("header" => "User-Agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36")));

		// step1: fetch downloadUrlPrefix:
		foreach ( $this->_data["commits"] as $commit ) {
			$attempArr  = empty( $commit["added"] ) ? $commit["modified"] : $commit["added"];

			if ( empty( $attempArr ) ) {
				break;
			}
			$fileName = $attempArr[0];
			$filePath = $contentsUrlPrefix.$fileName;
			$data = file_get_contents( $filePath, false, $httpRequestContext );
			$data = json_decode($data, true);
			$download_url = $data["download_url"];
			$this->_downloadUrlPrefix = str_replace($fileName, "", $download_url);
			break;
		}

		// echo "download_url_prefix: ".$this->_downloadUrlPrefix."\n";

		// step2 fetch all updated files content and modified files content
		// put into an result array
		$result = array();
		$statusKeys = array( "added", "modified", "removed" );

		foreach ( $this->_data["commits"] as $commit ) {
			// echo "commit msg: ".$commit["message"].", id: ".$commit["id"].PHP_EOL;
			foreach ( $statusKeys as $status ) {
				if ( empty( $commit[$status] ) ) {
					continue;
				}
					
				foreach ( $commit[$status] as $path ) {
					$result[$path] = array(
						"status" => $status,
						"commit" => $commit["id"],
						"content" => $status === "removed" ? null : file_get_contents( $this->_downloadUrlPrefix.$path, false, $httpRequestContext ),
					);
				}
			}
		}

		// var_dump($result);
		
		return $result;
	}


}