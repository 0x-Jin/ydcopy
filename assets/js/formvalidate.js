    var direction = 1;
    //添加
    function add_next(){
        if(direction == 1){
           $('#turn_node').show();
        }
        else{
            $('#turn_node').hide();
        }
        direction *= -1;  
    };
    //alert( /^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2})$/.test('2015-05-30 01:21'));
    //提交
    function tosubmit(num) {
           if (num == 1) {
               $('#interviewForm').append("<input type='hidden' name='save' value='save'/>");
               if (check($('#interviewForm'),true)) {
                   $('#interviewForm').submit();
               }
           }
           if (num == 2) {
               $('#interviewForm').append("<input type='hidden' name='finished' value='finished'/>");
               if (check($('#interviewForm'),true)) {
                   $('#interviewForm').submit();
               }
           }
           if (num == 3) {
               $('#interviewForm').append("<input type='hidden' name='turn' value='turn'/>");
               if (check($('#interviewForm'),false)) {
                   $('#interviewForm').submit();
               }
           }
    };
    //这部分
    function check(ele,bool) {
        var flag = 1;
        //找到所有的input,确定是否存在要验证的关键字，然后进行验证：
        ele.find('input[type=text]').each(function (){
            //假设
            if ($(this).attr("checkform-type") != '') {
                var val = $(this).val();
                val = val.replace(/^\s+|\s+$/g,"");
                var msg = $(this).attr("checkform-msg");
                var need_reuired = $(this).attr("need_reuired");
                if(need_reuired == 'on'){//先把必须的都检验一遍，不必须的
                   if(bool){//检验一部分
                       if(typeof($(this).attr("checkform-quick"))=="undefined"){//检验没有定义这个属性的；
                            var check_type = $(this).attr("checkform-type");
                            if(!check_vary_type(check_type,val)){
                                        flag = 0;
                                        alert(msg);
                                        return false;
                            }
                       }
                   }else{//检验全部
                        var check_type = $(this).attr("checkform-type");
                        if(!check_vary_type(check_type,val)){
                                    flag = 0;
                                    alert(msg);
                                    return false;
                        }
                   }
                }else{//非必捡，但有值
                    if(val){
                        if(bool){
                            if(typeof($(this).attr("checkform-quick"))=="undefined"){
                            var check_type = $(this).attr("checkform-type");
                            if(!check_vary_type(check_type,val)){
                                        flag = 0;
                                        alert(msg);
                                        return false;
                            }
                        }else{
                            var check_type = $(this).attr("checkform-type");
                            if(!check_vary_type(check_type,val)){
                                        flag = 0;
                                        alert(msg);
                                        return false;
                            }
                        }
                       }
                    }
                }
            }
        });
        if (flag == 0) return false;
        ele.find('select').each(function () {
            if(bool){//这部分要注意：检验一部分：
                if ( $(this).attr("checkform-type") == 'required' ) {
                    var msg = $(this).attr("checkform-msg");
                    if (!$(this).find('option:selected').val() && typeof($(this).attr("checkform-quick"))=="undefined" ) {            
                        flag = 0;
                        alert(msg);
                        return false;
                    }
                }
            }else{//都检验
               if ( $(this).attr("checkform-type") == 'required') {
                    var msg = $(this).attr("checkform-msg");
                    if (!$(this).find('option:selected').val()) {           
                        flag = 0;
                        alert(msg);
                        return false;
                    }
                } 
            }
        });
        if (flag == 0) return false;
        return true;
    };

    function check_vary_type(check_type,val){
         switch (check_type) {
                            case 'tellphone':
                                if (!/^1[0-9]{10}$/.test(val)) {
                                    return false;
                                }
                                break;
                            case 'number':
                                if (!/^[1-9]\d*$/.test(val)) {
                                    return false;
                                }
                                break;
                            case 'date'://这里不是很合理
                                if (!/^(\d{1,4})(-|\/)(\d{1,2})\2(\d{1,2}) (\d{1,2}):(\d{1,2})$/.test(val)) {
                                    return false;
                                }
                                break;
                            case 'required':
                                if (val == '') {
                                    return false;
                                }
                                break;
        }
        return true;
    }

    //日期
    $(function(){
        $(".datepicker").datetimepicker({
            format: "yyyy-mm-dd hh:ii"
        });
    });

