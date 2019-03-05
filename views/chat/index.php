<?php

/**
 * Description of index
 * Sep 20, 2016 3:37:59 PM
 *
 * @author Jonmer Carpio <jonmer09@gmail.com>
 */
use yii\helpers\Url;
use yii\widgets\ListView;
?>
<!--<script language="javascript" type="text/javascript" src="http://localhost/liveadmin/client.php?key=L2EDB1E4EV6B7DA9FM1D0B97A"></script>-->
<span id='liveadmin'></span>
<div>    
    <div class="col-sm-2">
        <div class="panel">            
            <div class="panel-body pre-scrollable left-scroll">                
                <div>
                    <h4>History Number</h4>
                    <input
                        name="to"
                        type="text"
                        placeholder="New number"
                        class="col-sm-12"
                        data-url="<?= Url::to(['chat']) ?>"
                        id="new_number" />
                </div>
                <?=
                ListView::widget([
                    'id' => 'sms_list_to',
                    'dataProvider' => $provider,
                    'summary' => "",
                    'itemView' => "_item"
                ])
                ?>        
            </div>
        </div>
    </div>
    <div class="col-sm-5 row right-scroll">
        <div id="sms_chat_container">
        </div>
    </div>
</div>
<div class="clearfix">
</div>
<style type="text/css">

    .left-scroll{
        min-height: 425px;
        border-radius: 4px 0px 0px 4px;
    }

    .right-scroll{
        border: 1px solid white;
        min-height: 427px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        margin: 0;
    }

    #sms_chat_form{
        bottom: 0px;
        position: absolute;
    }

    #sms_chat_list_scroll{
        position: relative;
    }
</style>
<?php
$js = "
    
    function l(){
    
        var selected_url;
        var reload = false;
        
        function loadUrl(url){
            selected_url = url;
            $('#sms_chat_container').load(selected_url);
        }
        $('#sms_list_to').on('click','.sms_item' , function(e){        
            var \$me = $(this);            
            loadUrl(\$me.attr('href'));                     
            return false;
        });
        
        $('#new_number').on('keydown', function(e){
          var \$me = $(this);
          if (e.keyCode == 13) {
            reload = true;
            loadUrl(\$me.data('url') + '?' + \$me.serialize());
          }
        });
              
    }
    
   l();
";
$this->registerJs($js);
