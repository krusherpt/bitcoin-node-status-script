<?php
/* 
The MIT License

Copyright (c) 2011 Schalk Bower <schalk@hotmail.co.nz>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

Donations: 14bBEcMwwnDVXAYR8n2iTk9PTF5wqYLGR2

*/

class Bitcoin {
	// @var string
	private $username;
	// @var string
	private $password;
	// @var string
	private $url;
	// @var integer
	private $id;
	
	/**
	 * Contructor
	 *
	 * @param string $url
	 * @param string $username
	 * @param string $password
	 * @param boolean $debug
	 */
	public function __construct($url, $username, $password) {
		//connection details
		$this->url = $url;
		$this->username = $username;
		$this->password = $password;
		//request id
		$this->id = 1;
	}
	
	/**
	 * Perform jsonRCP request and return results as array
	 *
	 * @param string $method
	 * @param array $params
	 * @return array
	 */
	public function __call($method,$params) {		
		// make params indexed array of values
		$params = array_values($params);
		
		// prepares the request
		$request = json_encode(array(
						'method' => strtolower($method),
						'params' => $params,
						'id' => $this->id
						));
						
		// performs the HTTP POST using curl
		$curl = curl_init();     
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
		curl_setopt($curl, CURLOPT_HTTPHEADER, Array("Content-type: application/json"));
		curl_setopt($curl, CURLOPT_URL, $this->url);  
		curl_setopt($curl, CURLOPT_USERPWD, $this->username.":".$this->password);  
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $request);
		$response = curl_exec($curl);  
		curl_close($curl); 
		
		// process response
		if (!$response) {
			throw new Exception('Unable to connect to '.$this->url, 0);
		}
		$response = json_decode($response,true);
		
		// check response id
		if ($response['id'] != $this->id) {
			throw new Exception('Incorrect response id (request id: '.$this->id.', response id: '.$response['id'].')',1);
		}
		if (!is_null($response['error'])) {
			throw new Exception('Request error: '.print_r($response['error'],1),2);
		}
		$this->id++;
		
		// return
		return $response['result'];
	}
}
?>
