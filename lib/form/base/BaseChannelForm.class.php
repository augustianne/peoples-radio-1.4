<?php

/**
 * Channel form base class.
 *
 * @method Channel getObject() Returns the current form's model object
 *
 * @package    peoplesradio
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseChannelForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'name'            => new sfWidgetFormInputText(),
      'icecast_port'    => new sfWidgetFormInputText(),
      'port'            => new sfWidgetFormInputText(),
      'slug'            => new sfWidgetFormInputText(),
      'community_list'  => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Track')),
      'track_vote_list' => new sfWidgetFormPropelChoice(array('multiple' => true, 'model' => 'Track')),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'            => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'icecast_port'    => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'port'            => new sfValidatorString(array('max_length' => 4, 'required' => false)),
      'slug'            => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'community_list'  => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Track', 'required' => false)),
      'track_vote_list' => new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Track', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('channel[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Channel';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['community_list']))
    {
      $values = array();
      foreach ($this->object->getCommunitys() as $obj)
      {
        $values[] = $obj->getTrackId();
      }

      $this->setDefault('community_list', $values);
    }

    if (isset($this->widgetSchema['track_vote_list']))
    {
      $values = array();
      foreach ($this->object->getTrackVotes() as $obj)
      {
        $values[] = $obj->getTrackId();
      }

      $this->setDefault('track_vote_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveCommunityList($con);
    $this->saveTrackVoteList($con);
  }

  public function saveCommunityList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['community_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(CommunityPeer::CHANNEL_ID, $this->object->getPrimaryKey());
    CommunityPeer::doDelete($c, $con);

    $values = $this->getValue('community_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new Community();
        $obj->setChannelId($this->object->getPrimaryKey());
        $obj->setTrackId($value);
        $obj->save();
      }
    }
  }

  public function saveTrackVoteList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['track_vote_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(TrackVotePeer::CHANNEL_ID, $this->object->getPrimaryKey());
    TrackVotePeer::doDelete($c, $con);

    $values = $this->getValue('track_vote_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new TrackVote();
        $obj->setChannelId($this->object->getPrimaryKey());
        $obj->setTrackId($value);
        $obj->save();
      }
    }
  }

}
