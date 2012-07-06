<?php

/**
 * ChannelTrack form base class.
 *
 * @method ChannelTrack getObject() Returns the current form's model object
 *
 * @package    peoplesradio
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseChannelTrackForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'track_id'   => new sfWidgetFormInputHidden(),
      'channel_id' => new sfWidgetFormPropelChoice(array('model' => 'Channel', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'track_id'   => new sfValidatorPropelChoice(array('model' => 'Track', 'column' => 'id', 'required' => false)),
      'channel_id' => new sfValidatorPropelChoice(array('model' => 'Channel', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('channel_track[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ChannelTrack';
  }


}
