# An example configuration file for MPD
# See the mpd.conf man page for a more detailed description of each parameter.


# Files and directories #######################################################

music_directory   "/Volumes/GitDevDisk2/peoples-radio-1.4/web/uploads/assets/tracks"

playlist_directory    "/Volumes/GitDevDisk2/peoples-radio-1.4/web/uploads/assets/playlists"

db_file     "/Volumes/GitDevDisk2/peoples-radio-1.4/web/uploads/assets/mpd/main/mpd.db"

log_file    "<?php print sfConfig::get('sf_config_dir') . DIRECTORY_SEPARATOR . 'mpd' . DIRECTORY_SEPARATOR . $channel->getSlug() . DIRECTORY_SEPARATOR . "mpd.log" ?>"

pid_file    "<?php print sfConfig::get('sf_config_dir') . DIRECTORY_SEPARATOR . 'mpd' . DIRECTORY_SEPARATOR . $channel->getSlug() . DIRECTORY_SEPARATOR . "mpd.pid" ?>"

state_file  "<?php print sfConfig::get('sf_config_dir') . DIRECTORY_SEPARATOR . 'mpd' . DIRECTORY_SEPARATOR . $channel->getSlug() . DIRECTORY_SEPARATOR . "mpdstate" ?>"


input {
        plugin "curl"
#       proxy "proxy.isp.com:8080"
#       proxy_user "user"
#       proxy_password "password"
}

bind_to_address "127.0.0.1"
port "<?php print $channel->getPort() ?>"

audio_output {
  type            "shout"
  name            "My MPD Stream"
  host            "www.icecast-streaming.com.local"
  port            "<?php print $channel->getIcecastPort() ?>"
  encoding        "mp3"
  encoder         "lame"
  mount           "/<?php print $channel->getSlug() ?>"
  quality         "5.0"
  format          "44100:16:1"
  user            "source"
  password        "pAssword"
}
