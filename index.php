<?php
?>
<!--
We will create a family tree using just CSS(3)
The markup will be simple nested lists
-->
<style>
    /* Forked from https://codepen.io/Pestov/pen/BLpgm */
    /* This horizontal version (c) https://codepen.io/paulsmirnov/pen/dyyOLwa */
    /* See also right to left at https://codepen.io/paulsmirnov/pen/WNNGVbv */
    /* See also vertical + fixed wrapping at https://codepen.io/paulsmirnov/pen/LYYZeGM */

    /*Now the CSS*/
    * {margin: 0; padding: 0;}

    .tree {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: start;
        -ms-flex-pack: start;
        justify-content: flex-start;
    }

    .tree ul {
        padding-left: 20px; position: relative;
        
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
    }

    .tree li {
        /*text-align: center;*/
        list-style-type: none;
        position: relative;
        padding: 5px 0 5px 20px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }

    /*We will use ::before and ::after to draw the connectors*/

    .tree li::before, .tree li::after{
        content: '';
        position: absolute; left: 0; bottom: 50%;
        border-left: 1px solid #ccc;
        width: 20px; height: 50%;
    }
    .tree li::after{
        bottom: auto; top: 50%;
        border-top: 1px solid #ccc;
    }

    /*We need to remove left-right connectors from elements without 
    any siblings*/
    .tree li:only-child::after, .tree li:only-child::before {
        display: none;
    }

    /*Remove space from the top of single children*/
    .tree li:only-child{ padding-left: 0;}

    /*Remove left connector from first child and 
    right connector from last child*/
    .tree li:first-child::before, .tree li:last-child::after{
        border: 0 none;
    }
    /*Adding back the vertical connector to the last nodes*/
    .tree li:last-child::before{
        border-bottom: 1px solid #ccc;
        border-radius: 0 0 5px 0;
        -webkit-border-radius: 0 0 5px 0;
        -moz-border-radius: 0 0 5px 0;
    }
    .tree li:first-child::after{
        border-radius: 0 0 0 5px;
        -webkit-border-radius: 0 0 0 5px;
        -moz-border-radius: 0 0 0 5px;
    }

    /*Time to add downward connectors from parents*/
    .tree ul ul::before{
        content: '';
        position: absolute; left: 0; top: 50%;
        border-top: 1px solid #ccc;
        width: 20px; height: 0;
    }

    .tree li a{
        border-top: 6px solid #40A4F4;
        box-shadow: 0 4px 6px 0 hsla(0,0%,0%,0.2);
        padding: 0px;
        text-decoration: none;
        color: #666;
        font-family: arial, verdana, tahoma;
        font-size: 11px;
        display: inline-block;
        -ms-flex-item-align: center;
        -ms-grid-row-align: center;
        align-self: center;
        
        border-radius: 5px;
        -webkit-border-radius: 5px;
        -moz-border-radius: 5px;
        
        transition: all 0.5s;
        -webkit-transition: all 0.5s;
        -moz-transition: all 0.5s;
    }
    .ptx-tree__listinfo {
        padding: 15px;
        padding-bottom: 30px;
    }
    .ptx-listinfo__item {
        padding-bottom: 7px;
        font-size: 13px;
    }
    .ptx-tree__profile {
        padding: 15px;
        padding-top: 30px;
        position: relative;
        background: hsl(176,100%,24%);
        color: #fff;
    }
    .ptx-tree__avatar img{
        width: 100%;
        height: 100%;
    }
    .ptx-tree__avatar {
        overflow: hidden;
        left: 50%;
        top: -30px;
        position: absolute;
        margin: 0 auto;
        border-radius: 100%;
        height: 50px;
        width: 50px;
        transform: translateX(-50%);
    }
    .ptx-profile__item {
        font-size: 13px;
        padding-bottom: 7px;
    }

    /*Time for some hover effects*/
    /*We will apply the hover effect the the lineage of the element also*/
    .tree li a:hover, .tree li a:hover+ul li a {
        background: #c8e4f8; color: #000; border: 1px solid #94a0b4;
    }
    /*Connector styles on hover*/
    .tree li a:hover+ul li::after, 
    .tree li a:hover+ul li::before, 
    .tree li a:hover+ul::before, 
    .tree li a:hover+ul ul::before{
        border-color:  #94a0b4;
    }

    /*Thats all. I hope you enjoyed it.
    Thanks :)*/

</style>
<div id="ptxsearch-tree">
    <label for="gsearch">Search Tree:</label>
    <input type="search" id="ptxsearch-input" name="search">
</div>
<div class="tree" id="ptxtreelist">
<!--    <ul>-->
<!--        <li id="treeSub-1" data-id="1">-->
<!--            <a href="#">-->
<!--                <div class="ptx-tree__item">-->
<!--                    <div class="ptx-tree__listinfo">-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                           Tên người dùng: PHU THUY XAM-->
<!--                        </div>-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                            sđt: 0344719082-->
<!--                        </div>-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                            Chức danh: Giam đốc-->
<!--                        </div>-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                            Mã người dùng: MBL80-032-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="ptx-tree__profile">-->
<!--                        <div class="ptx-tree__avatar">-->
<!--                            <img src="https://cdn2.iconfinder.com/data/icons/avatar-profile/476/profile_avatar_contact_account_user_default-512.png">-->
<!--                        </div>-->
<!--                        <div class="ptx-profile__item ptx-profile__name">-->
<!--                            <b>Phuthuyxam</b>-->
<!--                        </div>-->
<!--                        <div class="ptx-profile__item">-->
<!--                            <strong>-->
<!--                                Point: sadasdasd-->
<!--                            </strong>-->
<!--                        </div>-->
<!--                        <div class="ptx-profile__item">-->
<!--                            <strong>-->
<!--                                Công việc: 0/0-->
<!--                            </strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--            <ul>-->
<!--                <li id="treeSub-5" class="" data-search="" data-id="5">-->
<!--                    <a href="#">ptx5</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-7" data-id="7">-->
<!--                            <a href="#">ptx7</a>-->
<!--                            <ul>-->
<!--                                <li id="treeSub-8" class="" data-search="" data-id="8">-->
<!--                                    <a href="#">ptx8</a>-->
<!--                                    <ul>-->
<!--                                        <li id="treeSub-19" data-id="19"><a href="#">ptx19</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li id="treeSub-6" class="" data-search="" data-id="6">-->
<!--                    <a href="#">ptx6</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-14" data-id="14"><a href="#">ptx14</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li id="treeSub-2" data-id="2">-->
<!--            <a href="#">ptx2</a>-->
<!--            <ul>-->
<!--                <li id="treeSub-12" class="" data-search="" data-id="12">-->
<!--                    <a href="#">ptx12</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-13" data-id="13"><a href="#">ptx13</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li id="treeSub-3" data-id="3">-->
<!--            <a href="#">ptx3</a>-->
<!--            <ul>-->
<!--                <li id="treeSub-9" class="" data-search="" data-id="9">-->
<!--                    <a href="#">ptx9</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-10" data-id="10">-->
<!--                            <a href="#">ptx10</a>-->
<!--                            <ul>-->
<!--                                <li id="treeSub-11" class="" data-search="" data-id="11">-->
<!--                                    <a href="#">ptx11</a>-->
<!--                                    <ul>-->
<!--                                        <li id="treeSub-15" data-id="15"><a href="#">ptx15</a></li>-->
<!--                                        <li id="treeSub-16" data-id="16">-->
<!--                                            <a href="#">ptx16</a>-->
<!--                                            <ul>-->
<!--                                                <li id="treeSub-17" class="" data-search="" data-id="17">-->
<!--                                                    <a href="#">ptx17</a>-->
<!--                                                    <ul>-->
<!--                                                        <li id="treeSub-18" data-id="18">-->
<!--                                                            <a href="#">ptx18</a>-->
<!--                                                            <ul>-->
<!--                                                                <li id="treeSub-20" class="" data-search="" data-id="20"><a href="#">ptx20</a></li>-->
<!--                                                            </ul>-->
<!--                                                        </li>-->
<!--                                                    </ul>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li id="treeSub-4" data-id="4"><a href="#">ptx4</a></li>-->
<!--    </ul> <ul>-->
<!--        <li id="treeSub-1" data-id="1">-->
<!--            <a href="#">-->
<!--                <div class="ptx-tree__item">-->
<!--                    <div class="ptx-tree__listinfo">-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                           Tên người dùng: PHU THUY XAM-->
<!--                        </div>-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                            sđt: 0344719082-->
<!--                        </div>-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                            Chức danh: Giam đốc-->
<!--                        </div>-->
<!--                        <div class="ptx-listinfo__item">-->
<!--                            Mã người dùng: MBL80-032-->
<!--                        </div>-->
<!--                    </div>-->
<!---->
<!--                    <div class="ptx-tree__profile">-->
<!--                        <div class="ptx-tree__avatar">-->
<!--                            <img src="https://cdn2.iconfinder.com/data/icons/avatar-profile/476/profile_avatar_contact_account_user_default-512.png">-->
<!--                        </div>-->
<!--                        <div class="ptx-profile__item ptx-profile__name">-->
<!--                            <b>Phuthuyxam</b>-->
<!--                        </div>-->
<!--                        <div class="ptx-profile__item">-->
<!--                            <strong>-->
<!--                                Point: sadasdasd-->
<!--                            </strong>-->
<!--                        </div>-->
<!--                        <div class="ptx-profile__item">-->
<!--                            <strong>-->
<!--                                Công việc: 0/0-->
<!--                            </strong>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </a>-->
<!--            <ul>-->
<!--                <li id="treeSub-5" class="" data-search="" data-id="5">-->
<!--                    <a href="#">ptx5</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-7" data-id="7">-->
<!--                            <a href="#">ptx7</a>-->
<!--                            <ul>-->
<!--                                <li id="treeSub-8" class="" data-search="" data-id="8">-->
<!--                                    <a href="#">ptx8</a>-->
<!--                                    <ul>-->
<!--                                        <li id="treeSub-19" data-id="19"><a href="#">ptx19</a></li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--                <li id="treeSub-6" class="" data-search="" data-id="6">-->
<!--                    <a href="#">ptx6</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-14" data-id="14"><a href="#">ptx14</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li id="treeSub-2" data-id="2">-->
<!--            <a href="#">ptx2</a>-->
<!--            <ul>-->
<!--                <li id="treeSub-12" class="" data-search="" data-id="12">-->
<!--                    <a href="#">ptx12</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-13" data-id="13"><a href="#">ptx13</a></li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li id="treeSub-3" data-id="3">-->
<!--            <a href="#">ptx3</a>-->
<!--            <ul>-->
<!--                <li id="treeSub-9" class="" data-search="" data-id="9">-->
<!--                    <a href="#">ptx9</a>-->
<!--                    <ul>-->
<!--                        <li id="treeSub-10" data-id="10">-->
<!--                            <a href="#">ptx10</a>-->
<!--                            <ul>-->
<!--                                <li id="treeSub-11" class="" data-search="" data-id="11">-->
<!--                                    <a href="#">ptx11</a>-->
<!--                                    <ul>-->
<!--                                        <li id="treeSub-15" data-id="15"><a href="#">ptx15</a></li>-->
<!--                                        <li id="treeSub-16" data-id="16">-->
<!--                                            <a href="#">ptx16</a>-->
<!--                                            <ul>-->
<!--                                                <li id="treeSub-17" class="" data-search="" data-id="17">-->
<!--                                                    <a href="#">ptx17</a>-->
<!--                                                    <ul>-->
<!--                                                        <li id="treeSub-18" data-id="18">-->
<!--                                                            <a href="#">ptx18</a>-->
<!--                                                            <ul>-->
<!--                                                                <li id="treeSub-20" class="" data-search="" data-id="20"><a href="#">ptx20</a></li>-->
<!--                                                            </ul>-->
<!--                                                        </li>-->
<!--                                                    </ul>-->
<!--                                                </li>-->
<!--                                            </ul>-->
<!--                                        </li>-->
<!--                                    </ul>-->
<!--                                </li>-->
<!--                            </ul>-->
<!--                        </li>-->
<!--                    </ul>-->
<!--                </li>-->
<!--            </ul>-->
<!--        </li>-->
<!--        <li id="treeSub-4" data-id="4"><a href="#">ptx4</a></li>-->
<!--    </ul>-->
</div>
<div id="ptxPluss" style="float: right; cursor: pointer;">
    <img width="30" height="30" src="plus.svg" alt="load more">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
 <script src="tree.js"></script>