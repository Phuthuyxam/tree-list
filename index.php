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
        padding-left: 35px; position: relative;
        
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
    .searchResult>a{
        border: solid thin #fc9923;
        border-top: 6px solid #fc9923 !important;
        box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034), 0 6.7px 5.3px rgba(0, 0, 0, 0.048), 0 12.5px 10px rgba(0, 0, 0, 0.06), 0 22.3px 17.9px rgba(0, 0, 0, 0.072), 0 41.8px 33.4px rgba(0, 0, 0, 0.086), 0 100px 80px rgba(0, 0, 0, 0.12);
    }

    .tree li {
        /*text-align: center;*/
        list-style-type: none;
        position: relative;
        padding: 5px 0 5px 35px;
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
        width: 35px; height: 50%;
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
        width: 35px; height: 0;
    }

    .tree li a{
        border-top: 6px solid hsl(176,100%,24%);
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
        background: hsl(0, 0% , 98%);
        padding: 10px;
        padding-bottom: 30px;
    }
    .ptx-listinfo__item {
        padding-bottom: 7px;
        font-size: 13px;
    }
    .ptx-tree__profile {
        text-align: center;
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
        border: solid thin #40A4F4;
        border-top: 6px solid #40A4F4 !important;
        box-shadow: 0 2.8px 2.2px rgba(0, 0, 0, 0.034), 0 6.7px 5.3px rgba(0, 0, 0, 0.048), 0 12.5px 10px rgba(0, 0, 0, 0.06), 0 22.3px 17.9px rgba(0, 0, 0, 0.072), 0 41.8px 33.4px rgba(0, 0, 0, 0.086), 0 100px 80px rgba(0, 0, 0, 0.12);
    }
    /*Connector styles on hover*/
    .tree li a:hover+ul li::after, 
    .tree li a:hover+ul li::before, 
    .tree li a:hover+ul::before, 
    .tree li a:hover+ul ul::before{
        border-color:  #94a0b4;
    }

    .ptx-result__search {
        position: absolute;
        left: 83px;
        z-index: 99;
        box-shadow: 0 4px 6px 0 hsla(0,0%,0%,0.2);
        background: hsl(0,0%,97%);
    }
    .ptx-result__item {
        padding: 10px 10px;
    }
    div#ptxsearch-tree {
        position: relative;
    }

</style>
<div id="ptxsearch-tree">
    <label for="gsearch">Search Tree:</label>
    <input type="search" id="ptxsearch-input" name="search">

    <div class="ptx-result__search">
        <div class="ptx-result__item">
            <div class="result-item__image" style="width: 50px; height: 50px;">
                <img width="100%" src="https://atpmedia.vn/wp-content/uploads/2019/12/C%C3%A1ch-s%E1%BB%AD-d%E1%BB%A5ng-th%E1%BA%BB-IMG.jpg" alt="">
            </div>
            <div class="result-item__info">
                hello1 <br> phamphuc12@gmail.com <br> hudyahy
            </div>

        </div>
        <div class="ptx-result__item">
            hello2 | phamphuc12@gmail.com | hudyahy
        </div>
        <div class="ptx-result__item">
            hello3 | phamphuc12@gmail.com | hudyahy
        </div>
        <div class="ptx-result__item">
            hello4 | phamphuc12@gmail.com | hudyahy
        </div>
        <div class="ptx-result__item">
            hello5 | phamphuc12@gmail.com | hudyahy
        </div>
        <div class="ptx-result__item">
            no result
        </div>
    </div>

</div>
<div class="tree" id="ptxtreelist">
</div>
<div id="ptxPluss" style="float: right; cursor: pointer;">
    <img width="30" height="30" src="plus.svg" alt="load more">
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.js"></script>
 <script src="tree.js"></script>