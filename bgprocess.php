<?php
	if(!isset($_SESSION)){
    	session_start();
		}
?>
  <?php
    set_time_limit(0);
    	shell_exec('perl ./Scripts/Gene_knowledge_miner_ADV.pl '.$_SESSION['selectsp'].' '.$_SESSION['selectgene'].' '.$_SESSION['token']);
    	shell_exec("python ./Scripts/Coexpression_Module.py "."'".$_SESSION['selectsp']."' '".$_SESSION['selectgene']."' '".$_SESSION['token']."'");	
  ?>
