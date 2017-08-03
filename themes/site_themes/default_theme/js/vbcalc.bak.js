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
// var getAcceptedEntries = function(){
//     return ["30","134","49","123"];
// }

var vbBuildTable=function(ei){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    var prod = vbStock[ei],countModifiers = function(prod){
        for(var i in prod){
            for(var j in prod[i]) return (!isNaN(prod[i][j]))?2:3;
        }
        return 0;
    }, isTabs = countModifiers(prod)>2;
    console.debug(countModifiers(prod));
    var $table = $(".features-table"),$tabs = $("#p-tabs"),tabs=[], rows=[],col=[],colMade = false;
    if(isTabs){
        var tabLinks = {},tables={},t=1;
        $tabs.html('').attr("class","p-tab1");
        for(var k in prod){
            tabLinks[k]='<a class="p-tab'+t+'" href="javascript:{$(\'#p-tabs\').attr(\'class\',\'p-tab'+t+'\').attr(\'data-val\',\''+k+'\');void(0);}">'+k+'</a>';
            for(var i in prod[k]){
                var row = [];
                row.push('<td class="grey" style="max-width:160px;padding:4px;">'+i+'</td>');
                for(var j in prod[k][i]){
                    (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                    var price = parseFloat(prod[k][i][j]);
                    row.push('<td class="grey1" data-type="'+k+'"data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+j.replace(/"/g,'\"')+'" onclick="vbSetCalculator(this)">'+(isNaN(price)?"&nbsp;":(price.currency()+' руб.'))+'</td>')
                }
                colMade=true;
                rows.push('<tr>'+row.join('')+'</tr>')
            }
            tables[t] = '<div class="p-tab'+t+'"><table class="features-table">\
                <tr height="35"><td class="grey" rowspan="2">Формат, / тираж, шт.</td><td class="grey" colspan="'+col.length+'">Цена за единицу</td></tr>\
                <tr height="35">'+col.join('')+'</tr>'
                +rows.join('')+
                '</table></div>';
            rows=[];
            t++;
        }
        for(var i in tabLinks)$tabs.append(tabLinks[i]);
        for(var i in tables)$tabs.append(tables[i]);
    }
    else {
		var x = 0;
        for(var i in prod){
			x++;
            var row = [];
            row.push('<td class="grey" style="max-width:160px;"><a href="http://www.giprint.ru/images/uploads/x'+x+'.jpg" rel="fancybox1" title="Нажмите, чтобы посмотреть фото бирки" style="color:#FFF;text-decoration:none;">'+i+'</a></td>');
            for(var j in prod[i]){
                (!colMade)?col.push('<td class="grey">'+j+'</td>'):{};
                var price = parseFloat(prod[i][j]);
                row.push('<td class="grey1 selected-cell" data-type="" data-row="'+i.replace(/"/g,'\"')+'" data-quantity="'+j.replace(/"/g,'\"')+'" onclick="vbSetCalculator(this)" data-price="'+price+'">'+(isNaN(price)?"&nbsp;":(price.currency()+' руб.'))+'</td>')
            }
            colMade=true;
            rows.push('<tr>'+row.join('')+'</tr>')
        }
        //console.debug(rows.join(' '));
        $table.html('');
        $table.append('<tr height="35"><td class="grey" rowspan="2">Формат, / тираж, шт.</td><td class="grey" colspan="'+col.length+'">Цена за единицу</td></tr>');
        $table.append('<tr height="35">'+col.join('')+'</tr>');
        $table.append(rows.join(''));
    }
    $("body").trigger("vb:tableLoaded");
};
var vbBuildCalculator=function(ei){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[ei])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    var $container = $("#product_modifiers"),itr=0,prod = vbStock[ei],countModifiers = function(prod){
        for(var i in prod){
            for(var j in prod[i]) return (!isNaN(prod[i][j]))?2:3;
        }
        return 0;
    }, isTabs = countModifiers(prod)>=3,modNames=["Тип","Формат","Тираж"],drawModifier=function(mod,itr){
        var $c = $('<div class="p-row"></div>').appendTo($container);
        $('<div class="p-label p-required">'+modNames[itr]+'</div>').appendTo($c);
        $c = $('<div class="p-value"></div>').appendTo($c);
        //$c = $('<select id="'+(ei+"_"+itr)+'" name="'+modNames[itr]+'" data-name="'+modNames[itr]+'" class="p-modifiers-select modifier_selecting " uid="'+ei+'" required></select>').appendTo($c);
        $c = $('<select id="'+(ei+"_"+itr)+'"  data-field="'+itr+'" data-name="'+modNames[itr]+'" class="p-modifiers-select-builded modifier_selecting " onchange="vbCalculate()" uid="'+ei+'" required></select>').appendTo($c);
        for(var i in mod){
            $c.append('<option>'+i+'</option>');
        }
    };
    $container.find('.p-row').hide();
    itr+=(isTabs)?0:1;
    drawModifier(prod,itr);
    itr+=1;
    for(var i in prod){
        drawModifier(prod[i],itr);
        itr+=1;
        if(isTabs){
            for(var j in prod[i]){
                drawModifier(prod[i][j],itr++);
                break;
            }
        }
        break;
    }
    $container.append('<div class="p-row"><div class="p-label">Комментарий</div><div class="p-value"><input type="text" id="comment" value="" class="p-modifiers-input" /></div></div>')
    $("body").trigger("vb:calculatorLoaded");
}
var vbCalculate=function(){
    if(typeof(vbStock)=="undefined") {console.debug("no vbStock defined");return;}
    if(typeof(vbStock[$('[name=entry_id]').val()])=="undefined")  {console.debug("no "+ei+" defined in  vbStock");return;}
    var stock = vbStock[$('[name=entry_id]').val()],qty = 1,total=0,data="";
    $(".p-modifiers-select-builded").each(function(){
        var $t = $(this),n=$t.attr("data-name"),v=$t.val();
        data+=v+"; ";
        stock = stock[v];
        if(n=="Тираж")qty = parseInt(v.replace(/\D/ig,""));
        //console.debug(stock,n,v);
    });
    total = parseFloat(stock)*qty;
    //console.debug(total,qty);
    data+="Комментарий:"+$("#comment").val()+"; ";
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
        price:pr
    }
    $(".calc_order").click();
}

$("body").on("vb:stockLoaded",function(e,d){
    var ei = $("[name=entry_id]").val();
    console.debug('Build new tables by '+ei);
    vbBuildTable(ei);
    $("body").unbind("vb:stockLoaded");
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
    console.debug(selectedCell);
    $(".p-modifiers-select-builded option:contains('"+selectedCell.t+"'):first").attr("selected","selected");
    $(".p-modifiers-select-builded option:contains('"+selectedCell.f+"'):first").attr("selected","selected");
    $(".p-modifiers-select-builded option:contains('"+selectedCell.q+"'):first").attr("selected","selected");
    vbCalculate();
    //$("body").unbind("vb:calculatorLoaded");
});
//start trigger
$.getJSON("/themes/site_themes/default_theme/vbstock.json",function(d){
    console.debug(d);
    window.vbStock = d;
    $("body").trigger("vb:stockLoaded",[d]);
});
