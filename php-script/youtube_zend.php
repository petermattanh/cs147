<?php
/*
// feed for top rated videos
https://gdata.youtube.com/feeds/api/standardfeeds/top_rated?time=today

// top rated comedy videos in japan
https://gdata.youtube.com/feeds/api/standardfeeds/JP/top_rated_Comedy?v=2

// sending search query
http://gdata.youtube.com/feeds/api/videos?
     q=skateboarding+dog
     &start-index=21
     &max-results=10
     &v=2

// categories for feeds
category term='Autos'
category term='Animals'
category term='Sports'
category term='Shortmov'
category term='Travel'
category term='Games'
category term='Videoblog'
category term='People'
category term='Comedy'
category term='Entertainment'
category term='News'
category term='Howto'
category term='Education'
category term='Tech'
category term='Nonprofit'
category term='Movies'
category term='Movies_anime_animation'
category term='Movies_action_adventure'
category term='Movies_classics'
category term='Movies_comedy'
category term='Movies_documentary'
category term='Movies_drama'
category term='Movies_family'
category term='Movies_foreign'
category term='Movies_horror'
category term='Movies_sci_fi_fantasy'
category term='Movies_thriller'
category term='Movies_shorts'
category term='Shows'
category term='Trailers'

tutorials
http://googlesystem.blogspot.com/2008/01/youtube-feeds.html
http://www.ibm.com/developerworks/xml/library/x-youtubeapi/
*/
	$yt = new YoutubeScraper();
	
	$yt->updateDatabase('Autos', 'medium');
	$yt->updateDatabase('Autos', 'short');
	$yt->updateDatabase('Animals', 'medium');
	$yt->updateDatabase('Animals', 'short');
	$yt->updateDatabase('Sports', 'medium');
	$yt->updateDatabase('Sports', 'short');
	$yt->updateDatabase('Travel', 'medium');
	$yt->updateDatabase('Travel', 'short');
	$yt->updateDatabase('Games', 'medium');
	$yt->updateDatabase('Games', 'short');
	$yt->updateDatabase('People', 'medium');
	$yt->updateDatabase('People', 'short');
	$yt->updateDatabase('Comedy', 'short');
	$yt->updateDatabase('Comedy', 'medium');
	$yt->updateDatabase('Entertainment', 'short');
	$yt->updateDatabase('Entertainment', 'medium');
	$yt->updateDatabase('News', 'short');
	$yt->updateDatabase('News', 'medium');
	$yt->updateDatabase('Howto', 'short');
	$yt->updateDatabase('Howto', 'medium');
	$yt->updateDatabase('Movies', 'short');
	$yt->updateDatabase('Movies', 'medium');
	$yt->updateDatabase('Trailers', 'short');
	$yt->updateDatabase('Trailers', 'medium');


	class YoutubeScraper {
		protected $yt;
		protected $videos = array();

		function __construct() {
			require_once 'Zend/Loader.php'; // the Zend dir must be in your include_path
			Zend_Loader::loadClass('Zend_Gdata_YouTube');
			$this->yt = new Zend_Gdata_YouTube();
			$this->yt->setMajorProtocolVersion(2);
		}

		public function updateDatabase($category, $duration) {
			include('../../connect.php');
			
			$this->getVideos($category, $duration);

			$stmt = $mysqli->stmt_init();
			$stmt->prepare("INSERT INTO youtube(title, category, videoId, description, smallThumb, largeThumb, duration, views, rating) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?)");

			$stmt->bind_param('ssssssiis', $title, $category, $videoId, $description, $smallThumb, $largeThumb, $duration, $views, $rating);

			foreach($this->videos as $video) {
				$title       = $video['title'];
				$videoId     = $video['videoId'];
				$description = $video['description'];
				$smallThumb  = $video['smallThumb'];
				$largeThumb  = $video['largeThumb'];
				$duration    = $video['duration'];
				$views       = $video['views'];
				$rating      = $video['rating'];

				if(!$stmt->execute()) {
					echo 'Error inserting ' . $stmt->error;
				}
			}
			echo 'DONE!';
			$stmt->close();
			$mysqli->close();
		}

		private function getVideos($category, $duration) {
			$feedUrl = 'https://gdata.youtube.com/feeds/api/videos?category='.$category;
			$sxml = simplexml_load_file($feedUrl);
			include('../../connect.php');
			$stmt = $mysqli->stmt_init();
			$stmt->prepare("SELECT COUNT(id) FROM youtube where videoId=?");
			$stmt->bind_param('s', $videoId);
			$stmt->bind_result($count);
			foreach($sxml->entry as $entry) {
				// get nodes in media: namespace for media information
				$media = $entry->children('http://search.yahoo.com/mrss/');
		      	
		      	// get title
		      	$title = $entry->title;

				// get video player URL
				$attrs    = $media->group->player->attributes();
				$videoUrl = $attrs['url'];
				$start    = strpos($videoUrl, '=');
				$end      = strpos($videoUrl, '&', $start+1);
				$videoId  = substr($videoUrl, $start+1, $end-$start-1);

				$stmt->execute();
				$stmt->fetch();
				if($count > 0) {
					continue;
				}
				// description
				$description = $media->group->description;

				// thumbnails in serialized format
		      	$thumbnails = $media->group->thumbnail;

		      	$smallThumb = $thumbnails[0]->attributes();
		      	$largeThumb = $thumbnails[2]->attributes();

				// get <yt:duration> node for video length
				$yt     = $media->children('http://gdata.youtube.com/schemas/2007');
				$attrs  = $yt->duration->attributes();
				$length = $attrs['seconds']; 
		      	
		      	// get view count
				$yt    = $entry->children('http://gdata.youtube.com/schemas/2007');
				$views = $yt->statistics->attributes();
				$views = $views['viewCount'];

		      	// get rating
				$gd     = $entry->children('http://schemas.google.com/g/2005');
				$rating = $gd->rating->attributes();
				$rating = $rating['average'];

		      	$this->videos[] = array(
						'title'      => $title,
						'videoId'    => $videoId,
						'description' => $description,
						'smallThumb' => $smallThumb,
						'largeThumb' => $largeThumb,
						'duration'   => $length,
						'views'      => $views,
						'rating'     => $rating);
			}
			$stmt->close();
			$mysqli->close();
		}
	}