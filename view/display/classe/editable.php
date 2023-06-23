<?php
// Obligatoire
    if(!isset($obj)) {throw new Exception("obj is not set");}else{if(!is_object($obj)) {throw new Exception("obj is not set");}}

// Conseillé
    if(!isset($user)) {$user = ControllerConnect::getCurrentUser();}else{if(get_class($user) != "User") {$user = ControllerConnect::getCurrentUser();}}
    if(!isset($bookmark_icon)) {$bookmark_icon =  Style::ICON_REGULAR;}else{if(!is_string($bookmark_icon)) {$bookmark_icon =  Style::ICON_REGULAR;}}
    if(!isset($style)){ $style = new Style; }else{ if(!get_class($style) == "Style"){ $style = new Style; } }
?>

<div class="mb-3">
    <div class="row g-0">
        <div class="col-auto selector-image-main"><?=$obj->getFile('img', new Style(['format' => Content::FORMAT_EDITABLE, "class" => "img-back-200"]))?></div>
        <div class="col m-2">
            <div class="row">
                <div class="col">
                    <p class="text-main-l-2 size-0-8">Arme priviligiée :</p>
                    <?=$obj->getWeapons_of_choice(Content::FORMAT_EDITABLE)?>
                    <?=$obj->getTrait(Content::FORMAT_EDITABLE)?>
                </div>
                <div class="col-auto">
                    <?=$obj->getUsable(Content::FORMAT_EDITABLE)?>
                </div>
            </div>
            <div class="nav-item-divider back-main-d-1"></div>
            <p class='size-0-7 mb-2'>Classe <?=$obj->getId(Content::FORMAT_BADGE);?> | Créé le <?=$obj->getTimestamp_add(Content::DATE_FR);?> | Modifié le <?=$obj->getTimestamp_updated(Content::DATE_FR);?></p>
            <div class="my-2"><?=$obj->getDescription_fast(Content::FORMAT_EDITABLE);?></div>
        </div>
    </div>
    <div>
        <div class="my-3"><?=$obj->getDescription(Content::FORMAT_EDITABLE);?></div>
        <div class="my-3"><?=$obj->getLife(Content::FORMAT_EDITABLE);?></div>
        <div class="my-3"><?=$obj->getSpecificity(Content::FORMAT_EDITABLE);?></div>
        <div class="my-3"><?=$obj->getSpell(Content::FORMAT_EDITABLE);?></div>
        <div class="my-3"><?=$obj->getCapability(Content::FORMAT_EDITABLE);?></div>
    </div>
</div>