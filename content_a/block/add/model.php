<?php
namespace content_a\block\add;


class model
{
	public static function post()
	{
		$post             = [];
		$post['title']    = \dash\request::post('title');

		$result = \lib\app\block::add($post);

		if(\dash\engine\process::status())
		{
			if(isset($result['id']))
			{
				\dash\redirect::to(\dash\url::this(). '/general?id='. $result['id']);
			}
			else
			{
				\dash\redirect::to(\dash\url::this());
			}

		}
	}
}
?>
