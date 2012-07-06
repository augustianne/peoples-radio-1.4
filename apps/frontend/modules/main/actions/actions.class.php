<?php

/**
 * main actions.
 *
 * @package    peoplesradio
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mainActions extends sfActions
{
  public function preExecute(){
	$request = $this->getRequest();
	$this->channelId = $request->getParameter('channel', 'main');
	$this->channel = ChannelPeer::retrieveBySlug($this->channelId);


	$this->forward404If(!$this->channel AND ($request->isMethod(sfRequest::POST) == false));
  }
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {                    
	$this->pager = new sfPropelPager('Track', 10);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->setCriteria(TrackPeer::getAvailableTracksCriteria($this->channel));
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();       

	$this->hasVotingRights = $this->hasVotingRights();
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeVote(sfWebRequest $request)
  {
	$this->forward404If(!$request->isXmlHttpRequest());
	$this->getResponse()->setContentType('application/json');
	$this->hasVotingRights = $this->hasVotingRights();

	if($this->hasVotingRights){
		$track = TrackPeer::retrieveByPK($request->getParameter('id', 0));
		if(!$track){
			$this->getResponse()->setStatusCode(401);
			return sfView::NONE;
		}
		$vote = TrackVotePeer::doVote($track, $this->channel);
		$vCount = $this->vTimes+1;
		setcookie('ppr_ucid', $vCount, $this->expire, '/');

		return $this->renderText(json_encode(array('success' => true, 'hasVotingRights' => $this->hasVotingRights)));
	}               
	
	return $this->renderText(json_encode(array('success' => false, 'hasVotingRights' => $this->hasVotingRights)));
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUpdateVoteQueue(sfWebRequest $request)
  {
	$this->forward404If(!$request->isXmlHttpRequest());
	$this->pager = new sfPropelPager('Track', 10);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->setCriteria(TrackPeer::getAvailableTracksCriteria($this->channel));
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();

	$this->resetVotingRights();
	return $this->renderPartial('main/list', array('pager' => $this->pager, 'hasVotingRights' => $this->hasVotingRights, 'channel' => $this->channel));
  }
                         
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUpdatePlaylist(sfWebRequest $request)
  {
	// $this->forward404If(!$request->isXmlHttpRequest());
	
	$this->updatePhysicalPlaylist(TrackPeer::doSelect(TrackPeer::getTopNTracksInQueueCriteria($this->channel)));

	CommunityPeer::prunePlaylist($this->channel);

	$this->pager = new sfPropelPager('Track', 10);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->setCriteria(TrackPeer::getTracksInPlaylistCriteria($this->channel));
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();      
	
	$ret = $this->renderPartial('main/playlist', array('pager' => $this->pager));

	TrackVotePeer::resetChannelVotes($this->channel);

	return $ret;
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUpdateCoverArt(sfWebRequest $request)
  {
	$this->forward404If(!$request->isXmlHttpRequest());

	return $this->renderPartial('main/coverArt', array('channel' => $this->channel));
  }

 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUpdateListeners(sfWebRequest $request)
  {
	$this->forward404If(!$request->isXmlHttpRequest());

	return $this->renderPartial('main/listeners', array('channel' => $this->channel));
  }

 /**
  * Set DefaultSearchOptions from request
  *
  * @param sfRequest $request A request object
  */
  protected function updatePhysicalPlaylist($tracks)
  {
	$lines = array();
	sfProjectConfiguration::getActive()->loadHelpers('MPD');
	foreach($tracks as $track){
		$lines[] = $track->getName();
		$community = CommunityPeer::retrieveByPk($track->getId(), $this->channel->getId());
		if(!$community){
			$community = new Community();
			$community->setTrackId($track->getId());
			$community->setChannelId($this->channel->getId());
		}                                    
		$community->setPlayCount($community->getPlayCount()+1);
		$community->save();

		mpd_add_track($track->getFilename(), $this->channel->getPort());
	}
	
  }

 /**
  * Set DefaultSearchOptions from request
  *
  * @param sfRequest $request A request object
  */
  public function executeReadMp3(sfWebRequest $request)
  {                                                                              
	$trackPath = sfConfig::get('sf_upload_dir').'/assets/tracks';
	$tracks = MP3_Reader::readMp3($trackPath);
	$coverDir = sfConfig::get('sf_upload_dir').'/assets/cover';
	foreach($tracks as $track){                    
		$cover = '';
		if (!is_null($track['cover'])) {                                          
			$cover = $track['name'].'.'.$track['extension'];
			file_put_contents($coverDir.'/'.$cover, $track['cover']);
		}

		$c = new Criteria;
		$c->add(TrackPeer::FILENAME, $track['filename']);
		$c->add(TrackPeer::NAME, $track['name']);
		$c->add(TrackPeer::ARTIST, $track['artist']);
		$c->add(TrackPeer::TIME, $track['length']);
		$c->add(TrackPeer::GENRE, $track['genre']);
		$c->add(TrackPeer::COVER, $cover);
		
		$trackId = TrackPeer::doInsert($c);
		
		$c = new Criteria();
		$c->add(ChannelTrackPeer::TRACK_ID, $trackId);
		$c->add(ChannelTrackPeer::CHANNEL_ID, 1);

		$channelId = ChannelTrackPeer::doInsert($c);
		
		MP3_Writer::writeDbId($trackPath.'/'.$track['filename'], $trackId);
	}   
	
	return sfView::NONE;
  }

  protected function hasVotingRights(){
	$this->expire = (time()+60);
	$id = isset($_COOKIE['ppr_uid']) ? $_COOKIE['ppr_uid'] : false;
	if(!$id){
		$arr = posix_getpwuid(posix_geteuid());                
		$uid = base64_encode($arr['uid'].'_'.$arr['name']);
		setcookie('ppr_uid', $uid, $this->expire, '/');
	}

	$this->vTimes = isset($_COOKIE['ppr_ucid']) ? $_COOKIE['ppr_ucid'] : 0;

	return ($this->vTimes < 3);
  }

  protected function resetVotingRights(){
	$arr = posix_getpwuid(posix_geteuid());                
	$uid = base64_encode($arr['uid'].'_'.$arr['name']);

	if(isset($_COOKIE['ppr_uid'])) setcookie('ppr_uid', '', 1, '/');
	if(isset($_COOKIE['ppr_ucid'])) setcookie('ppr_ucid', '', 1, '/');
	
	$this->hasVotingRights = true;
  }

  /**
   * Function: executeCreateRoom
   * 
   * description
   * 
   * Parameters:
   * 
   *   sfWebRequest $request - sfWebRequest
   * 
   * Returns:
   * 
   *   return description
   */
  public function executeCreateRoom(sfWebRequest $request)
  {
  	$channel = $request->getParameter('channel');
  	// $this->forward404If(is_null($channel) OR !$request->isXmlHttpRequest());
  	$obj = ChannelPeer::retrieveByName($channel);
  	$this->getResponse()->setContentType('application/json');
  	if(!$obj)
  	{
  		$slug = Slugify::getInstance()->format($channel);
  		$obj = new Channel;
  		$obj->setName($channel);
  		$obj->setSlug($slug);
  		$obj->save();

  		$baseMpdPort = 6600;
  		$baseIcecastPort = 8000;

  		$mpdPort = ($obj->getID() - 1) + $baseMpdPort;
  		$icecastPort = (($obj->getID() - 1) + 2) + $baseIcecastPort;
  		
  		$obj->setPort($mpdPort);
  		$obj->setIcecastPort($icecastPort);
  		$obj->save();

  		$this->_createMpdFiles($obj);

  		return $this->renderText(json_encode(array('success' => true, 'message' => 'Your room has been successfully created!')));
  	}

  	return $this->renderText(json_encode(array('success' => false, 'message' => 'A room with the same name already exists!')));
  	
  }


  protected function _createMpdFiles(Channel $channel)
  {
	$baseDir = sfConfig::get('sf_config_dir') . DIRECTORY_SEPARATOR . 'mpd';
	$channelConfigDir = $baseDir . DIRECTORY_SEPARATOR . $channel->getSlug();
	if(!file_exists($channelConfigDir))
	{
		mkdir($channelConfigDir);
	}
	
	sfContext::getInstance()->getConfiguration()->loadHelpers('Partial, MPD');
	$template = $this->getPartial('global/mpdConf', array('channel' => $channel));

	// create mpd.conf
	$mpdConf = $channelConfigDir . DIRECTORY_SEPARATOR . "mpd.conf";
	$fh = fopen($mpdConf, 'w') or die("can't open file");
	fwrite($fh, $template);
	fclose($fh);
	// create mpd.log
	$mpdLog = $channelConfigDir . DIRECTORY_SEPARATOR . "mpd.log";
	touch($mpdLog);
	// $fh = fopen($mpdLog, 'w') or die("can't open file");
	// fwrite($fh, "");
	// fclose($fh);
	// create mpd.pid
	$mpdPid = $channelConfigDir . DIRECTORY_SEPARATOR . "mpd.pid";
	touch($mpdPid);
	// $fh = fopen($mpdPid, 'w') or die("can't open file");
	// fwrite($fh, "");
	// fclose($fh);
	// create mpdstate
	$mpdState = $channelConfigDir . DIRECTORY_SEPARATOR . "mpdstate";
	touch($mpdState);
	// $fh = fopen($mpdState, 'w') or die("can't open file");
	// fwrite($fh, "");
	// fclose($fh);

	// run mpd
	mpd_run($mpdConf);
  }


}