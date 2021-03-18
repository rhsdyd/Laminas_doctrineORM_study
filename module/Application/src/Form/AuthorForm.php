<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\InputFilter\InputFilter;


class AuthorForm extends Form
{
  // Constructor.
  public function __construct()
  {

    parent::__construct('author-form');


    $this->setAttribute('method', 'post');

    $this->addElements();
    $this->addInputFilter();
  }

  // This method adds elements to form (input fields and submit button).
  protected function addElements()
  {

    $this->add([
           'type'  => 'text',
            'name' => 'name',
            'attributes' => [
                'id' => 'name'
            ],
            'options' => [
                'label' => 'name',
            ],
        ]);

    $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [
                'value' => 'Save',
                'id' => 'submitbutton',
            ],
        ]);
  }

  // This method creates input filter (used for form filtering/validation).
  private function addInputFilter()
  {
    $inputFilter = new InputFilter();
    $this->setInputFilter($inputFilter);

    $inputFilter->add([
            'name'     => 'name',
            'required' => true,
            'filters'  => [
                ['name' => 'StringTrim'],
                ['name' => 'StripTags'],
                ['name' => 'StripNewlines'],
            ],
            'validators' => [
                [
                    'name'    => 'StringLength',
                    'options' => [
                        'min' => 1,
                        'max' => 100
                    ],
                ],
            ],
        ]);

  }
}
