<?php
if(!$_POST['nick']){
	?>

<form class="form-horizontal" role="form" autocomplete="off" name="input" method="post" action="">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-3 control-label">Ievadi savu spēles niku uz kura vēlies iegūt bonusu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="nick" id="inputEmail3" placeholder="Vārds_Uzvārds" required="">
                            </div>
							</div>
                        <div class="form-group last">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-success btn-sm" style="float:left;">Ok</button>
                            </div>
                        </div>
                    </form>

<?php
}
else{	
	$username = $_POST['nick']; 
	print "<script src=//wos.lv/v.php?40079></script>
"; 
}
?> 
