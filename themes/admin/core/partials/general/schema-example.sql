-- Example build sql that the system generates out if no schema.sql is found in the partial folder
-- You can optionally create a schema.sql to expressly build your own partial schema
-- This example was for an "accordion"


CREATE TABLE IF NOT EXISTS `cms_core_partial_accordion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_partial_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `modified_at` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `color` varchar(20) not null,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `cms_core_partial_accordion_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `updated_at` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `content` text NOT NULL,
  `displayorder` int(11) not null,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
