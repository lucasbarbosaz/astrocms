<?php
	class Functions{
		static function Filter($type, $string) {
			if ($type == 'XSS' || $type == 'xss') {
				$value = htmlspecialchars_decode($string);
				$value = trim($value);

				# 18
				$search = [
					"<script", "/script>", 
					"<div", "/div>",
					"<a", "/a>",
					"<button", "/button>",
					"<?php", "?>",
					"<?=", "?>",
					"<svg", "/svg>",
					"<link", "<?xml"
				];

				$replace = [
					"", "", 
					"", "", 
					"", "",
					"", "",
					"", "", 
					"", "", 
					"", "", 
					"", "", 
					"", ""
				];
				
				$value = str_replace($search, $replace, $value);
			} else if ($type == 'username') {
				$value = htmlspecialchars_decode($string);
				$value = trim($value);

				$search = [
					" ", "/", "\\"
				];

				$replace = [
					"", "", ""
				];
				
				$value = str_replace($search, $replace, $value);
			}
		}
}

?>
