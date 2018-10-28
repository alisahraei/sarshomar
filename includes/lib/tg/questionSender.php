<?php
namespace lib\tg;
// use telegram class as bot
use \dash\social\telegram\tg as bot;


class questionSender
{
	public static function analyse($_questionData)
	{
		// get message body
		$text         = self::body($_questionData);
		$reply_markup = false;


		switch ($_questionData['type'])
		{
			case 'short_answer':
				self::short_answer($_questionData, $text, $reply_markup);
				break;

			case 'descriptive_answer':
				self::descriptive_answer($_questionData, $text, $reply_markup);
				break;

			case 'numeric':
				self::numeric($_questionData, $text, $reply_markup);
				break;


			case 'multiple_choice':
				// self::multiple_choice($_questionData, $text, $reply_markup);
				break;


			case 'single_choice':
			case 'dropdown':
			case 'date':
			case 'time':
			case 'mobile':
			case 'email':
			case 'website':
			case 'rating':
			case 'rangeslider':
				break;

			default:
				// not support this type
				bot::sendMessage(T_('This type of message is not supported!'));
				return false;
				break;
		}

		// generate result
		$result =
		[
			'text'         => $text,
			'reply_markup' => $reply_markup
		];
		// send message
		bot::sendMessage($result);
	}


	private static function body($_questionData)
	{
		$bodyTxt = '';
		if(isset($_questionData['title']))
		{
			$bodyTxt .= "❔";
			$bodyTxt .= " <b>". $_questionData['title']. "</b>";
			// add require badge
			if(isset($_questionData['require']))
			{
				$bodyTxt .= " <code>*". T_('Require'). "</code>";
			}
			$bodyTxt .= "\n\n";
		}

		if(isset($_questionData['desc']))
		{
			$temp = $_questionData['desc'];
			$temp = str_replace('&nbsp;', ' ', $temp);
			$temp = str_replace('</p>', "</p>\n", $temp);
			$temp = strip_tags($temp, '<br><b>');
			$bodyTxt .= $temp;
		}

		if(isset($_questionData['media']['file']))
		{
			$bodyTxt .= "\n". "<a href='". $_questionData['media']['file']. "'>". T_("Image"). "</a>";
		}

		return $bodyTxt;
	}


	private static function short_answer($_question, &$_txt, &$_kbd)
	{
		$_txt .= "\n\n";
		$_txt .= '❇️ '. T_('Please wrote short answer for this question.');
	}


	private static function descriptive_answer($_question, &$_txt, &$_kbd)
	{
		$_txt .= "\n\n";
		$_txt .= '❇️ '. T_('Please describe your answer.');
	}

	private static function numeric($_question, &$_txt, &$_kbd)
	{
		$min = null;
		$max = null;
		if(isset($_question['setting']['numeric']['min']))
		{
			$min = $_question['setting']['numeric']['min'];
		}
		if(isset($_question['setting']['numeric']['max']))
		{
			$max = $_question['setting']['numeric']['max'];
		}

		$_txt .= "\n\n";
		$_txt .= '❇️ '. T_('Please enter number between :min and :max.', ['min' => $min, 'max' => $max]);
	}







	// private static function multiple_choice()
	// {
	// 	$question = \dash\data::question();
	// 	$msg = '';
	// 	if(isset($question['choice']) && is_array($question['choice']))
	// 	{
	// 		foreach ($question['choice'] as $key => $choice)
	// 		{
	// 			if(isset($choice['title']))
	// 			{
	// 				$msg .= $key . ': '. $choice['title']. "\n";

	// 			}
	// 		}

	// 	}
	// 	return $msg;
	// }



}
?>