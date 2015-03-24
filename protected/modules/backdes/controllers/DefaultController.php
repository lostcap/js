<?php

class DefaultController extends Controller
{
    public $layout="column1";
	public function actionIndex()
	{
        echo '@@@@';
		$this->render('index');
	}
}