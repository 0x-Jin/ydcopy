<!DOCTYPE html>
<html>
    <head>
        <meta name="_token" content="{{ csrf_token() }}"/>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>益丰电商管理系统 | 天猫查询</title>

        <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-dist/css/bootstrap.css') }}" >
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/bootstrap-dist/css/bootstrap-theme.css') }}" >
		
		<style>
			.txt_red {color:red;}
			.txt_green {color: green;}
		</style>
		
    </head>
    <body>
    <section id="page">
        <div class="container">
            <div class="row" style="margin-top:75px;">
                <div id="content" class="col-lg-12">
                        <div class="box-body">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>名称</th>
                                        <th>最新市值</th>
                                        <th>成本价</th>
                                        <th>仓位</th>
                                        <th>当前市值</th>
                                        <th>浮动比例</th>
                                        <th>浮动盈亏</th>
                                        <th>时间</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($trs as $tr)
                                        <?php echo $tr;?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
            </div>
            </div>
        </div>
    </section>
    </body>
    <script src="{{ asset('assets/js/jquery/jquery-2.0.3.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-dist/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript">
    	$(function(){
    		var total = 0;
    		$('tbody tr').each(function(i){
    			var num = $(this).find('td:eq(3)').text();
    			total += parseInt(num);
    		});

    		$('tbody tr').each(function(i){
    			var num = $(this).find('td:eq(3)').text();
    			var percent = num*100/total;
    			$(this).find('td:eq(3)').html(num+'<span style="float:right;color:red">('+percent.toFixed(2)+'%)</span>');
    		});
    	});
    </script>
</html>