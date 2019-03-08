<table>
    <thead>
    <tr>
        <td><button type="submit" class="btn btn-default">一级按钮</button>名字:</td>
        <td><button type="submit" class="btn btn-default">二级按钮</button></td>
        <td>按钮类型:</td>
        <td>操作</td>
    </tr>
    </thead>
    <tbody id="show">
    <tr>
        <td><input type="text" name="name"></td>
        <td><input type="text" name="sex"></td>
        <td><input type="text" name="age"></td>
        <td>
            <input type="button" value="+" style="width: 30px;" class="btn">
        </td>
    </tr>
    </tbody>
</table>
<input type="button" value="保存" class="add">

<script>
    $(function(){
        $(document).on('click','.btn',function(){
            var _this=$(this);
            var _val=_this.val();
            if(_val=='+'){
                var _tr=_this.parents('tr').clone();
                _this.parents('tr').after(_tr);
                _this.val('-');
            }else{
                _this.parents('tr').remove();
            }
        })

        $('.add').click(function(){
            var _tr=$('#show').children('tr');//2个tr
            var str="";
            for(var i=0;i<_tr.length;i++){
                var _td= _tr.eq(i).children('td');
                var _input=_td.find("input[name]");
                for(var j=0;j<_input.length;j++){
                    var n=_input.eq(j).prop('name');
                    var v=_input.eq(j).val();
                    str+=n+':'+v+',';
                }
                str+='|';
            }

            $.post(
                "{:url('Jq/add')}",
                {str:str},
                function(result){
                    console.log(result);
                }
            );
        });
    })
</script>