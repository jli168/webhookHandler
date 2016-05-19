<?php

class GitHookHandler {
	protected $_data;

	public function __construct( $data ) {
		$this->_data = $data;
	}

	// handle posted data from git hook request
	public function handleData( ) {
		var_dump( $data );

	}
}