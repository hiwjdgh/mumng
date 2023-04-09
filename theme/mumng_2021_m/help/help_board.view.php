<?php
if (!defined('_PAVE_')) exit;
?>
<div class="help__board">
    <div class="help__board-title">
        <h3 class="help__board-title-text"><?=$help_bd["help_bo_name"]?></h3>
    </div>

    <?php if(pave_is_array($help_bd["help_bd_content_list"])){ ?>
    <div class="help__board-inner-box">
        <?php foreach ($help_bd["help_bd_content_list"] as $i => $bd_content) { ?>
        <div class="help__board-cate">
            <div class="help__board-cate-inner-box"> 
                <?php if($bd_content["title"]){ ?>
                    <h4 class="help__board-cate-text"><?=$bd_content["title"]?></h4>
                <?php } ?>
                <?php if($bd_content["description"]){ ?>
                    <p class="help__board-cate-description">
                        <?php 
                            if(preg_match_all('/[\{](.*?)[\}]/', $bd_content["description"], $matches)){
                                foreach ($matches[0] as $i => $word) { 
                                    $bd_content["description"] = preg_replace('/\{/', "<span class='help__board-cate-description-bold'>", $bd_content["description"]);
                                    $bd_content["description"] = preg_replace('/\,/', "</span> > <span class='help__board-cate-description-bold'>", $bd_content["description"]);
                                    $bd_content["description"] = preg_replace('/\}/', "</span>", $bd_content["description"]);
                                }
                            }
                        echo $bd_content["description"];
                        ?>
                    </p>
                <?php } ?>
                <?php if($bd_content["link"]["url"]){ ?>
                    <a href="<?=$bd_content["link"]["url"]?>" class="help__board-link"><?=$bd_content["link"]["title"]?></a>
                <?php } ?>
            </div>
            <?php foreach ((array)$bd_content["content"] as $j => $bd_content_detail){ ?>
            <?php if($bd_content_detail["type"] == "general"){ ?>
                <div class="help__board-general">
                    <?php if($bd_content_detail["content"]){ ?>
                        <p class="help__board-general-text"><?=nl2br($bd_content_detail["content"])?></p>
                    <?php } ?>
                    <?php if($bd_content_detail["link"]["url"]){ ?>
                        <a href="<?=$bd_content_detail["link"]["url"]?>" class="help__board-link"><?=$bd_content_detail["link"]["title"]?></a>
                    <?php } ?>
                </div>
            <?php }else if($bd_content_detail["type"] == "flow"){ ?>
            <div class="help__board-flow">
                <?php if($bd_content_detail["title"]){ ?>
                <h4 class="help__board-flow-text"><?=$bd_content_detail["title"]?></h4>
                <?php } ?>

                <?php if($bd_content_detail["content"]){ ?>
                <p class="help__board-flow-description"><?=$bd_content_detail["content"]?></p>
                <?php } ?>

                <?php foreach ((array)$bd_content_detail["step"] as $k => $bd_content_detail_step){ ?>
                <div class="help__board-flow2">
                    <?php if($bd_content_detail_step["title"]){ ?>
                    <h4 class="help__board-flow2-text"><?=$bd_content_detail_step["title"]?></h4>
                    <?php } ?>
                    <?php if($bd_content_detail_step["content"]){ ?>
                    <p class="help__board-flow2-description"><?=$bd_content_detail_step["content"]?></p>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <?php }else if($bd_content_detail["type"] == "caution"){ ?>
            <?php } ?>
            <?php } ?>
        </div>
        <?php } ?>
    </div>
    <?php } ?>
</div>