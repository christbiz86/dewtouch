<div class="alert  ">
    <button class="close" data-dismiss="alert"></button>
    Question: Advanced Input Field</div>

<p>
    1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
    2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

    <?php echo htmlentities('<input name="data[1][quantity]" class="">')?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
    <button class="close" data-dismiss="alert"></button>
    The table you start with</div>

<table id="tableTarget" class="table table-striped table-bordered table-hover">
    <thead>
    <th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
    <th>Description</th>
    <th>Quantity</th>
    <th>UOM</th>
    <th>Unit Price</th>
    <th>AMT</th>
    </thead>

    <tbody>
    <tr id="template" class="hidden">
        <td class="iDel"><span class="delButton" class="btn mini black delbutton"><i class="icon-trash"></i></span></td>
        <td class="iDesc"><span class="dataText"></span><textarea class="inputForm hidden m-wrap  description required" rows="2" ></textarea></td>
        <td class="iQty"><span class="dataText">0</span><input class="inputForm hidden"></td>
        <td class="iUOM"><span class="dataText">pc</span><input  class="inputForm hidden"></td>
        <td class="iUnitPrice"><span class="dataText">0.00</span><input  class="inputForm hidden"></td>
        <td class="iAMT"><span class="dataText">0.00</span><input  class="inputForm hidden"></td>
    </tr>
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5" class="text-right">Total</td>
        <td id="totalData"></td>
    </tr>
    </tfoot>

</table>


<p></p>
<div class="alert alert-info ">
    <button class="close" data-dismiss="alert"></button>
    Video Instruction</div>

<p style="text-align:left;">
    <video width="78%"   controls>
        <source src="/video/q3_2.mov">
        Your browser does not support the video tag.
    </video>
</p>





<?php $this->start('script_own');?>
<script>
    function switchMode(e){
        e.stopPropagation();
        if($(".inputForm",this).hasClass("hidden")){
            $(".dataText",this).addClass("hidden");
            $(".inputForm",this).removeClass("hidden");
            $(".inputForm",this).focus();
        }
    }

    function loadText(){
        var sibling = $(this).siblings(".dataText")
        sibling.text($(this).val());
        $(this).addClass("hidden");
        $(sibling).removeClass("hidden");
        if($(this).closest("td").hasClass("iQty")||$(this).closest("td").hasClass("iUnitPrice")){
            var row = $(this).closest("tr");
            var AMT = parseInt($(".iQty .inputForm",row).val()*$(".iUnitPrice .inputForm",row).val());
            console.log(AMT);
            $(".iAMT .inputForm",row).val(AMT);
            $(".iAMT .dataText",row).text(AMT);
            var total = 0;
            $(".iAMT:visible").each(function(){
                total+=parseInt($(".inputForm",this).val());
            });
            $("#totalData").text(total);
        }
    }

    function delRow(){
        var parent = $(this).closest("tr");
        var rowNum = $(".iDesc .inputForm",parent).attr("name");
        rowNum = rowNum.split('data[')[1];
        rowNum = rowNum.split(']')[0];
        if(confirm("Are you sure to delete this data "+rowNum+"?")){
            parent.remove();
        }
    }

    $(document).ready(function(){
        $("#add_item_button").click(function(){
            var newRow = $("tr#template").clone().removeAttr("id").removeClass("hidden");
            $("td",newRow).click(switchMode);
            $(".inputForm",newRow).blur(loadText);
            var newNum = $("#tableTarget tbody tr:visible").length+1;
            while($("[name='data["+newNum+"][description]']").length>0){
                newNum++;
            }
            $(".iDesc .inputForm",newRow).attr("name","data["+newNum+"][description]");
            $(".iQty .inputForm",newRow).attr("name","data["+newNum+"][quantity]");
            $(".iUOM .inputForm",newRow).attr("name","data["+newNum+"][uom]");
            $(".iUnitPrice .inputForm",newRow).attr("name","data["+newNum+"][unit_price]");
            $(".iAMT .inputForm",newRow).attr("name","data["+newNum+"][amt]");
            $(".delButton",newRow).click(delRow);
            $("#tableTarget tbody").append(newRow);
        });
    });
</script>
<?php $this->end();?>