CREATE TABLE `funamble_index` (
  `index_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `teaser` text NOT NULL,
  `media` text NOT NULL,
  `content_type` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`index_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1243 DEFAULT CHARSET=latin1;

CREATE TABLE  `funamble_index_tags` (
  `tag` varchar(255) NOT NULL,
  `index_id` int(11) NOT NULL,
  PRIMARY KEY (`tag`,`index_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1