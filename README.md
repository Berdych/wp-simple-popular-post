# wp-simple-popular-post
Подсчет и отображение постов по количеству просмотров.

1. Для подсчета просмотров в цикле одиночного поста single.php устанавливаем функцию-счетчик:

```<?php setPostViews(get_the_ID()); ?>```

2. Для отображения количества просмотров поста, пишем в цикл шаблона single.php следующую строку:

```Просмотров: <?php echo getPostViews(get_the_ID()); ?>```

3. Для сортировки и отображения постов по количеству просмотров в цикле ленты постов делаем запрос с определенными параметрами:
```
<?php
query_posts('cat=1&showposts=5&meta_key=post_views_count&orderby=meta_value_num');
	while (have_posts()): the_post(); ?>
		<a href="<?php the_permalink(); ?>" class="link-b"><?php the_title(); ?></a>
		<p><?php the_excerpt(); ?>
	<?php endwhile; 
wp_reset_query(); 
?>
```
где 
- cat=1 - идентификатор рубрики; 
- showposts=5 - количество выводимых постов; 
- meta_key=post_views_count - мета-поле счетчика;
- orderby=meta_value_num - сортировка по показаниям счетчика.
