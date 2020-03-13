<?php 
	if(isset($result)){
		if($result=='1'){
?>
	<h1>Type 1</h1>
	<div id="dialog_1" class="dialog" title="Type 1">
        <span style="display:inline-block">
            <ul>
                <li>Title of type 1</li>
                <li>Detail of type 1</li>
            </ul>
        </span>
    </div>
<?php
		}
		else{
?>
	<h1>Type 2</h1>
	<div id="dialog_2" class="dialog" title="Type 2">
        <span style="display:inline-block">
            <ul>
                <li>Title of type 2</li>
                <li>Detail of type 2</li>
            </ul>
        </span>
    </div>
<?php
		}
	}
?>
	
<?php $this->end()?>