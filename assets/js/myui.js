//这些方法要写成类：
 //刷新
 //修改部分
 function update(url) {
     $('#modal').html('');
     //请求数据，将数据放入modal中去
     $.ajax({
         type: "post",
         url: edit_url,
         data: {'_token':index_ajax_token,'id':url},
         dataType: "html",
         success: function (data) {
             $('#modal').html(data);
         }
     });
     $('#modal').modal('show');
 };
 //删除部分，url
 function dele(url) {
     //传一个地址过去,关键问题是如何将值传过去，这时候页面可以设计成静态的了
     $('#modal').html('');
     $('#modal').html($('#deleteshow').html());
     $('#hide_op_id').val(url);
     $('#modal').modal('show');
 };
 //确认删除
 function delete_sure(){
     //得到地址
     var id = $('#delete_btn').data('url');
     ajax_req($('#hide_op_id').val());
 };
 //将ajax请求的部分抽出来，因为后面有很多的交互性细节，更新，删除用到的方法，成功完成：这是所有的方法中的最后一步
 function ajax_req(id) {
     $.ajax({
         type: "GET",
         url: delete_url,
         dataType: "html",//直接显示
         data: {'_token':index_ajax_token,'id':id},
         success: function (data) {
             //这里要进行判断，例如提交更新失败，删除失败，尽量只有一个弹窗；如何控制成为难题
             $('#modal').html('');//先清空，这样就把原来的数据弄没有，不是一种好的方式
            //存在错误，处理
            $('#modal').html(data);//
            $('#modal').modal("show");//关闭按钮不起作用
      },
    });
 };


 function add_page(){
       $.ajax({
            type: "get",
            url: add_url,
            data: {'_token':index_ajax_token},
            dataType: "html",
            success: function (data) {
                 $('#modal').html('');
                 $('#modal').modal('show');//这里有错误
                 $('#modal').html(data);
            } 
        }); 
    };

