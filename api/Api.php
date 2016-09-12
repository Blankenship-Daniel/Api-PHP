<?php
abstract class Api {

	public function __construct($request) {
		$this->router($request);
	}

	protected function router($request) {
		$req = $request['req'];

		if ($req === 'create') {
			$this->create($req);
		} else if ($req === 'retrieve') {
			$this->retrieve($req);
		} else if ($req === 'update') {
			$this->update($req);
		} else if ($req === 'delete') {
			$this->delete($req);
		} else {
			throw new Exception('Invalid request');
		}
	}

	abstract protected function create($req);
	abstract protected function retrieve($req);
	abstract protected function update($req);
	abstract protected function delete($req);
}
?>
