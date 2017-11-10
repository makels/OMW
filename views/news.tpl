<!DOCTYPE html>
<html class="no-js" lang="ru">
    <head>
        {include file="head.tpl"}
    </head>
    <body class="about-page">

        {* HEADER *}
        {include file="header.tpl"}

        {* NEWS *}

        <main class="main">

            {if $news.up_slider != ""}
            <section class="news-page-start" style="background-image: url(/upload/{$news.up_slider});">
                <div class="container">
                    <div class="news-page-start__title">
                        <h2>{$news.title}</h2>
                    </div>
                </div>
            </section>
            {/if}
            <section class="news-page-text">
                <div class="container">
                    <div class="line-item">
                        <span class="line-item__1 line"></span>
                        <span class="line-item__2 line"></span>
                        <span class="line-item__3 line"></span>
                        <span class="line-item__4 line"></span>
                        <span class="line-item__5 line"></span>
                        <span class="line-item__6 line"></span>
                        <span class="line-item__7 line"></span>
                    </div>
                    {if $news.up_slider == ""}
                        <div class="news_title"><h2>{$news.title}</h2></div>
                    {/if}

                    {if $news.main_image != ""}
                        <div class="news-page-text__item">
                            <div class="img" style="background-image: url(/upload/{$news.main_image})"></div>
                        </div>
                    {/if}
                    <div class="news-page-text__item">
                        <h5>{$news.body}</h5>
                    </div>
                </div>
            </section>


            {* Bottom slider *}

            {if count($news.down_slider) > 0}
            <section class="news-page-slider">
                <div class="container">
                    <ul class="news-page-slider__slider" >
                        {foreach from=$down_slider item=slide}
                        <li>
                            <div class="img img1" style="background-image: url(/upload/{$slide});"></div>
                            <div class="box-readMore">
                                <div class="checked"></div>
                                <h6>Header goes here.</h6>
                                <p>Having been around since 2012 and having made over 20,000 units we have alreadybecome...
                                    <a href="">Read More</a>
                                </p>
                            </div>
                        </li>
                        {/foreach}
                    </ul>
                    <div class="clearfix">
                        <div class="social-networks">
                            <div class="social-networks__text">
                                <h3>Social Networks</h3>
                                <h6>Read us everywhere you would like to do it.</h6>
                            </div>
                            <ul>
                                <li  class=" ">
                                    <a class="social " target="_blank" href="https://www.facebook.com/arenaprofessional">
                                        <img class="icon" src="/theme/images/content/facebook.svg" alt="f">
                                    </a>
                                </li>
                                <li  class=" ">
                                    <a class="social" target="_blank" href="https://www.instagram.com/arenalux/">
                                        <img class="icon" src="/theme/images/content/instagram.svg" alt="i">
                                    </a>
                                </li>
                                <li  class=" ">
                                    <a class="social linkedin" target="_blank" href="https://www.linkedin.com/in/oleksandr-kravets-4655b391/">
                                        <img class="icon " src="/theme/images/content/linkedin.svg" alt="l">
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            {/if}

            {* Other news *}
            <section class="news-page-other" id="">
                <div class="container">
                    <div class="news-page-other__title">
                        <h2>other news</h2>
                    </div>
                    <div class="clearfix">
                        {foreach from=$others item=other}
                        <div class="news-page-other__item">
                            <h6 class="date">{$other.date_time|date_format:"%d, %B %Y"}</h6>
                            <h3 class="title">{$other.title}</h3>
                            {if $other.main_image != ""}<div class="img " style="background-image: url(/upload/{$other.main_image})"></div>{/if}
                            <div class="text">
                                <h5>{$other.body|truncate:300}
                                    <span class="blue"></span>
                                </h5>
                            </div>
                            <div class="link">
                                <a href="/news?id={$other.id}">read more
                                    <span class="arr"></span>
                                </a>
                            </div>
                        </div>
                        {/foreach}
                    </div>
                </div>
            </section>
        </main>

        {* END OF NEWS *}

        {include file="footer.tpl"}

    </body>
</html>