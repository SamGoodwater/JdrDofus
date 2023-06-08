<?php

use SebastianBergmann\Type\VoidType;

class Capability extends Content
{
    const FILES = [
        "logo" => [
            "type" => FileManager::FORMAT_IMG,
            "default" => "medias/modules/capabilities/default.svg",
            "dir" => "medias/modules/capabilities/",
            "preferential_format" => "jpg",
            "naming" => "[uniqid]"
        ]
    ];

    const TYPE_DAMAGE = 0;
    const TYPE_PROTECT = 1;
    const TYPE_BUFF = 2;
    const TYPE_DEBUFF = 3;
    const TYPE_INVOCATION = 4;   
    const TYPE_PLACEMENT = 5;   
    const TYPE_MANIPULATION = 6;   
    const TYPE_TRANSFORMATION = 7;   

    const TYPE = [
        "Dommage" => self::TYPE_DAMAGE,
        "Protection" => self::TYPE_PROTECT,
        "Boost" => self::TYPE_BUFF,
        "Retrait" => self::TYPE_DEBUFF,
        "Invocation" => self::TYPE_INVOCATION,
        "Placement" => self::TYPE_PLACEMENT,
        "Manipulation" => self::TYPE_MANIPULATION,
        "Transformation" => self::TYPE_TRANSFORMATION
    ];

    const CATEGORY_HISTORICAL = 0;

    const CATEGORY_DAMAGE = 1;
    const CATEGORY_TANK = 2;
    const CATEGORY_OFFENSIV_SUPPORT = 3;
    const CATEGORY_DEFENSIV_SUPPORT = 4;
    const CATEGORY_PLACEMENT = 5;
    const CATEGORY_ANIMAL_RELATION = 6;
    const CATEGORY_HEAL = 7;

    const CATEGORY = [
        "Aptitude liée à l'historique" => self::CATEGORY_HISTORICAL,
        "Aptitude de soigneur·gneuse" => self::CATEGORY_HEAL,
        "Aptitude des comabattant·e" => self::CATEGORY_DAMAGE,
        "Aptitude de tank" => self::CATEGORY_TANK,
        "Aptitude de support offensif" => self::CATEGORY_OFFENSIV_SUPPORT,
        "Aptitude de support défensif" => self::CATEGORY_DEFENSIV_SUPPORT,
        "Aptitude de placement" => self::CATEGORY_PLACEMENT,
        "Aptitude de relation avec les animaux" => self::CATEGORY_ANIMAL_RELATION
    ];

    //♥♥♥♥♥♥♥♥♥♥♥♥♥♥ ATTRIBUTS ♥♥♥♥♥♥♥♥♥♥♥♥♥♥
        private $_name='';
        private $_description='';
        private $_effect="";
        private $_level=1;
        private $_po=1;
        private $_po_editable=true;
        private $_time_before_use_again=null;
        private $_element = Spell::ELEMENT_NEUTRE;
        private $_category = Capability::CATEGORY_HISTORICAL;
        private $_is_magic = true;
        private $_powerful = 1;

    //♥♥♥♥♥♥♥♥♥♥♥♥♥♥ GETTERS ♥♥♥♥♥♥♥♥♥♥♥♥♥♥
        public function getName(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:  
                    return $view->dispatch(
                        template_name : "input/text",
                        data : [
                            "class_name" => "Capability",
                            "uniqid" => $this->getUniqid(),
                            "input_name" => "name",
                            "label" => "Nom",
                            "placeholder" => "Nom de l'aptitude",
                            "value" => $this->_name,
                            "style" => Style::INPUT_FLOATING
                        ], 
                        write: false);
                
                default:
                    return $this->_name;
            }
        }
        public function getLevel(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    return $view->dispatch(
                        template_name : "input/text",
                        data : [
                            "class_name" => "Capability",
                            "uniqid" => $this->getUniqid(),
                            "input_name" => "level",
                            "label" => "Niveau",
                            "placeholder" => "Niveau à partir duquel il est possible de maitriser l'aptitude",
                            "tooltip" => "Niveau à partir duquel il est possible de maitriser l'aptitude",
                            "value" => $this->_level,
                            "color" => Style::getColorFromLetter($this->_level, true) . "-d-3"
                        ], 
                        write: false);
                
                case Content::FORMAT_BADGE:
                    if(empty($this->_level) || $this->_level == 0){return '';}
                    return $view->dispatch(
                        template_name : "badge",
                        data : [
                            "content" => "Niveau {$this->_level}",
                            "color" => Style::getColorFromLetter($this->_level, true) . "-d-3",
                            "tooltip" => "Niveau à partir duquel il est possible de maitriser l'aptitude",
                            "style" => Style::STYLE_OUTLINE
                        ], 
                        write: false);
                
                case Content::FORMAT_ICON:
                    if(empty($this->_level) || $this->_level == 0){return '';}
                    return $view->dispatch(
                        template_name : "badge",
                        data : [
                            "content" => $this->_level,
                            "color" => "",
                            "tooltip" => "Niveau à partir duquel il est possible de maitriser l'aptitude",
                            "style" => Style::STYLE_NONE,
                            "class" => "text-".Style::getColorFromLetter($this->_level, true) . "-d-3"
                        ], 
                        write: false);
                
                default:
                    return $this->_level;
            }
        }
        public function getDescription(int $format = Content::FORMAT_BRUT){
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    $view = new View(View::TEMPLATE_SNIPPET);
                    return $view->dispatch(
                        template_name : "input/ckeditor",
                        data : [
                            "class_name" => "Capability",
                            "id" => "description".$this->getUniqid(),
                            "uniqid" => $this->getUniqid(),
                            "input_name" => "description",
                            "label" => "Description",
                            "value" => $this->_description
                        ], 
                        write: false);
                
                default:
                    return html_entity_decode($this->_description);
            }
        }
        public function getEffect(int $format = Content::FORMAT_BRUT){
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    $view = new View(View::TEMPLATE_SNIPPET);
                    return $view->dispatch(
                        template_name : "input/ckeditor",
                        data : [
                            "class_name" => "Capability",
                            "id" => "effect".$this->getUniqid(),
                            "uniqid" => $this->getUniqid(),
                            "input_name" => "effect",
                            "label" => "Effet de l'aptitude",
                            "value" => $this->_effect
                        ], 
                        write: false);
                
                default:
                    return html_entity_decode($this->_effect);
            }
        }
        public function getPo(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    return $view->dispatch(
                        template_name : "input/text",
                        data : [
                            "class_name" => "Capability",
                            "uniqid" => $this->getUniqid(),
                            "input_name" => "po",
                            "label" => "Portée",
                            "placeholder" => "Portée de l'aptitude",
                            "tooltip" => "Portée de l'aptitude (en case)",
                            "value" => $this->_po,
                            "color" => "po-d-2",
                            "style" => Style::INPUT_ICON,
                            "size" => Style::SIZE_SM,
                            "icon" => "po.png",
                            "style_icon" => Style::ICON_MEDIA,
                            "color_icon" => "po-d-4"
                        ], 
                        write: false);
                
                case Content::FORMAT_BADGE:
                    if(empty($this->_po)){return "";}
                    return $view->dispatch(
                        template_name : "badge",
                        data : [
                            "content" => "{$this->_po} PO",
                            "color" => "po-d-2",
                            "tooltip" => "Portée de l'aptitude (en case)",
                            "style" => Style::STYLE_BACK
                        ], 
                        write: false);

                case Content::FORMAT_ICON:
                    if(empty($this->_po)){return "";}
                    return $view->dispatch(
                        template_name : "icon",
                        data : [
                            "style" => Style::ICON_MEDIA,
                            "icon" => "po.png",
                            "color" => "po-d-2",
                            "tooltip" => "Portée de l'aptitude (en case)",
                            "content" => $this->_po,
                            "content_placement" => Style::POSITION_LEFT
                        ], 
                        write: false);

                default:
                    return $this->_po;
            }
        }
        public function getPo_editable(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    ob_start(); ?>
                        <div class="d-flex flex-row justify-content-start align-items-center"><?php
                            $view->dispatch(
                                template_name : "badge",
                                data : [
                                    "content" => "Portée Non modifiable",
                                    "color" => "grey-d-2",
                                    "style" => Style::STYLE_BACK,
                                    "tooltip" => "La portée de l'aptitude n'est pas modifiable",
                                    "tooltip_placement" => Style::DIRECTION_TOP,
                                    "class" => "me-3"
                                ], 
                                write: true);
                            
                            $view->dispatch(
                                template_name : "input/checkbox",
                                data : [
                                    "class_name" => "Capability",
                                    "uniqid" => $this->getUniqid(),
                                    "id" => "po_editable_" . $this->getUniqid(),
                                    "input_name" => "po_editable",
                                    "label" => "",
                                    "color" => "po_editable-d-2",
                                    "checked" => $this->returnBool($this->_po_editable),
                                    "style" => Style::CHECK_SWITCH
                                ], 
                                write: true);

                            $view->dispatch(
                                template_name : "badge",
                                data : [
                                    "content" => "Portée modifiable",
                                    "color" => "po_editable-d-2",
                                    "style" => Style::STYLE_BACK,
                                    "tooltip" => "La portée de l'aptitude est modifiable",
                                    "tooltip_placement" => Style::DIRECTION_TOP,
                                    "css" => "me-1"
                                ], 
                                write: true);?>
                        </div>
                    <?php return ob_get_clean();
                    
                case Content::FORMAT_BADGE:
                    if(empty($this->_po)){return "";}
                    if($this->_po_editable && !in_array($this->getPO(), Spell::EXPRESSION_CAC)){ // Aptitude à distance Avec portée modifiable
                        $content = "PO modifiable";
                        $tooltip = "La portée de l'aptitude est modifiable";
                        $color = "po_editable-d-2";
                    } elseif(in_array($this->getPO(), Spell::EXPRESSION_CAC)) { // Aptitude au CàC
                        $content = "CàC";
                        $tooltip = "L'aptitude est une aptitude de corps à corps - c'est à dire une aptitude avec un rayon d'action d'1m50 maximum.";
                        $color = "red-d-2";
                    }else{ // Aptitude à distane sans portée modifiable
                        $content = "PO non modifiable";
                        $tooltip = "La portée de l'aptitude n'est pas modifiable";
                        $color = "grey-d-2";
                    }
                    return $view->dispatch(
                        template_name : "badge",
                        data : [
                            "content" => $content,
                            "color" => $color,
                            "style" => Style::STYLE_OUTLINE,
                            "tooltip" => $tooltip
                        ], 
                        write: false);

                case Content::FORMAT_ICON:
                    if(empty($this->_po)){return "";}
                    if($this->_po_editable && !in_array($this->getPO(), Spell::EXPRESSION_CAC)){ // Aptitude à distance Avec portée modifiable
                        $icon = "po_editable.png";
                        $tooltip = "La portée de l'aptitude est modifiable";
                    } elseif(in_array($this->getPO(), Spell::EXPRESSION_CAC)) { // Aptitude au CàC
                        $icon = "cac.png";
                        $tooltip = "L'aptitude est une aptitude de corps à corps - c'est à dire une aptitude avec un rayon d'action d'1m50 maximum.";
                    }else{ // Aptitude à distane sans portée modifiable
                        $icon = "po_no_editable.png";
                        $tooltip = "La portée de l'aptitude n'est pas modifiable";
                    }
                    return $view->dispatch(
                        template_name : "icon",
                        data : [
                            "style" => Style::ICON_MEDIA,
                            "icon" => $icon,
                            "tooltip" => $tooltip
                        ], 
                        write: false); 

                case Content::FORMAT_PATH:
                    if($this->_po_editable && !in_array($this->getPO(), Spell::EXPRESSION_CAC)){ // Aptitude à distance Avec portée modifiable
                        return "medias/icons/po_editable.png";
                    } elseif(in_array($this->getPO(), Spell::EXPRESSION_CAC)) { // Aptitude au CàC
                        return "medias/icons/cac.png";
                    } else { 
                        return "medias/icons/po_no_editable.png";   
                    }
                    
                default:
                    return $this->_po_editable;
            }
        }
        public function getTime_before_use_again(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    return $view->dispatch(
                        template_name : "input/text",
                        data : [
                            "class_name" => "Capability",
                            "uniqid" => $this->getUniqid(),
                            "input_name" => "time_before_use_again",
                            "label" => "Durée avant réutilisation",
                            "placeholder" => "Durée avant réutilisation",
                            "tooltip" => "Durée avant réutilisation",
                            "value" => $this->_time_before_use_again,
                            "color" => "time_before_use_again-d-2",
                            "style" => Style::INPUT_ICON,
                            "size" => Style::SIZE_SM,
                            "icon" => "time_before_use_again.svg",
                            "style_icon" => Style::ICON_MEDIA,
                            "color_icon" => "time_before_use_again-d-4"
                        ], 
                        write: false);
                
                case Content::FORMAT_BADGE:
                    if(empty($this->_time_before_use_again)){return "";}
                    return $view->dispatch(
                        template_name : "badge",
                        data : [
                            "content" => $this->_time_before_use_again,
                            "color" => "time_before_use_again-d-2",
                            "tooltip" => "Durée avant réutilisation",
                            "style" => Style::STYLE_BACK
                        ], 
                        write: false);

                case Content::FORMAT_ICON:
                    if(empty($this->_time_before_use_again)){return "";}
                    return $view->dispatch(
                        template_name : "icon",
                        data : [
                            "style" => Style::ICON_MEDIA,
                            "icon" => "time_before_use_again.svg",
                            "color" => "time_before_use_again-d-2",
                            "size" => Style::SIZE_SM,
                            "tooltip" => "Durée avant réutilisation",
                            "content" => $this->_time_before_use_again,
                            "content_placement" => Style::POSITION_RIGHT
                        ], 
                        write: false);

                default:
                    return $this->_time_before_use_again;
            }
        }
        public function getElement(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    $items = [];
                    foreach(Spell::ELEMENT as $id_element => $element) { 
                        $items[] = [
                            "onclick" => "Capability.update('".$this->getUniqid()."', ".$id_element.", 'element', ".Controller::IS_VALUE.");",
                            "display" => "<span class='badge back-".$element['color']."-d-2'>" .ucfirst($element['name'])."</span>"
                        ];
                    }

                    return $view->dispatch(
                        template_name : "dropdown",
                        data : [
                            "tooltip" => "Element(s) de l'aptitude",
                            "label" => $this->getElement(Content::FORMAT_BADGE),
                            "size" => Style::SIZE_SM,
                            "items" => $items
                        ], 
                        write: false);
    
                case Content::FORMAT_BADGE:
                    if(isset(Spell::ELEMENT[$this->_element])){
                        return $view->dispatch(
                            template_name : "badge",
                            data : [
                                "content" => ucfirst(Spell::ELEMENT[$this->_element]['name']),
                                "color" => Spell::ELEMENT[$this->_element]['color'] ."-d-2",
                                "tooltip" => "Element(s) de l'aptitude",
                                "style" => Style::STYLE_BACK
                            ], 
                            write: false);
                            
                    } else  {
                        return "";
                    }

                case Content::FORMAT_COLOR_VERBALE:
                    if(isset(Spell::ELEMENT[$this->_element])){
                        return strtolower(Spell::ELEMENT[$this->_element]['color']);
                    } else {
                        return "";
                    }

                case Content::FORMAT_TEXT:
                    if(isset(Spell::ELEMENT[$this->_element])){
                        return strtolower(Spell::ELEMENT[$this->_element]['name']);
                    } else {
                        return "";
                    }

                default:
                    return $this->_element;
            }

        }
        public function getCategory(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    $items = [];
                    foreach(self::CATEGORY as $name => $category) { 
                        $items[] = [
                            "onclick" => "Capability.update('".$this->getUniqid()."', ".$category.", 'category', ".Controller::IS_VALUE.");",
                            "display" => "<span class='badge back-".Style::getColorFromLetter($category)."-d-2'>" .ucfirst($name)."</span>"
                        ];
                    }

                    return $view->dispatch(
                        template_name : "dropdown",
                        data : [
                            "tooltip" => "Catégorie de l'aptitude",
                            "label" => $this->getCategory(Content::FORMAT_BADGE),
                            "size" => Style::SIZE_SM,
                            "items" => $items
                        ], 
                        write: false);
    
                case Content::FORMAT_BADGE:
                    if(in_array($this->_category,  self::CATEGORY)){
                        return $view->dispatch(
                            template_name : "badge",
                            data : [
                                "content" => array_search($this->_category, self::CATEGORY),
                                "color" => Style::getColorFromLetter($this->_category)."-d-2",
                                "tooltip" => "Catégorie de l'aptitude",
                                "style" => Style::STYLE_BACK
                            ], 
                            write: false);
                            
                    } else  {
                        return "";
                    }

                case Content::FORMAT_TEXT:
                    if(in_array($this->_category, self::CATEGORY)){
                        return array_search($this->_category, self::CATEGORY);
                    } else {
                        return "";
                    }

                default:
                    return $this->_category;
            }
        }
        public function getIs_magic(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    ob_start(); ?>
                        <div class="d-flex flex-row justify-content-start align-items-center"><?php
                            $view->dispatch(
                                template_name : "badge",
                                data : [
                                    "content" => "Physique",
                                    "color" => "brown-d-2",
                                    "style" => Style::STYLE_BACK,
                                    "tooltip" => "L'aptitude est physique.",
                                    "tooltip_placement" => Style::DIRECTION_TOP,
                                    "class" => "me-1"
                                ], 
                                write: true);
                            
                            $view->dispatch(
                                template_name : "input/checkbox",
                                data : [
                                    "class_name" => "Capability",
                                    "uniqid" => $this->getUniqid(),
                                    "id" => "is_magic_" . $this->getUniqid(),
                                    "input_name" => "is_magic",
                                    "label" => "",
                                    "color" => "main",
                                    "checked" => $this->returnBool($this->_is_magic),
                                    "style" => Style::CHECK_SWITCH
                                ], 
                                write: true);

                            $view->dispatch(
                                template_name : "badge",
                                data : [
                                    "content" => "Wakfu",
                                    "color" => "purple-d-2",
                                    "style" => Style::STYLE_BACK,
                                    "tooltip" => "L'aptitude est magique.",
                                    "tooltip_placement" => Style::DIRECTION_TOP,
                                    "css" => "me-1"
                                ], 
                                write: true);?>
                        </div>
                    <?php return ob_get_clean();
                    
                case Content::FORMAT_BADGE:
                    if($this->_is_magic){
                        $color = "purple-d-2";
                        $content = "Wakfu";
                        $tooltip = "L'aptitude est magique.";
                    } else {
                        $color = "brown-d-2";
                        $content = "Physique";
                        $tooltip = "L'aptitude est physique.";
                    }
                    return $view->dispatch(
                        template_name : "badge",
                        data : [
                            "content" => $content,
                            "color" => $color,
                            "style" => Style::STYLE_BACK,
                            "tooltip" => $tooltip,
                            "tooltip_placement" => Style::DIRECTION_TOP
                        ], 
                        write: false);

                case Content::FORMAT_ICON:
                    if($this->_is_magic){
                        $color = "purple-d-2";
                        $icon = "magic";
                        $tooltip = "L'aptitude est magique.";
                    } else {
                        $color = "brown-d-2";
                        $icon = "fist-raised";
                        $tooltip = "L'aptitude est physique.";
                    }
                    return $view->dispatch(
                        template_name : "icon",
                        data : [
                            "style" => Style::ICON_SOLID,
                            "icon" => $icon,
                            "color" => $color,
                            "tooltip" => $tooltip
                        ], 
                        write: false); 
                    
                default:
                    return $this->_is_magic;
            }
        }
        public function getPowerful(int $format = Content::FORMAT_BRUT){
            $view = new View();
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    $items = [];
                    for ($i=1; $i <= 7 ; $i++) { 
                        $items[] = [
                            "onclick" => "Capability.update('".$this->getUniqid()."', ".$i.", 'powerful', ".Controller::IS_VALUE.");",
                            "display" => "<span class='badge back-deep-purple-d-3'>Puissance " .$i."</span>"
                        ];
                    }

                    return $view->dispatch(
                        template_name : "dropdown",
                        data : [
                            "tooltip" => "Puissance d'une aptitude sur 7 niveaux",
                            "label" => $this->getPowerful(Content::FORMAT_BADGE),
                            "size" => Style::SIZE_SM,
                            "items" => $items,
                            "comment" => "Puissance d'une aptitude sur 7 niveaux"
                        ], 
                        write: false);
    
                case Content::FORMAT_BADGE:
                    if(in_array($this->_powerful,  [1,2,3,4,5,6,7])){
                        return $view->dispatch(
                            template_name : "badge",
                            data : [
                                "content" => "Puissance ".$this->_powerful,
                                "color" => "deep-purple-d-3",
                                "tooltip" => "Puissance d'une aptitude sur 7 niveaux",
                                "style" => Style::STYLE_BACK
                            ], 
                            write: false);
                            
                    } else  {
                        return "";
                    }

                case Content::FORMAT_TEXT:
                    if(in_array($this->_powerful, [1,2,3,4,5,6,7])){
                        return "Puissance " . $this->_powerful;
                    } else {
                        return "";
                    }

                default:
                    return $this->_powerful;
            }
        }

        public function getType(int $format = Content::FORMAT_BRUT, bool $is_remove = false){
            $view = new View();
            $manager = new CapabilityManager();
            $types = $manager->getLinkType($this);
            
            switch ($format) {
                case Content::FORMAT_EDITABLE:
                    $items = [];
                    foreach(self::TYPE as $name => $type) { 
                        $items[] = [
                            "onclick" => "Capability.update('".$this->getUniqid()."',{action:'add', type:'".$type."'},'type', IS_VALUE);",
                            "display" => "<span class='btn btn-sm btn-border-".Style::getColorFromLetter($type)."-d-4'>" .ucfirst($name)."</span>"
                        ];
                    }

                    ob_start();
                        $view->dispatch(
                            template_name : "dropdown",
                            data : [
                                "tooltip" => "Types de l'aptitude",
                                "label" => $this->getType(Content::FORMAT_BADGE),
                                "size" => Style::SIZE_SM,
                                "items" => $items
                            ], 
                            write: true);

                        echo $this->getType(Content::FORMAT_BADGE, true);

                    return ob_get_clean();

                case Content::FORMAT_BADGE:
                    ob_start(); 
                        if(!empty($types)){?>
                            <div class="d-flex flex-row justify-content-around flex-wrap">
                                <?php foreach ($types as $type) {
                                    $view->dispatch(
                                        template_name : "badge",
                                        data : [
                                            "content" => array_search($type, Capability::TYPE),
                                            "color" => Style::getColorFromLetter($type) . "-d-4",
                                            "tooltip" => "Puissance d'une aptitude sur 7 niveaux",
                                            "style" => Style::STYLE_OUTLINE,
                                            "onclick" => "Capability.update('".$this->getUniqid()."',{action:'remove', type:'".$type."'},'type', IS_VALUE);$(this).remove();"
                                        ], 
                                        write: true);
                                } ?>
                            </div>
                        <?php }
                    return ob_get_clean();

                case Content::FORMAT_TEXT:
                    if(!empty($types)){
                        $array = [];
                        foreach ($types as $type) {
                            $array[$type] = array_search($type, Capability::TYPE);
                        }
                        return $array;
                    } else {
                        return [];
                    }
                    
                case Content::FORMAT_ARRAY:
                    return $types;
                
            }
        }

    //♥♥♥♥♥♥♥♥♥♥♥♥♥♥ SETTERS ♥♥♥♥♥♥♥♥♥♥♥♥♥♥
        public function setName(string | int | null $data){
            $this->_name = $data;
            return true;
        }
        public function setDescription(string | null $data){
            $this->_description = $data;
            return true;
        }
        public function setEffect(string | null $data){
            $this->_effect = $data;
            return true;
        }
        public function setLevel(int | null | string $data){
            if(is_numeric($data) || is_null($data) || $data == ""){
                $this->_level = $data;
                return true;
            } else {
                throw new Exception("La valeur doit être un nombre ou être null");
            }
        }
        public function setPo(string | int | null $data){
            $this->_po = $data;
            return true;
        }
        public function setPo_editable(bool | null $data){
            $this->_po_editable = $this->returnBool($data);
            return true;
        }
        public function setTime_before_use_again(string | int | null $data){
            $this->_time_before_use_again = $data;
            return true;
        }
        public function setElement(string | null $data){
            if(isset(Spell::ELEMENT[$this->_element])){
                $this->_element = $data;
                return true;
            } else {
                throw new Exception("Valeur incorrect");
            }
        }
        public function setCategory(int | null $data){
            if(in_array($data, self::CATEGORY)){
                $this->_category = $data;
                return true;
            } else {
                throw new Exception("Valeur incorrect");
            }
        }
        public function setIs_magic(bool | null $data){
            $this->_is_magic = $this->returnBool($data);
            return true;
        }
        public function setPowerful(int | null $data){
            if(in_array($data, [1,2,3,4,5,6,7])){
                $this->_powerful = $data;
                return true;
            } else {
                throw new Exception("Valeur incorrect");
            }
        }

        /* Data = array(
                        action => add ou remove,
                        type => numéro du type de l'aptitude                        
                    )
            Js : Item.update(Uniqid,{action:'add|remove', type:'type'},'type', IS_VALUE);
        */
        public function setType(array $data){ 
            if(is_array($data)){
                $manager = new CapabilityManager;
                if(!isset($data['type'])){throw new Exception("Le type n'est pas défini");}
                if(in_array($data['type'], Capability::TYPE)){
    
                    if(isset($data['action'])){
                        switch ($data['action']) {
                            case 'add':
                                if($manager->addLinkType($this, $data['type'])){
                                    return true;
                                }else{
                                    throw new Exception("Erreur lors de l'ajout du type");
                                }
                   
                            case "remove":
                                if($manager->removeLinkType($this, $data['type'])){
                                    return true;
                                }else{
                                    throw new Exception("Erreur lors de la suppression du type");
                                }
    
                            default:
                                throw new Exception("L'action n'est pas valide");
                        }
    
                    } else {
                        throw new Exception("Une action est requise.");
                    }
                }
            }
        }
}