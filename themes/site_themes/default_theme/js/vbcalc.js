"use strict";
window.vbStock={};
window.selectedCell = {};
Number.prototype.currency=function(){
    var r = this.valueOf().toFixed(2),a = r.toString().split(/\./),na = [],n = "",f = "";
    if (this.valueOf() >= 1000) {
        na = a[0].split("").reverse();
        var c = 3;
        for (var i in na) {n += na[i];if (--c <= 0) {n += " ";c = 3;}}
        r = n.split("").reverse().join("") + ((a.length > 1) ? ("." + a[1]) : "");
    }
    return r;
}
var __all = [24,25,29,30,31,33,34,35,37,40,41,46,47,49,51,52,53,54,77,83,88,108,117,123,124,134,160,166,177,183,184,221,230,231,232,234,290],
// var __all = [24,25,29,30,31,33,34,35,37,40,41,46,47,49,51,52,53,54,77,83,88,108,117,123,124,134,160,166,177,183,184,221,230,231,232,234],
    __cms = [24,25,30,35,49,51,52,124,134,160,230,234];
var countModifiers = function(prod){
    for(var i in prod){
        for(var j in prod[i]) return (!isNaN(prod[i][j])||(typeof(prod[i].prices)!="undefined"))?2:3;
    }
    return 0;
};
var vbBuildTable=function(ei){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    $("li.textrelise,.textrelise:empty").hide();
    var prod = vbStock[ei], isTabs = countModifiers(prod)>2;
    var tabs=[], rows=[],col=[],colMade = false;
    var drawRows = function(prow,key){
        var colMade = false,rows=[],col=[];
        key = (key==null || typeof(key)=="undefined")?"":key;
        // console.debug(prow);
        for(var i in prow){
            var row = [];
            if(typeof(prow[i].title)!="undefined"){
                var title = prow[i].title;
                title = (typeof(prow[i].image)!="undefined")?'<img alt="'+i+'" src="'+prow[i].image+'" width="100%"><br>'+title:title;
                row.push('<td class="grey" style="max-width:160px;">'+title+'</td>');

            }
            else row.push('<td class="grey" style="max-width:160px;">'+i+'</td>');
            var prices = (typeof(prow[i].prices)!="undefined")?prow[i].prices:prow[i];
            for(var j in prices){
                (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                var price = parseFloat(prices[j]),
                    quantity = j.replace(/"/g,'\"');
                row.push('<td class="'+((price>0)?'grey1 ':'')+'selected-cell" data-type="'+key+'" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+quantity+'" onclick="'+((price>0)?"vbSetCalculator(this)":'')+'" data-price="'+price+'">'+((isNaN(price)||price<0)?"&nbsp;":(price.currency()))+'</td>')
            }
            colMade=true;
            rows.push('<tr>'+row.join('')+'</tr>')
        }
        return [rows,col];
    }
    if(typeof(prod.options)!="undefined") return vbBuildBoxes(ei);
    if(isTabs){
        var $tabs = $('<div id="p-tabs" class="features-table-new"></div>').insertAfter( ($("#p-tabs").length)?"#p-tabs":".features-table:first")
            ,tabLinks = {},tables={},t=1;
        $tabs.html('').addClass("p-tab1");
        for(var k in prod){
            tabLinks[k]='<a class="p-tab'+t+'" href="javascript:{$(\'#p-tabs\').attr(\'class\',\'p-tab'+t+'\').attr(\'data-val\',\''+k+'\');void(0);}">'+k+'</a>';
            var dr = drawRows(prod[k],k);
            rows=dr[0];
            col = dr[1];
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
        var $table = $('<table class="features-table features-table-new"></table>').insertAfter(".features-table:first");
        var dr = drawRows(prod,null);
        rows=dr[0];
        col = dr[1];
        $table.html('');
        $table.append('<tr height="35"><td class="grey" rowspan="2">Формат, / тираж, шт.</td><td class="grey" colspan="'+col.length+'">Цена за единицу, руб.</td></tr>');
        $table.append('<tr height="35">'+col.join('')+'</tr>');
        $table.append(rows.join(''));
    }
    $(".features-table:not(.features-table-new),#p-tabs:not(.features-table-new)").remove();
    $("body").trigger("vb:tableLoaded");
};
var drawModifier=function(mod,itr){
    var $container = $("#product_modifiers"),ei = $('[name=entry_id]').val(),$c = $('<div class="p-row"></div>').appendTo($container),modNames=["Тип","Формат","Тираж"],
        options='', arrData = mod;
    arrData = (typeof(arrData.prices)!="undefined")?arrData.prices:mod;
    // console.debug("drawModifier",itr,arrData,mod);

    for(var i in arrData){
        if(i=="options")continue;
        // console.debug("drawModifier - ",i,arrData,mod);
        var re = /^\s*(A|А)\d+\s*$/;
        if(itr==2 && i.match(re))modNames[2]="Размерость";
        options+='<option>'+((typeof(arrData[i].title)!="undefined")?arrData[i].title:i)+'</option>';
    }
    $('<div class="p-label p-required">'+modNames[itr]+'</div>').appendTo($c);
    $c = $('<div class="p-value"></div>').appendTo($c);
    $c = $('<select id="'+(ei+"_"+itr)+'"  data-field="'+itr+'" data-name="'+modNames[itr]+'" class="p-modifiers-select-builded modifier_selecting " onchange="vbCalculate(true)" uid="'+ei+'" required></select>').appendTo($c);
    $c.append(options);
}
var vbBuildCalculator=function(ei){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    var $container = $("#product_modifiers"),itr=0,prod = vbStock[ei], isTabs = countModifiers(prod)>=3;
    $container.find('.p-row').hide();
    itr+=(isTabs)?0:1;
    drawModifier(prod,itr);
    itr+=1;
    for(var i in prod){
        drawModifier(prod[i],itr);
        itr+=1;
        if(isTabs){
            for(var j in prod[i]){
                // drawModifier(prod[i][j],itr++);
                drawModifier(prod[i][j],itr);
                break;
            }
        }
        break;
    }
    $container.append('<div class="p-row"><div class="p-label">Комментарий</div><div class="p-value"><input type="text" id="comment" value="" class="p-modifiers-input" onchange="vbCalculate(true)"/></div></div>')
    $("body").trigger("vb:calculatorLoaded");
}
var vbRebuildCalculator = function(prod,ei,itr,manual){
    var eid = "#"+ei+"_"+itr.toString(),was = $(eid).val(),
        arrData = (typeof(prod)!="undefined" && typeof(prod.prices)!="undefined")?prod.prices:prod;
    if(!$(eid).length)return;
    $(eid).html('');
    for(var j in arrData){
        var wasSelected = false;
        // if(manual)wasSelected = (was==j && arrData[j]!=-1);
        if(manual)wasSelected = (was==j);
        else if(typeof(selectedCell["d"+itr])!="undefined" && selectedCell["d"+itr]==j)wasSelected=true;
        // $(eid).append('<option'+((wasSelected || (arrData[j]!=-1))?' selected="selected"':'')+'>'+j+'</option>');
        $(eid).append('<option'+((wasSelected)?' selected="selected"':'')+'>'+j+'</option>');
    }
};
var vbCalculate=function(){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[$('[name=entry_id]').val()])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    var ei = $('[name=entry_id]').val(),stock = vbStock[ei],qty = 1,total=0,data="", isTabs = countModifiers(stock)>=3, itr=isTabs?0:1,manual = arguments.length&&arguments[0]==true?true:false;
    $(".p-modifiers-select-builded").each(function(){
        var $t = $(this),n=$t.attr("data-name"),v=$t.val();
        while(v==-1){
            $t=$(this).find(":selected").next().attr("selected","selected");
            n=$t.attr("data-name");
            v=$t.val();
        }
        // console.debug(stock,n,v);
        itr++;
        data+=n+": "+v+"<br>";
        // stock = stock[v];
        stock = ( (typeof(stock.prices)!="undefined") && (typeof(stock.prices[v])!="undefined")) ?stock.prices[v]:stock[v];
        console.debug(stock,' -> ',v);
        vbRebuildCalculator(stock,ei,itr,manual);
        if(n=="Тираж")qty = parseInt(v.replace(/\D/ig,""));

    });
    total = parseFloat(stock)*qty;
    console.debug(total,qty);
    if($("#comment").val().length)data+="Комментарий: "+$("#comment").val()+"<br/>";
    //data= "Параметры заказа:"+data;
    $("[data-name=price]").val(total.toFixed(2));
    $("[data-name=data]").val(data);
    $("[name=item_qty]").val(qty);
    $("#p_total_price").text(total.currency());
}
var vbSetCalculator = function(t){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[$('[name=entry_id]').val()])=="undefined")  {console.debug("no entry_id defined in  vbStock");return;}
    var $t =$(t),f1 = $t.attr("data-row"),f2 = $t.attr("data-quantity"), f0 = $t.attr("data-type"),pr = $t.attr('data-price');
    selectedCell = {
        t:f0,
        f:f1,
        q:f2,
        price:pr,
        d0:f0,
        d1:f1,
        d2:f2
    }
    // console.debug(t,$t,selectedCell);
    $(".calc_order:first").click();
}
var vbBuildBoxes = function(ei){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    if(typeof(vbStock[ei].options)=="undefined")  {console.debug("no options "+ei+" defined in vbStock["+ei+"]");return;}
    var prod = vbStock[ei], isTabs = prod.options.tabs,drawBox=function(r,t,d){
        var s = '<div class="productblock productblock-new">',fprice = null;
        s+= '<div class="image"><img src="'+d.image+'" alt="'+d.title+'" title="'+d.title+'" style="max-height:154px;width:auto;"></div>';
        // s+= '<div class="image"><img src="'+d.image+'" alt="'+d.title+'" title="'+d.title+'" width="100%"></div>';
        // s+= '<div class="title"><div class="razm">Размеры:</div> длина 9,5 см, ширина 3,5 см, высота 2,5 см</div>';
        s+= '<div class="title">'+d.title+'</div>';
        s+= '<div class="description">'+t+'</div>';
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
        s+= '<a class="selected-cell" href="javascript:void(0);" onclick="vbSetCalculator(this);" data-type="'+r+'" data-row="'+t+'" data-quantity="'+fprice.title+'" data-price="'+fprice.price+'" style="text-decoration: none;"><div class="cart">&nbsp;</div></a>'
        s+='</div>';
        return s;
    };

    if(isTabs){
        var $content = $('<div id="p-tabs" class="features-table-new p-tab1"></div>').insertAfter( ($("#p-tabs").length)?"#p-tabs":".features-table:first"),t=1,
            tabBoxes=[], tabs=[];
        for(var k in prod){
            if(k=="options")continue;
            var boxes = [];
            for(var r in prod[k])boxes.push(drawBox(k,r,prod[k][r]));
            tabs.push('<a class="p-tab'+t+'" href="javascript:{$(\'#p-tabs\').attr(\'class\',\'p-tab'+t+'\').attr(\'data-val\',\''+k+'\');void(0);}">'+k+'</a>');
            tabBoxes.push('<div class="p-tab'+t+'">'+boxes.join('')+'</div>');
            ++t;
        }
        $content.append(tabs.join(''));
        $content.append(tabBoxes.join(''));
        console.debug($content);
    }else{
        var $content = $('<div class="p-tab1">'+'</div>').insertAfter(".features-table:first"),
            boxes = [];
        for(var r in prod)boxes.push(drawBox("",r,prod[r]));
        $content.append(boxes.join(''));
    }
    $(".features-table:not(.features-table-new),#p-tabs:not(.features-table-new),.productblock:not(.productblock-new)").remove();
    $("body").trigger("vb:tableLoaded");
}

$("body").on("vb:stockLoaded",function(e,d){
    var ei = $("[name=entry_id]").val();
    if(typeof(ei)!="undefined"){
        // console.debug('Build new tables by '+ei);
        vbBuildTable(ei);
        $("body").unbind("vb:stockLoaded");
    }
});
$("body").on("vb:tableLoaded", function(e) {
    $('.grey1').hover(function() {
        var p = $(this).closest('td').prevAll().length,greyqty = $(this).parent().find("td.grey").length;
        $(this).parent().find("td.grey1").css("background-color", "rgba(151, 189, 227,1)");
        $(this).parent().find("td:nth-child("+greyqty+")").css("background-color", "#d3dff1");

        $(this).parent().parent().find("tr td.grey1:nth-child(" + (p + 1) + ")").css("background-color", "rgba(151, 189, 227,1)");
        $(this).parent().parent().find("tr:nth-child(2) td:nth-child(" + (p+1-greyqty)+ ")").css("background-color", "#d3dff1");
        $(this).css("background-color", "#1175bc").css("color", "#ffffff");
    }, function() {
        var p = $(this).closest('td').prevAll().length,greyqty = $(this).parent().find("td.grey").length;
        $(this).parent().find("td.grey1").css("background-color", "#d3dff1");
        $(this).parent().find("td:nth-child("+greyqty+")").css("background-color", "#97bde3");

        $(this).parent().parent().find("tr td.grey1:nth-child(" + (p + 1) + ")").css("background-color", "#d3dff1");
        $(this).parent().parent().find("tr:nth-child(2) td:nth-child(" + (p+1-greyqty) + ")").css("background-color", "#97bde3");
    });
});
$("body").on("vb:calculatorLoaded", function(e) {
    // console.debug(selectedCell);
    $(".p-modifiers-select-builded option:contains('"+selectedCell.t+"'):first").attr("selected","selected");
    $(".p-modifiers-select-builded option:contains('"+selectedCell.f+"'):first").attr("selected","selected");
    $(".p-modifiers-select-builded option:contains('"+selectedCell.q+"'):first").attr("selected","selected");
    vbCalculate();
    //$("body").unbind("vb:calculatorLoaded");
    $(".p-modifiers-input").on("keyup change blur",function(e){
        var label = $(this).closest(".p-row"),val = $(this).val();
        if(val.length)label.removeClass("p-empty");
        else label.addClass("p-empty");
    });
});
//start trigger
$.getJSON("/themes/site_themes/default_theme/vbstock.json",function(d){
    // console.debug(d);
    window.vbStock = d;
    $("body").trigger("vb:stockLoaded",[d]);
});
