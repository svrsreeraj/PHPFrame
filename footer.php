     
      <?php
		$obj		=	$GLOBALS["obj"];
		$smarty		=	$GLOBALS["smarty"];
		$fileArray	=	pathinfo($obj->getPageName());
		$file		=	$smarty->template_dir."/help/".$fileArray["filename"].".tpl.html";
		if(file_exists($file)) require_once $file;
		?>
   </div>
   </div>
</body>
</html>
