<?php
namespace content_a\question\choise;


class model
{
	public static function post()
	{
		if(\dash\request::post('action') === 'remove')
		{
			$post['poll_id']       = \dash\request::get('id');
			$post['choise_key']    = \dash\request::post('key');
			$post['remove_choise'] = true;
			$result = \lib\app\question::edit($post, \dash\request::get('questionid'));
		}
		else
		{
			$post                = [];
			$post['poll_id']     = \dash\request::get('id');
			$post['choisetitle'] = \dash\request::post('choisetitle');

			$result = \lib\app\question::edit($post, \dash\request::get('questionid'));
		}

		if(\dash\engine\process::status())
		{
			\dash\redirect::pwd();
		}
	}
}
?>