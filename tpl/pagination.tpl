{if $pages_count>1}
	<div class="pagination">
		<a href="{url page=$current_page-1}" class="{if $current_page <= 1}disabled{/if}">&laquo;</a>

		{foreach $range as $p}
			<a href="{url page=$p}" class="{if $p == $current_page}active{/if}">{$p}</a>
		{/foreach}

		<a href="{url page=$current_page+1}" class="{if $current_page >= $total_pages}disabled{/if}">&raquo;</a>
	</div>
{/if}

