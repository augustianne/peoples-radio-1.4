<?php

/**
 * main actions.
 *
 * @package    peoplesradio
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainComponents extends sfComponents
{

  public function executePlaylist(sfWebRequest $request)
  {
	$this->channel = ChannelPeer::retrieveBySlug($this->channelId);

	$this->pager = new sfPropelPager('Track', 10);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->setCriteria(TrackPeer::getTracksInPlaylistCriteria($this->channel));
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();       
  }

}
