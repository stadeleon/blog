<?php

class Application_Form_AddComents extends Zend_Form
{

    public function init()
    {
        $postId = new Zend_Form_Element_Hidden('postId');
        $postId->addFilter('Int');

        $name   = new Zend_Form_Element_Text('name');
        $name->setLabel('Your Name')
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->setRequired('true');

        $email   = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->setRequired('true')
              ->addValidator('NotEmpty')
              ->addValidator('EmailAdress');

        $comment = new Zend_Form_Element_Textarea('coment');
        $comment->setLabel('Coment')
                ->addFilter('StripTags')
                ->addValidator('NotEmpty');
        $date = new Zend_Form_Element_Hidden('date');
        $actDate = new Zend_Date();
        $date->setValue($actDate -> toString('YYYY-MM-dd HH:mm:ss'));

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Save');
/*        $submit = new Zend_Form_Element_Button('submit');
        $submit->setLabel('Save')
               ->setAttribs( array("onclick"=>"return gsubmit()"));*/

        $this->setName('addComent');
        $this->setAttrib('action', '/index/save-coment');
        $this->setMethod('get');
        $this->addElements(array($name, $email, $comment, $date, $submit));
    }


}

