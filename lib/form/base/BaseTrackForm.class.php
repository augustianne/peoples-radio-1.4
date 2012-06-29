<?php

/**
 * Track form base class.
 *
 * @method Track getObject() Returns the current form's model object
 *
 * @package    peoplesradio
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTrackForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'filename' => new sfWidgetFormInputText(),
      'name'     => new sfWidgetFormInputText(),
      'artist'   => new sfWidgetFormInputText(),
      'time'     => new sfWidgetFormInputText(),
      'genre'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'filename' => new sfValidatorString(array('max_length' => 255)),
      'name'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'artist'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'time'     => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'genre'    => new sfValidatorString(array('max_length' => 45, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('track[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Track';
  }


}
