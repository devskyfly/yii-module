<?php
/* @var $this \yii\web\View */
/* @var $routePrefix string */
/* @var $info [] */
use devskyfly\php56\types\Arr;
use yii\helpers\Url;

?>


<div>
    <?php foreach ($info as $item):?>
    
    <div>
        <div>
        <?if(!Arr::IsArray($item['label'])):?>
             <h3><?=$item['label']?></h3>
        <?else:?>
        <h3>
            <a href="<?=Url::toRoute([$item['label']['route']])?>">
            	<?=$item['label']['name']?>
            </a>
        </h3>
        <?endif;?>
        </div>
        <div>
            <ul class="list-group">
            <?php foreach ($item['sub_list'] as $sub_item):?>

            	<li class="list-group-item">
                	<a href="<?=Url::toRoute([$routePrefix.'/'.$sub_item['route']])?>">
                		<?=$sub_item['name']?>
                	</a>
            	</li>
        	<?php endforeach;?>
            </ul>
        </div>
    </div>
    <?php endforeach;?>
</div>