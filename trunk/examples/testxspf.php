<?php
/*********************************************  
* testxspf.php is a script to demonstrate the use of
* the XSPF and XSPF_Track classes
* it will create a XSPF [http://www.xspf.org] playlist. 
* Copyright (C) 2005  Bjorn Wijers [me@bjornwijers.com]
*
* This program is free software; you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation; either version 2
* of the License, or (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program; if not, write to the Free Software
* Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*
*********************************************/
require_once('../class.XSPF.php');

/* create a XSPF object */
$xspf = new XSPF();


/*
* set some of the possible options for a playlist
*
*/
$xspf->setPlaylistTitle("Playlist");
$xspf->setPlaylistCreator("BjornW");
$xspf->setPlaylistDate();
$xspf->setPlaylistAnnotation("Comment");
$xspf->setPlaylistImage("http://pear.php.net/gifs/pearsmall.gif");
$xspf->setPlaylistIdentifier(md5("test"));
$xspf->setPlaylistLocation("http://www.somelocation.nl");
$xspf->setPlaylistInfo("http://www.more.info");
$xspf->setPlaylistLicense("http://www.license.info");

/* this is (for now) mandatory if you plan on using the extension element in the track element */
$extension = array('_content'=>array('firstname'=>'Bjorn','lastname'=>'Wijers', 'age'=>25));
$meta = array(0=>'a Creative Commons license');

/* 
* create a few tracks 
* to give an impression
*
* NOTE:
* this order is of importance:
* 	
*	$track['track_extension_application'] = "http://www.simuze.nl";
*	$track['track_meta_rel'] ="http://creativecommons.org/licenses/by/2.0/";
*	$track['track_meta'] = $meta;
*	$track['track_extension'] = $extension;
*
*/
for($i = 0; $i< 11; $i++) {
	$track = array();
	$locations = array();
	// create track array example
	if($i % 2) {
		array_push($locations, "test1.mp3");
	} else {
		array_push($locations, "test2.mp3");
	}
	array_push($locations, "locationB");
	array_push($locations, "locationC");
	$track['track_title'] = "Title of track$i";
	$track['track_creator'] = "Creator of track$i";
	$track['track_annotation'] = "Annotation of track$i";
	$track['track_info'] = "Info of track$i";
	$track['track_duration'] = "Duration of track$i";
	$track['track_image'] = "Image of track$i";
	$track['track_album'] = "Album of track$i";
	$track['track_nr'] = $i;
	$track['track_location'] = $locations;
	$track['track_extension_application'] = "http://www.simuze.nl";
	$track['track_meta_rel'] ="http://creativecommons.org/licenses/by/2.0/";
	$track['track_meta'] = $meta;
	$track['track_extension'] = $extension;
	$xspf->addTrack($track);
}


/* get the playlist xml */
if($playlist = $xspf->getPlaylistXML()) {
	/* output the playlist to the browser */
	echo header('Content-type: text/xml');
	echo $playlist;
} else {
 echo "no playlist created";
}
?>
