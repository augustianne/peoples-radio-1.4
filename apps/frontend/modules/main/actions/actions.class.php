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
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
	$this->pager = new sfPropelPager('Track', 10);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->setCriteria(TrackPeer::getAvailableTracksCriteria());
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();       
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
	$expire = (time()+60);
	$id = isset($_COOKIE['ppr_uid']) ? $_COOKIE['ppr_uid'] : false;
	if(!$id){
		$arr = posix_getpwuid(posix_geteuid());                
		$uid = base64_encode($arr['uid'].'_'.$arr['name']);
		setcookie('ppr_uid', $uid, $expire, '/');
	}

	$vTimes = isset($_COOKIE['ppr_ucid']) ? $_COOKIE['ppr_ucid'] : 0;
	if($vTimes < 3){
		$track = TrackPeer::retrieveByPK($request->getParameter('id', 0));
		if(!$track){
			$this->getResponse()->setStatusCode(401);
			return sfView::NONE;
		}
		$vote = TrackVotePeer::doVote($track);
		$vCount = $vTimes+1;
		setcookie('ppr_ucid', $vCount, $expire, '/');
		return $this->renderText(json_encode(array('success' => true)));
	}
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
	$this->pager->setCriteria(TrackPeer::getAvailableTracksCriteria());
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();
	
	return $this->renderPartial('main/list', array('pager' => $this->pager));
  }
                         
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeUpdatePlaylist(sfWebRequest $request)
  {
	$this->forward404If(!$request->isXmlHttpRequest());
	
	$this->pager = new sfPropelPager('Track', 10);
	$this->pager->setPage($request->getParameter('page', 1));
	$this->pager->setCriteria(TrackPeer::getTopNTracksInQueueCriteria());
	$this->pager->setPeerMethod('doSelect');
	$this->pager->init();      
	
	$this->updatePhysicalPlaylist($this->pager->getResults());
	return $this->renderPartial('main/playlist', array('pager' => $this->pager));
  }

 /**
  * Set DefaultSearchOptions from request
  *
  * @param sfRequest $request A request object
  */
  protected function updatePhysicalPlaylist($tracks)
  {
	$lines = array();
	foreach($tracks as $track){
		$lines[] = $track->getName();
		$community = CommunityPeer::retrieveByPk($track->getId());
		if(!$community){
			$community = new Community();
			$community->setTrackId($track->getId());
		}                                    
		$community->setPlayCount($community->getPlayCount()+1);
		$community->save();
	}
	
	$handler = fopen('/Volumes/GitDevDisk2/tracks.txt', 'w+');
	fwrite($handler, implode("\n", $lines));
	fclose($handler);	
  }

 /**
  * Set DefaultSearchOptions from request
  *
  * @param sfRequest $request A request object
  */
  public function executeReadMp3(sfWebRequest $request)
  {
	$tracks = MP3_Reader::readMp3(sfConfig::get('sf_upload_dir').'/assets/tracks');
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
		
		TrackPeer::doInsert($c);
	}   
	
	return sfView::NONE;
  }

}