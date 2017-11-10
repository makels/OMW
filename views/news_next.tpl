{foreach from=$news key=i item=news_item}
    <div class="news__item" style="float: left;">
        {if $news_item.main_image == ""}
            <div class="clean-img"></div>
        {/if}
        <h6 class="date">{$news_item.date_time|date_format:"%d, %B %Y"}</h6>
        <h3 class="title">{$news_item.title}</h3>
        {if $news_item.main_image != ""}
            <div class="img {if $i==0}img1{/if}"  style="background-image: url(/upload/{$news_item.main_image})" ></div>
        {/if}
        <div class="text">
            <h5>{$news_item.body|truncate:200}
                <span class="blue"></span>
            </h5>
        </div>
        <div class="link">
            <a href="/news?id={$news_item.id}">read more
                <span class="arr"></span>
            </a>
        </div>
    </div>
{/foreach}