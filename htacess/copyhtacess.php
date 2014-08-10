<?php
		
        $ROOT = 'E:/xampp/htdocs/freemobiweb.mobi';
		$subdomain ='phuc';
		
		$filenamehtacess = $ROOT.'/htacess/.htaccess';
		$dirSourceCopy = $ROOT.'/htacess/'.$subdomain.'/';
		if(file_exists($filenamehtacess))
		{
		
			//+++++++copy+++++
			$myFile = $ROOT.'/htacess/.htaccess';
			$fh = fopen ( $myFile, 'w' ) or die ( "can't open file" );
			$stringData = "";
			$stringData .= "<IfModule mod_rewrite.c> \n";
			$stringData .= "RewriteEngine On \n";
			$stringData .= "RewriteCond %{HTTP_HOST} ^".$subdomain.".freemobiweb.mobi$ [OR] \n";
			$stringData .= "RewriteCond %{HTTP_HOST} ^www.".$subdomain.".freemobiweb.mobi$ \n";
			$stringData .= "RewriteRule (.*)$ http://freemobiweb.mobi/".$subdomain."$1 [R=301,L] \n";
			$stringData .= "</IfModule>\n";
			fwrite ( $fh, $stringData );
			fclose ( $fh );
		
			$fromfile = $ROOT.'/htacess/.htaccess';
			$tofile = $ROOT.'/htacess/'.$subdomain.'/';
			$tofilesoure = $ROOT.'/htacess/'.$subdomain.'/.htaccess';
			
			//var_dump(is_dir($tofile));
			//var_dump(file_exists($fromfile));
			if(is_dir($tofile))
			{
			    $fileindexhtml = $tofile.'/index.html';
				if (file_exists ( $fileindexhtml )) {
					unlink($fileindexhtml);
				}
				if (file_exists ( $tofilesoure )) {
					return $error = "htaccess already is use!";
					//exit ();
				}
			echo "phuc check copy</br>"; var_dump(copy ( $fromfile, $tofilesoure ));
			
			}else {
				$error = "Not creat directory ".$subdomain;
				echo  $error;
			}
		}else
		{ 
		$error ="done all";
		echo  $error;}
		
?>