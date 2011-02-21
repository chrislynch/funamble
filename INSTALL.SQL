CREATE TABLE  `funamble_index` (
  `index_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `content` text NOT NULL,
  `teaser` text NOT NULL,
  `media` text NOT NULL,
  `content_type` varchar(255) NOT NULL,
  PRIMARY KEY (`index_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1