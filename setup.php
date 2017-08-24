<?php
$entityBody = file_get_contents('php://input');

if(strlen($entityBody)){
    echo $entityBody;
    file_put_contents("themes/site_themes/default_theme/vbstock.json",$entityBody);
}
?>
<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="/themes/site_themes/default_theme/style.css" />
    <link rel="stylesheet" href="/themes/site_themes/default_theme/vbstyle.css" />
    <style>
        .save-button{
            font-size:16px;
            font-weight: bold;
            height:2.4em;
            color:#97bde3;
            background-color:white;
            line-height:2.4em;
            text-align:center;
            padding:0 1em;
            border:solid 3px #97bde3;
            border-radius: 3px;
            cursor: pointer;
            transition: all .3s ease-in;
            display: inline-block;
            margin-right: 6em;
        }
        .save-button:hover{
            height:2.4em;
            color:rgba(255,255,255,1);
            background-color:#97bde3;
        }
    </style>
</head>
<body>
    <table class="features-table"></table>
    <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <!-- <script src="themes/site_themes/default_theme/js/vbcalc.js"></script> -->
    <script>
        // var __all = {24,25,30,35,49,51,52,53,54,123,124,134,160,230,231,234};
        var __all = {
            "24":{title:"Эксклюзивные визитки - изготовление визиток VIP-класса в Москве | «Центральная типография»",url:"http://www.giprint.ru/eksklyuzivnye-vizitki"},
            "25":{title:"Настольный календарь, печать настольного календаря домик в Москве - Giprint",url:"http://www.giprint.ru/nastolnyj-perekidnoj-kalendar"},
            "29":{title:"Печать плакатов, заказать изготовление плакатов в Москве | «Центральная типография»",url:"http://www.giprint.ru/plakaty/"},
            "30":{title:"Печать листовок - дёшево, цены на цифровую и офсетную печать листовок в Москве | «Центральная типография»",url:"http://www.giprint.ru/listovki"},
            "31":{title:"Печать флаеров: от 0.5 руб./шт., заказать изготовление флаеров в Москве | «Центральная типография»",url:"http://www.giprint.ru/flaery/"},
            "33":{title:"Печать бланков",url:"http://www.giprint.ru/blanki/"},
            "34":{title:"ПЕчать открыток",url:"http://www.giprint.ru/pechat-otkrytok/"},
            "35":{title:"Печать пластиковых карт - изготовление в Москве, производство на заказ, дешево | «Центральная типография»",url:"http://www.giprint.ru/plastikovye-karty"},
            "37":{title:"Иготовление буклетов",url:"http://www.giprint.ru/izgotovlenie-bukletov/"},
            "40":{title:"Печать каталогов: от 15.60 руб./шт., дешево, заказать изготовление каталогов в Москве",url:"http://giprint.ru/proizvodstvo-izgotovlenie-katalogov/"},
            "41":{title:"Печать блокнотов - изготовление блокнотов в Москве | «Центральная типография»",url:"http://www.giprint.ru/bloknoty/"},
            "46":{title:"фотокартины",url:"http://giprint.ru/fotokartiny/"},
            "47":{title:"Фотопортреты",url:"http://giprint.ru/fotoportrety/"},
            "49":{title:"Печать наклеек, изготовление на заказ в Москве | «Центральная типография»",url:"http://www.giprint.ru/naklejki"},
            "51":{title:"Изготовление бейджей из пластика, с клипсой",url:"http://www.giprint.ru/BEYDJ"},
            "52":{title:"Изготовление удостоверений и пропусков: от 52 руб./шт., на заказ в Москве, печать на пластике, картоне, коже | «Центральная типография»",url:"http://www.giprint.ru/propuska"},
            "53":{title:"Печать бирок - изготовление бирок на заказ, производство в Москве | «Центральная типография»",url:"http://www.giprint.ru/birki"},
            "54":{title:"Изготовление и печать браслетов - купить оптом на заказ в Москве, с логотипом | «Центральная типография»",url:"http://www.giprint.ru/brasleti"},
            "77":{title:"Штендеры",url:"http://www.giprint.ru/shtendery/"},
            "83":{title:"Печать презентаций",url:"http://giprint.ru/razrabotka-prezentacij/"},
            "88":{title:"Настенные перекидные календари: от 87 руб./шт., изготовление и печать на заказ в Москве | «Центральная типография»",url:"http://www.giprint.ru/kalendar-perekidnoj/"},
            "108":{title:"Печать папок: от 55 руб./шт., изготовление на заказ, с логотипом, в Москве ",url:"http://giprint.ru/Papki-econom/"},
            "117":{title:"Бумажные пакеты - изготовление на заказ, купить оптом в Москве | «Центральная типография» (1 variations)",url:"http://giprint.ru/bumazhnye-pakety1/"},
            "123":{title:"Бумажные стаканы - заказать оптом в Москве, бумажные стаканчики с логотипом | «Центральная типография»",url:"http://www.giprint.ru/bumazhnye-stakanchiki"},
            "124":{title:"Самоклеящиеся этикетки, печать этикеток, изготовление на заказ | «Центральная типография»",url:"http://www.giprint.ru/samokleyaschayasya-etiketka"},
            "134":{title:"Печать сертификатов - заказать изготовление сертификатов в Москве, срочно | «Центральная типография»",url:"http://www.giprint.ru/sertifikaty"},
            "160":{title:"Изготовление голограмм - купить голограммы на заказ в Москве | «Центральная типография»",url:"http://www.giprint.ru/gologrammy-tipovye"},
            "166":{title:"Жиростойкая бумага",url:"http://www.giprint.ru/jirostoikaia-bumaga/"},
            "177":{title:"Кубарики",url:"http://www.giprint.ru/pechati-cubaricov-stickerov/"},
            "183":{title:"Фотоальбомы в твердом переплете",url:"http://giprint.ru/fotoalbomi/"},
            "184":{title:"Печать рекламы на чеках и кассовой ленте",url:"http://giprint.ru/pechati-na-chekovoi-lente/"},
            "221":{title:"Печать приглашений - изготовление пригласительных на свадьбу, юбилей, праздник в Москве | «Центральная типография»",url:"http://www.giprint.ru/priglashenia/"},
            "230":{title:"Карманный календарь, изготовление карманных календарей в Москве - Giprint",url:"http://www.giprint.ru/karmanie-kalendary-2015"},
            "231":{title:"Двухслойные бумажные стаканы - купить одноразовые стаканчики для кофе, горячих напитков | «Центральная типография»",url:"http://www.giprint.ru/dvuhsloinie-bumajnie-stakani"},
            "232":{title:"Воблеры рекламные",url:"http://giprint.ru/vobleri/"},
            "234":{title:"Ростовые фигуры - изготовление на заказ в Москве, из картона, ПВХ, пластика | «Центральная типография»",url:"http://www.giprint.ru/body-stend"},
            "290":{title:"Готовые коробки",url:"http://www.giprint.ru/gotovye-korobki/"},
            "317":{title:"Картонные  коробки",url:"http://www.giprint.ru/gotovye-korobki/"},
        };
        var countModifiers = function(prod){
            if(prod.options !== undefined) return (prod.options.tabs=="true")?3:2;
            for(var i in prod){
                for(var j in prod[i]) return (!isNaN(prod[i][j])||(typeof(prod[i].prices)!="undefined"))?2:3;
            }
            return 0;
        };
        var vbBuildTable=function(ei){
            if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
            if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
            $("li.textrelise,.textrelise:empty").hide();
            var prod = vbStock[ei],opts = (prod.options != undefined)?prod.options:{style:"product_table",tabs:((countModifiers(prod)>2)?"true":"false"),stock:false};
            opts.stock = (opts.stock==undefined)?false:opts.stock;
            opts.tabs=(opts.tabs=="true");
            var isTabs = opts.tabs;
            var tabs=[], rows=[],col=[],colMade = false;
            var ttitle = (typeof(__all[ei])!="undefined")?__all[ei].title:" no title";
            var turl = (typeof(__all[ei])!="undefined")?__all[ei].url:"#";
            var $body = $('<div class="ei-product" data-id="'+ei+'"></div>').appendTo("body");
            if(opts.style=="product_box")console.debug(ei,opts);

            $body.append('<br /><h2 class="ei" id="'+ei+'"><a href="'+turl+'" target="_blank">#'+ei+" "+ttitle+"</a></h2>")
            $body.append('&nbsp;Формат отображения: <select name="options.style"><option value="product_table" '+((opts.style=="product_table")?'selected="selected"':"")+'>Табличный вид</option><option value="product_box"'+((opts.style=="product_box")?'selected="selected"':"")+'>С картинками</option></select>');
            $body.append('<br>Акция:<input type="checkbox" onchange="setStockAll(this);"'+(opts.stock?' checked="checked"':'')+'/>');
            $body.append('<input type="hidden" name="options.stock" value="'+opts.stock.toString()+'" />');
            $body.append('<input type="hidden" name="options.tabs" value="'+opts.tabs.toString()+'" />');

            // if(typeof(prod.options)!="undefined" && prod.options.style=="product_box") return vbBuildBoxes(ei);
            var drawCell = function(prod,k,i,j,ei){
                var s = "",val = (k=="")?prod[i]:prod[k][i],
                    val = (val.prices != undefined)?val.prices[j]:val[j];
                    price = parseFloat((val.value != undefined)?val.value:val),
                    base = parseFloat((val.base != undefined)?val.base:val),
                    style = (val.style!=undefined)?val.style:["normal"];
                    quantity = j.replace(/"/g,'\"');
                s = '<td class="'+((price>0)?'grey1 ':'')+'" data-prod="'+ei+'" data-type="'+k+'" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" data-price="'+price+'" data-price-base="'+base+'">';//' onclick="'+((price>0)?"vbSetCalculator(this)":'')+'">';
                s+= '<input name="value" value="'+( (isNaN(price)||price<0)? "&nbsp;" : price )+'"/>';
                // console.debug(style,($.inArray("red",style)>=0)?'checked':'')
                s+= '<br>Акция:<input type="checkbox" onchange="setStock(this);"'+(($.inArray("red",style)>=0)?' checked="checked"':'')+'/>';
                s+= '<input type="hidden" name="style" value="'+style.join(",")+'"/>';
                s+= '</td>';
                return s;
            },
            drawBox=function(r,t,d){
                // console.debug("vbBuildBoxes:drawBox: ",r,t,d);
                var s = '<div class="productblock productblock-new">',fprice = null;
                s+= '<div class="image"><img src="'+d.image+'" alt="'+d.title+'" title="'+d.title+'" style="max-height:154px;width:auto;"></div>';
                // s+= '<div class="image"><img src="'+d.image+'" alt="'+d.title+'" title="'+d.title+'" width="100%"></div>';
                // s+= '<div class="title"><div class="razm">Размеры:</div> длина 9,5 см, ширина 3,5 см, высота 2,5 см</div>';
                s+= '<div class="title">'+t+'</div>';
                s+= '<div class="description">'+d.title+'</div>';
                s+= '<hr/>';
                s+= '<div class="pricek">';
                for(var i in d.prices){
                    var pr = d.prices[i];
                    if(pr==-1)continue;
                    if(fprice == null){
                        fprice = {price:pr,title:i};
                        s+=i+' - '+pr+'&nbsp;&#8381;<br/>';
                        break;
                    }

                }
                s+= '</div>';
                s+= '<a class="selected-cell" href="javascript:void(0);" onclick="vbSetCalculator(this);" data-type="'+r+'" data-row="'+t+'" data-quantity="'+fprice.title+'" data-price="'+fprice.price+'" data-price-base="'+fprice.base+'" style="text-decoration: none;"><div class="cart">&nbsp;</div></a>'
                s+='</div>';
                return s;
            };
            if(isTabs){
                var $tabs = $('<div id="p-tabs" class="features-table-new p-tabs"></div>').appendTo($body)//.insertAfter( ($("#p-tabs").length)?"#p-tabs":".features-table:first")
                    ,tabLinks = {},tables={},t=1;
                $tabs.html('').addClass("p-tab1");
                for(var k in prod){
                    if($.inArray(k,["options","option","style","value","stock"])!=-1)continue;
                    tabLinks[k]='<a class="p-tab'+t+'" href="javascript:void(0);" onclick="{$(this).parent(\'#p-tabs\').attr(\'class\',\'p-tab'+t+'\').attr(\'data-val\',\''+k+'\');void(0);}"><input name="" class="tabData" value="'+k+'" /></a>';
                    for(var i in prod[k]){
                        var row = [];
                        var title = (prod[k][i].title != undefined)?prod[k][i].title:i;
                        var prices = (prod[k][i].prices != undefined)?prod[k][i].prices:prod[k][i];
                        var image =  (prod[k][i].image != undefined)?prod[k][i].image:"";
                        row.push('<td class="grey" style="max-width:160px;"><img width="160px" src="'+image+'" /><input name="title" value="'+title+'" /><br /><input name="image" value="'+image+'"/></td>');
                        for(var j in prices){
                            (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                            row.push(drawCell(prod,k,i,j,ei));
                            // var price = parseFloat(prod[k][i][j]),
                            //     quantity = j.replace(/"/g,'\"');
                            //
                            // // row.push('<td class="'+((price>0)?'grey1 ':'')+'" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'"  data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>');
                            // row.push('<td class="'+((price>0)?'grey1 ':'')+'" data-prod="'+ei+'" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'"  data-price="'+price+'"><input name="" value="'+((isNaN(price)||price<0)?"&nbsp;":(price))+'"/></td>');
                        }
                        colMade=true;
                        rows.push('<tr>'+row.join('')+'</tr>')
                    }
                    tables[t] = '<div class="p-tab'+t+'"><table class="features-table features-table-new">\
                        <tr height="35"><td class="grey" rowspan="2">Формат, / тираж, шт.</td><td class="grey" colspan="'+col.length+'">Цена за единицу, руб.</td></tr>\
                        <tr height="35">'+col.join('')+'</tr>'
                        +rows.join('')+
                        '</table></div>';
                    col = [];colMade=false;

                    rows=[];
                    t++;
                }
                for(var i in tabLinks)$tabs.append(tabLinks[i]);
                for(var i in tables)$tabs.append(tables[i]);
            }
            else {
                var $table = $('<table class="features-table features-table-new"></table>').appendTo($body);
                for(var i in prod){
                    if($.inArray(i,["options","option","style","value","stock"])!=-1)continue;
                    var row = [];
                    var title = (prod[i].title != undefined)?prod[i].title:i;
                    var prices = (prod[i].prices != undefined)?prod[i].prices:prod[i];
                    var image =  (prod[i].image != undefined)?prod[i].image:"";
                    row.push('<td class="grey" style="max-width:160px;"><img width="160px" src="'+image+'" /><input name="title" value="'+title+'" /><br /><input name="image" value="'+image+'"/></td>');
                    for(var j in prices){

                        (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                        row.push(drawCell(prod,"",i,j,ei));
                        // var price = parseFloat(prod[i][j]);
                        // // row.push('<td class="grey1" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'"  data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>');
                        // // row.push('<td class="'+((price>0)?'grey1 ':'')+'selected-cell" data-type="" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+j.replace(/"/g,'\"')+'" onclick="vbSetCalculator(this)" data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>')
                        // row.push('<td class="'+((price>0)?'grey1 ':'')+'selected-cell" data-type="" data-prod="'+ei+'" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+j.replace(/"/g,'\"')+'" onclick="vbSetCalculator(this)" data-price="'+price+'"><input name="" value="'+((isNaN(price)||price<0)?"&nbsp;":(price))+'"/></td>')
                    }
                    colMade=true;
                    rows.push('<tr>'+row.join('')+'</tr>')
                }
                //console.debug(rows.join(' '));
                $table.html('');
                $table.append('<tr height="35"><td class="grey" rowspan="2">Формат, / тираж, шт.</td><td class="grey" colspan="'+col.length+'">Цена за единицу, руб.</td></tr>');
                $table.append('<tr height="35">'+col.join('')+'</tr>');
                $table.append(rows.join(''));
            }
            //remove old data
            // console.debug("will remove "+$(".features-table:not(.features-table-new),#p-tabs:not(.features-table-new)").length+" objects");
            $(".features-table:not(.features-table-new),#p-tabs:not(.features-table-new)").remove();
            // $("body").trigger("vb:tableLoaded");
            $body.append('<div style="width:100%;padding-right:2em;text-align:right;"><button class="save-button" onclick="save();">Сохранить</button></div>');
            $body.append('<HR /><br />');
        };
        //start trigger
        $.getJSON("/themes/site_themes/default_theme/vbstock.json",function(d){
            console.debug(d);
            window.vbStock = d;
            // for(var i in __all){
            //     var list = $("ul").appendTo("body");
            // }

            for(var ei in d ){
                vbBuildTable(ei);
                $(".tabData").on("keyup change",function(){
                    var a=$(this).parent("a"),aclass = a.attr("class");
                    console.debug("."+aclass+" .grey1");
                    a.parent().find("."+aclass+" .grey1").attr("data-type",$(this).val());
                });
            }
        });
        function save(){
            var dd = {};//{"24":{},"25":{},"29":{},"30":{},"31":{},"33":{},"34":{},"35":{},"37":{},"40":{},"41":{},"46":{},"47":{},"49":{},"51":{},"52":{},"53":{},"54":{},"77":{},"83":{},"88":{},"108":{},"117":{},"123":{},"124":{},"134":{},"160":{},"166":{},"177":{},"183":{},"184":{},"221":{},"230":{},"231":{},"232":{},"234":{},"290":{}};
            $(".ei").each(function(){
                dd[$(this).attr("id")]={
                    options:{
                        style:$(this).parent('.ei-product').find("[name='options.style']").val(),
                        tabs:$(this).parent('.ei-product').find("[name='options.tabs']").val(),
                        stock:($(this).parent('.ei-product').find("[name='options.stock']").val()=="true")
                    }
                };
            });
            $(".grey1").each(function(){
                var $t = $(this),tt = $t.attr("data-type"),rr = $t.attr("data-row"); qq = $t.attr("data-quantity"), prod = $t.attr("data-prod"),pp={},p=$t.attr("data-price-base"),stc=$t.find("input[name=value]").val(),
                    stl=$t.find("[name=style]").val().split(/,/),
                    img=$t.parent().find("[name=image]").val(),
                    tle=$t.parent().find("[name=title]").val();
                // p = (p == undefined)?p:stc;
                // stc = (stc == undefined)?p:stc;
                p=p.length?p:"-1";
                pp=dd[prod];
                var isbox = (pp.options.style=="product_box");
                if(tt.length){ //tabs view
                    pp[tt]=(typeof(pp[tt])=="undefined")?{}:pp[tt];
                    pp[tt][rr]=(typeof(pp[tt][rr])=="undefined")?{}:pp[tt][rr];
                    if(isbox){
                            pp[tt][rr]["title"] = tle;
                            pp[tt][rr]["image"] = img;
                            if(pp[tt][rr]["prices"] == undefined)pp[tt][rr]["prices"]={};
                            pp[tt][rr]["prices"][qq]={value:parseFloat(stc),style:stl,base:parseFloat(p)};
                        }
                    else pp[tt][rr][qq]={value:parseFloat(stc),style:stl,base:parseFloat(p)};
                }
                else {
                    pp[rr]=(typeof(pp[rr])=="undefined")?{}:pp[rr];
                    if(isbox){
                            pp[rr]["title"] = tle;
                            pp[rr]["image"] = img;
                            if(pp[rr]["prices"] == undefined)pp[rr]["prices"]={};
                            pp[rr]["prices"][qq]={value:parseFloat(stc),style:stl,base:parseFloat(p)}
                        }
                    else pp[rr][qq]={value:parseFloat(stc),style:stl,base:parseFloat(p)};
                }
                // console.debug(pp);
                // dd[prod] = $.extend(pp,dd[prod]);
            });
            console.debug("save",dd);//return;
            $.ajax({
                url:"/setup.php",
                type:"post",
                data:JSON.stringify(dd),
                dataType:"json",
                success:function(){
                    document.location.reload();
                }
            });
        }
        function setStockAll(t){
            var checked = $(t).is(':checked'),stockValue = 0;
            $(t).parent(".ei-product").find("[name='options.stock']").val(checked.toString());
            if(checked)stockValue = parseFloat(prompt("Введите размер скидки в процентах",5));
            $(t).parent(".ei-product").find(".features-table .grey1 input[type=checkbox]").each(function(){
                if(checked)$(this).attr("checked","checked");
                else $(this).removeAttr("checked");
                _setValueStock($(this),stockValue);
            });
        }
        function _setValueStock($t,stockValue){
            var styleInput = $t.next('[name=style]'), priceInput = $t.parent().find("[name=value]"),priceBase = $t.parent(),baseValue=0,priceValue=0;;
            if($t.is(':checked')){
                styleInput.val('red,bold');

                baseValue = parseFloat(priceInput.val());
                priceValue = baseValue*((100-stockValue)/100);
                priceBase.attr("data-price-base",baseValue);
                priceInput.val(priceValue);
            }
            else{
                styleInput.val( 'normal' );
                priceInput.val(priceBase.attr("data-price-base"));
            }
        }
        function setStock(t){
            var styleInput = $(t).next('[name=style]'), priceInput = $(t).parent().find("[name=value]"),priceBase = $(t).parent(),stockValue=0,baseValue=0,priceValue=0;;
            if($(t).is(':checked')){
                stockValue = parseFloat(prompt("Введите размер скидки в процентах",5));
            }
            _setValueStock($(t),stockValue);
        }
    </script>
</body>
</html>
