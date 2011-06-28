truncate funamble_index;
truncate funamble_tags;
truncate funamble_index_tags;

insert into funamble_index(index_id,name,content,teaser,media,content_type,timestamp)
select ID,post_title,post_content,'','','',post_date from wp_posts
where post_status = 'publish';

insert into funamble_tags(tag)
select slug from wp_terms;

insert into funamble_index_tags(tag,index_id)
select t.slug as tag, p.ID as index_id
from wp_term_relationships tr
join wp_term_taxonomy tt on tt.term_taxonomy_id = tr.term_taxonomy_id
join wp_terms t on t.term_id = tt.term_id
join wp_posts p on p.ID = tr.object_id;
