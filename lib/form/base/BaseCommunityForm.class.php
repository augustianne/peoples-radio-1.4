<?php

/**
 * Community form base class.
 *
 * @method Community getObject() Returns the current form's model object
 *
 * @package    peoplesradio
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCommunityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'track_id'   => new sfWidgetFormInputHidden(),
      'channel_id' => new sfWidgetFormInputHidden(),
      'play_count' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'track_id'   => new sfValidatorPropelChoice(array('model' => 'Track', 'column' => 'id', 'required' => false)),
      'channel_id' => new sfValidatorPropelChoice(array('model' => 'Channel', 'column' => 'id', 'required' => false)),
      'play_count' => new sfValidatorInteger(array('min' => -32768, 'max' => 32767, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('community[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Community';
  }


}
