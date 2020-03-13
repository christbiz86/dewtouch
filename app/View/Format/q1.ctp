
<div id="message1">


    <?php echo $this->Form->create('Type',array('id'=>'form_type','type'=>'file','url'=>'result','class'=>'','method'=>'POST','autocomplete'=>'off','inputDefaults'=>array(

        'label'=>false,'div'=>false,'type'=>'text','required'=>false)))?>

    <?php echo __("Hi, please choose a type below:")?>
    <br><br>

    <?php $options_new = array(
        'Type1' => __('<span class="showDialog" data-id="dialog_1" style="color:blue">Type1</span><div id="dialog_1" class="dialog" title="Type 1">
 				<span style="display:inline-block">
 				    <ul>
                        <li>Title of type 1</li>
                        <li>Detail of type 1</li>
                    </ul>
                </span>
 				</div>'),
        'Type2' => __('<span class="showDialog" data-id="dialog_2" style="color:blue">Type2</span><div id="dialog_2" class="dialog" title="Type 2">
 				<span style="display:inline-block">
 				    <ul>
 				        <li>Title of type 2</li>
 				        <li>Detail of type 2</li>
                    </ul>
                </span>
 				</div>')
    );?>

    <?php echo $this->Form->input('type', array('legend'=>false, 'type' => 'radio', 'options'=>$options_new,'before'=>'<label class="radio line notcheck">','after'=>'</label>' ,'separator'=>'</label><label class="radio line notcheck">'));
    echo $this->Form->submit('Save', array('class' => 'btn btn-primary hide'));?>


    <?php echo $this->Form->end();?>

</div>

<style>
    .showDialog:hover{
        text-decoration: underline;
    }

    #message1 .radio{
        vertical-align: top;
        font-size: 13px;
    }

    .control-label{
        font-weight: bold;
    }

    .wrap {
        white-space: pre-wrap;
    }

</style>

<?php $this->start('script_own')?>
<script>

    $(document).ready(function(){
        $(".dialog").css({
            "position":"absolute"
        }).hide();


        $(".showDialog").hover(function(){
            var id = $(this).data('id');
            $("#"+id).css({
                "top":$(this)[0].offsetTop,
                "left":$(this)[0].offsetLeft+$(this).width(),
            }).show();
        },function(){
            var id = $(this).data('id');
            $("#"+id).hide();
        })
            .click(function(){
                $('[type="submit"]').show();
            });

    })


</script>
<?php $this->end()?>