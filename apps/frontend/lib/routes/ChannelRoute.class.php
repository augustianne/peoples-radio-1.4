<?php
class ChannelRoute extends sfRequestRoute
{

    public function matchesUrl($url, $context = array()){
        $match = parent::matchesUrl($url, $context);
        if($match){
            $pathInfo = $context['path_info'];
            $pathChunks = explode('/',substr($pathInfo,1,strlen($pathInfo)));
            $channel = ChannelPeer::retrieveBySlug($pathChunks[0]);
            if(is_null($channel)){
                return false;
            }
        }
            
        return $match;
    }


}

