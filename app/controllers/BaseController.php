<?php

class BaseController extends Controller {


	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		$title = "";
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	protected function addTitle($title,$url) {

		return $this->title = ":: <a href='$url'>".$title."</a>";

	}

}