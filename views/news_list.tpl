<!DOCTYPE html>
<html class="no-js" lang="ru">
<head>
    {include file="head.tpl"}
</head>
<body class="about-page">

{* HEADER *}
{include file="header.tpl"}

{* NEWS LIST *}

<main class="main">
    <div id="path"></div>
    <section class="news" id="news">
        <div class="container">

            <div class="news__title">
                <h2>news</h2>
            </div>
            <div class="bg-text js-shine" id="headline2">ARENA</div>
            <div class="clearfix" id="news-items">

                {foreach from=$news key=i item=news_item}
                    {if $i == 0}
                        <div class="news__item">
                            <div class="social-networks">
                                <div class="social-networks__text">
                                    <h3>Social Networks</h3>
                                    <h6>Read us everywhere you would like to do it.</h6>
                                </div>
                                <ul>
                                    <li  class=" ">
                                        <a class="social " target="_blank" href="https://www.facebook.com/arenaprofessional">
                                            <img class="icon" src="theme/images/content/facebook.svg" alt="f">
                                        </a>
                                    </li>
                                    <li  class=" ">
                                        <a class="social" target="_blank" href="https://www.instagram.com/arenalux/">
                                            <img class="icon" src="theme/images/content/instagram.svg" alt="i">
                                        </a>
                                    </li>
                                    <li  class=" ">
                                        <a class="social linkedin" target="_blank" href="https://www.linkedin.com/in/oleksandr-kravets-4655b391/">
                                            <img class="icon " src="theme/images/content/linkedin.svg" alt="l">
                                        </a>
                                    </li>
                                </ul>

                            </div>
                        </div>
                    {/if}
                    <div class="news__item">
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

            </div>
            <div class="button">
                <a class="btn" id="moreNews1">load more news</a>
            </div>
            <ul class="noMoreNews">
                <li><h4>No more news on the site</h4></li>
                <li><h4>Follow us on social networks</h4></li>
                <li>
                    <ul>
                        <li  class="li">
                            <a class="social " target="_blank" href="https://www.facebook.com/arenaprofessional">
                                <img class="icon" src="theme/images/content/facebook.svg" alt="f">
                            </a>
                        </li>
                        <li  class="li">
                            <a class="social" target="_blank" href="https://www.instagram.com/arenalux/">
                                <img class="icon" src="theme/images/content/instagram.svg" alt="i">
                            </a>
                        </li>
                        <li  class="li">
                            <a class="social linkedin" target="_blank" href="https://www.linkedin.com/in/oleksandr-kravets-4655b391/">
                                <img class="icon " src="theme/images/content/linkedin.svg" alt="l">
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>

</main>


{* END OF NEWS *}

{include file="footer.tpl"}

</body>
</html>