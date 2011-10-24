<?php
class UrlController extends AppController {
	private $availableChars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	private $baseUrl = 'http://pian.in/';
	public $url = null;
	public $newUrl = null;
	
	public function index() {
		# Output formats
		$ext = end(explode('.', end(explode('/', $this->param('here')))));
		
		if ($this->data) {
			$this->url = trim($this->data['url']);
			if ($this->isValid()) {
				$url = (!$urlCheck = $this->Url->firstByOriginal($this->url)) ? $this->generateUrl() : $urlCheck;
				$successUrl = $this->getFullUrl($url);
				Session::writeFlash('url.success', $successUrl);
			} else {
				$this->setError('URL inválida, tente novamente.');
			}
			
			if ($ext == 'htm') {
				$this->redirect('/');
			} else {
				$this->params['extension'] = $ext;
				$this->autoLayout = false;
				if ($successUrl) {
					$this->set('result', $successUrl);
				} else {
					$this->set('result', false);
				}
			}
			
		} else {
			if ($ext == '') {
				if ($shortened) $this->goToUrl();
			} else {
				$this->redirect('/');
			}
		}
	}
	
	private function generateUrl() {
			$this->Url->id = null;
			$this->Url->save(array(
				'original' => $this->url,
				'user_info' => $this->userInfo()
			));

			# Generate shorten code
			$id = $this->Url->id;
			$code = $this->generateShortned($id);
			$this->Url->save(array(
				'id' => $id,
				'short' => $code
			));
			
			$url = $this->Url->firstById($id);
			return $url;
	}
	
	private function goToUrl() {
		$here = explode('/', Mapper::here());
		$url = end($here);
		if ($original = $this->Url->firstByShort($url)) {
			$this->countVisit($original);
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: ' . $original['original']);
			exit;
		} else {
			$this->setError('URL inválida, tente novamente');
			$this->redirect('/');
		}
	}
	
	private function countVisit($url) {
		# Count 1 more visit
		$total = $url['visits'] + 1;
		$this->Url->save(array(
			'id' => $url['id'],
			'visits' => $total
		));
	}
	
	private function generateShortned($id) {
		$size = strlen($this->availableChars);
		while($id > $size - 1) {
			$output   = $base[fmod($id, $size)] . $output;
			$id = floor( $id / $size );
		}
		
		return $this->availableChars[$id] . $output;
	}
	
	private function getFullUrl($url) {
		return $this->baseUrl . $url['short'];
	}
	
	private function setView($url) {
		$full = $this->getFullUrl($url);
		$this->set('url_shortened', $full);
	}
	
	private function userInfo() {
		return json_encode(array(
			'ip' => $_SERVER['REMOTE_ADDR'],
			'agent' => $_SERVER['HTTP_USER_AGENT'],
			'created' => date('Y-m-d H:i:s')
		));
	}
	
	private function isValid() {
		return (filter_var($this->url, FILTER_VALIDATE_URL, FILTER_FLAG_HOST_REQUIRED) !== false) ? true : false;
	}
	
	private function setError($error) {
		Session::writeFlash('url.error', $error);
	}
}