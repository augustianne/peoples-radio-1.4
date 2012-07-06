<?php

/**
 * TrackVote form base class.
 *
 * @method TrackVote getObject() Returns the current form's model object
 *
 * @package    peoplesradio
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTrackVoteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'track_id'   => new sfWidgetFormInputHidden(),
      'channel_id' => new sfWidgetFormInputHidden(),
      'all_votes'  => new sfWidgetFormInputText(),
      'temp_votes' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'track_id'   => new sfValidatorPropelChoice(array('model' => 'Track', 'column' => 'id', 'required' => false)),
      'channel_id' => new sfValidatorPropelChoice(array('model' => 'Channel', 'column' => 'id', 'required' => false)),
      'all_votes'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'temp_votes' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('track_vote[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TrackVote';
  }


}
