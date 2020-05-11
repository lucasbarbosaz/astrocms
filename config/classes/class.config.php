<?php
class Config
{
	public function manutencao($pageid, $page, $urank) 
	{
		if($urank <= 5 || $pageid != "manutencao" || $page != "hk") {
		if(hybbe('manutencao') == "true") {
		Redirect(URL."/manutencao");
		}
		}
		return true;
		
	}
}
?>