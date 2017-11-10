<!DOCTYPE html>
<html class="no-js" lang="ru">
    <head>
        {include file="head.tpl"}
    </head>
    <body class="about-page">

        {* HEADER *}
        {include file="header.tpl"}

        {* PRODUCT *}
        <main class="main">

            <section class="catalog-start">
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
                    <ul class="catalog-start__slider" style="height: 750px;">
                        <li>
                            <div class="catalog-start__title">
                                <h2>{$product.model}</h2>
                            </div>
                            <!--div class="catalog-start__text">
                                <h5>P2.5 LED Signage that exudes bright and clear LED expression</h5>
                            </div-->
                            {if count($product.images) > 0}
                                <div class="img"><img class="catalog-start__img" src="/upload/{$product.images[0]}"/></div>
                            {else}
                                <div class="img"><img class="catalog-start__img" src="/theme/images/content/catalog1.png"/></div>
                            {/if}
                        </li>
                    </ul>
                    {if count($product.images) > 0}
                    <div id="catalog-pager" class="catalog-pager">
                        {foreach from=$product.images key=i item=image}
                            <a data-slide-index="{$i}" href=""><img class="catalog-start__pager" src="/upload/{$image}" /></a>
                        {/foreach}
                    </div>
                    {/if}
                </div>
            </section>

            <section class="key">
                <div class="container">
                    <div class="key__title">
                        <h2>Key Highlights</h2>
                    </div>
                    <ul class="clearfix">
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                    </ul>
                    <div class="key__text">
                        <h3>Revitalize Indoor Customer</h3>
                        <h5>The IF Series’ user-friendly design allows for a faster, tidier and more cost-efficient activation. Samsung’s new LED Signage Box (S-Box) transmits UHD content across multiple screens from a single source without requiring an expensive splitter or multiple external boxes. Users also can leverage existing cable structures to easily configure signal redundancy.</h5>
                        <br>
                        <h5>Likewise, the integrated Samsung MagicInfo content platform makes content creation, scheduling and deployment across the IF Series displays easier.</h5>

                    </div>
                </div>
            </section>

            <section class="catalog-slider">
                <!--<div class="container">-->
                <ul class="catalog-slider__slider">
                    <li class="catalog-slider__img">
                        <span class="help" style="top: 290px; left: 380px;" data-title="Display">+</span>
                        <div class="help-hover">
                            <h3 class="blue">display</h3>
                            <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloremque, nisi.</h5>
                        </div>
                    </li>
                    <li class="catalog-slider__img"></li>
                    <li class="catalog-slider__img"></li>
                </ul>
                <!--</div>-->
                <div class="catalog-slider__text">
                    <h5>P2.5 LED Signage that exudes bright and clear LED expression</h5>
                </div>

            </section>

            <section class="key">
                <div class="container">
                    <div class="key__title">
                        <h2>FEATURES</h2>
                    </div>
                    <ul class="clearfix">
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                    </ul>
                    <div class="clearfix key__list">
                        <div class="key__item">
                            <h5 style="padding-bottom: 30px;">With more businesses turning to LED signage for an enhanced customer experience, Samsung’s fine pixel pitch IF Series displays offer an ideal combination of superior picture quality and intuitive usability.</h5>
                            <!--<br>-->
                            <h5 style="padding-top: 0;">The IF Series combines Samsung’s leading video processing technologies with High Dynamic Range (HDR) picture refinement to add clarity and sophistication to featured content – all within a compact, easy-to-maintain design.</h5>
                        </div>
                        <div class="key__item">
                            <h3>Revitalize Indoor Customer Engagement With Realistically Brilliant Picture Quality</h3>
                        </div>
                    </div>
                </div>
            </section>

            <section class="catalog-second-slider">
                <!--<div class="container">-->
                <div class="catalog-second-slider__position">
                    <ul class="catalog-second-slider__slider">
                        <li><img src="/theme/images/content/catalog-slider1.jpg"/></li>
                        <li><img src="/theme/images/content/catalog-slider1.jpg"/></li>
                        <li><img src="/theme/images/content/catalog-slider1.jpg"/></li>
                    </ul>
                    <!--</div>-->
                </div>

            </section>

            <section class="display">
                <div class="container">
                    <div class="display__item">
                        <div class="display__title">
                            <h2>5 years</h2>
                        </div>
                        <div class="display__text">
                            <h5>Наша компания работает в сфере производства профессионального светового оборудования.</h5>
                        </div>
                    </div>
                    <div class="display__item">
                        <div class="display__name">
                            <h5>Display</h5>
                        </div>
                        <ul>
                            {foreach from=$product.options item=option}
                            <li class="right">
                                <h5 class="display__numbers">{$option.value}</h5>
                                <h5 class="display__characteristic">{$option.name}</h5>
                            </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </section>

            <section class="key">
                <div class="container">
                    <div class="key__title">
                        <h2 style="color: black; text-transform: uppercase">Clean And Hassle-free Installation</h2>
                    </div>
                    <ul class="clearfix">
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="installation">
                <div class="container">
                    <div class="installation__img">
                        <div class="installation__list">
                            <div class="installation__title">
                                <h3>Revitalize Indoor Customer
                                    Engagement With Realistically</h3>
                            </div>
                            <div class="installation__text">
                                <h5>Added installation flexibility, the Samsung IF Series displays leverage a compact design that is significantly lighter than
                                    comparable alternatives. Full-front access to critical signage
                                    components ensures a neat installation free of catwalk space,
                                    while complementary rear access enables more convenient
                                    and quick-turn maintenance. </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="catalog-bg">
                <div class="catalog-bg__list">
                    <div class="catalog-bg__title">
                        <h3>Revitalize Indoor Customer</h3>
                    </div>
                    <div class="catalog-bg__text">
                        <h5>The IF Series’ user-friendly design allows for a faster, tidier and more cost-efficient activation.</h5>
                        <h5>Samsung’s new LED Signage Box (S-Box) transmits UHD content across multiple screens from a single source without requiring an expensive splitter or multiple external boxes. Users also can leverage existing cable structures to easily configure signal redundancy. </h5>
                        </h5>
                    </div>
                </div>
            </section>

            <section class="key key-dark">
                <div class="container">
                    <div class="key__title">
                        <h2 style="color: white; text-transform: uppercase">sharp design</h2>
                    </div>
                    <ul class="clearfix">
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5>LED Signage</h5>
                        </li>
                    </ul>
                </div>
            </section>

            <section class="design">
                <div class="container">
                    <div class="design__item">
                        <div class="design__img"></div>
                    </div>
                    <div class="design__item">
                        <div class="design__title">
                            <h2>Ultra-light Design</h2>
                        </div>
                        <div class="design__text">
                            <h5>Super light & thin, without magnetic plate, one module only 0.4kg; Magnesium alloy cabinet frame plus accessory about 2.7kg; Magnesium alloy power box cover and accessory about 2.8kg; </h5>
                        </div>
                        <div class="design__text">
                            <h4>Awesome Design</h4>
                        </div>
                        <ul>
                            <li>
                                <h2>1.5 mm</h2>
                                <h5>Pixel Pitch</h5>
                            </li>
                            <li>
                                <h2>1 red, 1 green, 1 blue</h2>
                                <h5>Pixel Configuration</h5>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>

            <section class="recomendation">
                <div class="container">
                    <div class="recomendation__item">
                        <div class="recomendation__title">
                            <h4>See the Recommendations</h4>
                        </div>
                        <div class="button">
                            <a class="btn" href="">see all</a>
                        </div>
                    </div>
                    <div class="recomendation__item">
                        <div class="recomendation__name">
                            <h5>Features</h5>
                        </div>
                        <ul>
                            {foreach from=$product.options1 item=option}
                                <li class="right">
                                    <h5 class="display__numbers">{$option.value}</h5>
                                    <h5 class="display__characteristic">{$option.name}</h5>
                                </li>
                            {/foreach}
                        </ul>
                    </div>
                </div>
            </section>

            <section class="other-models">
                <div class="container">
                    <div class="other-models__title">
                        <h2>browse Other Models</h2>
                    </div>
                    <div class="">
                        <div class="other-models__item" style="width: 25%;margin-bottom: 20px;">
                            <div class="other-models__item-title">
                                <h3>Cabinet Hero</h3>
                            </div>
                            <div class="other-models__item-text">
                                <h5>Super light & thin</h5>
                            </div>
                            <img style="width: 180px;height: 180px;" class="other-models__img" src="/theme/images/content/cabinet-hero.png"/>
                            <div class="button">
                                <a class="btn" href="">learn more</a>
                            </div>
                        </div>
                        <div class="other-models__item center"  style="width: 25%;margin-bottom: 20px;">
                            <div class="other-models__item-title">
                                <h3>Cabinet Hero</h3>
                            </div>
                            <div class="other-models__item-text">
                                <h5>Super light & thin</h5>
                            </div>
                            <img style="width: 180px;height: 180px;" class="other-models__img" src="/theme/images/content/cabinet-hero.png"/>
                            <div class="button">
                                <a class="btn" href="">learn more</a>
                            </div>
                        </div>
                    </div>
                    <div class="other-models__btn">
                        <div class="button">
                            <a class="btn" href="">browse more</a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="key key-footer">
                <div class="container">
                    <ul class="clearfix">
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5 class="service">Delivery</h5>
                            <h5 class="text">And Free returns.</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5 class="service">Realtime Customer Support</h5>
                            <h5 class="text">Buy online and pick up available items in a hour.</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5 class="service">Delivery Service</h5>
                            <h5 class="text">And Free returns.</h5>
                        </li>
                        <li class="">
                            <img class="key__pager" src="/theme/images/content/key1.png" />
                            <h5 class="service">Have a Project?</h5>
                            <h5 class="text">Leave your information and our manager will contact you</h5>
                            <div class="button">
                                <a class="btn contactsDisplay cd-nav-trigger" href="#cd-nav">contact us</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </section>

        </main>

        {* END OF PRODUCT *}

        {include file="footer.tpl"}

    </body>
</html>