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
            "290":{title:"Готовые коробки",url:"http://www.giprint.ru/gotovye-korobki/"}
        };
        var countModifiers = function(prod){
            for(var i in prod){
                for(var j in prod[i]) return (!isNaN(prod[i][j]))?2:3;
            }
            return 0;
        };
        var vbBuildTable=function(ei){
            if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
            if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
            $("li.textrelise,.textrelise:empty").hide();
            var prod = vbStock[ei], isTabs = countModifiers(prod)>2;
            var tabs=[], rows=[],col=[],colMade = false;
            var ttitle = (typeof(__all[ei])!="undefined")?__all[ei].title:" no title";
            var turl = (typeof(__all[ei])!="undefined")?__all[ei].url:"#";
            $("body").append('<br /><h2><a href="'+turl+'" target="_blank">#'+ei+" "+ttitle+"</a></h2>")
            if(isTabs){
                var $tabs = $('<div id="p-tabs" class="features-table-new p-tabs"></div>').appendTo("body")//.insertAfter( ($("#p-tabs").length)?"#p-tabs":".features-table:first")
                    ,tabLinks = {},tables={},t=1;
                $tabs.html('').addClass("p-tab1");
                for(var k in prod){
                    tabLinks[k]='<a class="p-tab'+t+'" href="javascript:void(0);" onclick="{$(this).parent(\'#p-tabs\').attr(\'class\',\'p-tab'+t+'\').attr(\'data-val\',\''+k+'\');void(0);}"><input name="" class="tabData" value="'+k+'" /></a>';
                    for(var i in prod[k]){
                        var row = [];
                        row.push('<td class="grey" style="max-width:160px;padding:4px;">'+i+'</td>');
                        for(var j in prod[k][i]){
                            (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                            var price = parseFloat(prod[k][i][j]),
                                quantity = j.replace(/"/g,'\"');

                            // row.push('<td class="'+((price>0)?'grey1 ':'')+'" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'"  data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>');
                            row.push('<td class="'+((price>0)?'grey1 ':'')+'" data-prod="'+ei+'" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'"  data-price="'+price+'"><input name="" value="'+((isNaN(price)||price<0)?"&nbsp;":(price))+'"/></td>');
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
                var $table = $('<table class="features-table features-table-new"></table>').appendTo("body");
                for(var i in prod){
                    var row = [];
                    row.push('<td class="grey" style="max-width:160px;">'+i+'</td>');
                    for(var j in prod[i]){
                        (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                        var price = parseFloat(prod[i][j]);
                        // row.push('<td class="grey1" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'"  data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>');
                        // row.push('<td class="'+((price>0)?'grey1 ':'')+'selected-cell" data-type="" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+j.replace(/"/g,'\"')+'" onclick="vbSetCalculator(this)" data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>')
                        row.push('<td class="'+((price>0)?'grey1 ':'')+'selected-cell" data-type="" data-prod="'+ei+'" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+j.replace(/"/g,'\"')+'" onclick="vbSetCalculator(this)" data-price="'+price+'"><input name="" value="'+((isNaN(price)||price<0)?"&nbsp;":(price))+'"/></td>')
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
            $("body").append('<div style="width:100%;padding-right:2em;text-align:right;"><button class="save-button" onclick="save();">Сохранить</button></div>');
            $("body").append('<HR /><br />');
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
            var dd = {"24":{},"25":{},"29":{},"30":{},"31":{},"33":{},"34":{},"35":{},"37":{},"40":{},"41":{},"46":{},"47":{},"49":{},"51":{},"52":{},"53":{},"54":{},"77":{},"83":{},"88":{},"108":{},"117":{},"123":{},"124":{},"134":{},"160":{},"166":{},"177":{},"183":{},"184":{},"221":{},"230":{},"231":{},"232":{},"234":{},"290":{}};
            $(".grey1").each(function(){
                var $t = $(this),tt = $t.attr("data-type"),rr = $t.attr("data-row"); qq = $t.attr("data-quantity"), prod = $t.attr("data-prod"),pp={},p=$t.find("input").val();
                p=p.length?p:"-1";
                pp=dd[prod];
                if(tt.length){
                    pp[tt]=(typeof(pp[tt])=="undefined")?{}:pp[tt];
                    pp[tt][rr]=(typeof(pp[tt][rr])=="undefined")?{}:pp[tt][rr];
                    pp[tt][rr][qq]=p;
                }
                else {
                    pp[rr]=(typeof(pp[rr])=="undefined")?{}:pp[rr];
                    pp[rr][qq]=p;
                }
                // console.debug(pp);
                // dd[prod] = $.extend(pp,dd[prod]);
            });
            console.debug("save",dd);
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
    </script>
</body>
</html>
