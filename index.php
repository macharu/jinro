<!DOCTYPE HTML>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>人狼オンラインX勝率計算ツール</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel='stylesheet' id='google_font-css'  href='http://fonts.googleapis.com/css?family=Roboto%3A500%2C900%2C100%2C300%2C700%2C400&#038;ver=4.1' type='text/css' media='all' />
        <link href='//fonts.googleapis.com/css?family=Quicksand:400,700' rel='stylesheet' type='text/css'>
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        <script src="js/vendor/modernizr-2.6.2.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        <div class="main_area">
        	<h1>人狼オンラインX勝率計算ツール</h1>
        	<div class="submit_area">
        		<form method="post">
				    <input id="value" type="text" name="url" placeholder="人狼オンラインXのユーザーページのURLを入力してください">
				    <p class="sample_url">サンプルURL：http://www.werewolfonline.net/user/5834097552261120</p>
				    <input id="button" type="submit" value="勝率を計算">
				    
				</form>
                <div class="attention">
                    プレイ回数が多いと集計に時間がかかります</br>
                    通信環境にもよりますが、だいたい300戦で約30秒程です
                </div>
        	</div>	
        	
			
			<div id="result">
                <span id="loading">
                    <img src="img/loading.gif" height="55" width="54" alt="">
                </span>
			    	<table>
                        <thead>
                            <tr>
                                <th>役職</th>
                                <th>プレイ数</th>
                                <th>勝利数</th>
                                <th>勝率</th>
                            </tr>
                        </thead>
                        <tr id="villege">
                            <th>村人</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
                        <tr id="knight">
                            <th>騎士</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
                        <tr id="madman">
                            <th>狂人</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
                        <tr id="uranai">
                            <th>占い師</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
                        <tr id="reinou">
                            <th>霊能者</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
                        <tr id="jinrou">
                            <th>人狼</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
                        <tr id="all">
                            <th>総合</th>
                            <td class="game"><span>0</span>戦</td>
                            <td class="win"><span>0</span>勝</td>
                            <td class="percentage"><span>0</span>%</td>
                        </tr>
			    		
			    	</table>
			    	
			 </div>
             <div class="intro">
                 <i class="fa fa-twitter-square"></i><a href="https://twitter.com/sonyatan_jinro" target="_blank">sonyatan_jinro</a>
             </div>
             
        	
        </div>
        
        

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>



        <script>
    	
        $(function(){
            $("#button").click(function(event) {
                $("#button").attr("disabled", "disabled");
                $("#loading").fadeIn();
                console.time('timer1');
                
            	var url = $("#value").val();
            	$.ajax({
            		url: "get.php",
            		type: 'POST',
            		data: {url: url},
                    
            	})
            	.done(function() {
            		console.log("success");
                    
                    
            	})
            	.fail(function() {
            		console.log("error");
                    alert("データを取得できませんでした");
            	})
            	.always(function(data) {
            		console.log("complete");
                    console.log(data);
                    data = JSON.parse( data );
                    if(data != "error"){
                        
                        
                        var vildata = data.detail;
                        console.log(vildata);
                        var myObjKeys = Object.keys(vildata);
                        
                        var table = "";
                        var allwin = 0;
                        
                        for (key in vildata) {
                            $("#"+key+" .game span").text(vildata[key]['all']);
                            $("#"+key+" .win span").text(vildata[key]['win']);
                            $("#"+key+" .percentage span").text(keisan(vildata[key]['win']/vildata[key]['all']*100));
                            
                            allwin += vildata[key]['win'];
                        };
                        
                        $("#all .game span").text(data.all);
                        $("#all .win span").text(allwin);
                        $("#all .percentage span").text(keisan(allwin/data.all*100));
                        
                        $("#loading").fadeOut();
                        $('#button').removeAttr("disabled");
                        
                        console.timeEnd('timer1');
                        
                        // $(".percentage").each(function(index, el) {
                        //     countup($("span",this),$(this).data("meta"),1);
                        // });
                        
                        
                        
                        
                        // for(var i=0; i<myObjKeys.length; i++){
                            
                        //     table += "<tr><th>"+vildata[myObjKeys[i]].name+"</th><td>"+vildata[myObjKeys[i]].all+"戦</td><td>"+vildata[myObjKeys[i]].win+"勝</td><td>勝率"+keisan(vildata[myObjKeys[i]].win/vildata[myObjKeys[i]].all*100)+"%</td><tr>"
                        //     allwin += vildata[myObjKeys[i]].win;
                        // };
                        // table += "<tr><th>総合勝率</th><td>"+data.all+"戦</td><td>"+allwin+"勝</td><td>勝率"+keisan(allwin/data.all*100)+"%</td><tr>"
                        
                        
                    }else{
                        console.log("error");
                        alert("データを取得できませんでした");
                        $("#loading").fadeOut();
                        $('#button').removeAttr("disabled");
                    }
            		
                    
            		
            	});
            	return false;
            	
            });
            
        });
        
        function keisan(num){

			  
			  var num = parseFloat(num);
			  
			  
			  var num = num * 100;

			  
			  num = Math.round(num) / 100;
			  
			  return num;
			  
		}
        function countup(tgt,max,speed){
            var num = 0;
            var ma = max*100
            setInterval(function(){
                if(num <= ma){
                    tgt.html(num/100);
                    num ++;
                }
            },speed);
        }
    </script>
    </body>
</html>
